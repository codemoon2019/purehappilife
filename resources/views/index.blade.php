@include('incs.header')

@yield('section')


 <!-- main slider start -->
 <section class="bg-light position-relative">
      <div class="main-slider slick-dots-style slick-dots-align-center">
         <div class="slider-item bg-img bg-img1">
            <div class="container">
               <div class="row align-items-center slider-height">
                  <div class="col-12">
                     <div class="slider-content">
         
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- slider-item end -->
         <div class="slider-item bg-img bg-img2">
            <div class="container">
               <div class="row align-items-center slider-height slide2">
                  <div class="col-12">
                     <div class="slider-content">
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- slider-item end -->
         <div class="slider-item bg-img bg-img3">
            <div class="container">
               <div class="row align-items-center slider-height slide2">
                  <div class="col-12">
                     <div class="slider-content">
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- slider-item end -->
      </div>
      <!-- slick-progress -->
      <div class="slick-progress">
         <span></span>
      </div>
      <!-- slick-progress end-->
   </section>
   <!-- main slider end -->
   <!-- staic media start -->
   <section class="static-media-section py-6rem bg-white">
      <div class="container">
         <div class="static-media-wrap">
            <div class="row">
               <div class="col-lg-3 col-sm-6 py-3">
                  <div class="media static-media2">
                     <img class="align-self-center mr-3" src="assets/img/icon/2.png" alt="icon">
                     <div class="media-body">
                        <h4 class="title text-capitalize text-dark">Free Shipping</h4>
                        <p class="text">Within Metro Manila</p>
                     </div>
                  </div>
               </div>
               <div class="col-lg-3 col-sm-6 py-3">
                  <div class="media static-media2">
                     <img class="align-self-center mr-3" src="assets/img/icon/3.png" alt="icon">
                     <div class="media-body">
                        <h4 class="title text-capitalize text-dark">Free Returns</h4>
                        <p class="text">Returns are free within 7 days</p>
                     </div>
                  </div>
               </div>
               <div class="col-lg-3 col-sm-6 py-3">
                  <div class="media static-media2">
                     <img class="align-self-center mr-3" src="assets/img/icon/4.png" alt="icon">
                     <div class="media-body">
                        <h4 class="title text-capitalize text-dark">100% Payment Secure</h4>
                        <p class="text">Your payment are safe with us.</p>
                     </div>
                  </div>
               </div>
               <div class="col-lg-3 col-sm-6 py-3">
                  <div class="media static-media2">
                     <img class="align-self-center mr-3" src="assets/img/icon/5.png" alt="icon">
                     <div class="media-body">
                        <h4 class="title text-capitalize text-dark">Support 24/7</h4>
                        <p class="text">Contact us 24 hours a day</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- staic media end -->
   <!-- common banner  start -->
   <!--<div class="common-banner pb-5 bg-white">
      <div class="container">
         <div class="row">
            <div class="col-md-3 mb-5">
               <div class="banner-thumb common-bthumb1">
                  <a href="shop-grid-4-column.html" class="zoom-in d-block overflow-hidden">
                     <img src="assets/img/banner/1.jpg" alt="banner-thumb-naile">
                  </a>
               </div>
            </div>
            <div class="col-md-6 mb-5">
               <div class="banner-thumb common-bthumb1">
                  <a href="shop-grid-4-column.html" class="zoom-in d-block overflow-hidden">
                     <img src="assets/img/banner/2.jpg" alt="banner-thumb-naile">
                  </a>
               </div>
            </div>
            <div class="col-md-3 mb-5">
               <div class="banner-thumb common-bthumb1">
                  <a href="shop-grid-4-column.html" class="zoom-in d-block overflow-hidden">
                     <img src="assets/img/banner/3.jpg" alt="banner-thumb-naile">
                  </a>
               </div>
            </div>
         </div>
      </div>
   </div>-->
   <!-- common banner  end -->
   <!-- product tab start -->
   <section class="product-tab bg-white pb-6rem">
      <div class="container">
         <div class="product-tab-nav border-bottom cbb1 mb-3rem">
            <div class="row align-items-end">
               <div class="col-sm-10 col-md-9 col-lg-5 col-xl-5">
                  <div class="section-title pb-4 pb-md-4 position-relative">
                     <h2 class="title">New Arrivals</h2>
                     <p class="text">Here are the featured products of Cartsy Gallery PH.</p>
                  </div>
               </div>
            </div>
         </div>
         <!-- product-tab-nav end -->
         <div class="row">
            <div class="col-12">
      
               @if($products->count() != 0)
               <div class="tab-content" id="pills-tabContent">
                  <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                     aria-labelledby="pills-home-tab">
                     <div class="product-slider-init style">
                        @foreach($products as $product)
                           <div class="slider-item">
                              <div class="single-product position-relative">
                                 <div class="product-thumbnail position-relative">
                                    @if(!auth::check())
                                          <a href="/product-info/{{ $product->id }}">
                                    @endif
                                    @if(auth::check())
                                          <a href="/home/product-info/{{ $product->id }}">
                                    @endif
                                       @if($product->user_type == null)
                                          @if($product->product_image_url != 'no-path')
                                             <img class="first-img" src="{{ config('app.api_url') }}{{ $product->product_image_url }}" style="width: 250px; height: 250px;" alt="thumbnail">
                                          @endif
                                          @if($product->product_image_url == 'no-path')
                                             <img class="first-img" src="{{ config('app.url') }}/assets/img/no-image.png" alt="thumbnail">
                                          @endif
                                       @else
                                          @if($product->product_image_url != 'no-path')
                                             <img class="first-img" src="{{ $product->product_image_url }}" style="width: 250px; height: 250px;" alt="thumbnail">
                                          @endif
                                          @if($product->product_image_url == 'no-path')
                                             <img class="first-img" src="/assets/img/no-image.png" alt="thumbnail">
                                          @endif
                                       @endif
                                    </a>
                                    <ul class="product-links d-flex justify-content-center">
                                       <li>
                                          <a href="javascript()" class="{{ auth::check() ? 'btn-add' : 'btn-add-to-wishlist-disabled' }}" data-id="{{ $product->id }}" action-type="wishlist">
                                             <span data-toggle="tooltip" data-placement="bottom" title="wishlist">
                                                <i class="ion-ios-heart-outline"></i>
                                             </span>
                                          </a>
                                       </li>
                                       <li>
                                       @if(!auth::check())
                                          <a href="/product-info/{{ $product->id }}">
                                             <span data-toggle="tooltip" data-placement="bottom" title="Quick view">
                                                <i class="ion-ios-search-strong"></i>
                                             </span>
                                          </a>
                                       @endif
                                       @if(auth::check())
                                          <a href="/home/product-info/{{ $product->id }}">
                                             <span data-toggle="tooltip" data-placement="bottom" title="Quick view">
                                                <i class="ion-ios-search-strong"></i>
                                             </span>
                                          </a>
                                       @endif
                                       </li>
                                    </ul>
                                 </div>
                                 <div class="product-desc pt-2rem position-relative text-center">
                                    <h3 class="title">
                                    @if(!auth::check())
                                    <a href="/product-info/{{ $product->id }}">
                                    @endif
                                    @if(auth::check())
                                    <a href="/home/product-info/{{ $product->id }}">
                                    @endif
                                    {{ $product->product_name }}</a></h3>
                                    @if(\App\Models\UserComment::whereIn('pid', [$product->id])->get()->count() != 0)
                                       @if(\App\Models\UserComment::whereIn('pid', [$product->id])->get()->first()->points == 1)
                                          <div class="star-rating">
                                             <span class="ion-ios-star"></span>
                                             <span class="ion-ios-star de-selected"></span>
                                             <span class="ion-ios-star de-selected"></span>
                                             <span class="ion-ios-star de-selected"></span>
                                             <span class="ion-ios-star de-selected"></span>
                                          </div>
                                       @endif
                                       @if(\App\Models\UserComment::whereIn('pid', [$product->id])->get()->first()->points == 2)
                                          <div class="star-rating">
                                             <span class="ion-ios-star"></span>
                                             <span class="ion-ios-star"></span>
                                             <span class="ion-ios-star de-selected"></span>
                                             <span class="ion-ios-star de-selected"></span>
                                             <span class="ion-ios-star de-selected"></span>
                                          </div>
                                       @endif
                                       @if(\App\Models\UserComment::whereIn('pid', [$product->id])->get()->first()->points == 3)
                                          <div class="star-rating">
                                             <span class="ion-ios-star"></span>
                                             <span class="ion-ios-star"></span>
                                             <span class="ion-ios-star"></span>
                                             <span class="ion-ios-star de-selected"></span>
                                             <span class="ion-ios-star de-selected"></span>
                                          </div>
                                       @endif
                                       @if(\App\Models\UserComment::whereIn('pid', [$product->id])->get()->first()->points == 4)
                                          <div class="star-rating">
                                             <span class="ion-ios-star"></span>
                                             <span class="ion-ios-star"></span>
                                             <span class="ion-ios-star"></span>
                                             <span class="ion-ios-star"></span>
                                             <span class="ion-ios-star de-selected"></span>
                                          </div>
                                       @endif
                                       @if(\App\Models\UserComment::whereIn('pid', [$product->id])->get()->first()->points == 5)
                                          <div class="star-rating">
                                             <span class="ion-ios-star"></span>
                                             <span class="ion-ios-star"></span>
                                             <span class="ion-ios-star"></span>
                                             <span class="ion-ios-star"></span>
                                             <span class="ion-ios-star"></span>
                                          </div>
                                       @endif
                                    @endif
                                    @if(\App\Models\UserComment::whereIn('pid', [$product->id])->get()->count() == 0)
                                       <p>No ratings yet</p>
                                    @endif
                                    <h6 class="product-price">₱ {{ number_format($product->product_price) }}</h6>
                                    <button style="width:100%;" class="pro-btn {{ auth::check() ? 'btn-add' : 'btn-add-to-cart-disabled' }}" data-id="{{ $product->id }}" action-type="cart">add to cart <i
                                          class="ion-bag"></i></button>
                                 </div>
                              </div>
                           </div>
                        @endforeach
                     </div>
                  </div>
               </div>
               @else
               <div class="row text-center">
                  <div class="col-lg-12">
                     No Product Available
                  </div>
               </div>
               @endif
               
            </div>
         </div>
      </div>
   </section>
   <!-- product tab end -->

@include('incs.footer')


