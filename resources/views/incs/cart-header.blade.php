@if(auth()->user()->userCart->count() != 0)
    <div style="overflow-y:scroll; height:300px;">
        @foreach(auth()->user()->userCart as $cart)
        <div class="small-cart-item cart-item-{{ $cart->id }}">
            <div class="single-item">
                <div class="image">
                        <a href="/home/product-info/{{ $cart->productInfo->id }}">
                            <img src="{{ config('app.api_url') }}{{ $cart->productInfo->product_image_url }}" class="img-fluid" alt="">
                        </a>
                    <span class="badge badge-primary cb2">{{ $cart->quantity }}x</span>
                </div>
                <div class="cart-content">
                    <p class="cart-name"><a href="/home/product-info/{{ $cart->productInfo->id }}">{{ $cart->productInfo->product_name }}</a>
                    </p>
                    <p class="cart-quantity">₱ {{ number_format($cart->total_price) }}</p>
                </div>
                <button id="{{ $cart->id }}" class="remove-icon remove-cart-item"><i class="ion-close-round"></i></button>
            </div>
        </div>
        @endforeach                  
    </div>
    <div class="cart-table">
        <table class="table m-0">
            <tbody>
                <tr>
                    <td class="text-left">Total:</td>
                    <td class="text-right"><span class="cart-total-price">₱ {{ number_format(auth()->user()->userCart->sum('total_price')) }}</span></td>
                </tr>
            </tbody>
        </table>
        <div class="cart-buttons pt-5">
            <a href="/home/checkout" class="btn btn-primary btn-block rounded">Checkout</a>
        </div>
    </div>
@endif

@if(auth()->user()->userCart->count() == 0)
    <div class="row" style="margin-top:20px; margin-bottom:20px;">
        <div class="col-lg-12 text-center">
            No item available to your cart.
        </div>
    </div>
@endif