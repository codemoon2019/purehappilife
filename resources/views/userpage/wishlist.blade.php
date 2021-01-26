@include('incs.header')

@yield('section')

 <!-- bread crumb start -->
 <nav class="breadcrumb-section bg-white pt-5 pb-6rem">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <ol class="breadcrumb bg-transparent m-0 p-0 align-items-center">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Wishlist </li>
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

                @if($productWishlist->count() == 0)
                <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-12">
                        <div class="card text-center">
                            <div class="card-body">
                                <span class="icon">
                            <i class="ion-ios-information"></i>
                        </span>
                                <h4 class="sub-title">
                                    No item on your wishlist
                                </h4>
                            </div>
                        </div>
                </div>
                @endif
                @if($productWishlist->count() != 0)
                <div class="col-12">
                    <h3 class="title text-capitalize">Your wish list</h3>
                    <div class="table-responsive pt-4">
                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center" scope="col">products</th>
                                    <th class="text-center" scope="col">product name</th>
                                    <th class="text-center" scope="col">Price</th>
                                    <th class="text-center" scope="col">action</th>
                                    <th class="text-center" scope="col">Checkout</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($productWishlist->get() as $wishlist)
                                    <tr class="wishlist-item-{{ $wishlist->id }}">
                                        <th class="text-center" scope="row">
                                            <img src="{{ config('app.api_url') }}{{ $wishlist->productInfo->product_image_url }}" style="width:100px; height:100px;" alt="img">
                                        </th>
                                        <td class="text-center">
                                            <span class="whish-title">{{ $wishlist->productInfo->product_name }}</span>
                                        </td>
                                        <td class="text-center">
                                            <span class="product-price">
                                            ₱ {{ number_format($wishlist->productInfo->product_price) }}
                                        </span></td>

                                        <td class="text-center">
                                            <button id="{{ auth::check() ? $wishlist->id : '' }}" class="delete-wishlist"> <span class="trash"><i class="fas fa-trash-alt"></i> </span></button>
                                        </td>
                                        <td class="text-center">
                                            <a href="javascript()" class="btn btn-dark3 {{ auth::check() ? 'btn-add' : 'btn-add-to-wishlist-disabled' }}"  data-id="{{ auth::check() ? $wishlist->productInfo->id : '' }}" action-type="cart">add to cart now</a>
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

@include('incs.footer')