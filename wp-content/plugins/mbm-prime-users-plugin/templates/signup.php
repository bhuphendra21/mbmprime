<?php

/**
 * Template Name: Custom Register Page
 */

get_header();
?>
<!-- ============ Tom Code ============= -->
<!-- <div class="Page__SteppedForm">
    <div class="SteppedForm">
        <div class="StepForm__section-image">
            <img src="<?php //echo PLUGIN_URL.'assets/img/deal-people.jpg' 
                        ?>" alt="">
        </div>
        <h2 class="SteppedForm__title">Join the PRIME family!</h2>
        <p id="step-message" class="SteppedForm__subtitle"></p>
        <div id="alert-message" class="alert-message"></div>
        <div class="SteppedForm__section-form">
            <div id="form-inputs-section" class="SteppedForm__section-form-inputs"></div>
            <div id="form-buttons-section" class="SteppedForm__section-buttons"></div>
        </div>
    </div>
</div> -->

<!-- ================ Senza ================= -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<div id="primary" class="content-area bb-grid-cell">
    <main id="main" class="site-main">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                    <div class="card text-black" style="border-radius: 25px;">
                        <div class="card-body p-md-5">
                            <img class="mb-3" src="/wp-content/uploads/2022/04/mbm_logo.png" alt="mbm-logo" width="200" />
                            <div class="row justify-content-center flex-row-reverse">
                                <div class="col-md-10 col-lg-6 col-xl-6 order-2 order-lg-1">
                                    <?php
                                    global $wpdb;
                                    global $wp_roles;

                                    $strJsonFileContents = file_get_contents("wp-content/plugins/mbm-prime-users-plugin/assets/CustomJson.json");
                                    $array = json_decode($strJsonFileContents, true);
                                    if (isset($_GET['user_id'])) {
                                        $user_id = $_GET['user_id'];
                                        $token = $_GET['token'];
                                    } else {
                                        $user_id = 0;
                                        $token = '';
                                    }

                                    $all_roles = $wp_roles->get_names();

                                    foreach (array_values($all_roles) as $ar) {
                                        foreach ($array['Role'] as $a) {
                                            if ($ar != $a['role']) {
                                                $role_value = str_replace(' ', '_', $a['role']);
                                                add_role(strtolower($role_value), $a['role']);
                                            }
                                        }
                                    }

                                    $memberpressdata = get_post_meta(166);
                                    $membership_id = 166;
                                    $memberpress_price = $memberpressdata['_mepr_product_price'][0];
                                    $memberpress_preiod = $memberpressdata['_mepr_product_period'][0] . " " . $memberpressdata['_mepr_product_period_type'][0];
                                    $memberpress_button_txt = $memberpressdata['_mepr_product_signup_button_text'][0];
                                    $memberpress_pricing_title = $memberpressdata['_mepr_product_pricing_title'][0];
                                    $memberpress_benefits = $memberpressdata['_mepr_product_pricing_benefits'];
                                    $memberpress_limited_users = $memberpressdata['_mepr_cannot_purchase_message'][0]; // Used For Unauthorised User
                                    $memberpress_roles = $memberpressdata['_mepruserroles_roles'];

                                    $memberpress_roles = unserialize(strtolower($memberpress_roles[0]));
                                    $memberpress_benefits = unserialize(strtolower($memberpress_benefits[0]));
                                    ?>

                                    <div id="step-1">
                                        <form class="mx-1 mx-md-4" id="UserRegister" method="POST">
                                            <p class="h3 fw-bold my-1">Create Account</p>
                                            <label class="mb-3">To begin enter your email, first name, last name and choose a password.</label>
                                            <div class="mb-3">
                                                <div class="form-outline flex-fill mb-0">
                                                    <label class="form-label mb-0" for="firstname">First Name</label>
                                                    <input type="text" name="firstname" id="firstname" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="form-outline flex-fill mb-0">
                                                    <label class="form-label mb-0" for="lastname">Last Name</label>
                                                    <input type="text" name="lastname" id="lastname" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="form-outline flex-fill mb-0">
                                                    <label class="form-label mb-0" for="email">Email</label>
                                                    <input type="email" name="email" id="email" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="form-outline flex-fill mb-0">
                                                    <label class="form-label mb-0" for="password">Password</label>
                                                    <input type="password" name="password" id="password" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="form-check mb-3">
                                                <div class="form-outline flex-fill mb-0">
                                                    <input class="form-check-input me-2" value="YES" name="terms[]" type="checkbox" id="terms" />
                                                    <label class="form-check-label mb-0" for="terms">
                                                        *Accept terms and conditions and data privacy
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="text-right mb-3 mb-lg-4">
                                                <button type="submit" class="btn btn-primary mbm" id="submit" data-step="2">Email Validation</button>
                                            </div>
                                        </form>
                                    </div>

                                    <div id="step-2">
                                        <form class="mx-1 mx-md-4">
                                            <p class="h3 fw-bold my-1">Verify your email address</p>
                                            <label>Please check your email for a link to verify your email address.Once verified, you´ll be able to continue.</label>
                                            <input type="hidden" name="current_user_id" class="current_user_id" value="<?php echo $user_id; ?>">
                                            <input type="hidden" name="verification_code" class="verification_code" value="<?php echo $verification_code; ?>">
                                            <input type="hidden" name="current_user_token" class="current_user_token" value="<?php echo $token; ?>">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="mb-4 d-flex align-items-center">
                                                    <p class="mb-0 mx-1">Didn´t recieve an email? </p>
                                                    <button type="button" class="btn-resend" id="ResendEmail">Resend</button>
                                                </div>
                                                <div class="mb-4">
                                                    <button type="button" class="btn btn-primary btn-lg step2-btn" data-step="3" id="EmailValidate">Verify email <i class="fas fa-check"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div id="step-3">
                                        <form class="mx-1 mx-md-4" id="CompanyRelatedInformation" method="POST">
                                            <p class="h3 fw-bold my-1 mb-3">Registration</p>
                                            <input type="hidden" name="current_user_id" class="current_user_id" value="<?php echo $user_id; ?>">
                                            <div class="row">
                                                <div class="form-outline flex-fill mb-0">
                                                    <!-- <label class="form-label mb-0" for="Title">Title*</label> -->
                                                    <select class="form-select form-select-lg mb-3" name="Title" id="Title" aria-label=".form-select-lg example">
                                                        <option value="">Title</option>
                                                        <?php
                                                        foreach ($array['Title'] as $ar) {
                                                            $ar_value = str_replace(' ', '_', $ar['title']);
                                                        ?>
                                                            <option value=<?php echo $ar_value; ?>><?php echo  $ar['title']; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                                <div class="form-outline flex-fill mb-0">
                                                    <label class="form-label mb-0" for="SocioeconomicCategory">Events you are interested in*</label>
                                                    <select class="form-select form-select-lg mb-3" name="SocioeconomicCategory" id="SocioeconomicCategory" aria-label=".form-select-lg example">
                                                        <option value="">Socio-economic categories</option>
                                                        <?php
                                                        foreach ($array['Socio-economic Category'] as $ar) {
                                                            $category_value = str_replace(' ', '_', $ar['category']);
                                                        ?>
                                                            <option value=<?php echo $category_value; ?>><?php echo  $ar['category']; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="row align-items-end">
                                                <div class="form-outline flex-fill mb-0">
                                                    <label class="form-label mb-0" for="Role">Role*</label>
                                                    <select class="form-select form-select-lg mb-3" name="Role" id="Role" aria-label=".form-select-lg example">
                                                        <option value="">Roles</option>
                                                        <?php
                                                        foreach ($array['Role'] as $ar) {
                                                            $role_value = str_replace(' ', '_', $ar['role']);
                                                        ?>
                                                            <option value=<?php echo strtolower($role_value); ?>><?php echo  $ar['role']; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                                <div class="form-outline flex-fill mb-0">
                                                    <select class="form-select form-select-lg mb-3" name="Businessentity" id="Businessentity" aria-label=".form-select-lg example">
                                                        <option value="">Business categories </option>
                                                        <?php
                                                        foreach ($array['Business Entity'] as $ar) {
                                                            $business_value = str_replace(' ', '_', $ar['business']);
                                                        ?>
                                                            <option value=<?php echo $business_value; ?>><?php echo  $ar['business']; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="text-right mb-3 mb-lg-4">
                                                <button type="submit" class="btn btn-primary btn" id="companyinformation" data-step="4">Continue</button>
                                            </div>
                                        </form>
                                    </div>

                                    <div id="step-4">
                                        <form class="mx-1 mx-md-4" id="FStep4" method="POST">
                                            <p class="h3 fw-bold my-1 mb-3">Registration</p>
                                            <input type="hidden" name="current_user_id" class="current_user_id" value="<?php echo $user_id; ?>">
                                            <div class="row align-items-end mb-3">
                                                <div class="form-outline flex-fill mb-3">
                                                    <label class="form-label" for="companyname">Company Name*</label>
                                                    <input type="text" name="companyname" id="companyname" class="form-control" />
                                                </div>

                                                <div class="form-outline flex-fill mb-3">
                                                    <!-- <label class="form-label" for="CompanyIndustry">Company Industry*</label> -->
                                                    <select class="form-select form-select-lg" name="CompanyIndustry" id="CompanyIndustry" aria-label=".form-select-lg example">
                                                        <option value="">Company Industry</option>
                                                        <?php
                                                        foreach ($array['Company Industry'] as $ar) {
                                                            $industry_value = str_replace(' ', '_', $ar['industry']);
                                                        ?>
                                                            <option value=<?php echo $industry_value; ?>><?php echo  $ar['industry']; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row align-items-end">
                                                <div class="col-sm">
                                                    <div class="form-outline flex-fill mb-0">
                                                        <label class="form-label" for="city">Web</label>
                                                        <input type="text" name="web" id="web" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-sm">
                                                    <div class="form-outline flex-fill mb-0">
                                                        <label class="form-check-label" for="website">
                                                            <input class="form-check-input me-2" name="website" type="checkbox" value="YES" id="website" />
                                                            *Do You Have Website?
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div>
                                                <h5 class="form-label">Company's Objectives</h5>
                                            </div>

                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <div class="form-outline flex-fill mb-0">
                                                    <?php
                                                    foreach ($array['Company Objectives'] as $ar) {
                                                        $objectives_value = str_replace(' ', '_', $ar['objectives']);
                                                    ?>
                                                        <label class="form-check-label" for="<?php echo $objectives_value; ?>">
                                                            <input class="form-check-input me-2" name="CompanyObjectives[]" value="<?php echo $objectives_value; ?>" type="checkbox" id="<?php echo $objectives_value; ?>" />
                                                            <?php echo $ar['objectives']; ?>
                                                        </label> </br>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-end mb-3 mb-lg-4">
                                                <button type="submit" class="btn btn-primary btn" id="step5" data-step="5">Continue</button>
                                            </div>
                                        </form>
                                    </div>

                                    <div id="step-5">
                                        <form class="mx-1 mx-md-4" id="FStep5" method="POST">
                                            <p class="h3 fw-bold my-1 mb-3">Registration</p>
                                            <input type="hidden" name="current_user_id" class="current_user_id" value="<?php echo $user_id; ?>">
                                            <div class="mb-4">
                                                <div class="form-outline flex-fill mb-0">
                                                    <!-- <label class="form-label" for="Country">Country*</label> -->
                                                    <select class="form-select form-select-lg mb-3" name="Country" id="Country" aria-label=".form-select-lg example">
                                                        <option value="">Country</option>
                                                        <?php
                                                        foreach ($array['Country'] as $ar) {
                                                            $country_value = str_replace(' ', '_', $ar['name']);
                                                        ?>
                                                            <option value=<?php echo $country_value; ?>><?php echo  $ar['name']; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-4">
                                                <div class="form-outline flex-fill mb-0">
                                                    <label class="form-label" for="Contact">Phone*</label>
                                                    <input type="tel" name="Contact" id="Contact" class="form-control" />
                                                </div>
                                            </div>
                                            <div id="CountryBlock">
                                                <div class="mb-4">
                                                    <div class="form-outline flex-fill mb-0">
                                                        <label class="form-check-label" for="federalopportunities">
                                                            <input class="form-check-input me-2" name="federalopportunities" type="checkbox" value="YES" id="federalopportunities" />
                                                            *Are you interested on federal opportunities?
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-right mb-3 mb-lg-4">
                                                <button type="submit" class="btn btn-primary btn" id="step6" data-step="6">Continue</button>
                                            </div>
                                        </form>
                                    </div>

                                    <div id="step-6">
                                        <form class="mx-1 mx-md-4" id="FStep6" method="POST">
                                            <p class="h3 fw-bold my-1">Registration</p>
                                            <label class="mb-3">To complete 100% of profile registration.</label>
                                            <input type="hidden" name="current_user_id" class="current_user_id" value="<?php echo $user_id; ?>">
                                            <div class="form-check mb-4 ps-0">
                                                <div class="form-outline flex-fill mb-0">
                                                    <label class="form-label" for="address">Address</label>
                                                    <textarea class="form-control" id="address" name="address"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-check mb-4 ps-0">
                                                <div class="form-outline flex-fill mb-0">
                                                    <label class="form-label" for="city">City</label>
                                                    <input type="text" name="city" id="city" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="row align-items-end">
                                                <div class="col-sm">
                                                    <div class="form-outline flex-fill mb-0">
                                                        <label class="form-label" for="state">State/Province</label>
                                                        <input type="text" name="state" id="state" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-sm">
                                                    <div class="form-outline flex-fill mb-0">
                                                        <label class="form-label" for="zip">ZIP</label>
                                                        <input type="text" name="zip" id="zip" class="form-control" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-check mb-4 ps-0">
                                                <div class="form-outline flex-fill mb-0">
                                                    <label class="form-label" for="companydescription">Company description</label>
                                                    <input type="text" name="companydescription" id="companydescription" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="form-check mb-4 ps-0">
                                                <div class="form-outline flex-fill mb-0">
                                                    <label class="form-label" for="year_of_creation">Year Of Creation</label>
                                                    <input type="text" name="year_of_creation" id="year_of_creation" class="form-control" />
                                                </div>
                                            </div>
                                            
                                            <div class="align-items-end">
                                                <label class="form-label">Business Certifications</label>
                                            </div>
                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <div class="form-outline flex-fill mb-0">
                                                    <?php
                                                    foreach ($array['Business Certifications'] as $ar) {
                                                        $business_certification_value = str_replace(' ', '_', $ar['business_certification']);
                                                    ?>
                                                        <label class="form-check-label" for="<?php echo $business_certification_value; ?>">
                                                            <input class="form-check-input me-2" name="BusinessCertifications[]" value="<?php echo $business_certification_value; ?>" type="checkbox" id="<?php echo $business_certification_value; ?>" />
                                                            <?php echo $ar['business_certification']; ?>
                                                        </label> </br>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>

                                            <div class="row align-items-end">
                                                <div class="form-outline flex-fill mb-0">
                                                    <label class="form-label" for="Revenue">Revenue</label>
                                                    <select class="form-select form-select-lg mb-3" name="Revenue" id="Revenue" aria-label=".form-select-lg example">
                                                        <option value="">Please Select</option>
                                                        <?php
                                                        foreach ($array['Revenue'] as $ar) {
                                                            $revenue_value = str_replace(' ', '_', $ar['revenue']);
                                                        ?>
                                                            <option value=<?php echo $industry_value; ?>><?php echo  $ar['revenue']; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row align-items-end">
                                                <div class="col-sm">
                                                    <div class="form-outline flex-fill mb-0">
                                                        <label class="form-label" for="no_of_employees">No. Of Employees</label>
                                                        <input type="text" name="no_of_employees" id="no_of_employees" class="form-control" />
                                                    </div>
                                                </div>
                                            </div>

                                            </br>
                                            <div class="d-flex flex-wrap">
                                                <div class="me-3">
                                                    <div class="form-outline flex-fill mb-0">
                                                        <input type="button" value="Choose Photo" class="button-primary" id="upload_image" />
                                                        <input type="hidden" name="image_id" class="image_id" value="" /> </br>
                                                        <img src="" class="image" style="display:none;margin-top:10px;" />
                                                    </div>
                                                </div>

                                                <div class="me-3">
                                                    <div class="form-outline flex-fill mb-0">
                                                        <input type="button" value="Choose Logo" class="button-primary" id="upload_logo" />
                                                        <input type="hidden" name="logo_id" class="logo_id" value="" /> </br>
                                                        <img src="" class="image" style="display:none;margin-top:10px;" />
                                                    </div>
                                                </div>

                                                <div class="me-3">
                                                    <div class="form-outline flex-fill mb-0">
                                                        <input type="button" value="Upload Broucher" class="button-primary" id="upload_broucher" />
                                                        <input type="hidden" name="broucher_id" class="broucher_id" value="" /> </br>
                                                        <img src="" class="image" style="display:none;margin-top:10px;" />
                                                    </div>
                                                </div>
                                            </div>

                                            </br>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="mb-4 d-flex align-items-center">
                                                    <button type="button" class="btn-resend" id="skip7" data-step="7">Skip</button>
                                                </div>
                                                <div class="mb-4">
                                                    <button type="submit" class="btn btn-primary btn" id="step7" data-step="7">Continue</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div id="step-7">
                                        <form class="mx-1 mx-md-4" id="FStep7" method="POST">
                                            <p class="h3 fw-bold my-1"><?php echo $memberpress_pricing_title; ?></p>
                                            <input type="hidden" name="membership_id" class="membership_id" value="<?php echo $membership_id; ?>">
                                            <input type="hidden" name="current_user_id" class="current_user_id" value="<?php echo $user_id; ?>">
                                            <input type="hidden" name="current_user_token" class="current_user_token" value="<?php echo $token; ?>">
                                            <div class="terms">
                                                <div class="p-3 d-flex justify-content-between boxx mb-3">
                                                    <h5 class="mb-0">Terms:</h5>
                                                    <h5 class="mb-0"><?php echo "$" . $memberpress_price . "  /" . $memberpressdata['_mepr_product_period_type'][0]; ?></h5>
                                                </div>
                                                <?php foreach ($memberpress_benefits as $mbm_benefits) {
                                                    echo "<div>";
                                                    echo "<h6 class='ms-benefits mb-2'>" . $mbm_benefits . "</h6>";
                                                    echo "</div>";
                                                }
                                                ?>
                                                <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                                    <button type="submit" class="btn btn-primary btn" id="step8" data-step="8"><?php echo $memberpress_button_txt; ?></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div id="step-8">
                                        <form class="mx-1 mx-md-4" id="FStep8" method="POST">
                                            <p class="h3 fw-bold my-1"><?php echo $memberpress_pricing_title; ?></p>
                                            <input type="hidden" name="membership_id" class="membership_id" value="<?php echo $membership_id; ?>">
                                            <input type="hidden" name="current_user_id" class="current_user_id" value="<?php echo $user_id; ?>">
                                            <input type="hidden" name="current_user_token" class="current_user_token" value="<?php echo $token; ?>">
                                            <div class="flex">
                                                <h5>Terms: </h5><?php echo "$" . $memberpress_price . " / " . $memberpressdata['_mepr_product_period_type'][0]; ?>
                                            </div>
                                            <table>
                                                <tr>
                                                    <th>DESCRIPTION</th>
                                                    <th>AMOUNT</th>
                                                </tr>
                                                <tr>
                                                    <td><?php echo $memberpress_pricing_title; ?></td>
                                                    <td><?php echo "$" . $memberpress_price; ?></td>
                                                </tr>
                                            </table>
                                            <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                                <button type="submit" class="btn btn-primary btn" id="step9" data-step="9">Continue For Payment</button>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="response"></div>
                                </div>
                                <div class="col-md-10 col-lg-6 col-xl-6 d-flex align-items-center order-1 order-lg-2 flex-column">
                                    <img src="<?php echo PLUGIN_URL . 'assets/img/statstics.png'
                                                ?>" alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
<?php
get_footer();
