<?php

namespace Inc\Api;

use Exception;
use WP_Error;
use WP_REST_Response;
use WP_User;

class User
{
    public function register()
    {
        // add_action('rest_api_init', [$this, 'generateUserEndpoint']);
        // add_action('rest_api_init', [$this, 'generateUserStepTwoEndpoint']);
        // add_action('plugins_loaded', [$this, 'whiteListRegisterEndpoint']);

        // Senza Solutionss
        add_action('wp_ajax_mbm_new_user_register', [$this, 'createuser']); // Create User Step-1
        add_action('wp_ajax_nopriv_mbm_new_user_register', [$this, 'createuser']); // Create User Step-1

        add_action('wp_ajax_mbm_resending_email', [$this, 'resendingemail']); // Resending Email Step-2
        add_action('wp_ajax_nopriv_mbm_resending_email', [$this, 'resendingemail']); // Resending Email Step-2
        add_action('wp_ajax_mbm_email_validate', [$this, 'emailvalidate']); // Email Verification Step-2
        add_action('wp_ajax_nopriv_mbm_email_validate', [$this, 'emailvalidate']); // Email Verification Step-2

        add_action('wp_ajax_company_related_infomation', [$this, 'companyrelatedinfomation']); // Company Information Step-3
        add_action('wp_ajax_nopriv_company_related_infomation', [$this, 'companyrelatedinfomation']); // Company Information Step-3

        add_action('wp_ajax_company_infomation', [$this, 'companyinfomation']); // Company Information Step-4
        add_action('wp_ajax_nopriv_company_infomation', [$this, 'companyinfomation']); // Company Information Step-4

        add_action('wp_ajax_company_contact_details', [$this, 'companycontactdetails']); // Company Contact Details Step-5
        add_action('wp_ajax_nopriv_company_contact_details', [$this, 'companycontactdetails']); // Company Contact Details Step-5

        add_action('wp_ajax_company_personal_infomation', [$this, 'companypersonalinfomation']); // Company Contact Details Step-6
        add_action('wp_ajax_nopriv_company_personal_infomation', [$this, 'companypersonalinfomation']); // Company Contact Details Step-6

        add_action('wp_ajax_memberpress_sign_up', [$this, 'memberpresssignup']); // Membership Details Step-7
        add_action('wp_ajax_nopriv_memberpress_sign_up', [$this, 'memberpresssignup']); // Membership Details Step-7 

        add_action('wp_ajax_memberpress_final_sign_up', [$this, 'membershipfinalstep']); // Membership Final Details Step-8
        add_action('wp_ajax_nopriv_memberpress_final_sign_up', [$this, 'membershipfinalstep']); // Membership Final Details Step-8
    }

    // Create User Function By Senza Step - 1
    public function createuser()
    {
        $response = [];
        $array = array();
        parse_str($_POST['formdata'], $array);
        $server_url = "https://" . $_SERVER['SERVER_NAME'];

        $firstname = $array['firstname'];
        $lastname = $array['lastname'];
        $username = $array['email'];
        $email = $array['email'];
        $password = $array['password'];
        $terms = $array['terms'];

        if (empty($firstname)) {
            $response['error'][] = __("FirstName field 'FirstName' is required.", 'wp-rest-user');
        }
        if (empty($lastname)) {
            $response['error'][] = __("Lastname field 'LastName' is required.", 'wp-rest-user');
        }
        if (empty($email)) {
            $response['error'][] = __("Email field 'Email' is required.", 'wp-rest-user');
        }
        if (empty($password)) {
            $response['error'][] = __("Password field 'Password' is required.", 'wp-rest-user');
        }

        if (!empty($response['error'])) {
            $response['status'] = 400;
        } else {
            $user_id = username_exists($username);
            if (!$user_id) {
                $userdata = array(
                    'user_login' =>  $username,
                    'user_pass'  =>  $password,
                    'user_email' => $email,
                    'user_nicename' => $firstname . ' ' . $lastname,
                    'display_name' => $firstname . ' ' . $lastname
                );
                $user_id = wp_insert_user($userdata);
                if (!is_wp_error($user_id)) {
                    $code = md5(time());
                    $string = array('id' => $user_id, 'code' => $code);

                    // Ger User Meta Data (Sensitive, Password included. DO NOT pass to front end.)
                    $user = get_user_by('id', $user_id);
                    $user->set_role('subscriber');
                    update_user_meta($user_id, 'first_name', $firstname);
                    update_user_meta($user_id, 'last_name', $lastname);

                    update_user_meta($user_id, 'account_activated', 0);
                    update_user_meta($user_id, 'activation_code', $code);

                    if (!empty($terms)) {
                        update_user_meta($user_id, "company_term_condition", $terms);
                    } else {
                        $terms = "NO";
                        update_user_meta($user_id, "company_term_condition", $terms);
                    }

                    $curl = curl_init();

                    curl_setopt_array($curl, array(
                        CURLOPT_URL => $server_url . '/wp-json/jwt-auth/v1/token',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => array('username' => $username, 'password' => $password),
                    ));
                    $token = curl_exec($curl);
                    curl_close($curl);
                    $token = json_decode($token);
                    $token = $token->data->token;
                    update_user_meta($user_id,'token_authorizer',$token);

                    $url = add_query_arg(
                        array(
                            'user_id' => $user_id,
                            'token' => $token,
                            'verification_code' => base64_encode(serialize($string))
                        ),
                        home_url('/sign-up')
                    );

                    $subject = __('New User Activation Email');
                    $html = 'Hi ' . $firstname . ',
                             We are happy you signed up for MBMPRIME. To Start exploring the MBMPRIME and neighborhood, please confirm your email address.
                                ' . $url . '';
                    $html = '
                            <html>
                                <body>
                                    <h1>Hi ' . $firstname . ',</h1>
                                    <div>
                                        <p>We are happy you signed up for MBMPRIME. To Start exploring the MBMPRIME and neighborhood, please confirm your email address.</p>
                                        <a href = "' . $url . '"><button>Verify Now</button></a>
                                    </div></br></br>

                                    <div> Welcome to MBMPRIME!</div>
                                    <div> The MBMPRIME Team </div>
                                    <div>Did you receive this email without signing up? <a href="' . $url . '"> Click here </a>This verification link will expire in 24 hours.
                                <body>
                            </html>
                    ';
                    $headers = array('Content-Type: text/html; charset=UTF-8');

                    if (wp_mail($email, $subject, $html, $headers)) {
                        // Ger User Data (Non-Sensitive, Pass to front end.)
                        $response['message'] = __("User '" . $firstname . "' Registration was Successful and verification email send to your email. To activate your account please verify your identity", "wp-rest-user");
                        $response['user_id'] = $user_id;
                        $response['link'] =  $url;
                        $response['verification_code'] = base64_encode(serialize($string));
                        $response['token'] = $token;
                        $response['status'] = 200;
                    } else {
                        $response['error'][] = __("Error while sending the verification email please try after sometime", "wp-rest-user");
                        $response['status'] = 400;
                    }
                } else {
                    $response['error'][] = __("Error while creating user please try after sometime", "wp-rest-user");
                    $response['status'] = 400;
                }
            } else {
                $response['error'][] = __("User '" . $firstname . "' Already exist in system", "wp-rest-user");
                $response['status'] = 400;
            }
        }
        echo json_encode($response);
        wp_die();
    }

