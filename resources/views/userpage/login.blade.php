@include('incs.header')

@yield('section')
    <!-- bread crumb start -->
    <nav class="breadcrumb-section bg-white pt-5 pb-6rem">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <ol class="breadcrumb bg-transparent m-0 p-0 align-items-center">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Login an account</li>
                    </ol>
                </div>
            </div>
        </div>
   </nav>
   <!-- bread crumb end -->
   <!-- my-account start -->
   <div class="my-account pb-6rem">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12 offset-lg-2">
                    <h3 class="title text-center"> Log in to your account</h3>
                    <form class="log-in-form">
                        <div class="row">
                            <div class="col-lg-8 offset-lg-2">
                            <label class="pull-left">Email: </label>
                                <div class="input-group mb-2 mr-sm-2">
                                    <input type="phone" class="form-control validate-field" error-message="Please input your email" id="txtEmail">
                                </div>
                                <span class="error-message text-center"></span>
                            </div>
                            <div class="col-lg-8 offset-lg-2">
                            <label for="staticEmail">Password: </label>
                                <div class="input-group mb-2 mr-sm-2">
                                    <input type="password" class="form-control validate-field" error-message="Please input your password" id="txtPassword">
                                    <div class="input-group-prepend">
                                        <button type="button" class="input-group-text btn-dark3 show-password">show</button>
                                    </div>
                                </div>
                                <span class="error-message text-center"></span>
                            </div>
                        </div>
                        <div class="form-group row pb-3 text-center">
                            <div class="col-md-6 offset-md-3">
                                <div class="login-form-links">
                                    <!-- <a href="#" class="for-get">Forgot your password?</a> -->
                                    <div class="sign-btn">
                                        <button class="btn btn-dark3 btn-login">Sign in</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row text-center">
                            <div class="col-12">
                                <div class="border-top">
                                    <a href="/register" class="no-account">No account? Create one here</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@include('incs.footer')
<script src="{{ config('app.cdn') . '/js/user/login.js' . '?v=' . config('app.version') }}"></script>