@include('incs.header')

@yield('section')
    <!-- bread crumb start -->
    <nav class="breadcrumb-section bg-white pt-5 pb-6rem">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <ol class="breadcrumb bg-transparent m-0 p-0 align-items-center">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Account registration</li>
                    </ol>
                </div>
            </div>
        </div>
   </nav>
   <!-- bread crumb end -->
   <!-- my-account start -->
   <div class="my-account pb-6rem">
        <div class="container">

            <div class="row text-center hide" id="register-successfully">
                <div class="col-lg-12">
                    <h3 class="title">Registered successfully</h3>
                    <form class="log-in-form" id="register-form">
                        <div class="row">
                                <div class="col-lg-6 col-md-6 offset-md-3">
                                    <p><strong>Don't reload or exit this page</strong></p>
                                    <label for="staticEmail">Your password successfully send to the registered email. If you dont see the sent password please check your "spam" email. </label>
                                    <input type="email" class="form-control validate-field-confirmation text-center" placeholder="Enter your password here" error-message-confirmation="Please input the given password to your email." id="txtConfirmationCode">
                                    <span class="error-message-confirmation text-center" style="color:red;"></span>
                                </div>
                                <div class="col-lg-6 col-md-6 offset-md-3" style="margin-top:10px;">
                                    <button class="btn btn-primary btn-continue-authentication" style="width:100%;">CONTINUE</button>
                                </div>
                        </div>
                        <div class="row" style="margin-top:10px;">
                                <div class="col-lg-6 col-md-6 offset-md-3">
                                    <button class="btn btn-primary btn-resend-password" style="width:100%;">RESEND A NEW PASSWORD</button>
                                    <label for="staticEmail" id="countdown">Did'nt receive the code even you check your spam email ? Try to resend a new password.</label>
                                </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row" id="registration-form-content">
                <div class="col-12">
                    <h3 class="title"> Register a new account</h3>
                    <form class="log-in-form" id="register-form">
                        <div class="row">
                            <input type="text" id="txtRefLink" style="display:none;" value="{{ Request::get('ref_link') != null ? Request::get('ref_link') : '' }}">
                            <div class="col-lg-4">
                                <label for="staticEmail">First Name: </label>
                                <input type="email" class="form-control validate-field" error-message="First name is required" id="txtFirstName">
                                <span class="error-message text-center"></span>
                            </div>
                            <div class="col-lg-4">
                                <label for="staticEmail">Last Name: </label>
                                <input type="email" class="form-control validate-field" error-message="Last name is required" id="txtLastName">
                                <span class="error-message text-center"></span>
                            </div>
                            <div class="col-lg-4">
                                <label for="staticEmail">Middle Name: </label>
                                <input type="email" class="form-control validate-field" error-message="Middle name is required" id="txtMiddleName">
                                <span class="error-message text-center"></span>
                            </div>
                        </div>
                        <div class="row" style="margin-top:10px;">
                            <div class="col-lg-6">
                            <label for="staticEmail">Email: </label>
                                <div class="input-group mb-2 mr-sm-2">
                                    <input type="email" class="form-control validate-field" error-message="Email is required" id="txtEmail">
                                </div>
                                <span class="error-message text-center"></span>
                            </div>
                        </div>
                        <div class="row" style="margin-top:10px;">
                            <div class="col-lg-6">
                            <label for="staticEmail">Mobile Phone: </label>
                                <div class="input-group mb-2 mr-sm-2">
                                    <input type="phone" class="form-control validate-field" error-message="Mobile phone is required" id="txtMobilePhone">
                                </div>
                                <span class="error-message text-center"></span>
                            </div>
                        </div>

                        <div class="row" style="margin-top:10px;"> 
                            <div class="col-lg-12">
                                <div class="border-top"></div>
                            </div>
                            <div class="col-lg-6" style="margin-top:10px;">
                                Do you have an account ? <a href="/login">Login here</a>
                                <br>
                                <a href="/login">Forgot your password ?</a>
                            </div>
                            <div class="col-lg-6 text-right" style="margin-top:10px;">
                                <button class="btn btn-dark3 btn-register-user" style="margin-top:10px; width:100%;">REGISTER AN ACCOUNT</button>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <!-- my-account end -->
@include('incs.footer')
<script src="{{ config('app.cdn') . '/js/user/registeruser.js' . '?v=' . config('app.version') }}"></script>