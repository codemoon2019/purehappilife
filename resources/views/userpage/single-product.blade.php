@include('incs.header')

@yield('section')

 <!-- product tab start -->
 <nav class="breadcrumb-section bg-white pt-5 pb-6rem">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <ol class="breadcrumb bg-transparent m-0 p-0 align-items-center">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{!! html_entity_decode($productInfo->product_name) !!}</li>
                    </ol>
                </div>
            </div>
        </div>
    </nav>
    <!-- bread crumb end -->
    <!-- single-product start -->
    <section class="product-single style1 pb-6rem">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mx-auto col-lg-5 mb-5 mb-lg-0">
                    <div class="product-sync-init mb-20">
                    @if($productInfo->user_type == null) 
                        <div class="single-product">
                            <div class="product-thumb">
                                @if($productInfo->product_image_url == 'no-path')
                                    <img src="{{ config('app.url') }}/assets/img/no-image.png" style="width:450px; height:450px;" alt="product-thumb">
                                @endif
                                @if($productInfo->product_image_url != 'no-path')
                                    <img src="{{ config('app.api_url') }}{{ $productInfo->product_image_url }}" style="width:400px; height:400px;" alt="product-thumb">
                                @endif
                            </div>
                        </div>
                    
                        @if($productInfo->productImages->count() != 0)
                            @foreach($productInfo->productImages as $image)
                                <!-- single-product end -->
                                <div class="single-product">
                                    <div class="product-thumb">
                                        <img src="{{ config('app.api_url') }}{{ $image->product_image_url }}" style="width:400px; height:400px;"  alt="product-thumb">
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    @else
                        <div class="single-product">
                            <div class="product-thumb">
                                @if($productInfo->product_image_url == 'no-path')
                                    <img src="/assets/img/no-image.png" style="width:450px; height:450px;" alt="product-thumb">
                                @endif
                                @if($productInfo->product_image_url != 'no-path')
                                    <img src="{{ $productInfo->product_image_url }}" style="width:400px; height:400px;" alt="product-thumb">
                                @endif
                            </div>
                        </div>
                    
                        @if($productInfo->productImages->count() != 0)
                            @foreach($productInfo->productImages as $image)
                                <!-- single-product end -->
                                <div class="single-product">
                                    <div class="product-thumb">
                                        <img src="{{ $image->product_image_url }}" style="width:400px; height:400px;"  alt="product-thumb">
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    @endif


                    </div>

                    <div class="product-sync-nav" style="margin-top:10px;">
                    @if($productInfo->user_type == null) 
                        <div class="single-product">
                            <div class="product-thumb">
                                <a href="javascript:void(0)">
                                    @if($productInfo->product_image_url == 'no-path')
                                        <img src="{{ config('app.url') }}/assets/img/no-image.png" alt="product-thumb">
                                    @endif
                                    @if($productInfo->product_image_url != 'no-path')
                                        <img src="{{ config('app.api_url') }}{{ $productInfo->product_image_url }}" style="width:90px; height:90px;" alt="product-thumb">
                                    @endif
                                </a>
                            </div>
                        </div>

                        @if($productInfo->productImages->count() != 0)
                            @foreach($productInfo->productImages as $image)
                                <div class="single-product">
                                    <div class="product-thumb">
                                        <a href="javascript:void(0)"> <img src="{{ config('app.api_url') }}{{ $image->product_image_url }}" alt="product-thumb"></a>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    @else
                        <div class="single-product">
                            <div class="product-thumb">
                                <a href="javascript:void(0)">
                                    @if($productInfo->product_image_url == 'no-path')
                                        <img src="/assets/img/no-image.png" alt="product-thumb">
                                    @endif
                                    @if($productInfo->product_image_url != 'no-path')
                                        <img src="{{ $productInfo->product_image_url }}" style="width:90px; height:90px;" alt="product-thumb">
                                    @endif
                                </a>
                            </div>
                        </div>

                        @if($productInfo->productImages->count() != 0)
                            @foreach($productInfo->productImages as $image)
                                <div class="single-product">
                                    <div class="product-thumb">
                                        <a href="javascript:void(0)"> <img src="{{ $image->product_image_url }}" alt="product-thumb"></a>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    @endif

                    </div>
                </div>
                <div class="col-lg-6 mt-5 mt-md-0">
                    <div class="modal-product-info">
                        <div class="product-head">
                            <h2 class="title">{!! html_entity_decode($productInfo->product_name) !!}</h2>
                            <div class="star-content">

                            @if(\App\Models\UserComment::whereIn('pid', [$id])->get()->count() != 0)
                                       @if(\App\Models\UserComment::whereIn('pid', [$id])->get()->first()->points == 1)
                                            <span class="star-on"><i class="fas fa-star"></i> </span>
                                            <span class="star-off"><i class="fas fa-star"></i> </span>
                                            <span class="star-off"><i class="fas fa-star"></i> </span>
                                            <span class="star-off"><i class="fas fa-star"></i> </span>
                                            <span class="star-off"><i class="fas fa-star"></i> </span>
                                       @endif
                                       @if(\App\Models\UserComment::whereIn('pid', [$id])->get()->first()->points == 2)
                                            <span class="star-on"><i class="fas fa-star"></i> </span>
                                            <span class="star-on"><i class="fas fa-star"></i> </span>
                                            <span class="star-off"><i class="fas fa-star"></i> </span>
                                            <span class="star-off"><i class="fas fa-star"></i> </span>
                                            <span class="star-off"><i class="fas fa-star"></i> </span>
                                       @endif
                                       @if(\App\Models\UserComment::whereIn('pid', [$id])->get()->first()->points == 3)
                                            <span class="star-on"><i class="fas fa-star"></i> </span>
                                            <span class="star-on"><i class="fas fa-star"></i> </span>
                                            <span class="star-on"><i class="fas fa-star"></i> </span>
                                            <span class="star-off"><i class="fas fa-star"></i> </span>
                                            <span class="star-off"><i class="fas fa-star"></i> </span>
                                       @endif
                                       @if(\App\Models\UserComment::whereIn('pid', [$id])->get()->first()->points == 4)
                                            <span class="star-on"><i class="fas fa-star"></i> </span>
                                            <span class="star-on"><i class="fas fa-star"></i> </span>
                                            <span class="star-on"><i class="fas fa-star"></i> </span>
                                            <span class="star-on"><i class="fas fa-star"></i> </span>
                                            <span class="star-off"><i class="fas fa-star"></i> </span>
                                       @endif
                                       @if(\App\Models\UserComment::whereIn('pid', [$id])->get()->first()->points == 5)
                                            <span class="star-on"><i class="fas fa-star"></i> </span>
                                            <span class="star-on"><i class="fas fa-star"></i> </span>
                                            <span class="star-on"><i class="fas fa-star"></i> </span>
                                            <span class="star-on"><i class="fas fa-star"></i> </span>
                                            <span class="star-on"><i class="fas fa-star"></i> </span>
                                       @endif
                                    @endif


                                <a href="#" id="write-comment"><span class="ml-2"><i class="far fa-comment-dots"></i>
                                    @if($productReview->get()->count() == 0)
                                        </span> No review yet. Buy this product to make a review.</span>
                                    @endif
                                    @if($productReview->get()->count() != 0)
                                        </span> Read reviews <span>({{ $productReview->get()->count() }})</span>
                                    @endif
                                </a>
                                <div class="product-discount">
                                @if($productInfo->product_retail_price != '')
                                    <span class="regular-price"> <del>₱ {!! number_format($productInfo->product_price) !!}</del> ₱ {!! number_format($productInfo->product_retail_price) !!}</span>
                                @else
                                    <span class="regular-price"> ₱ {!! number_format($productInfo->product_price) !!}</span>
                                @endif
                                </div>
                            </div>
                        </div>  

                        <div class="product-footer">

                            <div class="product-count style d-flex flex-column flex-sm-row mt-5 mb-5 pt-3">
                                <div class="count d-flex">
                                    <input type="number" min="1" max="10" step="1" id="txtQuantity" value="1">
                                    <div class="button-group">
                                        <button class="count-btn increment"><i class="fas fa-chevron-up"></i></button>
                                        <button class="count-btn decrement"><i class="fas fa-chevron-down"></i></button>
                                    </div>
                                </div>
                                <div>
                                    <button class="btn btn-primary rounded mt-5 mt-sm-0 {{ auth::check() ? 'btn-add-to-cart' : 'btn-add-to-cart-single' }}" id="{{ $id }}">
                                    <span class="mr-2"><i class="ion-android-add"></i></span>
                                    Add to cart
                                  </button>
                                </div>
                            </div>
                            
                            <div class="addto-whish-list">
                                <a href="#" class="{{ auth::check() ? 'btn-add' : 'btn-add-to-wishlist-disabled' }}" data-id="{{ auth::check() ? $id : '' }}" action-type="wishlist"><i class="far fa-heart"></i> Add to wishlist</a>
                            </div>

                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- single-product end -->
    <div class="product-tab bg-light py-6rem">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card border-0 rounded-0">
                        <div class="card-body">
                            <nav class="product-tab-menu style1 border-bottom cbb1 mb-4rem pr-0">
                                <ul class="nav nav-pills justify-content-center" id="pills-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Description</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Reviews</a>
                                    </li>
                                </ul>
                            </nav>
                            <div class="tab-content" id="pills-tabContent">
                                <!-- first tab-pane -->
                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                    <div class="product-description">
                                        {!! html_entity_decode($productInfo->product_description) !!}
                                        @if($productInfo->user_type == null) 
                                            @if($productInfo->lorikeet != 'no-path')
                                                <img src="{{ config('app.api_url') }}{{ $productInfo->lorikeet }}" style="width:100%; margin-top:20px;" alt="product-thumb">
                                            @endif
                                        @else
                                            @if($productInfo->lorikeet != 'no-path')
                                                <img src="{{ $productInfo->lorikeet }}" style="width:100%; margin-top:20px;" alt="product-thumb">
                                            @endif
                                        @endif
                                      
                                    </div>
                                </div>
                                <!-- third tab-pane -->
                                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                                    @if($productReview->get()->count() == 0)
                                    <p class="text-center">No ratings yet</p>
                                    @endif
                                    @if($productReview->get()->count() != 0)
                                        @foreach($productReview->get() as $review)
                                            <div class="grade-content">
                                                <span class="grade">Grade </span>

                                                <span class="star-on"><i class="fas fa-star"></i> </span>
                                                <span class="star-on"><i class="fas fa-star"></i> </span>
                                                <span class="star-on"><i class="fas fa-star"></i> </span>
                                                <span class="star-on"><i class="fas fa-star"></i> </span>
                                                <span class="star-on"><i class="fas fa-star"></i> </span>
                                                <h6 class="sub-title">{{ $review->customerInfo->first_name }} {{ $review->customerInfo->last_name }}</h6>
                                                <p>24/08/2020</p>
                                                <h4 class="title">{{ $review->subject }}</h4>
                                                <p>{{ $review->description }}</p>
                                            </div>
                                        @endforeach
                                    @endif
                        
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- product tab end -->
@include('incs.footer')