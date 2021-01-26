                    @if($data->count() != 0)
                    <div class="row grid-list1" id="shop-list">
                        @foreach($data as $data)        
                            <div class="col-lg-4 col-sm-6 col-md-4 mb-5 grid-list">
                                <div class="single-product position-relative">
                                    <span class="badge badge-primary cb3">Pure</span>
                                    <div class="product-thumbnail position-relative text-center">
                                            <a href="{{ auth::check() ? '/home/product-info/'.$data->id : '/product-info/'.$data->id }}">
                                                <img class="first-img" src="{{ config('app.api_url') }}{{ $data->product_image_url }}" style="height:350px; width:350px;" alt="thumbnail">
                                            </a>
                                            <ul class="product-links d-flex justify-content-center">
                                                <li>
                                                    <a href="javascript();" class="{{ auth::check() ? 'btn-add' : 'btn-add-to-wishlist-disabled' }}" data-id="{{ auth::check() ? $data->id : '' }}" action-type="wishlist">
                                                        <span data-toggle="tooltip" data-placement="bottom" title="wishlist">
                                                        <i class="ion-ios-heart-outline"></i>
                                                        </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ auth::check() ? '/home/product-info/'.$data->id : '/product-info/'.$data->id }}">
                                                        <span data-toggle="tooltip" data-placement="bottom" title="Quick view">
                                                        <i class="ion-ios-search-strong"></i>
                                                        </span>
                                                    </a>
                                                </li>
                                            </ul>
                                    </div>
                                    <div class="product-desc pt-2rem position-relative text-center">
                                        <h3 class="title"><a href="{{ auth::check() ? '/home/product-info/'.$data->id : '/product-info/'.$data->id }}">{{ $data->product_name }}</a></h3>
                                        @if(\App\Models\UserComment::whereIn('pid', [$data->id])->get()->count() != 0)
                                        @if(\App\Models\UserComment::whereIn('pid', [$data->id])->get()->first()->points == 1)
                                            <div class="star-rating">
                                                <span class="ion-ios-star"></span>
                                                <span class="ion-ios-star de-selected"></span>
                                                <span class="ion-ios-star de-selected"></span>
                                                <span class="ion-ios-star de-selected"></span>
                                                <span class="ion-ios-star de-selected"></span>
                                            </div>
                                        @endif
                                        @if(\App\Models\UserComment::whereIn('pid', [$data->id])->get()->first()->points == 2)
                                            <div class="star-rating">
                                                <span class="ion-ios-star"></span>
                                                <span class="ion-ios-star"></span>
                                                <span class="ion-ios-star de-selected"></span>
                                                <span class="ion-ios-star de-selected"></span>
                                                <span class="ion-ios-star de-selected"></span>
                                            </div>
                                        @endif
                                        @if(\App\Models\UserComment::whereIn('pid', [$data->id])->get()->first()->points == 3)
                                            <div class="star-rating">
                                                <span class="ion-ios-star"></span>
                                                <span class="ion-ios-star"></span>
                                                <span class="ion-ios-star"></span>
                                                <span class="ion-ios-star de-selected"></span>
                                                <span class="ion-ios-star de-selected"></span>
                                            </div>
                                        @endif
                                        @if(\App\Models\UserComment::whereIn('pid', [$data->id])->get()->first()->points == 4)
                                            <div class="star-rating">
                                                <span class="ion-ios-star"></span>
                                                <span class="ion-ios-star"></span>
                                                <span class="ion-ios-star"></span>
                                                <span class="ion-ios-star"></span>
                                                <span class="ion-ios-star de-selected"></span>
                                            </div>
                                        @endif
                                        @if(\App\Models\UserComment::whereIn('pid', [$data->id])->get()->first()->points == 5)
                                            <div class="star-rating">
                                                <span class="ion-ios-star"></span>
                                                <span class="ion-ios-star"></span>
                                                <span class="ion-ios-star"></span>
                                                <span class="ion-ios-star"></span>
                                                <span class="ion-ios-star"></span>
                                            </div>
                                        @endif
                                        @endif
                                        @if(\App\Models\UserComment::whereIn('pid', [$data->id])->get()->count() == 0)
                                        <p>No ratings yet</p>
                                        @endif
                                        @if($data->product_retail_price != '')
                                            <h6 class="product-price"><del>₱ {{ number_format($data->product_retail_price) }}</del> ₱ {{ number_format($data->product_price) }}</h6>
                                        @else
                                            <h6 class="product-price"><del>₱ {{ number_format($data->product_price) }}</h6>
                                        @endif
                                        
                                        <button class="pro-btn {{ auth::check() ? 'btn-add' : 'btn-add-to-cart-disabled' }}" data-id="{{ auth::check() ? $data->id : '' }}" action-type="cart" >add to cart  <i class="ion-bag"></i></button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="row text-center">
                            <div class="col-lg-12">
                                No Product Available
                            </div>
                        </div>
                    @endif
                   