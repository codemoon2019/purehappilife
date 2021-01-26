@include('incs.header')

@yield('section')
    <!-- bread crumb start -->
    <nav class="breadcrumb-section bg-white pt-5 pb-6rem">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <ol class="breadcrumb bg-transparent m-0 p-0 align-items-center">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">My profile</li>
                    </ol>
                </div>
            </div>
        </div>
   </nav>
 <!-- blog-section start -->
 <section class="blog-section pb-5">
        <div class="container">
            <div class="border-bottom cbb1 mb-3rem">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title pb-4 pb-md-4 position-relative">
                            <h2 class="title"> {{ auth()->user()->first_name }}, {{ auth()->user()->last_name }} {{ auth()->user()->middle_name != '' ? auth()->user()->middle_name.'.' : ''  }} </h2>
                            <p class="text">You can set the information of your account here.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 profile-picture">
                    <form action="/home/update-profile-picture" method="POST" enctype="multipart/form-data" id="update-profile-form">
                        <div class="text-center">
                            <img src="{{ auth()->user()->profile_picture_url == '' ? 'http://ssl.gstatic.com/accounts/ui/avatar_2x.png' : config('app.url').auth()->user()->profile_picture_url }} " class="avatar img-circle img-thumbnail" alt="avatar" style="width:200px; height:200px;">
                            <h6>Change your profile picture</h6>
                            <div class="form-group row">
                                <div class="col-lg-6 col-md-12 offset-lg-3">
                            <input type="file" class="file-upload form-control" name="txtFileProfilePicture" id="txtFileProfilePicture">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6 col-md-12 offset-lg-3">
                                    <button class="btn btn-success btn-save-profile form-control" style="height:30px; margin-top:10px;"> SAVE NEW PROFILE PICTURE </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-12">
                    <div id="accordion">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"
                                            aria-expanded="true" aria-controls="collapseOne">
                                            1 Personal Information
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        <form action="/home/update-user-info" method="POST" enctype="multipart/form-data" id="update-basic-info-form" class="personal-information">
                                            <div class="form-group row">
                                                <label for="inputPassword" class="col-md-3 col-form-label">First
                                                    name</label>
                                                <div class="col-md-6">
                                                    <input type="text" value="{{ auth()->user()->first_name }}" name="txtFirstName" id="txtFirstName" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputPassword" class="col-md-3 col-form-label">last name</label>
                                                <div class="col-md-6">
                                                    <input type="text" value="{{ auth()->user()->last_name }}" name="txtLastName" id="txtLastName" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputPassword" class="col-md-3 col-form-label">middle name</label>
                                                <div class="col-md-6">
                                                    <input type="text" value="{{ auth()->user()->middle_name }}" name="txtMiddleName" id="txtMiddleName" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputPassword" class="col-md-3 col-form-label">Email</label>
                                                <div class="col-md-6">
                                                    <input type="email" value="{{ auth()->user()->email }}" name="txtEmail" id="txtEmail" class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="inputPassword" class="col-md-3 col-form-label">Refferal link</label>
                                                <div class="col-md-6">
                                                    <div class="input-group mb-2 mr-sm-2">
                                                        <input type="text" value="{{ config('app.url') }}/register?ref_link={{ auth()->user()->referral_link }}" style="background-color:#c1c1c1;" class="form-control" id="inputPassword" disabled>
                                                        <div class="input-group-prepend">
                                                            <button type="button"
                                                                class="input-group-text btn-dark3 show-password">copy</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-lg-12">
                                                    <button class="btn btn-default btn-save-basic-info form-control" style="height:50px;"> SAVE BASIC INFORMATION </button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>


                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"
                                            aria-expanded="true" aria-controls="collapseOne">
                                            2 Set Password
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        <form action="/home/update-user-password" id="update-user-password" class="personal-information">
                                            <div class="form-group row">
                                                <label for="inputPassword" class="col-md-3 col-form-label">Current Password</label>
                                                <div class="col-md-6">
                                                    <input type="text" name="txtCurrentPassword" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputPassword" class="col-md-3 col-form-label">Type New Password</label>
                                                <div class="col-md-6">
                                                    <input type="text" name="txtNewPassword" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputPassword" class="col-md-3 col-form-label">Re-type New Password</label>
                                                <div class="col-md-6">
                                                    <input type="text" name="txtRetypePassword" class="form-control">
                                                </div>
                                            </div> 
                                            
                                            <div class="form-group row">
                                                <div class="col-lg-12">
                                                    <button class="btn btn-success btn-save-password form-control" style="height:50px;"> SAVE PASSWORD </button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" id="headingTwo">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" data-toggle="collapse"
                                            data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            3 Address
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="checkout-inner border-0">
                                            <div class="checkout-address p-0">
                                                <p>
                                                    The selected address will be used both as your personal address (for
                                                    invoice) and as your delivery address.
                                                </p>
                                            </div>
                                            <div class="check-out-content">
                                                @if(\App\Models\UserAddress::where('user_id', auth()->user()->id)->get()->count() != 0){
                                                    <form id="update-address-info" class="p-0" action="/home/update-user-address" method="post">
                                                        <div class="form-group row">
                                                            <label class="col-md-3">Address</label>
                                                            <div class="col-md-6">
                                                                <input class="form-control" value="{{ auth()->user()->userAddress->address }}" name="address1" type="text"
                                                                    required="">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-3">Address Complement</label>
                                                            <div class="col-md-6">
                                                                <input class="form-control" value="{{ auth()->user()->userAddress->address_complement }}" name="address2" type="text"
                                                                    required="">
                                                            </div>
                                                            <div class="col-md-3"> <span class="optional">
                                                                    Optional
                                                                </span> </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-3">City</label>
                                                            <div class="col-md-6">
                                                                <input class="form-control" value="{{ auth()->user()->userAddress->city }}" name="city" type="text" required="">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-3">State</label>
                                                            <div class="col-md-6">
                                                                <select class="form-control" name="state">
                                                                    <option>{{ auth()->user()->userAddress->state }}</option>
                                                                    <option>AA</option>
                                                                    <option>AE</option>
                                                                    <option>AP</option>
                                                                    <option>Alabama</option>
                                                                    <option>Alaska</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-3">Zip/Postal Code</label>
                                                            <div class="col-md-6">
                                                                <input class="form-control" value="{{ auth()->user()->userAddress->zip }}" name="postcode" type="text"
                                                                    required="">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-3">Country</label>
                                                            <div class="col-md-6">
                                                                <select class="form-control" name="country">
                                                                    <option value="{{ auth()->user()->userAddress->country }}">{{ auth()->user()->userAddress->country }}</option>
                                                                    <option>United States</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-lg-12">
                                                                <button class="btn btn-success btn-save-address form-control" style="height:50px;"> SAVE ADDRESS INFORMATION </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                @else
                                                <form id="update-address-info" class="p-0" action="/home/update-user-address" method="post">
                                                        <div class="form-group row">
                                                            <label class="col-md-3">Address</label>
                                                            <div class="col-md-6">
                                                                <input class="form-control" name="address1" type="text"
                                                                    required="">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-3">Address Complement</label>
                                                            <div class="col-md-6">
                                                                <input class="form-control" name="address2" type="text"
                                                                    required="">
                                                            </div>
                                                            <div class="col-md-3"> <span class="optional">
                                                                    Optional
                                                                </span> </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-3">City</label>
                                                            <div class="col-md-6">
                                                                <input class="form-control" name="city" type="text" required="">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-3">State</label>
                                                            <div class="col-md-6">
                                                                <select class="form-control" name="state">
                                                                    <option>AA</option>
                                                                    <option>AE</option>
                                                                    <option>AP</option>
                                                                    <option>Alabama</option>
                                                                    <option>Alaska</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-3">Zip/Postal Code</label>
                                                            <div class="col-md-6">
                                                                <input class="form-control" name="postcode" type="text"
                                                                    required="">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-3">Country</label>
                                                            <div class="col-md-6">
                                                                <select class="form-control" name="country">
                                                                    <option>Phillipines</option>
                                                                    <option>United States</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-lg-12">
                                                                <button class="btn btn-success btn-save-address form-control" style="height:50px;"> SAVE ADDRESS INFORMATION </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>                       
                        </div>
                    </div>
            </div>
        </div>
    </section>
    <!-- blog-section end -->                                            

    <script src="{{ config('app.cdn') . '/js/user/profile.js' . '?v=' . config('app.version') }}"></script>
@include('incs.footer')
