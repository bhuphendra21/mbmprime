
// =============================================== Senza Solutions ===============================================
var iti;
var token;
jQuery(function ($) {
    function getUrlVars() {
        var vars = [], hash;

        var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
        for (var i = 0; i < hashes.length; i++) {
            hash = hashes[i].split('=');
            vars.push(hash[0]);
            vars[hash[0]] = hash[1];
        }
        return vars;
    }
    var user_id = getUrlVars()["user_id"];
    if (typeof user_id != 'undefined') {
        jQuery("#step-1").hide();
        jQuery("#step-2").show();
        jQuery("#step-3").hide();
        jQuery("#step-4").hide();
        jQuery("#step-5").hide();
        jQuery("#step-6").hide();
        jQuery('#step-7').hide();
        jQuery('#step-8').hide();
    } else {
        jQuery("#step-2").hide();
        jQuery("#step-3").hide();
        jQuery("#step-4").hide();
        jQuery("#step-5").hide();
        jQuery("#step-6").hide();
        jQuery('#step-7').hide();
        jQuery('#step-8').hide();
    }

    input = document.querySelector("#Contact");
    iti = window.intlTelInput(input, {
        separateDialCode: true,
        utilsScript: "../wp-content/plugins/mbm-prime-users-plugin/assets/js/utils.js"
    });

    jQuery('#CountryBlock').hide();
});

// ---------- Script for user register Step-1 ----------
jQuery('#UserRegister').submit(function (event) {
    event.preventDefault();
    var step = jQuery(this).find('button[type="submit"]').attr('data-step');

    jQuery.ajax({
        url: ajaxurl,
        type: 'post',
        data: {
            'action': 'mbm_new_user_register',
            'formdata': jQuery("#UserRegister").serialize()
        },
        success: function (result) {
            var resp = jQuery.parseJSON(result);
            if (resp && resp.status == 400) {
                if (resp.error != '') {
                    var err_htm = '<ul>';
                    jQuery(resp.error).each(function (i, val) {
                        err_htm += '<li>' + val + '</li>';
                    });
                    err_htm += '</ul>';

                    jQuery('.response').addClass('invalid');
                    jQuery('.response').removeClass('valid');
                    jQuery('.response').html(err_htm);
                }
            } else {
                jQuery('.current_user_id').val(resp.user_id);
                jQuery('.response').removeClass('invalid');
                jQuery('.response').addClass('valid');
                jQuery('.response').html(resp.message);
                jQuery('#UserRegister')[0].reset();
                jQuery("#step-1").hide();
                jQuery("#step-" + step + "").show();
                jQuery('.response').hide();
            }
        }
    });
});
// ---------- Script for user register Step-1 ----------

// ---------- Script for user register Step-2 ----------
jQuery("#ResendEmail").click(function (event) {
    event.preventDefault();
    jQuery.ajax({
        url: ajaxurl,
        type: 'post',
        data: {
            'action': 'mbm_resending_email',
            'formdata': jQuery(".current_user_id").val()
        },
        success: function (result) {
            var resp = jQuery.parseJSON(result);

            jQuery('.response').addClass('valid');
            jQuery('.response').html(resp.message);
        }
    });
});

jQuery("#EmailValidate").click(function (event) {
    event.preventDefault();
    var step = jQuery(this).attr('data-step');
    jQuery.ajax({
        url: ajaxurl,
        type: 'post',
        data: {
            'action': 'mbm_email_validate',
            'formdata': jQuery(".verification_code").val()
        },
        success: function (result) {
            var resp = jQuery.parseJSON(result);
            if (resp && resp.status == 400) {
                if (resp.error != '') {
                    var err_htm = '<ul>';
                    jQuery(resp.error).each(function (i, val) {
                        err_htm += '<li>' + val + '</li>';
                    });
                    err_htm += '</ul>';

                    jQuery('.response').addClass('invalid');
                    jQuery('.response').removeClass('valid');
                    jQuery('.response').html(err_htm);
                }
            } else {
                jQuery('.response').removeClass('invalid');
                jQuery('.response').addClass('valid');
                jQuery('.response').html(resp.message);
                jQuery("#step-2").hide();
                jQuery("#step-" + step + "").show();
                jQuery('.response').hide();
            }
        }
    });
});
// ---------- Script for user register Step-2 ----------

