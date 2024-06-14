<?php include('config/functions.php');
$metatags = [
    'description' => 'This is a sample description.',
    'keywords' => 'PHP, meta tags, example',
    'author' => 'John Doe'
];
generate_head_tags('Sign Up', $metatags, [], ['Inter:wght@100..900']);
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
                            <form class="form w-100" id="signupForm">
                                <!--begin::Heading-->
                                <div class="text-center mb-11">
                                    <!--begin::Title-->
                                    <h1 class="text-gray-900 fw-bolder mb-3">Sign Up</h1>
                                    <!--end::Title-->
                                    <!--begin::Subtitle-->
                                    <div class="text-gray-500 fw-semibold fs-6">to create an account</div>
                                    <!--end::Subtitle=-->
                                </div>
                                <!--begin::Heading-->
                                <div class="fv-row mb-8">
                                    <!--begin::Username-->
                                    <input type="text" placeholder="Username" name="username" id="username" autocomplete="off" class="form-control bg-transparent" />
                                    <!--end::Username-->
                                </div>

                                <div class="row">
                                    <div class="col-12 col-lg-6 col-md-6 col-xxl-6">
                                        <div class="fv-row mb-8">
                                            <!--begin::Name-->
                                            <input type="text" placeholder="First Name" name="first_name" id="first_name" autocomplete="off" class="form-control bg-transparent" />
                                            <!--end::Name-->
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="fv-row mb-8">
                                            <!--begin::Name-->
                                            <input type="text" placeholder="Last Name" name="last_name" id="last_name" autocomplete="off" class="form-control bg-transparent" />
                                            <!--end::Name-->
                                        </div>
                                    </div>
                                </div>





                                <!--begin::Input group=-->
                                <div class="fv-row mb-8">
                                    <!--begin::Email-->
                                    <input type="text" placeholder="Email" name="email_address" id="email_address" autocomplete="off" class="form-control bg-transparent" />
                                    <!--end::Email-->
                                </div>
                                <!--begin::Input group-->
                                <div class="fv-row mb-8" data-kt-password-meter="true">
                                    <!--begin::Wrapper-->
                                    <div class="mb-1">
                                        <!--begin::Input wrapper-->
                                        <div class="position-relative mb-3">
                                            <input class="form-control bg-transparent" type="password" placeholder="Password" name="password" id="password" autocomplete="off" />
                                            <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                                                <i class="ki-outline ki-eye-slash fs-2"></i>
                                                <i class="ki-outline ki-eye fs-2 d-none"></i>
                                            </span>
                                        </div>
                                        <!--end::Input wrapper-->
                                        <!--begin::Meter-->
                                        <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                                        </div>
                                        <!--end::Meter-->
                                    </div>
                                    <!--end::Wrapper-->
                                    <!--begin::Hint-->
                                    <div class="text-muted">Use 8 or more characters with a mix of letters, numbers & symbols.</div>
                                    <!--end::Hint-->
                                </div>
                                <!--end::Input group=-->
                                <!--begin::Input group=-->
                                <div class="fv-row mb-8">
                                    <!--begin::Repeat Password-->
                                    <input placeholder="Repeat Password" name="confirm-password" id="confirm-password" type="password" autocomplete="off" class="form-control bg-transparent" />
                                    <!--end::Repeat Password-->
                                </div>
                                <!--end::Input group=-->
                                <!--begin::Select -->
                                <div class="fv-row mb-8">
                                    <!--begin::Select Country Select Country-->
                                    <select name="my_country" id="my_country" class="form-select bg-transparent">
                                        <option value="select_option" disabled selected>Select a Country</option>
                                    </select>
                                    <!--end::Select Country Select Country-->
                                </div>
                                <!--end::Select=-->
                                <!--begin::Accept-->
                                <!-- <div class="fv-row mb-8">
                                    <label class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="toc" value="1" />
                                        <span class="form-check-label fw-semibold text-gray-700 fs-base ms-1">I Accept the
                                            <a href="#" class="ms-1 link-primary">Terms</a></span>
                                    </label>
                                </div> -->
                                <!--end::Accept-->
                                <!--begin::Submit button-->
                                <button type="submit" id="signupFormBtn" class="btn btn-primary mx-auto d-block mb-5">
                                    Sign Up
                                </button>
                                <!--end::Submit button-->
                                <!--begin::Sign up-->
                                <div class="text-gray-500 text-center fw-semibold fs-6">Already have an Account?
                                    <a href="login" class="link-primary fw-semibold">Sign in</a>
                                </div>
                                <!--end::Sign up-->
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Form-->
                </div>
                <!--end::Body-->
                <!--begin::Aside-->
                <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2" style="background-image: url(assets/media/misc/auth-bg.png)">
                    <!--begin::Content-->
                    <div class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 w-100">
                        <!--begin::Logo-->
                        <a href="index.html" class="mb-0 mb-lg-12">
                            <img alt="Logo" src="assets/media/logos/custom-1.png" class="h-60px h-lg-75px" />
                        </a>
                        <!--end::Logo-->
                        <!--begin::Image-->
                        <img class="d-none d-lg-block mx-auto w-275px w-md-50 w-xl-500px mb-10 mb-lg-20" src="assets/media/misc/auth-screens.png" alt="" />
                        <!--end::Image-->
                        <!--begin::Title-->
                        <h1 class="d-none d-lg-block text-white fs-2qx fw-bolder text-center mb-7">Fast, Efficient and Productive</h1>
                        <!--end::Title-->
                        <!--begin::Text-->
                        <div class="d-none d-lg-block text-white fs-base text-center">In this kind of post,
                            <a href="#" class="opacity-75-hover text-warning fw-bold me-1">the blogger</a>introduces a person they’ve interviewed
                            <br />and provides some background information about
                            <a href="#" class="opacity-75-hover text-warning fw-bold me-1">the interviewee</a>and their
                            <br />work following this is a transcript of the interview.
                        </div>
                        <!--end::Text-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Aside-->
            </div>
            <!--end::Authentication - Sign-up-->
        </div>

    </div>

    <!-- dont' delete below div -->
</div>
<!-- Hat-tip -->
<div id="hattip" data-loud="" role="alert">
    <span id="msg"></span>
    <button type="button" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<!-- ./Hat-tip -->
</div>
</div>

<?php
$js = <<<JS
$(document).ready(function() {
    $.ajax({
        url: 'https://api.first.org/data/v1/countries',
        type: 'GET',
        success: function(response) {
            if (response['status'] === 'OK') {
                $.each(response['data'], function(code, country) {
                    $('#my_country').append('<option value="' + country.country + '">' + country.country + '</option>');
                });
            } else {
                console.error('Error: ' + response['status']);
            }
        },
        error: function(xhr, status, error) {
            console.error(status, error);
        }
    });
});
JS;
?>
<!-- dont' delete below div -->
<?php end_html(['signup'], true, false, $js); ?>