@include('incs.header')

@yield('section')

<!-- check-out-section start -->
<section class="check-out-section pt-6rem pb-5">
        <div class="container">
            <div class="row">
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
                                @if( auth()->user()->userCart->count() != 0 )
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
                                @foreach(auth()->user()->userCart as $cartItem)
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
                        @else
                        <p class="text-center">
                            No Orders Yet
                        </p>
                        @endif
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
                                                            <input class="form-control validate-field" error-message="Address is required" 
                                                            @if(auth()->user()->userAddress)
                                                                value="{{ auth()->user()->userAddress->address }}"
                                                            @endif     
                                                            @if(!auth()->user()->userAddress)
                                                                value=""
                                                            @endif                                                        
                                                            id="txtAddress1" type="text" required="">
                                                            <span class="error-message text-center" style="color:red;"></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3">Address Complement</label>
                                                        <div class="col-md-6">
                                                            <input class="form-control" id="txtAddress2"
                                                            @if(auth()->user()->userAddress)
                                                                value="{{ auth()->user()->userAddress->address_complement }}"
                                                            @endif     
                                                            @if(!auth()->user()->userAddress)
                                                                value=""
                                                            @endif    
                                                            type="text" required="">
                                                        </div>
                                                        <div class="col-md-3"> <span class="optional">
                                                                Optional
                                                            </span> </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3">City</label>
                                                        <div class="col-md-6">
                                                            <input class="form-control validate-field" error-message="City is required"
                                                            @if(auth()->user()->userAddress)
                                                                value="{{ auth()->user()->userAddress->city }}"
                                                            @endif     
                                                            @if(!auth()->user()->userAddress)
                                                                value=""
                                                            @endif    
                                                            id="txtCity" type="text" required="">
                                                            <span class="error-message text-center" style="color:red;"></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3">State</label>
                                                        <div class="col-md-6">
                                                            <input class="form-control validate-field" error-message="State is required"
                                                            @if(auth()->user()->userAddress)
                                                                value="{{ auth()->user()->userAddress->state }}"
                                                            @endif     
                                                            @if(!auth()->user()->userAddress)
                                                                value=""
                                                            @endif    
                                                            id="txtState" type="text" required="">
                                                            <!--<select class="form-control validate-field" id="txtState" error-message="State is required">
                                                                @if(auth()->user()->userAddress)
                                                                    <option value="{{ auth()->user()->userAddress->state }}">{{ auth()->user()->userAddress->state }}</option>
                                                                @endif     
                                                                @if(!auth()->user()->userAddress)
                                                                    <option value="">-- please choose --</option>
                                                                @endif    
                                                                <option value="AA">AA</option>
                                                                <option value="AE">AE</option>
                                                                <option value="AP">AP</option>
                                                                <option value="Alabama">Alabama</option>
                                                                <option value="Alaska">Alaska</option>
                                                            </select>-->

                                                            <span class="error-message text-center" style="color:red;"></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3">Zip/Postal Code</label>
                                                        <div class="col-md-6">
                                                            <input class="form-control validate-field" id="txtZipCode"
                                                            @if(auth()->user()->userAddress)
                                                                value="{{ auth()->user()->userAddress->zip }}"
                                                            @endif     
                                                            @if(!auth()->user()->userAddress)
                                                                value=""
                                                            @endif  
                                                            error-message="Zip is required" name="postcode" type="text" required="">
                                                            <span class="error-message text-center" style="color:red;"></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3">Country</label>
                                                        <div class="col-md-6">
                                                            <input class="form-control validate-field" error-message="Country is required"
                                                            @if(auth()->user()->userAddress)
                                                                value="{{ auth()->user()->userAddress->country }}"
                                                            @endif     
                                                            @if(!auth()->user()->userAddress)
                                                                value=""
                                                            @endif    
                                                            id="txtCountry" type="text" required="">
                                                            <!--<select class="form-control validate-field" id="txtCountry" error-message="Country is required">
                                                                @if(auth()->user()->userAddress)
                                                                    <option value="{{ auth()->user()->userAddress->country }}">{{ auth()->user()->userAddress->country }}</option>
                                                                @endif     
                                                                @if(!auth()->user()->userAddress)
                                                                    <option value="">-- please choose --</option>
                                                                @endif    
                                                                <option value="Phillipines">Phillipines</option>
                                                            </select>-->
                                                            <span class="error-message text-center" style="color:red;"></span>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @if( auth()->user()->userCart->count() != 0 )
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
                                            <input type="radio" id="test5" name="radio-group" class="radio-group-payment-method" value="paypal">
                                            <label for="test5">Pay by Paypal</label>
                                        </div>
                                        <!--
                                        <div class="custom-radio mb-4">
                                            <input type="radio" id="test4" name="radio-group" class="radio-group-payment-method" value="gcash">
                                            <label for="test4">Pay by G-Cash</label>
                                        </div>
                                        -->
                                          <!--
                                        <div class="custom-radio mb-4">
                                            <input type="radio" id="test3" name="radio-group" class="radio-group-payment-method" value="paymaya">
                                            <label for="test3">Pay by Paymaya</label>
                                        </div>
                                        -->
                                        <div class="custom-radio mb-4">
                                            <input type="radio" id="test3" name="radio-group" class="radio-group-payment-method" value="manual">
                                            <label for="test3">Direct Transaction</label>
                                        </div>
                                        <!--
                                        <div class="custom-radio mb-4">
                                            <input type="radio" id="test2" name="radio-group" class="radio-group-payment-method" value="happipoints">
                                            <label for="test2">Pay by Happi Points</label>
                                        </div>
                                        -->
                                        <div class="custom-radio mb-4">
                                            <input type="radio" id="test1" name="radio-group" class="radio-group-payment-method" value="cod">
                                            <label for="test1">Pay by Cash on Delivery</label>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
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
                                <li class="cart-total-price">₱ {{ number_format(auth()->user()->userCart->sum('total_price')) }}</li>
                                <li>₱ 0</li>
                                <li>₱ 0</li>
                            </ul>
                            <input type="number" id="txtTotalPrice" value="{{ round(auth()->user()->userCart->sum('total_price') / 52) }}" style="display:none;">
                        </li>

                        <li class="list-group-item">
                        <div class="row" id="manual-form">
                            <div class="col-lg-12 text-center">
                                <label>Select Payment Service:</label>
                                <select class="form-control" id="txtPaymentServiceType">
                                    <option>SELECT</option>
                                    <option>PayMaya</option>
                                    <option>GCash</option>
                                    <option>BDO</option>
                                </select>
                            </div>
                            <div class="col-lg-12 text-center">
                                <label><strong>Bank Information:</strong> <br> (BDO) 006781079084 | Rodel N. Tabunot</label>
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
                        <div id="gcash" class="payment">
                            <div id="gcash-container"></div>
                        </div>
                        <div id="paymaya" class="payment"></div>
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
        url: $('meta[name="app_url"]').attr('content')+'/home/shop/add-item-to-cart-input',
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
        url: $('meta[name="app_url"]').attr('content')+'/home/shop/add-item-to-cart',
        method:'POST',
        data:{
            '_token': $('meta[name="csrf-token"]').attr('content'),
            'id': this.id
        },
        success:function(data){
            
        }
    });
    
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
    formData.append('address1', $('#txtAddress1').val());
    formData.append('address2', $('#txtAddress2').val());
    formData.append('city', $('#txtCity').val());
    formData.append('state', $('#txtState').val());
    formData.append('zip', $('#txtZipCode').val());
    formData.append('country', $('#txtCountry').val());
    formData.append('proof', files);
    $.ajax({
                url: $('meta[name="app_url"]').attr('content')+'/home/shop/make-order-manual',
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
                        window.location.href = $('meta[name="app_url"]').attr('content')+'/home/my-orders';
                        Swal.fire({
                            icon: data.success == true ? 'success' : 'warning',
                            text: data.messages,
                        });
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

 $(document).on('click', '#btn-happipoints', function(){

            $.ajax({
                url: $('meta[name="app_url"]').attr('content')+'/home/shop/make-order-happi-points',
                method:'POST',
                data:{
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'address1': $('#txtAddress1').val(),
                    'address2': $('#txtAddress2').val(),
                    'city': $('#txtCity').val(),
                    'state': $('#txtState').val(),
                    'zip': $('#txtZipCode').val(),
                    'country': $('#txtCountry').val()
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
                        window.location.href = $('meta[name="app_url"]').attr('content')+'/home/my-orders';
                        Swal.fire({
                            icon: data.success == true ? 'success' : 'warning',
                            text: data.messages,
                        });
                    }else{
                        Swal.fire({
                            icon: data.success == true ? 'success' : 'warning',
                            text: data.messages,
                        });
                    }

                }
            })

 });

 $(document).on('click', '#btn-cod', function(){

$.ajax({
    url: $('meta[name="app_url"]').attr('content')+'/home/shop/make-order-cod',
    method:'POST',
    data:{
        '_token': $('meta[name="csrf-token"]').attr('content'),
        'address1': $('#txtAddress1').val(),
        'address2': $('#txtAddress2').val(),
        'city': $('#txtCity').val(),
        'state': $('#txtState').val(),
        'zip': $('#txtZipCode').val(),
        'country': $('#txtCountry').val()
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
            window.location.href = $('meta[name="app_url"]').attr('content')+'/home/my-orders';
            Swal.fire({
                icon: data.success == true ? 'success' : 'warning',
                text: data.messages,
            });
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
        url: $('meta[name="app_url"]').attr('content')+'/home/shop/minus-item-to-cart',
        method:'POST',
        data:{
            '_token': $('meta[name="csrf-token"]').attr('content'),
            'id': this.id
        },
        success:function(data){
            
        }
    });

});

 paypal.Buttons({
        createOrder: function(data, actions) {
            // This function sets up the details of the transaction, including the amount and line item details.
          return actions.order.create({
            purchase_units: [{
              amount: {
                value: $('#txtTotalPrice').val()
              }
            }]
          });
        },
        onApprove: function(data, actions) {
          // This function captures the funds from the transaction.
          return actions.order.capture().then(function(details) {
            Swal.fire({
                html: 'Setting up order creation',
                allowOutsideClick: false,
                showConfirmButton: false,
                willOpen: () => {
                  Swal.showLoading()
                },
            });

            $.ajax({
                url: $('meta[name="app_url"]').attr('content')+'/home/shop/make-order',
                method:'POST',
                data:{
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'address1': $('#txtAddress1').val(),
                    'address2': $('#txtAddress2').val(),
                    'city': $('#txtCity').val(),
                    'state': $('#txtState').val(),
                    'zip': $('#txtZipCode').val(),
                    'country': $('#txtCountry').val()
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

                    window.location.href = $('meta[name="app_url"]').attr('content')+'/home/my-orders';
                    Swal.fire({
                        icon: data.success == true ? 'success' : 'warning',
                        text: data.messages,
                    });

                }
            })

          });
        }
      }).render('#paypal-button-container');
      
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