// ---------- Script for user register Step-3 ----------
jQuery('#CompanyRelatedInformation').submit(function (event) {
    event.preventDefault();
    var step = jQuery(this).find('button[type="submit"]').attr('data-step');
    jQuery.ajax({
        url: ajaxurl,
        type: 'post',
        data: {
            'action': 'company_related_infomation',
            'formdata': jQuery("#CompanyRelatedInformation").serialize()
        },
        success: function (result) {
            var resp = jQuery.parseJSON(result);
            if (resp && resp.status == 400) {
                if (resp.error != '') {
                    var err_htm = '<ul>';
                    jQuery(resp.error).each(function (i, val) {
                        err_htm += '<li>' + val + '</li>';
                    });
                    err_htm += '</ul>';

                    jQuery('.response').addClass('invalid');
                    jQuery('.response').removeClass('valid');
                    jQuery('.response').html(err_htm);
                }
            }
            else {
                jQuery('.response').removeClass('invalid');
                jQuery('.response').addClass('valid');
                jQuery('.response').html(resp.message);
                jQuery("#step-3").hide();
                jQuery("#step-" + step + "").show();
                jQuery('.response').hide();
            }
        }
    });
});
// ---------- Script for user register Step-3 ----------

// ---------- Script for user register Step-4 ----------
jQuery('#FStep4').submit(function (event) {
    event.preventDefault();
    var step = jQuery(this).find('button[type="submit"]').attr('data-step');
    jQuery.ajax({
        url: ajaxurl,
        type: 'post',
        data: {
            'action': 'company_infomation',
            'formdata': jQuery("#FStep4").serialize()
        },
        success: function (result) {
            var resp = jQuery.parseJSON(result);
            if (resp && resp.status == 400) {
                if (resp.error != '') {
                    var err_htm = '<ul>';
                    jQuery(resp.error).each(function (i, val) {
                        err_htm += '<li>' + val + '</li>';
                    });
                    err_htm += '</ul>';

                    jQuery('.response').addClass('invalid');
                    jQuery('.response').removeClass('valid');
                    jQuery('.response').html(err_htm);
                }
            }
            else {
                jQuery('.response').removeClass('invalid');
                jQuery('.response').addClass('valid');
                jQuery('.response').html(resp.message);
                jQuery("#step-4").hide();
                jQuery("#step-" + step + "").show();
                jQuery('.response').hide();
            }
        }
    });
});
// ---------- Script for user register Step-4 ----------

// ---------- Script for user register Step-5 ----------
jQuery('#Country').change(function (event) {
    var data = jQuery("#Country").val();
    if (data == "United_States") {
        jQuery('#CountryBlock').show();
    } else {
        jQuery('#CountryBlock').hide();
    }
});

jQuery('#FStep5').submit(function (event) {
    event.preventDefault();
    var step = jQuery(this).find('button[type="submit"]').attr('data-step');
    jQuery.ajax({
        url: ajaxurl,
        type: 'post',
        data: {
            'action': 'company_contact_details',
            'formdata': jQuery("#FStep5").serialize(),
            'dialcode': jQuery(".iti__selected-dial-code").text()
        },
        success: function (result) {
            var resp = jQuery.parseJSON(result);
            if (resp && resp.status == 400) {
                if (resp.error != '') {
                    var err_htm = '<ul>';
                    jQuery(resp.error).each(function (i, val) {
                        err_htm += '<li>' + val + '</li>';
                    });
                    err_htm += '</ul>';

                    jQuery('.response').addClass('invalid');
                    jQuery('.response').removeClass('valid');
                    jQuery('.response').html(err_htm);
                }
            }
            else {
                jQuery('.response').removeClass('invalid');
                jQuery('.response').addClass('valid');
                jQuery('.response').html(resp.message);
                jQuery("#step-5").hide();
                jQuery("#step-" + step + "").show();
                jQuery('.response').hide();
            }
        }
    });
});
// ---------- Script for user register Step-5 ----------

// ---------- Script for user register Step-6 ----------
jQuery("#skip7").click(function () {
    // var step = jQuery(this).attr('data-step');
    // jQuery("#step-6").hide();
    // jQuery("#step-" + step + "").show();
    window.location.replace("https://mbmprime.com/mbm-prime-membership/");
});

