@include('incs.header')
<style type="text/css">
/* Star hover using lang hack in its own style wrapper, otherwise Gmail will strip it out */
    * [lang~="x-star-wrapper"]:hover *[lang~="x-star-number"]{
        color: #119da2 !important;
        border-color: #119da2 !important;
    }

    * [lang~="x-star-wrapper"]:hover *[lang~="x-full-star"],
    * [lang~="x-star-wrapper"]:hover ~ *[lang~="x-star-wrapper"] *[lang~="x-full-star"] {
      display : block !important;
      width : auto !important;
      overflow : visible !important;
      float : none !important;
      margin-top: -1px !important;
    }

    * [lang~="x-star-wrapper"]:hover *[lang~="x-empty-star"],
    * [lang~="x-star-wrapper"]:hover ~ *[lang~="x-star-wrapper"] *[lang~="x-empty-star"] {
      display : block !important;
      width : 0 !important;
      overflow : hidden !important;
      float : left !important;
      height: 0 !important;
    }
</style>


<style type="text/css">
/* Normal email CSS */
    @-ms-viewport {
        width: device-width;
    }
    body {
        margin: 0;
        padding: 0;
        min-width: 100%;
    }
    table {
        border-collapse: collapse;
        border-spacing: 0;
    }
    td {
        vertical-align: top;
    }
    img {
        border: 0;
        -ms-interpolation-mode: bicubic;
        max-width: 100% !important;
        height: auto;
    }
    a {
        text-decoration: none;
        color: #119da2;
    }
    a:hover {
        text-decoration: underline;
    }

    *[class=main-wrapper],
    *[class=main-content]{
        min-width: 0 !important;
        width: 600px !important;
        margin: 0 auto !important;
    }
    *[class=rating] {
      unicode-bidi: bidi-override;
      direction: rtl;
    }
    *[class=rating] > *[class=star] {
      display: inline-block;
      position: relative;
      text-decoration: none;
    }

    @media (max-width: 621px) {
        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            -o-box-sizing: border-box;
        }
        table {
            min-width: 0 !important;
            width: 100% !important;
        }
        *[class=body-copy] {
            padding: 0 10px !important;
        }
        *[class=main-wrapper],
        *[class=main-content]{
            min-width: 0 !important;
            width: 320px !important;
            margin: 0 auto !important;
        }
        *[class=ms-sixhundred-table] {
            width: 100% !important;
            display: block !important;
            float: left !important;
            clear: both !important;
        }
        *[class=content-padding] {
            padding-left: 10px !important;
            padding-right: 10px !important;
        }
        *[class=bottom-padding]{
            margin-bottom: 15px !important;
            font-size: 0 !important;
            line-height: 0 !important;
        }
        *[class=top-padding] {
            display: none !important;
        }
        *[class=hide-mobile] {
            display: none !important;
        }
        

        /* Prevent hover effects so double click issue doesn't happen on mobile devices */
        * [lang~="x-star-wrapper"]:hover *[lang~="x-star-number"]{
            color: #AEAEAE !important;
            border-color: #FFFFFF !important;
        }
        * [lang~="x-star-wrapper"]{
            pointer-events: none !important;
        }
        * [lang~="x-star-divbox"]{
            pointer-events: auto !important;
        }
        *[class=rating] *[class="star-wrapper"] a div:nth-child(2),
        *[class=rating] *[class="star-wrapper"]:hover a div:nth-child(2),
        *[class=rating] *[class="star-wrapper"] ~ *[class="star-wrapper"] a div:nth-child(2){
          display : none !important;
          width : 0 !important;
          height: 0 !important;
          overflow : hidden !important;
          float : left !important;
        }
        *[class=rating] *[class="star-wrapper"] a div:nth-child(1),
        *[class=rating] *[class="star-wrapper"]:hover a div:nth-child(1),
        *[class=rating] *[class="star-wrapper"] ~ *[class="star-wrapper"] a div:nth-child(1){
          display : block !important;
          width : auto !important;
          overflow : visible !important;
          float : none !important;
        }
    }
