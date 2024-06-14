<?php
include('config/functions.php');
// redirect if user is loggedin
redirectToDashboardIfLoggedIn();
$metatags = [
    'description' => 'This is a sample description.',
    'keywords' => 'PHP, meta tags, example',
    'author' => 'John Doe'
];
generate_head_tags('Log in', $metatags, [], ['Inter:wght@100..900']);
// load hat-tip
loadPlugin('hat-tip');
?>
<!--begin::App-->
<div class="d-flex flex-column flex-root app-root" id="kt_app_root">

    <!--begin::Page-->
    <div class="app-page flex-column flex-column-fluid" id="kt_app_page">

        <!--begin::Theme mode setup on page load-->
        <script>
            var defaultThemeMode = "light";
            var themeMode;
            if (document.documentElement) {
                if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                    themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
                } else {
                    if (localStorage.getItem("data-bs-theme") !== null) {
                        themeMode = localStorage.getItem("data-bs-theme");
                    } else {
                        themeMode = defaultThemeMode;
                    }
                }
                if (themeMode === "system") {
                    themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
                }
                document.documentElement.setAttribute("data-bs-theme", themeMode);
            }
        </script>
        <!--end::Theme mode setup on page load-->
        <!--begin::App-->
        <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
            <!--begin::Page-->

            <!-- sign in page -->
            <!--begin::Authentication - Sign-in -->
            <div class="d-flex flex-column flex-lg-row flex-column-fluid">
                <!--begin::Body-->
                <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
                    <!--begin::Form-->
                    <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                        <!--begin::Wrapper-->
                        <div class="w-lg-500px p-10">
                            <!--begin::Form-->
                            <form class="form w-100" id="loginForm">
                                <!--begin::Heading-->
                                <div class="text-center mb-11">
                                    <!--begin::Title-->
                                    <h1 class="text-gray-900 fw-bolder mb-3">Sign In</h1>
                                    <!-- Title-->
                                    <!--begin::Subtitle-->
                                    <div class="text-gray-500 fw-semibold fs-6">to your account</div>
                                    <!-- Subtitle=-->
                                </div>
                                <!--begin::Heading-->


                                <!--begin::Input group=-->
                                <div class="fv-row mb-8">
                                    <!--begin::Email-->
                                    <input type="text" placeholder="Email" name="email_address" id="email_address" autocomplete="off" class="form-control bg-transparent" />
                                    <!-- Email-->
                                </div>
                                <!-- Input group=-->
                                <div class="fv-row mb-3">
                                    <!--begin::Password-->
                                    <input type="password" placeholder="Password" name="password" id="password" autocomplete="off" class="form-control bg-transparent" />
                                    <!-- Password-->
                                </div>
                                <!-- Input group=-->
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                                    <div></div>
                                    <!--begin::Link-->
                                    <a href="forgot-password" class="link-primary">Forgot Password ?</a>
                                    <!-- Link-->
                                </div>
                                <!-- Wrapper-->
                                <!--begin::Submit button-->
                                <div class="d-grid mb-10">
                                    <button id="loginFormBtn" class="btn mx-auto btn-primary">Log in</button>

                                </div>
                                <!-- Submit button-->
                                <!--begin::Sign up-->
                                <div class="text-gray-500 text-center fw-semibold fs-6">Not a Member yet?
                                    <a href="signup" class="link-primary">Sign up</a>
                                </div>
                                <!-- Sign up-->
                            </form>
                            <!-- Form-->
                        </div>
                        <!-- Wrapper-->
                    </div>
                    <!-- Form-->

                </div>
                <!-- Body-->
                <!--begin::Aside-->
                <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2" style="background-image: url(assets/media/misc/auth-bg.png)">
                    <!--begin::Content-->
                    <div class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 w-100">
                        <!--begin::Logo-->
                        <a href="index.html" class="mb-0 mb-lg-12">
                            <img alt="Logo" src="assets/media/logos/custom-1.png" class="h-60px h-lg-75px" />
                        </a>
                        <!-- Logo-->
                        <!--begin::Title-->
                        <h1 class="d-none d-lg-block text-white fs-2qx fw-bolder text-center mb-7">Fast, Efficient and Productive</h1>
                        <!-- Title-->
                        <!--begin::Text-->
                        <div class="d-none d-lg-block text-white fs-base text-center">In this kind of post,
                            <a href="#" class="opacity-75-hover text-warning fw-bold me-1">the blogger</a>introduces a person they’ve interviewed
                            <br />and provides some background information about
                            <a href="#" class="opacity-75-hover text-warning fw-bold me-1">the interviewee</a>and their
                            <br />work following this is a transcript of the interview.
                        </div>
                        <!-- Text-->
                    </div>
                    <!-- Content-->
                </div>
                <!-- Aside-->
            </div>
            <!-- Authentication - Sign-in-->
        </div>
        <!-- Root-->
        <!-- ./sign in page -->

    </div>

    <!-- Hat-tip -->
    <div id="hattip" data-loud="" role="alert">
        <span id="msg"></span>
        <button type="button" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
    <!-- ./Hat-tip -->

    <!-- dont' delete below div -->
</div>
</div>

<!-- script to handle -->
<!-- dont' delete below div -->
<?php end_html(['login'], true); ?>