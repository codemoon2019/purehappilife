@include('incs.header')

@yield('section')

<!-- check-out-section start -->
<section class="check-out-section pt-6rem pb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12" style="margin-bottom:10px;">
                    <div class="card">
                        <div class="card-body">
                            <strong>Note:</strong> Your data are stored in cookies so all the data are not permanently stored in our database. All of the placed order by guest are can monitored via email on their registered email upon filling up all the fields required in checkout orders.
                            If you want to monitored your orders by using the Cartsy Gallery account you can register <a href="/register" style="color:skyblue;">here.</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 mb-5">
                    <div id="accordion">
                        <div class="card">
                            <div class="card-header" id="headingFour">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" aria-expanded="false" aria-controls="collapseFour">
                                        Your cart
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseFour" class="collapse show" aria-labelledby="headingFour"
                                data-parent="#accordion">
                                <div class="card-body pt-0">

                                <table class="table">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center" scope="col">Product Image</th>
                                    <th class="text-center" scope="col">Product Name</th>
                                    <th class="text-center" scope="col">Qty</th>
                                    <th class="text-center" scope="col">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(\App\Models\GuestCart::where('guest_id', request()->cookie('purehappilife_session') )->get() as $cartItem)
                                    <tr>
                                        <th class="text-center" scope="row">
                                            <img src="{{ config('app.api_url') }}{{ $cartItem->productInfo->product_image_url }}" width="100px" height="100px" alt="img">
                                        </th>
                                        <td class="text-center">
                                            <span class="whish-title">{{ $cartItem->productInfo->product_name }}</span>
                                        </td>
                                        <td class="text-center">
                                            <div class="product-count style">
                                                <div class="count d-flex justify-content-center">
                                                    <input type="number" min="1" class="txtProductQuantity" id="{{ $cartItem->id }}" step="1" value="{{ $cartItem->quantity }}">
                                                    <div class="button-group">
                                                        <button class="count-btn increment btn-item-increment" id="{{  $cartItem->id }}"><i class="fas fa-chevron-up"></i></button>
                                                        <button class="count-btn decrement btn-item-decrement" id="{{  $cartItem->id }}"><i class="fas fa-chevron-down"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <span class="product-price" id="product-price-{{ $cartItem->id }}">
                                            ₱ {{ number_format($cartItem->total_price) }}
                                        </span></td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                                </div>
                            </div>
                        </div>


                        <div class="card">
                                <div class="card-header" id="headingTwo">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" data-toggle="collapse"
                                            data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Your Basic Information
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="checkout-inner border-0">
                                            <div class="checkout-address p-0">
                                                <p>
                                                    Please fill up you basic information.
                                                </p>
                                            </div>
                                            <div class="check-out-content">
                                                <form id="contact-form" class="p-0" action="https://live.hasthemes.com/html/1/drama-preview/drama/assets/php/mail.php" method="post">
                                    
                                                   <div class="form-group row">
                                                        <label class="col-md-3">First Name</label>
                                                        <div class="col-md-6">
                                                            <input class="form-control validate-field"
                                                             @if(isset($guestInfo->first_name))
                                                                value="{{ $guestInfo->first_name }}"
                                                             @endif
                                                             error-message="Firstname is required"  id="txtFirstName" type="text" required="">
                                                             <span class="error-message text-center" style="color:red;"></span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-3">Last Name</label>
                                                        <div class="col-md-6">
                                                             <input class="form-control validate-field"
                                                             @if(isset($guestInfo->last_name))
                                                                value="{{ $guestInfo->last_name }}"
                                                             @endif
                                                             error-message="Lastname is required"  id="txtLastName" type="text" required="">
                                                             <span class="error-message text-center" style="color:red;"></span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-3">Middle Name</label>
                                                        <div class="col-md-6">
                                                             <input class="form-control validate-field" 
                                                             @if(isset($guestInfo->middle_name))
                                                                value="{{ $guestInfo->middle_name }}"
                                                             @endif
                                                             error-message="Middlename is required"  id="txtMiddleName" type="text" required="">
                                                             <span class="error-message text-center" style="color:red;"></span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-3">Email</label>
                                                        <div class="col-md-6">
                                                             <input class="form-control validate-field"
                                                             @if(isset($guestInfo->first_name))
                                                                value="{{ $guestInfo->email }}"
                                                             @endif
                                                             error-message="Email is required"  id="txtEmail" type="text" required="">
                                                             <span class="error-message text-center" style="color:red;"></span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-3">Mobile</label>
                                                        <div class="col-md-6">
                                                            <input class="form-control"
                                                            @if(isset($guestInfo->mobile))
                                                                value="{{ $guestInfo->mobile }}"
                                                            @endif
                                                            id="txtMobile" type="text" >
                                                        </div>
                                                    </div>

                                    
                                                    
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="card">
                                <div class="card-header" id="headingTwo">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" data-toggle="collapse"
                                            data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Shipping Address
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo"
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
                                                <form id="contact-form" class="p-0" action="https://live.hasthemes.com/html/1/drama-preview/drama/assets/php/mail.php" method="post">
                                                    <div class="form-group row">
                                                        <label class="col-md-3">Address</label>
                                                        <div class="col-md-6">
                                                            <input class="form-control validate-field"
                                                            @if(isset($guestAddress->address))
                                                                value="{{ $guestAddress->address }}"
                                                            @endif
                                                            error-message="Address is required"  id="txtAddress1" type="text" required="">
                                                            <span class="error-message text-center" style="color:red;"></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3">Address Complement</label>
                                                        <div class="col-md-6">
                                                            <input class="form-control"
                                                            @if(isset($guestAddress->address_complement))
                                                                value="{{ $guestAddress->address_complement }}"
                                                            @endif
                                                            id="txtAddress2" type="text" required="">
                                                        </div>
                                                        <div class="col-md-3"> <span class="optional">
                                                                Optional
                                                            </span> </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3">City</label>
                                                        <div class="col-md-6">
                                                            <input class="form-control validate-field"
                                                            @if(isset($guestAddress->city))
                                                                value="{{ $guestAddress->city }}"
                                                            @endif
                                                            error-message="City is required"
                                                         
                                                            id="txtCity" type="text" required="">
                                                            <span class="error-message text-center" style="color:red;"></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3">State</label>
                                                        <div class="col-md-6">
                                                            <input class="form-control validate-field"
                                                            @if(isset($guestAddress->state))
                                                                value="{{ $guestAddress->state }}"
                                                            @endif
                                                            error-message="State is required" id="txtState" type="text" required="">
                        
                                                            <span class="error-message text-center" style="color:red;"></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3">Zip/Postal Code</label>
                                                        <div class="col-md-6">
                                                            <input class="form-control validate-field" id="txtZipCode"
                                                            error-message="Zip is required" name="postcode"
                                                            @if(isset($guestAddress->zip))
                                                                value="{{ $guestAddress->zip }}"
                                                            @endif
                                                            type="text" required="">
                                                            <span class="error-message text-center" style="color:red;"></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3">Country</label>
                                                        <div class="col-md-6">
                                                            <input class="form-control validate-field" error-message="Country is required"   
                                                            @if(isset($guestAddress->country))
                                                                value="{{ $guestAddress->country }}"
                                                            @endif
                                                            id="txtCountry" type="text" required="">
                                                       
                                                            <span class="error-message text-center" style="color:red;"></span>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <div class="card">
                            <div class="card-header" id="headingFour">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" aria-expanded="false" aria-controls="collapseFour">
                                        Choose your payment method Payment
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseFour" class="collapse show" aria-labelledby="headingFour"
                                data-parent="#accordion">
                                <div class="card-body pt-0">
                                    <div class="">
                                        <div class="custom-radio mb-4">
                                            <input type="radio" id="test3" name="radio-group" class="radio-group-payment-method" value="manual">
                                            <label for="test3">Manual Payment</label>
                                        </div>
                                        <div class="custom-radio mb-4">
                                            <input type="radio" id="test1" name="radio-group" class="radio-group-payment-method" value="cod">
                                            <label for="test1">Pay by Cash on Delivery</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4">
                    <ul class="list-group cart-summary rounded-0">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <ul class="items">
                                <li>Total (tax excl.)</li>
                                <li>Taxes</li>
                                <li>Shipping Fee</li>
                            </ul>
                            <ul class="amount">
                                <li class="cart-total-price">₱ {{ number_format(\App\Models\GuestCart::where('guest_id', request()->cookie('purehappilife_session') )->sum('total_price')) }}</li>
                                <li>₱ 0</li>
                                <li>₱ 0</li>
                            </ul>
                            <input type="number" id="txtTotalPrice" value="{{ round(\App\Models\GuestCart::where('guest_id', request()->cookie('purehappilife_session') )->sum('total_price') / 52) }}" style="display:none;">
                        </li>

                        <li class="list-group-item">
                        <div class="row" id="manual-form" style="display:none   ;">
                            <div class="col-lg-12 text-center">
                                <label>Select Payment Service:</label>
                                <select class="form-control" id="txtPaymentServiceType">
                                    <option>SELECT</option>
                                    <option value="PayMaya">PayMaya</option>
                                    <option value="GCash">GCash</option>
                                    <option value="BDO">BDO</option>
                                </select>
                            </div>
                            <div class="col-lg-12 text-center">
                                <label><strong>Bank Information:</strong> <br> (BDO) 006781079084 | Rodel N. Tabunot</label>
                            </div>
                            <div class="col-lg-12 text-center">
                                <label><strong>GCash:</strong> <br> (BDO) 006781079084 | Rodel N. Tabunot</label>
                            </div>
                            <div class="col-lg-12 text-center">
                                <label><strong>PayMaya:</strong> <br> (BDO) 006781079084 | Rodel N. Tabunot</label>
                            </div>
                            <div class="col-lg-12">
                                <label>Upload proof of payment: </label>
                                <input type="file" class="form-control validate-field-checkout" error-message-checkout="Please upload your proof of payment." id="txtProofOfPayment">
                                <span class="error-message-checkout text-center" style="color:red;"></span>
                            </div>
                            <div class="col-lg-12" style="margin-top:10px;">
                                <button class="btn btn-success form-control btn-manual-payment">Proceed with checkout</button>
                            </div>
                        </div>
                        <div id="validation-message" class="text-center">Fill out all the field required before to checkout.</div>  
                        <div id="paypal-button-container" style="display:none;"></div> 
                        <button class="btn btn-dark3 form-control" id="btn-cod" style="display:none;">Proceed with COD</button>
                        <div id="gcash" class="payment" style="display:none;"></div>
                        <div id="paymaya" class="payment" style="display:none;"></div>
                        <button class="btn btn-dark3 form-control" id="btn-happipoints" style="display:none;">Pay with Happi Points</button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </section>
    <!-- check-out-section end -->