jQuery('#FStep6').submit(function (event) {
    event.preventDefault();
    var step = jQuery(this).find('button[type="submit"]').attr('data-step');
    jQuery.ajax({
        url: ajaxurl,
        type: 'post',
        data: {
            'action': 'company_personal_infomation',
            'formdata': jQuery("#FStep6").serialize(),
        },
        success: function (result) {
            var resp = jQuery.parseJSON(result);
            if (resp && resp.status == 400) {
                if (resp.error != '') {
                    var err_htm = '<ul>';
                    jQuery(resp.error).each(function (i, val) {
                        err_htm += '<li>' + val + '</li>';
                    });
                    err_htm += '</ul>';

                    jQuery('.response').addClass('invalid');
                    jQuery('.response').removeClass('valid');
                    jQuery('.response').html(err_htm);
                }
            }
            else {
                jQuery('.response').removeClass('invalid');
                jQuery('.response').addClass('valid');
                jQuery('.response').html(resp.message);
                jQuery("#step-6").hide();
                window.location.replace("https://mbmprime.com/mbm-prime-membership/");
                // jQuery("#step-" + step + "").show();
                // jQuery('.response').hide();
            }
        }
    });
});
// ---------- Script for user register Step-6 ----------

// ---------- Script for user register Step-7 ----------
jQuery('#FStep7').submit(function (event) {
    event.preventDefault();
    var step = jQuery(this).find('button[type="submit"]').attr('data-step');
    jQuery.ajax({
        url: ajaxurl,
        type: 'post',
        data: {
            'action': 'memberpress_sign_up',
            'formdata': jQuery("#FStep7").serialize(),
        },
        success: function (result) {
            var resp = jQuery.parseJSON(result);
            if (resp && resp.status == 400) {
                if (resp.error != '') {
                    var err_htm = '<ul>';
                    jQuery(resp.error).each(function (i, val) {
                        err_htm += '<li>' + val + '</li>';
                    });
                    err_htm += '</ul>';

                    jQuery('.response').addClass('invalid');
                    jQuery('.response').removeClass('valid');
                    jQuery('.response').html(err_htm);
                }
            }
            else {
                jQuery('.response').removeClass('invalid');
                jQuery('.response').addClass('valid');
                jQuery('.response').html(resp.message);
                jQuery("#step-7").hide();
                jQuery("#step-" + step + "").show();
                jQuery('.response').hide();
            }
        }
    });
});
// ---------- Script for user register Step-7 ----------

// ---------- Script for user register Step-8 ---------- 
jQuery('#FStep8').submit(function (event) {
    event.preventDefault();
    var step = jQuery(this).find('button[type="submit"]').attr('data-step');
    jQuery.ajax({
        url: ajaxurl,
        type: 'post',
        data: {
            'action': 'memberpress_final_sign_up',
            'formdata': jQuery("#FStep8").serialize(),
        },
        success: function (result) {
            alert(result);
            var resp = jQuery.parseJSON(result);
            // if (resp && resp.status == 400) {
            //     if (resp.error != '') {
            //         var err_htm = '<ul>';
            //         jQuery(resp.error).each(function (i, val) {
            //             err_htm += '<li>' + val + '</li>';
            //         });
            //         err_htm += '</ul>';

            //         jQuery('.response').addClass('invalid');
            //         jQuery('.response').removeClass('valid');
            //         jQuery('.response').html(err_htm);
            //     }
            // }
            // else {
            //     jQuery('.response').removeClass('invalid');
            //     jQuery('.response').addClass('valid');
            //     jQuery('.response').html(resp.message);
            //     jQuery("#step-8").hide();
            //     jQuery("#step-" + step + "").show();
            //     jQuery('.response').hide();
            // }
        }
    });
});
// ---------- Script for user register Step-8 ---------- 

/* ========================================= Senza Solutions ========================================= */
/* =================================================================================================== */
/* ========================================= Tomass Code ========================================= */


// const stepMsg = document.querySelector('#step-message');
// const inputsSection = document.querySelector('#form-inputs-section');
// const buttonsSection = document.querySelector('#form-buttons-section');
// const alertMsg = document.querySelector('#alert-message');
// const alertTypes = { DANGER: 'danger', WARNING: 'warning'};

// let token;
// const path ="/tomass/wp-json";