</style>
@yield('section')
 <!-- bread crumb start -->
 <nav class="breadcrumb-section bg-white pt-5 pb-6rem">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <ol class="breadcrumb bg-transparent m-0 p-0 align-items-center">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> My Order </li>
                    </ol>
                </div>
            </div>
        </div>
    </nav>
    <!-- bread crumb end -->
    <!-- whish-list-section satrt -->
    <section class="whish-list-section pb-6rem">
        <div class="container">
            <div class="row">
                @if($productOrder->count() == 0)
                <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-12">
                        <div class="card text-center">
                            <div class="card-body">
                                <span class="icon">
                            <i class="ion-ios-information"></i>
                        </span>
                                <h4 class="sub-title">
                                    No item on your order list
                                </h4>
                            </div>
                        </div>
                </div>
                @endif
                @if($productOrder->count() != 0)
                <div class="col-12">
                    <h3 class="title text-capitalize">Your product orders</h3>
                    <div class="table-responsive pt-4">
                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center" scope="col">Order #</th>
                                    <th class="text-center" scope="col">products</th>
                                    <th class="text-center" scope="col">product name</th>
                                    <th class="text-center" scope="col">Price</th>
                                    <th class="text-center" scope="col">Payment Status</th>
                                    <th class="text-center" scope="col">Order Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($productOrder->get() as $wishlist)
                                    <tr>
                                        <th class="text-center" scope="row">
                                            #{{ $wishlist->order_id }}
                                        </th>
                                        <th class="text-center" scope="row">
                                            <img src="{{ config('app.api_url') }}{{ $wishlist->productInfo->product_image_url }}" style="width:100px; height:100px;" alt="img">
                                        </th>
                                        <td class="text-center">
                                            <span class="whish-title">{{ $wishlist->productInfo->product_name }}</span>
                                        </td>
                                        <td class="text-center">
                                            <span class="product-price">
                                            ₱ {{ number_format($wishlist->productInfo->product_price) }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            {{ $wishlist->payment_method }}
                                        </td>
                                        <td class="text-center">
                                            @if($wishlist->status == 1)
                                                    PENDING
                                            @endif
                                            @if($wishlist->status == 2)
                                                    PREPARING
                                            @endif
                                            @if($wishlist->status == 3)
                                                    DELIVERING
                                            @endif
                                            @if($wishlist->status == 4)
                                                @if(\App\Models\UserComment::whereIn('pid', [$wishlist->pid])->whereIn('user_id', [auth()->user()->id])->get()->count() != 0 ) 
                                                    @if(\App\Models\UserComment::whereIn('pid', [$wishlist->pid])->whereIn('user_id', [auth()->user()->id])->get()->first()->points == 1)
                                                        <div class="star-rating">
                                                            <span class="ion-ios-star"></span>
                                                            <span class="ion-ios-star de-selected"></span>
                                                            <span class="ion-ios-star de-selected"></span>
                                                            <span class="ion-ios-star de-selected"></span>
                                                            <span class="ion-ios-star de-selected"></span>
                                                        </div>
                                                    @endif
                                                    @if(\App\Models\UserComment::whereIn('pid', [$wishlist->pid])->whereIn('user_id', [auth()->user()->id])->get()->first()->points == 2)
                                                        <div class="star-rating">
                                                            <span class="ion-ios-star"></span>
                                                            <span class="ion-ios-star"></span>
                                                            <span class="ion-ios-star de-selected"></span>
                                                            <span class="ion-ios-star de-selected"></span>
                                                            <span class="ion-ios-star de-selected"></span>
                                                        </div>
                                                    @endif
                                                    @if(\App\Models\UserComment::whereIn('pid', [$wishlist->pid])->whereIn('user_id', [auth()->user()->id])->get()->first()->points == 3)
                                                        <div class="star-rating">
                                                            <span class="ion-ios-star"></span>
                                                            <span class="ion-ios-star"></span>
                                                            <span class="ion-ios-star"></span>
                                                            <span class="ion-ios-star de-selected"></span>
                                                            <span class="ion-ios-star de-selected"></span>
                                                        </div>
                                                    @endif
                                                    @if(\App\Models\UserComment::whereIn('pid', [$wishlist->pid])->whereIn('user_id', [auth()->user()->id])->get()->first()->points == 4)
                                                        <div class="star-rating">
                                                            <span class="ion-ios-star"></span>
                                                            <span class="ion-ios-star"></span>
                                                            <span class="ion-ios-star"></span>
                                                            <span class="ion-ios-star"></span>
                                                            <span class="ion-ios-star de-selected"></span>
                                                        </div>
                                                    @endif
                                                    @if(\App\Models\UserComment::whereIn('pid', [$wishlist->pid])->whereIn('user_id', [auth()->user()->id])->get()->first()->points == 5)
                                                        <div class="star-rating">
                                                            <span class="ion-ios-star"></span>
                                                            <span class="ion-ios-star"></span>
                                                            <span class="ion-ios-star"></span>
                                                            <span class="ion-ios-star"></span>
                                                            <span class="ion-ios-star"></span>
                                                        </div>
                                                    @endif
                                                @endif
                                                @if(\App\Models\UserComment::whereIn('pid', [$wishlist->pid])->whereIn('user_id', [auth()->user()->id])->get()->count() == 0 ) 
                                                    <button class="btn btn-success btn-rate" id="{{ $wishlist->pid }}" data-toggle="modal" data-target="#quick-view">Rate this product (DELIVERED) <i class="fa fa-star"></i></button>
                                                @endif 
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>  
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>    
    <!-- whish-list-section end -->
  <!-- first modal -->
  <div class="modal fade style1" id="quick-view" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-8 col-md-12 col-sm-12 col-12 mb-12 offset-md-2" style="margin-top:10px;">
                            <label>Subject:</label>
                            <input type="text" class="form-control validate-field" id="txtSubject" error-message="Please input the subject of your comment">
                            <span class="error-message text-center"></span>
                        </div>
                        <div class="col-lg-8 col-md-12 col-sm-12 col-12 mb-12 offset-md-2" style="margin-top:10px;">
                            <label>Write a comment:</label>
                            <textarea class="form-control validate-field" id="txtComment" error-message="Please input your comment" rows="8"></textarea>
                            <span class="error-message text-center"></span>
                        </div>
                        <div class="col-12" style="margin-top:10px;">
                            <table class="main-wrapper" style="border-collapse: collapse;border-spacing: 0;display: table;table-layout: fixed; margin: 0 auto; -webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;text-rendering: optimizeLegibility;background-color: #f5f5f5; width: 100%;">
                                    <tbody>
                                        <tr>
                                            <td style="padding: 0;vertical-align: top" class="">
                                                <div class="bottom-padding" style="margin-bottom: 0px; line-height: 30px; font-size: 30px;">&nbsp;</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 0;vertical-align: top; width: 100%;" class="">
                                                <center>
                                                    <table class="main-content" style="width: 100%; max-width: 600px; border-collapse: separate;border-spacing: 0;margin-left: auto;margin-right: auto; border: 1px solid #EAEAEA; border-radius: 4px; -webkit-border-radius: 4px; -moz-border-radius: 4px; background-color: #ffffff; overflow: hidden;" width="600">
                                                        <tbody>
                                                            <tr>
                                                                <td style="padding: 0;vertical-align: top;">
                                                                    <table class="main-content" style="border-collapse: collapse;border-spacing: 0;margin-left: auto;margin-right: auto;width: 100%; max-width: 600px;">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td style="padding: 0;vertical-align: top;text-align: left">
                                                                                    <table class="contents" style="border-collapse: collapse;border-spacing: 0;width: 100%;">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td class="content-padding" style="padding: 0;vertical-align: top">
                                                                                                    <div style="margin-bottom: 0px; line-height: 30px; font-size: 30px;">&nbsp;</div>
                                                                                                    <div class="body-copy" style="margin: 0;">
                                                                                                        <div style="margin: 0;color: #60666d;font-size: 50px;font-family: sans-serif;line-height: 20px; text-align: left;">
                                                                                                            <div class="bottom-padding" style="margin-bottom: 0px; line-height: 15px; font-size: 15px;">&nbsp;</div>
                                                                                                            <div style="text-align: center; margin: 0; font-size: 10px;  text-transform: uppercase; letter-spacing: .5px;">Rating (select a star amount):</div>
                                                                                                            <div class="bottom-padding" style="margin-bottom: 0px; line-height: 7px; font-size: 7px;">&nbsp;</div>
                                                                                                            <div style="width: 100%; text-align: center; float: left;">
                                                                                                                <div class="rating" style="text-align: center; margin: 0; font-size: 50px; width: 275px; margin: 0 auto; margin-top: 10px;">
                                                                                                                    <table style="border-collapse: collapse;border-spacing: 0;width: 275px; margin: 0 auto; font-size: 50px; direction: rtl;" dir="rtl">
                                                                                                                        <tbody><tr>
                                                                                                                            <td style="padding: 0;vertical-align: top;" width="55" class="star-wrapper" lang="x-star-wrapper">
                                                                                                                                <div style="display: block; text-align: center; float: left;width: 55px;overflow: hidden;line-height: 60px;">
                                                                                                                                    <a href="http://example.com/?rating=5" class="star" data-value="5" target="_blank" lang="x-star-divbox" style="color: #FFCC00; text-decoration: none; display: inline-block;height: 50px;width: 55px;overflow: hidden;line-height: 60px;" tabindex="1">
                                                                                                                                        <div lang="x-empty-star" style="margin: 0;display: inline-block;">☆</div>
                                                                                                                                        <div lang="x-full-star" style="margin: 0;display: inline-block; width:0; overflow:hidden;float:left; display:none; height: 0; max-height: 0;">★</div>
                                                                                                                                    </a>
                                                                                                                                    <a href="http://example.com/?rating=5" class="star-number" data-value="5" target="_blank" lang="x-star-number" style="font-family: sans-serif;color: #AEAEAE; font-size: 14px; line-height: 14px; text-decoration: none; display: block;height: 50px;width: 55px;overflow: hidden;line-height: 60px;border-bottom: 3px solid #FFFFFF; text-align: center;">5</a>
                                                                                                                                </div>
                                                                                                                            </td>
                                                                                                                            <td style="padding: 0;vertical-align: top" width="55" class="star-wrapper" lang="x-star-wrapper">
                                                                                                                                <div style="display: block; text-align: center; float: left;width: 55px;overflow: hidden;line-height: 60px;">
                                                                                                                                    <a href="http://example.com/?rating=4" class="star" data-value="4" target="_blank" lang="x-star-divbox" style="color: #FFCC00; text-decoration: none; display: inline-block;height: 50px;width: 55px;overflow: hidden;line-height: 60px;" tabindex="2">
                                                                                                                                        <div lang="x-empty-star" style="margin: 0;display: inline-block;">☆</div>
                                                                                                                                        <div lang="x-full-star" style="margin: 0;display: inline-block; width:0; overflow:hidden;float:left; display:none; height: 0; max-height: 0;">★</div>
                                                                                                                                    </a>
                                                                                                                                    <a href="http://example.com/?rating=4" class="star-number" data-value="4" target="_blank" lang="x-star-number" style="font-family: sans-serif;color: #AEAEAE; font-size: 14px; line-height: 14px; text-decoration: none; display: block;height: 50px;width: 55px;overflow: hidden;line-height: 60px;border-bottom: 3px solid #FFFFFF; text-align: center;">4</a>
                                                                                                                                </div>
                                                                                                                            </td>
                                                                                                                            <td style="padding: 0;vertical-align: top" width="55" class="star-wrapper" lang="x-star-wrapper">
                                                                                                                                <div style="display: block; text-align: center; float: left;width: 55px;overflow: hidden;line-height: 60px;">
                                                                                                                                    <a href="http://example.com/?rating=3" class="star" data-value="3" target="_blank" lang="x-star-divbox" style="color: #FFCC00; text-decoration: none; display: inline-block;height: 50px;width: 55px;overflow: hidden;line-height: 60px;" tabindex="3">
                                                                                                                                        <div lang="x-empty-star" style="margin: 0;display: inline-block;">☆</div>
                                                                                                                                        <div lang="x-full-star" style="margin: 0;display: inline-block; width:0; overflow:hidden;float:left; display:none; height: 0; max-height: 0;">★</div>
                                                                                                                                    </a>
                                                                                                                                    <a href="http://example.com/?rating=3" class="star-number" data-value="3" target="_blank" lang="x-star-number" style="font-family: sans-serif;color: #AEAEAE; font-size: 14px; line-height: 14px; text-decoration: none; display: block;height: 50px;width: 55px;overflow: hidden;line-height: 60px;border-bottom: 3px solid #FFFFFF; text-align: center;">3</a>
                                                                                                                                </div>
                                                                                                                            </td>
                                                                                                                            <td style="padding: 0;vertical-align: top" width="55" class="star-wrapper" lang="x-star-wrapper">
                                                                                                                                <div style="display: block; text-align: center; float: left;width: 55px;overflow: hidden;line-height: 60px;">
                                                                                                                                    <a href="http://example.com/?rating=2" class="star" data-value="2" target="_blank" lang="x-star-divbox" style="color: #FFCC00; text-decoration: none; display: inline-block;height: 50px;width: 55px;overflow: hidden;line-height: 60px;" tabindex="4">
                                                                                                                                        <div lang="x-empty-star" style="margin: 0;display: inline-block;">☆</div>
                                                                                                                                        <div lang="x-full-star" style="margin: 0;display: inline-block; width:0; overflow:hidden;float:left; display:none; height: 0; max-height: 0;">★</div>
                                                                                                                                    </a>
                                                                                                                                    <a href="http://example.com/?rating=2" class="star-number" data-value="2" target="_blank" lang="x-star-number" style="font-family: sans-serif;color: #AEAEAE; font-size: 14px; line-height: 14px; text-decoration: none; display: block;height: 50px;width: 55px;overflow: hidden;line-height: 60px;border-bottom: 3px solid #FFFFFF; text-align: center;">2</a>
                                                                                                                                </div>
                                                                                                                            </td>
                                                                                                                            <td style="padding: 0;vertical-align: top" width="55" class="star-wrapper" lang="x-star-wrapper">
                                                                                                                                <div style="display: block; text-align: center; float: left;width: 55px;overflow: hidden;line-height: 60px;">
                                                                                                                                    <a href="http://example.com/?rating=1" class="star" data-value="1" target="_blank" lang="x-star-divbox" style="color: #FFCC00; text-decoration: none; display: inline-block;height: 50px;width: 55px;overflow: hidden;line-height: 60px;" tabindex="5">
                                                                                                                                        <div lang="x-empty-star" style="margin: 0;display: inline-block;">☆</div>
                                                                                                                                        <div lang="x-full-star" style="margin: 0;display: inline-block; width:0; overflow:hidden;float:left; display:none; height: 0; max-height: 0;">★</div>
                                                                                                                                    </a>
                                                                                                                                    <a href="http://example.com/?rating=1" class="star-number" data-value="1" target="_blank" lang="x-star-number" style="font-family: sans-serif;color: #AEAEAE; font-size: 14px; line-height: 14px; text-decoration: none; display: block;height: 50px;width: 55px;overflow: hidden;line-height: 60px;border-bottom: 3px solid #FFFFFF; text-align: center;">1</a>
                                                                                                                                </div>
                                                                                                                            </td>
                                                                                                                        </tr>
                                                                                                                    </tbody></table>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div style="margin-bottom: 0px; line-height: 30px; font-size: 30px;">&nbsp;</div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </center>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@include('incs.footer')
<script>

    var productID = 0;
    var submit = false;

    $(document).on('click', '.btn-rate', function(){
        productID = this.id;
    })

    $(document).on('click', '.star, .star-number', function(e){
        
        e.preventDefault();
        submit = true;
        validateFields()
        var points = this.getAttribute("data-value");
        
        $.ajax({
            url:'/home/shop/create-user-comment',
            method:'POST',
            data:{
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'points': points,
                'pid': productID,
                'subject': $('#txtSubject').val(),
                'comment': $('#txtComment').val(),
            },
            beforeSend:function(){
                Swal.fire({
                    text: 'Please wait while registering your account in Pure Happilife ...',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    willOpen: () => {
                    Swal.showLoading()
                    }
                })
            },
            success:function(data){
                Swal.fire({
                    icon: 'success',
                    text: response.userMessage,
                })
            }
        });

    });

    $(document).on('keyup', '.validate-field', function(){
        if(submit != false){
            validateFields();
        }
    })

    
    function validateFields(){

        for(var i = 0, countError = 0, inputFieldsCount = $('.validate-field').length; i < inputFieldsCount; i++){
            
            var errorMessage = document.getElementsByClassName("validate-field")[i].getAttribute("error-message");
            if(document.getElementsByClassName("validate-field")[i].value == ""){
                countError += 1;
                document.getElementsByClassName("validate-field")[i].style.border = "1px solid red";
                document.getElementsByClassName("error-message")[i].textContent = errorMessage;
            }else{
                document.getElementsByClassName("validate-field")[i].style.border = "1px solid #e3e3e3";
                document.getElementsByClassName("error-message")[i].textContent = "";
            }
            
        }

        return countError;

    }

</script>