@include('incs.footer')
<script src="{{ config('app.url') }}/assets/js/checkout.js"></script>
<script>

$(document).ready(function(){
 
 var submit = false;

 $(document).on('keyup', '.txtProductQuantity', function(){

    $.ajax({
        url: $('meta[name="app_url"]').attr('content')+'/shop/add-item-to-cart-input',
        method:'POST',
        data:{
            '_token': $('meta[name="csrf-token"]').attr('content'),
            'id': this.id,
            'value': this.value
        },
        success:function(data){
            $('.cart-total-price').text('₱ '+data.total_cart_price+'');
            $('.total-cart-item').text(data.total_cart_item);
            $('#product-price-'+data.id).text('₱ '+data.this_total_price+'')
        }
    });

 });

 $(document).on('click', '.btn-item-increment', function(){

    $.ajax({
        url: $('meta[name="app_url"]').attr('content')+'/shop/add-item-to-cart',
        method:'POST',
        data:{
            '_token': $('meta[name="csrf-token"]').attr('content'),
            'id': this.id
        },
        success:function(data){
            
        }
    });
    
 });



 $(document).on('click','.btn-guest-checkout', function(){
    alert('clicked')
 });


 $(document).on('click', '.btn-manual-payment', function(){
    submit = true;
    var files = $('#txtProofOfPayment')[0].files[0];
    if(validateCheckoutFields() == 0){
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });  
    var formData = new FormData();
    formData.append('fname', $('#txtFirstName').val());
    formData.append('lname', $('#txtLastName').val());
    formData.append('mname', $('#txtMiddleName').val());
    formData.append('email', $('#txtEmail').val());
    formData.append('mobile', $('#txtMobile').val());
    formData.append('address1', $('#txtAddress1').val());
    formData.append('address2', $('#txtAddress2').val());
    formData.append('city', $('#txtCity').val());
    formData.append('state', $('#txtState').val());
    formData.append('zip', $('#txtZipCode').val());
    formData.append('country', $('#txtCountry').val());
    formData.append('payment_service', $('#txtPaymentServiceType').val());
    formData.append('proof', files);
    $.ajax({
                url: $('meta[name="app_url"]').attr('content')+'/shop/make-order-manual',
                method:'POST',
                cache: false,
                contentType: false,
                processData: false,
                data:formData,
                beforeSend:function(){

                    Swal.fire({
                        html: 'Please wait while creating your product order ...',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        willOpen: () => {
                          Swal.showLoading()
                        },
                    });

                },
                success:function(data){
                    
                    if(data.success == true){
                        Swal.fire({
                            icon: data.success == true ? 'success' : 'warning',
                            text: data.messages,
                        });
                        location.reload()
                    }else{
                        Swal.fire({
                            icon: data.success == true ? 'success' : 'warning',
                            text: data.messages,
                        });
                    }

                }
            })

    }
    
 })


