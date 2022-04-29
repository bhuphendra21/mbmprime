<?php
/*
 * Template name: MBM Prime
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package BuddyBoss_Theme
 */

get_header();
?>

<style>
    .page-template-LandingPage div#content {
        background: linear-gradient(210deg, #0001, #001), url("/wp-content/uploads/2022/04/land_page.jpg");
        background-repeat: no-repeat;
        background-size: cover;
        background-position: inherit;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .container {
        width: 100%;
        height: auto;
    }

    .landing_page_con {
        width: 100%;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .quouts {
        width: 80%;
        margin: 10px auto;
        text-align: center;
        color: #F5F5F5;
        font-weight: 250;
    }

    .btn_gp {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .landing_btn {
        margin: 0px 20px;
    }

    .signup a {
        background: #DDA845;
        border-radius: 10px;
        border: #DDA845;
        display: flex;
        justify-content: center;
        align-items: center;
        color: #fff;
        transition: 0.5s;
        padding: 10px 30px;
    }

    .signup a:hover {
        color: #DDA860;
        border: 1px solid #ffffff;
        background: #ffffff;
    }

    .login_btn a {
        width: 150px;
        height: 40px;
        display: flex;
        justify-content: center;
        align-items: center;
        border: 1px solid #DDA845;
        border-radius: 10px;
        color: #DDA845;
        transition: 0.5s;
    }

    .login_btn a:hover {
        color: #fff;
        background: #DDA860;
    }

    .Heading {
        color: white;
        font-size: 35px;
    }

    #masthead {
        display: block !important;
    }

    .header-aside,
    #menu-item-246,
    .menu-item-246,
    .menu-item-245,
    .bb-login-section,
    #menu-item-245,
    .bb-icon-search {
        display: none;
    }


    @media screen and (max-width:650px) {
        .btn_gp {
            display: block;
            text-align: center;
        }

        .landing_page_con {
            height: auto;
            padding: 5px;
        }

        .landing_btn {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 10px 0px;
        }
    }
</style>

<div id="primary" class="content-area bb-grid-cell">
    <main id="main" class="site-main">

        <div class="container">
            <div class="landing_page_con">
                <div class="mamber_qt">
                    <div class="mbm_prime_mbs">
                        <h1 class="Heading">
                            <center><b>MBM PRIME Membership</b></center>
                        </h1>
                    </div>
                    <div class="quouts">
                        <p>MBM Prime is the largest business matchmaking network in the world. We connect businesses to great events from all sectors which contain real participants with interest to buy, sell or invest with valuable business opportunities. Every MBM Prime member is important. Our large MBM Prime network opens doors to global and national events and opportunities that you would not normally have access to. </p>
                    </div>

                    <div class="btn_gp">
                        <div class="signup landing_btn">
                            <a href="https://mbmprime.com/register/">Sign up</a>
                        </div>

                        <div class="login_btn landing_btn">
                            <a href="https://mbmprime.com/login-2/">Login</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
?>