    // Resending Email By Senza Step - 2
    public function resendingemail()
    {
        $response = [];
        $user_id = $_POST['formdata'];
        $user_info = get_userdata($user_id);
        $user_token = get_user_meta($user_id);
        $email = $user_info->user_email;
        $tokenizer = $user_token['token_authorizer'][0];
        $firstname = $user_token['first_name'][0];

        $code = md5(time());
        $string = array('id' => $user_id, 'code' => $code);
        update_user_meta($user_id, 'account_activated', 0);
        update_user_meta($user_id, 'activation_code', $code);

        $url = add_query_arg(
            array(
                'user_id' => $user_id,
                'token' => $tokenizer,
                'verification_code' => base64_encode(serialize($string))
            ),
            home_url('/sign-up')
        );

        $subject = __('New User Activation Email');
        $html = '
        <html>
            <body>
                <h1>Hi ' . $firstname . ',</h1>
                <div>
                    <p>We are happy you signed up for MBMPRIME. To Start exploring the MBMPRIME and neighborhood, please confirm your email address.</p>
                    <a href = "' . $url . '"><button>Verify Now</button></a>
                </div></br></br>

                <div> Welcome to MBMPRIME!</div>
                <div> The MBMPRIME Team </div>
                <div>Did you receive this email without signing up? <a href="' . $url . '"> Click here </a>This verification link will expire in 24 hours.
            <body>
        </html>';
        $headers = array('Content-Type: text/html; charset=UTF-8');

        if (wp_mail($email, $subject, $html, $headers)) {
            // Ger User Data (Non-Sensitive, Pass to front end.)
            $response['message'] = __("User '" . $email . "' Registration was Successful and verification email send to your email. To activate your account please verify your identity", "wp-rest-user");
            $response['user_id'] = $user_id;
            $response['verification_code'] = base64_encode(serialize($string));
            $response['status'] = 200;
        } else {
            $response['error'][] = __("Error while creating user please try after sometime", "wp-rest-user");
            $response['status'] = 400;
        }
        echo json_encode($response);
        wp_die();
    }

    // Email Verification By Senza Step - 2
    public function emailvalidate()
    {
        $response = [];
        $data = unserialize(base64_decode($_POST['formdata']));
        $code = get_user_meta($data['id'], 'activation_code', true);
        if ($code == $data['code']) {
            update_user_meta($data['id'], 'is_activated', 1);
            $response['message'] = __('Your account has been activated!!', 'text-domain');
            $response['status'] = 200;
        } else {
            $response['error'][] = __("Error while creating user please try after sometime", "wp-rest-user");
            $response['status'] = 400;
        }
        echo json_encode($response);
        wp_die();
    }

    // Company Related Information By Senza Step - 3
    public function companyrelatedinfomation()
    {
        $response = [];
        $array = array();
        parse_str($_POST['formdata'], $array);

        $Title = $array['Title'];
        $Role = strtolower($array['Role']);
        $SocioeconomicCategory = $array['SocioeconomicCategory'];
        $Businessentity = $array['Businessentity'];
        $current_user_id = $array['current_user_id'];

        if (empty($Title)) {
            $response['error'][] = __("Title field 'Title' is required.", 'wp-rest-user');
        }
        if (empty($Role)) {
            $response['error'][] = __("Role field 'Role' is required.", 'wp-rest-user');
        }
        if (empty($SocioeconomicCategory)) {
            $response['error'][] = __("SocioeconomicCategory field 'SocioeconomicCategory' is required.", 'wp-rest-user');
        }
        if (empty($Businessentity)) {
            $response['error'][] = __("Businessentity field 'Businessentity' is required.", 'wp-rest-user');
        }

        if (!empty($response['error'])) {
            $response['status'] = 400;
        } else {
            $userr = get_user_by('id', $current_user_id);
            $userr->set_role($Role);

            update_user_meta($current_user_id, "company_title", $Title);
            update_user_meta($current_user_id, "company_socioeconomicCategory", $SocioeconomicCategory);
            update_user_meta($current_user_id, "company_businessEntity", $Businessentity);

            $response['message'] = __("This Step Is Successfully Done.", "wp-rest-user");
            $response['status'] = 200;
        }
        echo json_encode($response);
        wp_die();
    }