$(document).on('click', '#btn-cod', function(){

$.ajax({
    url: $('meta[name="app_url"]').attr('content')+'/shop/make-order-cod',
    method:'POST',
    data:{
        '_token': $('meta[name="csrf-token"]').attr('content'),
        'fname': $('#txtFirstName').val(),
        'lname': $('#txtLastName').val(),
        'mname': $('#txtMiddleName').val(),
        'email': $('#txtEmail').val(),
        'mobile': $('#txtMobile').val(),
        'address1': $('#txtAddress1').val(),
        'address2': $('#txtAddress2').val(),
        'city': $('#txtCity').val(),
        'state': $('#txtState').val(),
        'zip': $('#txtZipCode').val(),
        'country': $('#txtCountry').val(),
        'payment_service': $('#txtPaymentServiceType').val()
    },
    beforeSend:function(){

        Swal.fire({
            html: 'Please wait while creating your product order ...',
            allowOutsideClick: false,
            showConfirmButton: false,
            willOpen: () => {
              Swal.showLoading()
            },
        });

    },
    success:function(data){
        
        if(data.success == true){
            Swal.fire({
                icon: data.success == true ? 'success' : 'warning',
                text: data.messages,
            });
            location.reload()
        }else{
            Swal.fire({
                icon: data.success == true ? 'success' : 'warning',
                text: data.messages,
            });
        }

    }
})

});


