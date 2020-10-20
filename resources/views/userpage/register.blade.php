@include('incs.header')

@yield('section')
    <!-- bread crumb start -->
    <nav class="breadcrumb-section bg-white pt-5 pb-6rem">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <ol class="breadcrumb bg-transparent m-0 p-0 align-items-center">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Your account</li>
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
                <div class="col-12">
                    <h3 class="title"> Log in to your account</h3>
                    <form class="log-in-form">
                        <div class="row">
                            <div class="col-lg-4">
                                <label for="staticEmail">First Name: </label>
                                <input type="email" class="form-control" id="staticEmail">
                            </div>
                            <div class="col-lg-4">
                                <label for="staticEmail">Last Name: </label>
                                <input type="email" class="form-control" id="staticEmail">
                            </div>
                            <div class="col-lg-4">
                                <label for="staticEmail">Middle Name: </label>
                                <input type="email" class="form-control" id="staticEmail">
                            </div>
                        </div>

                        <div class="row" style="margin-top:10px;">
                            <div class="col-lg-6">
                            <label for="staticEmail">Email: </label>
                                <div class="input-group mb-2 mr-sm-2">
                                    <input type="password" class="form-control" id="inputPassword">
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top:10px;">
                            <div class="col-lg-6">
                            <label for="staticEmail">Mobile Phone: </label>
                                <div class="input-group mb-2 mr-sm-2">
                                    <input type="password" class="form-control" id="inputPassword">
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-top:10px;">
                            <div class="col-lg-6">
                            <label for="staticEmail">Password: </label>
                                <div class="input-group mb-2 mr-sm-2">
                                    <input type="password" class="form-control" id="inputPassword">
                                    <div class="input-group-prepend">
                                        <button type="button" class="input-group-text btn-dark3 show-password">show</button>
                                    </div>
                                </div>
                            </div>
    
                            <div class="col-lg-6">
                            <label for="staticEmail">Re-type your Password: </label>
                                <div class="input-group mb-2 mr-sm-2">
                                    <input type="password" class="form-control" id="inputPassword">
                                </div>
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
                                <button class="btn btn-dark3" style="margin-top:10px; width:100%;">REGISTER AN ACCOUNT</button>
                            </div>
                        </div>

                       
                </div>
            </div>
        </div>
    </div>
    <!-- my-account end -->

@include('incs.footer')