    // Company Related Information By Senza Step - 4
    public function companyinfomation()
    {
        $response = [];
        $array = array();
        parse_str($_POST['formdata'], $array);

        $current_user_id = $array['current_user_id'];
        $companyname = $array['companyname'];
        $CompanyIndustry = $array['CompanyIndustry'];
        $website = $array['website'];
        $CompanyObjectives = $array['CompanyObjectives'];
        $Company_Website_Link = $array['web'];

        if (empty($companyname)) {
            $response['error'][] = __("CompanyName field 'CompanyName' is required.", 'wp-rest-user');
        }
        if (empty($CompanyIndustry)) {
            $response['error'][] = __("CompanyIndustry field 'CompanyIndustry' is required.", 'wp-rest-user');
        }

        if (!empty($response['error'])) {
            $response['status'] = 400;
        } else {
            update_user_meta($current_user_id, "company_name", $companyname);
            update_user_meta($current_user_id, "company_industry", $CompanyIndustry);

            if (!empty($website)) {
                update_user_meta($current_user_id, "company_have_website", $website);
                if (empty($Company_Website_Link)) {
                    $response['error'][] = __("Company Website Link field 'Company Website Link' is required.", 'wp-rest-user');
                }
                update_user_meta($current_user_id,"company_website_link",$Company_Website_Link);
            } else {
                $website = "NO";
                update_user_meta($current_user_id, "company_have_website", $website);
            }
            if (!empty($CompanyObjectives)) {
                update_user_meta($current_user_id, "company_objectives", $CompanyObjectives);
            } else {
                $CompanyObjectives = "NO";
                update_user_meta($current_user_id, "company_objectives", $CompanyObjectives);
            }
            $response['message'] = __("This Step Is Successfully Done.", "wp-rest-user");
            $response['status'] = 200;
        }
        echo json_encode($response);
        wp_die();
    }

    // Company Related Information By Senza Step - 5
    public function companycontactdetails()
    {
        $response = [];
        $array = array();
        parse_str($_POST['formdata'], $array);

        $current_user_id = $array['current_user_id'];
        $Country = $array['Country'];
        $Contact = $array['Contact'];
        $dialcode = $_POST['dialcode'];
        $Contact = $dialcode . $Contact;
        $federalopportunities = $array['federalopportunities'];

        if (empty($Country)) {
            $response['error'][] = __("Country field 'Country' is required.", 'wp-rest-user');
        }
        if (empty($Contact)) {
            $response['error'][] = __("Contact field 'Contact' is required.", 'wp-rest-user');
        }

        if (!empty($response['error'])) {
            $response['status'] = 400;
        } else {
            update_user_meta($current_user_id, "company_country", $Country);
            update_user_meta($current_user_id, "company_contact", $Contact);

            if ($Country == "United_States") {
                if (!empty($federalopportunities)) {
                    update_user_meta($current_user_id, "company_federal_oppprtunities", $federalopportunities);
                } else {
                    $federalopportunities = "NO";
                    update_user_meta($current_user_id, "company_federal_oppprtunities", $federalopportunities);
                }
            }
            $response['message'] = __("This Step Is Successfully Done.", "wp-rest-user");
            $response['status'] = 200;
        }
        echo json_encode($response);
        wp_die();
    }

    // Company Related Information By Senza Step - 6
    public function companypersonalinfomation()
    {
        $response = [];
        $array = array();
        parse_str($_POST['formdata'], $array);

        $current_user_id = $array['current_user_id'];
        $company_address = $array['address'];
        $company_city = $array['city'];
        $company_zip = $array['zip'];
        $company_state = $array['state'];
        $company_description = $array['companydescription'];
        $company_year_of_creation = $array['year_of_creation'];
        $company_no_of_employees = $array['no_of_employees'];
        $comapany_business_certifications = $array['BusinessCertifications'];
        $company_revenue = $array['Revenue'];
        $company_image = $array['image_id'];
        $company_broucher = $array['broucher_id'];
        $company_logo = $array['logo_id'];

        $company_image = wp_get_attachment_image_url($company_image, '');
        $company_broucher = wp_get_attachment_url($company_broucher, '');
        $company_logo = wp_get_attachment_image_url($company_logo, '');

        update_user_meta($current_user_id, "company_address", $company_address);
        update_user_meta($current_user_id, "company_city", $company_city);
        update_user_meta($current_user_id, "company_zip", $company_zip);
        update_user_meta($current_user_id, "company_state", $company_state);
        update_user_meta($current_user_id, "company_description", $company_description);
        update_user_meta($current_user_id, "company_year_of_creation", $company_year_of_creation);
        update_user_meta($current_user_id, "company_no_of_employees", $company_no_of_employees);
        update_user_meta($current_user_id, "comapany_business_certifications", $comapany_business_certifications);
        update_user_meta($current_user_id, "company_revenue", $company_revenue);
        update_user_meta($current_user_id, "company_image", $company_image);
        update_user_meta($current_user_id, "company_broucher", $company_broucher);
        update_user_meta($current_user_id, "company_logo", $company_logo);

        $response['message'] = __("This Step Is Successfully Done.", "wp-rest-user");
        $response['status'] = 200;

        echo json_encode($response);
        wp_die();
    }