$(document).on('click', '.btn-item-decrement', function(){

    $.ajax({
        url: $('meta[name="app_url"]').attr('content')+'/shop/minus-item-to-cart',
        method:'POST',
        data:{
            '_token': $('meta[name="csrf-token"]').attr('content'),
            'id': this.id
        },
        success:function(data){
            
        }
    });

});
      
      $(document).on('keyup change', '.validate-field-checkout', function(){
        if(submit != false){
            validateCheckoutFields();
        }
      })
      
    function validateCheckoutFields(){
        
        for(var i = 0, countError = 0, inputFieldsCount = $('.validate-field-checkout').length; i < inputFieldsCount; i++){
            
            var errorMessage = document.getElementsByClassName("validate-field-checkout")[i].getAttribute("error-message-checkout");
            if(document.getElementsByClassName("validate-field-checkout")[i].value == ""){
                countError += 1;
                document.getElementsByClassName("validate-field-checkout")[i].style.border = "1px solid red";
                document.getElementsByClassName("error-message-checkout")[i].textContent = errorMessage;
            }else{
                document.getElementsByClassName("validate-field-checkout")[i].style.border = "1px solid #e3e3e3";
                document.getElementsByClassName("error-message-checkout")[i].textContent = "";
            }
            
        }

        return countError;

    }

});

</script>