// const buildStepHtml = {
//     // TODO: you need to restructure the html of the steps because now there are going to be arround 8 steps
//     step1: () => {
//         const subtitle = 'Sign Up!'
//         const inputs = `
//             <input id="username-input" name="username" type="text" placeholder="username">
//             <input id="email-input" name="email" type="email" placeholder="email">
//             <input id="password-input" name="password" type="password" placeholder="password">
//         `;
//         const btn = `<button data-btnaction="step1" class="SteppedForm__section-buttons-signup-btn">Sign up<span data-btnaction="step1" class="dashicons dashicons-arrow-right-alt signup-btn-icon"></span></button>`;
//         return {subtitle, inputs, btn};
//     },

//     // ============= Senza Update Comment Below Code =================
//     // TODO: refactor step2 needs to be the waiting for email validation
//     step2: () => {
//         const subtitle = 'Add information about your company...';
//         const inputs = `
//             <div class="SteppedForm__double-inputs-wrapper">
//                 <input id="userTitle" name="userTitle" type="text" placeholder="Job Position">
//                 <input id="companyName" type="text" name="companyName" placeholder="Company Name">
//             </div>
//             <div class="SteppedForm__double-inputs-wrapper">
//                 <input id="phone" type="text" name="phone" placeholder="Phone">
//                 <input id="url" type="text" name="url" placeholder="Url">
//             </div>

//             <select name="socioeconomicCat" id="socioeconomicCat">
//                 <option value="" disabled selected>Socio-economic Category</option>
//                 <option value="">American Indian Owned Business</option>
//                 <option value="">Native American Owned</option>
//             </select>
//             <div class="SteppedForm__double-inputs-wrapper">
//                 <select name="companyType" id="companyType">
//                     <option value="" disabled selected>Company Type</option>
//                     <option>Agriculture, Forestry, Fishing and Hunting</option>
//                     <option>Mining</option>
//                     <option>Utilities</option>
//                     <option>Construction</option>
//                     <option>Manufacturing</option>
//                     <option>Wholesale Trade</option>
//                     <option>Retail Trade</option>
//                     <option>Transportation and Warehousing</option>
//                     <option>Information</option>
//                     <option>Finance and Insurance</option>
//                     <option>Real Estate Rental and Leasing</option>
//                     <option>Professional, Scientific, and Technical Services</option>
//                     <option>Management of Companies and Enterprises</option>
//                     <option>Administrative and Support and Waste Management and Remediation Services</option>
//                     <option>Educational Services</option>
//                     <option>Health Care and Social Assistance</option>
//                     <option>Arts, Entertainment, and Recreation</option>
//                     <option>Accommodation and Food Services</option>
//                     <option>Other Services (except Public Administration)</option>
//                     <option>Public Administration</option>
//                 </select>
//                 <select id="mbmUserRole" name="mbmUserRole">
//                     <option value="" selected disabled>Role in PRIME</option>
//                     <option value="buyer">Buyer</option>
//                     <option value="supplier">Supplier</option>
//                     <option value="investor">Inverstor</option>
//                     <option value="startup">Startup</option>
//                 </select>
//             </div>
//             <div class="SteppedForm__double-inputs-wrapper">
//                 <input id="address" type="text" name="address" placeholder="Address">
//                 <input id="city" type="text" name="city" placeholder="City">
//             </div>
//             <div class="SteppedForm__double-inputs-wrapper">
//                 <input id="zip" type="text" name="zip" placeholder="ZIP Code">
//                 <input id="stateProvince" type="text" name="stateProvince" placeholder="State/Province">
//             </div>
//             <input id="country" type="text" name="country" placeholder="Country">
//             <select name="opportunities" id="opportunities">
//                 <option value="" selected disabled>Opportunities...</option>
//             </select>
//             <label for="fedOpportunities">Are you interested in federal opportunities? <input type="checkbox" name="fedOpportunities" id="fedOpportunities"></label>
//         `;
//         const btn = `<button data-btnaction="step1" class="SteppedForm__section-buttons-signup-btn">Continue<span data-btnaction="step1" class="dashicons dashicons-arrow-right-alt signup-btn-icon"></span></button>`;
//         return {subtitle, inputs, btn};
//     },
//     step5: () => {
//         const subtitle = 'Let us help you get better matches...';
//         const inputs = `
//             <input id="companyDescription" name="companyDescription" type="text" placeholder="Company Description">
//             <input id="businessCertifications" name="businessCertifications" type="text" placeholder="Business Certifications">
//             <input id="revenue" name="revenue" type="text" placeholder="Revenue">
//             <input id="sales" name="sales" type="text" placeholder="Sales">
//             <input id="employeesNumber" name="employeesNumber" type="text" placeholder="Number of employees">
//             <label for="logo">Upload your logo:</label>
//             <input id="logo" name="logo" type="file" placeholder="Upload a logo">
//             <label for="brochure">Upload your brochure:</label>
//             <input id="brochure" name="brochure" type="file" placeholder="Upload a brochure">
//         `;
//         const btn = `<button data-btnaction="step1" class="SteppedForm__section-buttons-signup-btn">Finish Process<span data-btnaction="step1" class="dashicons dashicons-arrow-right-alt signup-btn-icon"></span></button>`;
//         return {subtitle, inputs, btn};
//     }
// };