    // Memberpress Signup By Senza Step - 7
    public function memberpresssignup()
    {
        $response = [];
        $array = array();
        parse_str($_POST['formdata'], $array);
        $server_url = "https://" . $_SERVER['SERVER_NAME'];

        $user_id = $array['current_user_id'];
        $user_data = get_userdata($user_id);
        $first_name = get_user_meta($user_id, 'first_name', true);
        $last_name = get_user_meta($user_id, 'last_name', true);
        $token = $array['current_user_token'];
        $user_name = $user_data->user_login;

        $membership_id = $array['membership_id'];
        $pending_str   = 'pending';
        $memberpressdata = get_post_meta($membership_id);
        $memberpress_price = $memberpressdata['_mepr_product_price'][0];
        $memberpress_preiod = $memberpressdata['_mepr_product_period'][0];
        $memberpress_preiod_type =  $memberpressdata['_mepr_product_period_type'][0];
        $memberpress_limit_expires_after = $memberpressdata['_mepr_product_limit_cycles_expires_after'][0];
        $memberpress_limit_expires_type =  $memberpressdata['_mepr_product_limit_cycles_expires_type'][0];
        $memberpress_limit_cycles_action  = $memberpressdata['_mepr_product_limit_cycles_action'][0];
        $memberpress_product_trial_days = $memberpressdata['_mepr_product_trial_days'][0];
        $memberpress_product_trial_amount = $memberpressdata['_mepr_product_trial_amount'][0];
        $memberpress_tax_class = $memberpressdata['_mepr_tax_class'][0];
        $memberpress_product_limit_cycles_num = $memberpressdata['_mepr_product_limit_cycles_num'][0];

        $gateway = "r7cwmn-1pi";  // Static
        $txn_type = "payment";    // static
        $current_date = date("Y-m-d H:i:s");

        global $wpdb;
        $mebr_events = 'wp_mepr_events';

        // ==================== Create Member...
        $url = $server_url . '/wp-json/mp/v1/members';
        $ch = curl_init($url);
        $data_string = json_encode(
            [
                'first_name'          => $first_name,
                'last_name'           => $last_name,
                'email'               => $user_name,
                'username'            => $user_name,
                'send_welcome_email'  => false, // Trigger a welcome email - this only works if adding a transaction (below)
                'transaction'         => [
                    'membership'  => $membership_id, // ID of the Membership
                    'amount'      => $memberpress_price,
                    'total'       => $memberpress_price,
                    'tax_amount'  => '0.00',
                    'tax_rate'    => '0.000',
                    'trans_num'   => 'mp-txn-' . uniqid(),
                    'status'      => 'complete',
                    'gateway'     => 'free',
                    'created_at'  => gmdate('c'),
                    'expires_at'  => '0000-00-00 00:00:00'
                ]
            ]
        );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'MEMBERPRESS-API-KEY: SFg73JOVC5',
            'Authorization: Bearer ' . $token . '',
            'Content-Type: application/json'
        ));
        $meb_response = curl_exec($ch);
        if (curl_errno($ch)) {
            throw new Exception(curl_error($ch));
        }
        // echo $meb_response;
        curl_close($ch);
        $response['member'] = __("You are added in the memberlist of Membership", "wp-rest-user");
        // ==================== End Of Member .....

        // ==================== Create Subscriptions .....
        $url = $server_url . '/wp-json/mp/v1/subscriptions';
        $curl =  curl_init($url);
        $subscr = json_encode(
            [
                'subscr_id'           => 'mp-sub-' . uniqid(),
                'response'            => '',
                'gateway'             => $gateway,
                'user_id'             => $user_id,
                'product_id'          => $membership_id,
                'coupon_id'           => 0,
                'price'               => $memberpress_price,
                'tax_amount'          => 0.00,
                'tax_rate'            => 0.00,
                'tax_desc'            => '',
                'period'              => $memberpress_preiod,
                'period_type'         => $memberpress_preiod_type,
                'limit_cycles'        => false,
                'limit_cycles_num'    => $memberpress_product_limit_cycles_num,
                'limit_cycles_action' => $memberpress_limit_cycles_action,
                'trial'               => 0,
                'trial_days'          => $memberpress_product_trial_days,
                'trial_amount'        => $memberpress_product_trial_amount,
                'status'              => $pending_str,
                'created_at'          => $current_date,
                'total'               => $memberpress_price,
                'cc_last4'            => null,
                'cc_exp_month'        => null,
                'cc_exp_year'         => null,
            ]
        );
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_POSTFIELDS, $subscr);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'MEMBERPRESS-API-KEY: SFg73JOVC5',
            'Authorization: Bearer ' . $token . '',
            'Content-Type: application/json'
        ));
        $sub_response = curl_exec($curl);
        if (curl_errno($curl)) {
            throw new Exception(curl_error($curl));
        }
        // echo $sub_response;
        curl_close($curl);
        $sub_array = array();
        $sub_array = json_decode($sub_response, true);
        $subscription_id = $sub_array['id'];
        $response['subscription'] = __("Your subscription is in progress.", "wp-rest-user");

        $results = $wpdb->get_results("SELECT max(evt_id) from $mebr_events where event='subscription-created' ");
        $evt_id = json_encode($results, true);
        $evt_id = json_decode($evt_id, true);
        $evt_id = $evt_id[0]['max(evt_id)'] + 1;

        $wpdb->insert($mebr_events, array('event' => "subscription-created", 'args' => '', 'evt_id' => $evt_id, 'evt_id_type' => "subscriptions", 'created_at' => $current_date));
        // ==================== End Of Subscription .....

        // ==================== Create transactions .....
        if ($memberpress_preiod_type == 'years') {
            $memberpress_preiod = "+" . $memberpress_preiod . " years";
            $expires = strtotime($memberpress_preiod, strtotime($current_date));
            $expires = date('Y-m-d H:i:s', $expires);
        } else if ($memberpress_preiod_type == 'days') {
            $memberpress_preiod = "+" . $memberpress_preiod . " days";
            $expires = strtotime($memberpress_preiod, strtotime($current_date));
            $expires = date('Y-m-d H:i:s', $expires);
        } else if ($memberpress_preiod_type == 'months') {
            $memberpress_preiod = "+" . $memberpress_preiod . " months";
            $expires = strtotime($memberpress_preiod, strtotime($current_date));
            $expires = date('Y-m-d H:i:s', $expires);
        } else {
            $expires = "0000-00-00 00:00:00";
        }

        $url = $server_url . '/wp-json/mp/v1/transactions';
        $curl = curl_init($url);
        $transact = json_encode(
            [
                'trans_num'           => 'mp-txn-' . uniqid(),
                'amount'              => $memberpress_price,
                'total'               => $memberpress_price,
                'tax_amount'          => 0.00,
                'tax_rate'            => 0.00,
                'tax_desc'            => '',
                'user_id'             => $user_id,
                'product_id'          => $membership_id,
                'coupon_id'           => 0,
                'status'              => $pending_str,
                'response'            => NULL,
                'gateway'             => $gateway,
                'subscription_id'     => $subscription_id,
                'created_at'          => $current_date,
                'expires_at'          => $expires
            ]
        );
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_POSTFIELDS, $transact);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'MEMBERPRESS-API-KEY: SFg73JOVC5',
            'Authorization: Bearer ' . $token . '',
            'Content-Type: application/json'
        ));
        $trans_response = curl_exec($curl);
        if (curl_errno($curl)) {
            throw new Exception(curl_error($curl));
        }
        // echo $trans_response;
        curl_close($curl);

        $results = $wpdb->get_results("SELECT max(evt_id) from $mebr_events where event='offline-payment-pending' ");
        $evt_id = json_encode($results, true);
        $evt_id = json_decode($evt_id, true);
        $evt_id = $evt_id[0]['max(evt_id)'] + 1;
        $wpdb->insert($mebr_events, array('event' => "offline-payment-pending", 'args' => '', 'evt_id' => $evt_id, 'evt_id_type' => "transactions", 'created_at' => $current_date));

        $response['transaction'] = __("Your transaction is in progress.", "wp-rest-user");
        $response['status'] = 200;
        // End Of transactions .....

        // ==================== Direct Database Method ====================
        // ------------ Database Connection ------------

        // global $wpdb;
        // $subscr_table = 'wp_mepr_subscriptions';
        // $membr_table = 'wp_mepr_transactions';
        // $mebr_events = 'wp_mepr_events';

        // ------------ For Subscriptions wp_mepr_subscriptions ------------

        // $subscr = array(
        //     'subscr_id'           => 'mp-sub-' . uniqid(),
        //     'gateway'             => $gateway,
        //     'user_id'             => $user_id,
        //     'product_id'          => $membership_id,
        //     'coupon_id'           => 0,
        //     'price'               => $memberpress_price,
        //     'period'              => $memberpress_preiod,
        //     'period_type'         => $memberpress_preiod_type,
        //     'limit_cycles'        => false,
        //     'limit_cycles_num'    => $memberpress_product_limit_cycles_num,
        //     'limit_cycles_action' => $memberpress_limit_cycles_action,
        //     'limit_cycles_expires_after' => $memberpress_limit_expires_after,
        //     'limit_cycles_expires_type' => $memberpress_limit_expires_type,
        //     'prorated_trial'      => 0,
        //     'trial'               => 0,
        //     'trial_days'          => $memberpress_product_trial_days,
        //     'trial_amount'        => $memberpress_product_trial_amount,
        //     'trial_tax_amount'    => 0.00,
        //     'trial_total'         => 0.00,
        //     'status'              => $pending_str,
        //     'created_at'          => $current_date,
        //     'total'               => $memberpress_price,
        //     'tax_rate'            => 0.00,
        //     'tax_amount'          => 0.00,
        //     'tax_desc'            => '',
        //     'tax_class'           => $memberpress_tax_class,
        //     'cc_last4'            => null,
        //     'cc_exp_month'        => null,
        //     'cc_exp_year'         => null,
        //     'token'               => null,
        //     'tax_shipping'        => 1,
        //     'tax_compound'        => 0,
        //     'response'            => ''
        // );

        // $results = $wpdb->get_results("SELECT * FROM $subscr_table WHERE user_id=$user_id AND product_id=$membership_id");
        // if (empty($results)) {
        //     $wpdb->insert($subscr_table, $subscr);

        // ------------ For Events Of Subscriptions ------------

        // $results = $wpdb->get_results("SELECT max(evt_id) from $mebr_events where event='subscription-created' ");
        // $evt_id = json_encode($results, true);
        // $evt_id = json_decode($evt_id, true);
        // $evt_id = $evt_id[0]['max(evt_id)'] + 1;

        // $wpdb->insert($mebr_events, array('event' => "subscription-created", 'args' => '', 'evt_id' => $evt_id, 'evt_id_type' => "subscriptions", 'created_at' => $current_date));

        // $results = $wpdb->get_results("SELECT * FROM $subscr_table WHERE user_id=$user_id AND product_id=$membership_id");
        // $get_results = json_encode($results, true);
        // $get_results = json_decode($get_results, true);

        // $subscription_id = $get_results[0]['id'];

        // if ($memberpress_preiod_type == 'years') {
        //     $memberpress_preiod = "+" . $memberpress_preiod . " years";
        //     $expires = strtotime($memberpress_preiod, strtotime($current_date));
        //     $expires = date('Y-m-d H:i:s', $expires);
        // } else if ($memberpress_preiod_type == 'days') {
        //     $memberpress_preiod = "+" . $memberpress_preiod . " days";
        //     $expires = strtotime($memberpress_preiod, strtotime($current_date));
        //     $expires = date('Y-m-d H:i:s', $expires);
        // } else if ($memberpress_preiod_type == 'months') {
        //     $memberpress_preiod = "+" . $memberpress_preiod . " months";
        //     $expires = strtotime($memberpress_preiod, strtotime($current_date));
        //     $expires = date('Y-m-d H:i:s', $expires);
        // } else {
        //     $expires = "0000-00-00 00:00:00";
        // }

        // ------------ For Memberships wp_mepr_transactions ------------

        // $member = array(
        //     'amount'              => $memberpress_price,
        //     'total'               => $memberpress_price,
        //     'tax_amount'          => 0.00,
        //     'tax_rate'            => 0.00,
        //     'tax_desc'            => '',
        //     'tax_compound'        => 0,
        //     'tax_shipping'        => 1,
        //     'tax_class'           => $memberpress_tax_class,
        //     'user_id'             => $user_id,
        //     'product_id'          => $membership_id,
        //     'coupon_id'           => 0,
        //     'trans_num'           => 'mp-txn-' . uniqid(),
        //     'status'              => $pending_str,
        //     'txn_type'            => $txn_type,
        //     'response'            => NULL,
        //     'gateway'             => $gateway,
        //     'subscription_id'     => $subscription_id,
        //     'prorated'            => 0,
        //     'created_at'          => $current_date,
        //     'expires_at'          => $expires,
        //     'corporate_account_id' => 0,
        //     'parent_transaction_id' => 0
        // );
        // $wpdb->insert($membr_table, $member);

        // ------------ For Events Of Memberships ------------

        //     $results = $wpdb->get_results("SELECT max(evt_id) from $mebr_events where event='offline-payment-pending' ");
        //     $evt_id = json_encode($results, true);
        //     $evt_id = json_decode($evt_id, true);
        //     $evt_id = $evt_id[0]['max(evt_id)'] + 1;

        //     $wpdb->insert($mebr_events, array('event' => "offline-payment-pending", 'args' => '', 'evt_id' => $evt_id, 'evt_id_type' => "transactions", 'created_at' => $current_date));

        //     $response['message'] = __("This Step Is Successfully Done.", "wp-rest-user");
        //     $response['status'] = 200;
        // } else {
        //     $response['message'] = __("You Already Have This Membership.", "wp-rest-user");
        //     $response['status'] = 200;
        // }
        // ==================== ==================== ====================
        echo json_encode($response);
        wp_die();
    }

    // Memberpress Signup Done By Senza Step - 8
    public function membershipfinalstep()
    {
        $response = [];
        $array = array();
        parse_str($_POST['formdata'], $array);
        $server_url = "https://" . $_SERVER['SERVER_NAME'];

        global $wpdb;
        $payment_info = "wp_mbm_payment";
        $mebr_events = 'wp_mepr_events';

        $results = $wpdb->get_results("SELECT max(evt_id) from $mebr_events where event='subscription-created' ");
        $evt_id = json_encode($results, true);
        $evt_id = json_decode($evt_id, true);
        $evt_id = $evt_id[0]['max(evt_id)'];

        // Table Created 
        $charset_collate = $wpdb->get_charset_collate();
        $sql = "CREATE TABLE `$payment_info` (
                    id int(11) NOT NULL AUTO_INCREMENT,
                    payment_type varchar(255) NOT NULL,
                    customer_email  varchar(255) NOT NULL,
                    membership_id  varchar(255) NOT NULL,
                    payment_status varchar(255) NOT NULL,
                    transaction_id varchar(255) NOT NULL,
                    payment_gateway varchar(255) NOT NULL,
                    cc_last4 varchar(255) NOT NULL,
                    cc_exp_month varchar(255) NOT NULL,
                    cc_exp_year varchar(255) NOT NULL,
                    cardswap_id  varchar(255) NOT NULL,
                    gateway_id  varchar(255) NOT NULL,
                    refund_url  varchar(255) NOT NULL,
                    receipt_url  varchar(255) NOT NULL
                    PRIMARY KEY  (id)
                  ) $charset_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
        die();

        $user_id = $array['current_user_id'];
        $user_data = get_userdata($user_id);
        $membership_id = $array['membership_id'];
        $token = $array['current_user_token'];
        $pending_str   = 'active';
        $memberpressdata = get_post_meta($membership_id);
        $memberpress_price = $memberpressdata['_mepr_product_price'][0];
        $memberpress_preiod = $memberpressdata['_mepr_product_period'][0];
        $memberpress_preiod_type =  $memberpressdata['_mepr_product_period_type'][0];
        $memberpress_limit_cycles_action  = $memberpressdata['_mepr_product_limit_cycles_action'][0];
        $memberpress_product_trial_days = $memberpressdata['_mepr_product_trial_days'][0];
        $memberpress_product_trial_amount = $memberpressdata['_mepr_product_trial_amount'][0];
        $memberpress_product_limit_cycles_num = $memberpressdata['_mepr_product_limit_cycles_num'][0];
        $user_email = $user_data->user_email;

        // Stripe Payment Gateway
        $data = array(
            "amount" => ((int)$memberpress_price) * (100),
            "currency" => 'USD',
            "source" => 'tok_amex',
            "description" => 'TEST Charge',
            "metadata" => ["membership_id" => $membership_id, 'customer_email' => $user_email],
        );
        $string = http_build_query($data);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.stripe.com/v1/charges',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => htmlspecialchars($string),
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer sk_test_51KTjmoF0cemjb7yXOvKF7cO74eln1UrTlvubtBGpcdS9vvmwJF4QigmQf6FoX2uEbpLNNLolfbZzDUiAaVMKa3PB00Pqa4CFJ9',
                'Content-Type: application/x-www-form-urlencoded',
            ],
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false
        ));
        $stripe_response = curl_exec($curl);
        curl_close($curl);
        $stripe_response = json_decode($stripe_response, true);

        $payment_status = $stripe_response['status'];
        $receipt_url = $stripe_response['receipt_url'];
        $transaction_id = str_replace('_', '-', $stripe_response['balance_transaction']);
        $cardswap_id = $stripe_response['payment_method'];
        $stripe_id = $stripe_response['id'];
        $refund_url = $stripe_response['refunds']['url'];
        $payment_gateway = $stripe_response['calculated_statement_descriptor'];
        $cc_last4 = $stripe_response['payment_method_details']['card']['last4'];
        $cc_exp_month = $stripe_response['payment_method_details']['card']['exp_month'];
        $cc_exp_year = $stripe_response['payment_method_details']['card']['exp_year'];
        $payment_type = $stripe_response['source']['object'];

        $payment_data = array(
            "payment_type" => $payment_type,
            "payment_status" => $payment_status,
            "transaction_id" => $transaction_id,
            "payment_gateway" => $payment_gateway,
            "cc_last4" => $cc_last4,
            "cc_exp_month" => $cc_exp_month,
            "cc_exp_year" => $cc_exp_year,
            "cardswap_id" => $cardswap_id,
            "gateway_id" => $stripe_id,
            "refund_url" => $refund_url,
            "receipt_url" => $receipt_url,
            "customer_email" => $user_email,
            "membership_id" => $membership_id
        );
        $wpdb->insert($payment_info, $payment_data);

        $current_date = date("Y-m-d H:i:s");

        // ==================== Update Subscriptions .....
        $url = $server_url . '/wp-json/mp/v1/subscriptions/' . $evt_id;

        $curl =  curl_init($url);
        $subscr = json_encode(
            [
                'subscr_id'           => 'ts_' . uniqid(),
                'response'            => '',
                'gateway'             => $payment_gateway,
                'user_id'             => $user_id,
                'product_id'          => $membership_id,
                'coupon_id'           => 0,
                'price'               => $memberpress_price,
                'tax_amount'          => 0.00,
                'tax_rate'            => 0.00,
                'tax_desc'            => '',
                'period'              => $memberpress_preiod,
                'period_type'         => $memberpress_preiod_type,
                'limit_cycles'        => false,
                'limit_cycles_num'    => $memberpress_product_limit_cycles_num,
                'limit_cycles_action' => $memberpress_limit_cycles_action,
                'trial'               => 0,
                'trial_days'          => $memberpress_product_trial_days,
                'trial_amount'        => $memberpress_product_trial_amount,
                'status'              => $pending_str,
                'created_at'          => $current_date,
                'total'               => $memberpress_price,
                'cc_last4'            => $cc_last4,
                'cc_exp_month'        => $cc_exp_month,
                'cc_exp_year'         => $cc_exp_year,
            ]
        );
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_POSTFIELDS, $subscr);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'MEMBERPRESS-API-KEY: SFg73JOVC5',
            'Authorization: Bearer ' . $token . '',
            'Content-Type: application/json'
        ));
        $sub_response = curl_exec($curl);
        if (curl_errno($curl)) {
            throw new Exception(curl_error($curl));
        }
        curl_close($curl);
        $sub_array = array();
        $sub_array = json_decode($sub_response, true);
        $subscription_id = $sub_array['id'];

        $response['subscription'] = __("Your subscription is in progress.", "wp-rest-user");
        // ==================== End Of Subscription .....

        // ==================== Update transactions .....
        if ($memberpress_preiod_type == 'years') {
            $memberpress_preiod = "+" . $memberpress_preiod . " years";
            $expires = strtotime($memberpress_preiod, strtotime($current_date));
            $expires = date('Y-m-d H:i:s', $expires);
        } else if ($memberpress_preiod_type == 'days') {
            $memberpress_preiod = "+" . $memberpress_preiod . " days";
            $expires = strtotime($memberpress_preiod, strtotime($current_date));
            $expires = date('Y-m-d H:i:s', $expires);
        } else if ($memberpress_preiod_type == 'months') {
            $memberpress_preiod = "+" . $memberpress_preiod . " months";
            $expires = strtotime($memberpress_preiod, strtotime($current_date));
            $expires = date('Y-m-d H:i:s', $expires);
        } else {
            $expires = "0000-00-00 00:00:00";
        }

        $results = $wpdb->get_results("SELECT max(evt_id) from $mebr_events where event='offline-payment-pending' ");
        $evt_id = json_encode($results, true);
        $evt_id = json_decode($evt_id, true);
        $evt_id = $evt_id[0]['max(evt_id)'];
        $pending_str   = 'complete';

        $url = $server_url . '/wp-json/mp/v1/transactions/' . $evt_id;
        $curl = curl_init($url);
        $transact = json_encode(
            [
                'trans_num'           => 'mp-' . $transaction_id,
                'amount'              => $memberpress_price,
                'total'               => $memberpress_price,
                'tax_amount'          => 0.00,
                'tax_rate'            => 0.00,
                'tax_desc'            => '',
                'user_id'             => $user_id,
                'product_id'          => $membership_id,
                'coupon_id'           => 0,
                'status'              => $pending_str,
                'response'            => NULL,
                'gateway'             => $payment_gateway,
                'subscription_id'     => $subscription_id,
                'created_at'          => $current_date,
                'expires_at'          => $expires
            ]
        );
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_POSTFIELDS, $transact);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'MEMBERPRESS-API-KEY: SFg73JOVC5',
            'Authorization: Bearer ' . $token . '',
            'Content-Type: application/json'
        ));
        $trans_response = curl_exec($curl);
        if (curl_errno($curl)) {
            throw new Exception(curl_error($curl));
        }
        curl_close($curl);

        $wpdb->insert($mebr_events, array('event' => "offline-payment-complete", 'args' => '', 'evt_id' => $evt_id, 'evt_id_type' => "transactions", 'created_at' => $current_date));
        $wpdb->insert($mebr_events, array('event' => "transaction-completed", 'args' => '', 'evt_id' => $evt_id, 'evt_id_type' => "transactions", 'created_at' => $current_date));
        $wpdb->insert($mebr_events, array('event' => "recurring-transaction-completed", 'args' => '', 'evt_id' => $evt_id, 'evt_id_type' => "transactions", 'created_at' => $current_date));
        $wpdb->insert($mebr_events, array('event' => "member-signup-completed", 'args' => $trans_response, 'evt_id' => $user_id, 'evt_id_type' => "users", 'created_at' => $current_date));
        // ==================== End Of transactions .....
    }

    public function whiteListRegisterEndpoint()
    {
        add_filter('jwt_auth_whitelist', function ($endpoints) {
            $whitelist = array(
                '/tomass/wp-json/mbm/users',
                'wp-json/mp/v1/webhooks/members'
            );
            return array_unique(array_merge($endpoints, $whitelist));
        });
    }

    // TODO: REMOVE THIS ENDPOINT AND FUNCTIONALITY WE ARE GOING TO USE BUDDYBOSS ENDPOINT
    // public function generateUserEndpoint($request)
    // {
    //     register_rest_route('mbm', 'users', [
    //         'methods' => 'POST',
    //         'callback' => [$this, 'CreateUserEndpointHandler']
    //     ]);
    // }

    // TODO: REMOVE THIS ENDPOINT AND FUNCTIONALITY WE ARE GOING TO USE BUDDYBOSS ENDPOINT
    // public function CreateUserEndpointHandler($request = null)
    // {
    //     $response = [];

    //     // Data Validation
    //     $parameters = $request->get_json_params();
    //     $username = sanitize_text_field($parameters['username']);
    //     $email = sanitize_text_field($parameters['email']);
    //     $password = sanitize_text_field($parameters['password']);
    //     // $role = sanitize_text_field($parameters['role']);
    //     $error = new WP_Error();

    //     if (empty($username)) {
    //         $error->add(400, __("Username field 'username' is required.", 'wp-rest-user'), array('status' => 400));
    //         return $error;
    //     }
    //     if (empty($email)) {
    //         $error->add(401, __("Email field 'email' is required.", 'wp-rest-user'), array('status' => 400));
    //         return $error;
    //     }
    //     if (empty($password)) {
    //         $error->add(404, __("Password field 'password' is required.", 'wp-rest-user'), array('status' => 400));
    //         return $error;
    //     }

    //     // if (empty($role)) {
    //     //  $role = 'subscriber';
    //     // } else {
    //     //     if ($GLOBALS['wp_roles']->is_role($role)) {
    //     //      // Silence is gold
    //     //     } else {
    //     //    $error->add(405, __("Role field 'role' is not a valid. Check your User Roles from Dashboard.", 'wp_rest_user'), array('status' => 400));
    //     //    return $error;
    //     //     }
    //     // }

    //     $user_id = username_exists($username);
    //     if (!$user_id && email_exists($email) == false) {
    //         $user_id = wp_create_user($username, $password, $email);
    //         if (!is_wp_error($user_id)) {
    //             // Ger User Meta Data (Sensitive, Password included. DO NOT pass to front end.)
    //             $user = get_user_by('id', $user_id);
    //             // $user->set_role($role);
    //             $user->set_role('subscriber');
    //             // Ger User Data (Non-Sensitive, Pass to front end.)
    //             $response['code'] = 200;
    //             $response['message'] = __("User '" . $username . "' Registration was Successful", "wp-rest-user");
    //         } else {
    //             return $user_id;
    //         }
    //     } else {
    //         $error->add(406, __("Email already exists, please try 'Reset Password'", 'wp-rest-user'), array('status' => 400));
    //         return $error;
    //     }
    //     return new WP_REST_Response($response, 200);
    // }

    // public function generateUserStepTwoEndpoint($request)
    // {
    //     register_rest_route('mbm', 'users/step-two', [
    //         'methods' => 'POST',
    //         'callback' => [$this, 'StoreStepTwoData']
    //     ]);
    // }

    // TODO: check this methods if it is storing user data, we should add it to wp_meta
    // public function StoreStepTwoData($request = null)
    // {
    //     global $wpdb;
    //     $response = [];
    //     $User = wp_get_current_user();
    //     $data = $request->get_json_params();
    //     $fields = $this->validateStepTwoData($data);

    //     $error = new WP_Error();
    //     if (!$fields['validated']) {
    //         $error->add(400, __("Username field 'username' is required.", 'wp-rest-user'), array('status' => 400));
    //         return $error;
    //     }

    //     $wpdb->insert(
    //         'mbmprime_users_extra',
    //         [
    //             'user_id' => $User->data->ID,
    //             'name' => $fields['fields']['name'],
    //             'lastname' => $fields['fields']['lastname'],
    //             'title' => $fields['fields']['title']
    //         ]
    //     );

    //     $wpdb->insert(
    //         'mbmprime_company',
    //         [
    //             'user_id' => $User->data->ID,
    //             'name' => $fields['fields']['companyName'],
    //             'phone' => $fields['fields']['phone'],
    //             'url' => $fields['fields']['url'],
    //             'socioeconomic_category' => $fields['fields']['socioeconomicCat'],
    //             'type' => $fields['fields']['companyType'],
    //             'address' => $fields['fields']['address'],
    //             'city' => $fields['fields']['city'],
    //             'zip' => $fields['fields']['zip'],
    //             'state_province' => $fields['fields']['stateProvince'],
    //             'country' => $fields['fields']['country'],
    //             'federal_opportunities' => $fields['fields']['federalOpportunities'],
    //         ]
    //     );
    // }

    //     public function validateStepTwoData($data)
    //     {
    //         $requiredFields = ['userTitle'];
    //         $return['validated'] = true;
    //         $return['fields']['userTitle'] = sanitize_text_field($data['userTitle']);
    //         $return['fields']['companyName'] = sanitize_text_field($data['companyName']);
    //         $return['fields']['phone'] = sanitize_text_field($data['phone']);
    //         $return['fields']['url'] = sanitize_text_field($data['url']);
    //         $return['fields']['socioeconomicCat'] = sanitize_text_field($data['socioeconomicCat']);
    //         $return['fields']['companyType'] = sanitize_text_field($data['companyType']);
    //         $return['fields']['mbmUserRole'] = sanitize_text_field($data['mbmUserRole']);
    //         $return['fields']['address'] = sanitize_text_field($data['address']);
    //         $return['fields']['ZIP'] = sanitize_text_field($data['ZIP']);
    //         $return['fields']['stateProvince'] = sanitize_text_field($data['stateProvince']);
    //         $return['fields']['country'] = sanitize_text_field($data['country']);
    //         $return['fields']['opportunities'] = sanitize_text_field($data['opportunities']);
    //         $return['fields']['fedOpportunities'] = rest_sanitize_boolean($data['fedOpportunities']);

    //         foreach ($return['fields'] as $field => $value) {
    //             if (in_array($field, $requiredFields) && empty($value)) {
    //                 $return['validated'] = false;
    //             }
    //         }
    //         return $return;
    //     }
}