// const stepButtonAction = {
//     step1: () => {
//         const inputsRequired = ['username', 'email', 'password'];
//         let inputs = document.querySelectorAll('input');
//         if (validateInputs(inputs, inputsRequired)){
//             inputs = [...inputs];
//             inputsData = {};
//             inputs.forEach((input) => {
//                 inputsData[input.name] = input.value;
//             })
//             body = {
//                 username: inputsData.username,
//                 email: inputsData.email,
//                 password: inputsData.password
//             };
//             // TODO: change this endpoint to be the buddyboss endpoint for creating users /wp-json/buddyboss/v1/signup
//             fetch(path+'/mbm/users', {
//                 method: 'POST',
//                 headers: {
//                     'Accept': 'application/json',
//                     'Content-Type': 'application/json'
//                 },
//                 body: JSON.stringify(body)
//             })
//             .then(handleFetchResp)
//             .then(data => {
//                 // TODO: handle response and show step 2. Step two should be waiting for email validation view
//                 if (data.code === 200){
//                     fd = new FormData();
//                     fd.append('username', body.username);
//                     fd.append('password', body.password);
//                     fetch(path+'/jwt-auth/v1/token', {
//                       method: 'POST',
//                       body: fd
//                     })
//                     .then(handleFetchResp)
//                     .then((data) => {
//                         token = data.token;
//                         renderStep(buildStepHtml.step2());
//                     })
//                 } else if(data.code === 406){
//                     setAlertMessage('The user already exists.', alertTypes.WARNING);
//                 }
//             })
//             .catch( err => {
//                 setAlertMessage('Sorry, there was an error. Please try again later.', alertTypes.DANGER)
//             })
//         }
//     },
//     step2: () => {
//         fetch()
//     },
//     step3: () => {

//     }
// }

// function setAlertMessage(message, type = alertTypes.WARNING)
// {
//     (Object.keys(alertTypes)).forEach(alertType => {alertMsg.classList.remove(alertTypes[alertType])})
//     alertMsg.innerText = message;
//     alertMsg.classList.add(type);
// }

// function handleFetchResp(resp)
// {
//     if (resp.status === 200){
//         return resp.json();
//     } else if (resp.status === 500) {
//         throw new Exception('Error 500');
//     } else if (resp.status === 404) {
//         throw new Exception('Error 404');
//     } else {
//         return resp.json();
//     }
// }

// function removeAllClass(inputs, classStr)
// {
//     inputs.forEach((input) => {
//        input.classList.remove(classStr);
//     });
// }

// function validateInputs(inputs, inputsRequired)
// {
//     let status = true;
//     removeAllClass(inputs, 'warning');
//     inputs.forEach((input) => {
//         if (inputsRequired.includes(input.name)){
//             if(input.value === ""){
//                 input.classList.add('warning');
//                 status = false;
//             }
//         }
//     });
//     return status;
// }

// function buttonsSectionClickHandler(ev)
// {
//     ev.preventDefault();
//     if (ev.target.dataset.btnaction){
//         stepButtonAction[ev.target.dataset.btnaction]();
//     }
// }

// function renderStep(step)
// {
//     stepMsg.innerText = step.subtitle;
//     inputsSection.innerHTML = step.inputs;
//     buttonsSection.innerHTML = step.btn;
// }

// buttonsSection.addEventListener('click', buttonsSectionClickHandler);

// renderStep(buildStepHtml.step1());
