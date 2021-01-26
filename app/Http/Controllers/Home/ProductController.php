<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use  App\Http\Controllers\NotificationController as NotificationBell;
use Illuminate\Http\Request;
use App\Models\Guest;
use App\Models\GuestAddress;
use App\Models\GuestCart;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductOrder;
use App\Models\ProductOrderPaymentProof;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\UserCart;
use App\Models\UserComment;
use App\Models\UserWishlist;
use Auth;

class ProductController extends Controller
{
    
    /**
    * Return single product.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    * @return void
    */

    public function productInfo($id){

        $productInfo = Product::find($id);

        $productReview = UserComment::whereIn('pid', [$id]);
        
        return view('userpage.single-product', compact('productInfo', 'productReview', 'id'));

    }


    /**
    * Return cart Item.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    * @return void
    */

    public function cartItem(){

        if(auth::check()){
            return view('incs.cart-header');
        }else{
            $guestCart = GuestCart::where('guest_id', request()->cookie('purehappilife_session'))->get();
            return view('incs.guest-cart-item', compact('guestCart'));
        }

    }

    /**
    * Add to cart and add to wishlist function.
    *
    * @param  Request  $request
    * @return Response
    */
    public function add(Request $request){

        $productInfo = Product::find($request->dataID);

        if($request->actionType == 'wishlist'){

            $findIfItemExist = UserWishlist::where(function ($query) use ($request) {
                $query->where('user_id', auth()->user()->id);
                $query->where('pid', $request->dataID);
            });

            if($findIfItemExist->count() == 0){

                try{

                    $wishlist = new UserWishlist;
                    $wishlist->user_id = auth()->user()->id;
                    $wishlist->pid = $request->dataID;
                    $wishlist->save();

                    $success = true;
                    $message = 'Product added to your wishlist';

                }catch(Exception $e){

                    $success = false;
                    $message = 'Something went wrong';
                    
                }

            }else{

                $success = false;
                $message = 'Product already exist in wishlist';
            
            }

        }

        if($request->actionType == 'cart'){

            if(auth::check()){
                $findIfItemExist = UserCart::where(function ($query) use ($request) {
                    $query->where('user_id', auth()->user()->id);
                    $query->where('pid', $request->dataID);
                });
            }else{
                $findIfItemExist = GuestCart::where(function ($query) use ($request) {
                    $query->where('guest_id', request()->cookie('purehappilife_session'));
                    $query->where('pid', $request->dataID);
                });
            }

            if($findIfItemExist->count() == 0){

                try{

                    if(auth::check()){
                        $cart = new UserCart;
                        $cart->user_id = auth()->user()->id;
                        $cart->pid = $request->dataID;
                        $cart->total_price = $productInfo->product_retail_price;
                        $cart->quantity = 1;
                        $cart->save();
                    }else{
                        $cart = new GuestCart;
                        $cart->guest_id = request()->cookie('purehappilife_session');
                        $cart->pid = $request->dataID;
                        $cart->total_price = $productInfo->product_retail_price;
                        $cart->quantity = 1;
                        $cart->save();
                    }

                    $success = true;
                    $message = 'Product added to your cart';

                }catch(Exception $e){

                    $success = false;
                    $message = 'Something went wrong';
                    
                }

            }else{

                    $updateCart = $findIfItemExist->update([
                        'total_price' => $findIfItemExist->get()->first()->total_price + $productInfo->product_retail_price,
                        'quantity' => 1 + $findIfItemExist->get()->first()->quantity
                    ]);

                    $success = true;
                    $message = 'Product added to your cart';
            
            }

        }

        if(auth::check()){

            $updatedCartInfo = UserCart::where('user_id', auth()->user()->id);
            $updatedWishlistInfo = UserWishlist::where('user_id', auth()->user()->id);

            return response()->json([
                'success' => $success,
                'messages' => $message,
                'total_cart_price' => number_format($updatedCartInfo->sum('total_price')),
                'total_cart_item' => $updatedCartInfo->sum('quantity'),
                'total_wishlist_item' => $updatedWishlistInfo->count()
            ], 200);
            
        }else{

            $updatedCartInfo = GuestCart::where('guest_id', request()->cookie('purehappilife_session'));
            return response()->json([
                'success' => $success,
                'messages' => $message,
                'total_cart_price' => number_format($updatedCartInfo->sum('total_price')),
                'total_cart_item' => $updatedCartInfo->sum('quantity'),
            ], 200);

        }

    }


    public static function addSingleProduct(Request $request){

        $productInfo = Product::find($request->dataID);

        if(auth::check()){
            $findIfItemExist = UserCart::where(function ($query) use ($request) {
                $query->where('user_id', auth()->user()->id);
                $query->where('pid', $request->dataID);
            });
        }else{
            $findIfItemExist = GuestCart::where(function ($query) use ($request) {
                $query->where('guest_id', request()->cookie('purehappilife_session'));
                $query->where('pid', $request->dataID);
            });
        }
    

        if($findIfItemExist->count() == 0){

            try{

                if(auth::check()){
                    $cart = new UserCart;
                    $cart->user_id = auth()->user()->id;
                    $cart->pid = $request->dataID;
                    $cart->total_price = $request->quantity * $productInfo->product_retail_price;
                    $cart->quantity = $request->quantity;
                    $cart->save();
                }else{
                    $cart = new GuestCart;
                    $cart->guest_id = request()->cookie('purehappilife_session');
                    $cart->pid = $request->dataID;
                    $cart->total_price = $request->quantity * $productInfo->product_retail_price;
                    $cart->quantity = $request->quantity;
                    $cart->save();
                }

                $success = true;
                $message = 'Product added to your cart';

            }catch(Exception $e){

                $success = false;
                $message = 'Something went wrong';
                
            }

        }else{

                $updateCart = $findIfItemExist->update([
                    'total_price' => $findIfItemExist->get()->first()->total_price + ($request->quantity * $productInfo->product_retail_price),
                    'quantity' => $request->quantity + $findIfItemExist->get()->first()->quantity
                ]);

                $success = true;
                $message = 'Product added to your cart';
        
        }

        if(auth::check()){

            $updatedCartInfo = UserCart::where('user_id', auth()->user()->id);
            $updatedWishlistInfo = UserWishlist::where('user_id', auth()->user()->id);
            return response()->json([
                'success' => $success,
                'messages' => $message,
                'total_cart_price' => number_format($updatedCartInfo->sum('total_price')),
                'total_cart_item' => $updatedCartInfo->sum('quantity'),
                'total_wishlist_item' => $updatedWishlistInfo->count()
            ], 200);

        }else{

            $updatedCartInfo = GuestCart::where('guest_id', request()->cookie('purehappilife_session'));
            return response()->json([
                'success' => $success,
                'messages' => $message,
                'total_cart_price' => number_format($updatedCartInfo->sum('total_price')),
                'total_cart_item' => $updatedCartInfo->sum('quantity'),
            ], 200);

        }

    }

    /**
    * Create product order.
    *
    * @param  Request  $request
    * @return Response
    */
    public function createOrder(Request $request){
        
        $userCart = UserCart::where('user_id', auth()->user()->id);
        $generatedOrderNumber = mt_rand(1000000, 9999999);

        $findUserAddress = UserAddress::whereIn('user_id', [auth()->user()->id]);
        if($findUserAddress->count() != 0){
            $findUserAddress->update([
                'address' => $request->address1,
                'address_complement' => $request->address2,
                'city' => $request->city,
                'state' => $request->address1,
                'zip' => $request->zip,
                'country' => $request->country,
                'status' => 1,
            ]);
        }else{
            $insertUserAddress = UserAddress::insert([
                'user_id' => auth()->user()->id,
                'address' => $request->address1,
                'address_complement' => $request->address2,
                'city' => $request->city,
                'state' => $request->address1,
                'zip' => $request->zip,
                'country' => $request->country,
                'status' => 1,
            ]);
        }

        foreach($userCart->get() as $checkoutOrder){
            
            $cartInfo = UserCart::find($checkoutOrder->id);
            $cartInfo->delete();

            $product = new ProductOrder;
            $product->user_id = auth()->user()->id;
            $product->order_id = $generatedOrderNumber;
            $product->pid = $checkoutOrder->pid;
            $product->quantity = $checkoutOrder->quantity;
            $product->total_price = $checkoutOrder->total_price;
            $product->payment_method = 'PAYPAL';
            $product->payment_status = 'PAID';
            $product->status = 1;
            $product->save();

        }

        NotificationBell::createNotification('admin', 'New order #'.$generatedOrderNumber, 'New order arrived!', 'order');

        return response()->json([
            'success' => true,
            'messages' => 'Order created successfully!'
        ], 200);

    }


    /**
    * Make order by cod
    *
    * @param  Request  $request
    * @return Response
    */
    public function makeOrderByHappiPoints(Request $request){

        $userCart = UserCart::where('user_id', auth()->user()->id);
        $generatedOrderNumber = mt_rand(1000000, 9999999);

        if(auth()->user()->tokens != $userCart->sum('total_price')){

                return response()->json([
                    'success' => false,
                    'messages' => 'You cannot make a purchase. You dont have enough points!'
                ], 200);

        }else{
            $findUserAddress = UserAddress::whereIn('user_id', [auth()->user()->id]);
            if($findUserAddress->count() != 0){
                $findUserAddress->update([
                    'address' => $request->address1,
                    'address_complement' => $request->address2,
                    'city' => $request->city,
                    'state' => $request->address1,
                    'zip' => $request->zip,
                    'country' => $request->country,
                    'status' => 1,
                ]);
            }else{
                $insertUserAddress = UserAddress::insert([
                    'user_id' => auth()->user()->id,
                    'address' => $request->address1,
                    'address_complement' => $request->address2,
                    'city' => $request->city,
                    'state' => $request->address1,
                    'zip' => $request->zip,
                    'country' => $request->country,
                    'status' => 1,
                ]);
            }
    
            foreach($userCart->get() as $checkoutOrder){
                
                $cartInfo = UserCart::find($checkoutOrder->id);
                $cartInfo->delete();
    
                $product = new ProductOrder;
                $product->user_id = auth()->user()->id;
                $product->order_id = $generatedOrderNumber;
                $product->pid = $checkoutOrder->pid;
                $product->quantity = $checkoutOrder->quantity;
                $product->total_price = $checkoutOrder->total_price;
                $product->payment_method = 'POINTS';
                $product->payment_status = 'PAID';
                $product->status = 1;
                $product->save();
    
            }
    
            NotificationBell::createNotification('admin', 'New order #'.$generatedOrderNumber, 'New order arrived!', 'order');

            return response()->json([
                'success' => true,
                'messages' => 'Order created successfully!'
            ], 200);
        }

    }


    /**
    * Make order by cod
    *
    * @param  Request  $request
    * @return Response
    */
    public function makeOrderByCod(Request $request){

            if(auth::check()){
                $userCart = UserCart::where('user_id', auth()->user()->id);
                $findUserAddress = UserAddress::whereIn('user_id', [auth()->user()->id]);
            }else{
                $userCart = GuestCart::where('guest_id', request()->cookie('purehappilife_session'));
                $findUserAddress = GuestAddress::whereIn('guest_id', [request()->cookie('purehappilife_session')]);
            }
            
            $generatedOrderNumber = mt_rand(1000000, 9999999);

            if($findUserAddress->count() != 0){

                $findUserAddress->update([
                    'address' => $request->address1,
                    'address_complement' => $request->address2,
                    'city' => $request->city,
                    'state' => $request->address1,
                    'zip' => $request->zip,
                    'country' => $request->country,
                    'status' => 1,
                ]);
                
            }else{
            
                if(auth::check()){
                    
                    $insertUserAddress = UserAddress::insert([
                        'user_id' => auth()->user()->id,
                        'address' => $request->address1,
                        'address_complement' => $request->address2,
                        'city' => $request->city,
                        'state' => $request->address1,
                        'zip' => $request->zip,
                        'country' => $request->country,
                        'status' => 1,
                    ]);

                }else{
                    
                    $findIfGuestExist = Guest::where('guest_id', request()->cookie('purehappilife_session'))->get()->count();
                    
                    if($findIfGuestExist == 0){
                        
                        $insertGuestInfo = Guest::insert([
                            'guest_id' => request()->cookie('purehappilife_session'),
                            'first_name' => $request->fname,
                            'last_name' => $request->fname,
                            'middle_name' => $request->fname,
                            'email' => $request->email,
                            'mobile' => $request->mobile,
                        ]);

                    }

                    $insertUserAddress = GuestAddress::insert([
                        'guest_id' => request()->cookie('purehappilife_session'),
                        'address' => $request->address1,
                        'address_complement' => $request->address2,
                        'city' => $request->city,
                        'state' => $request->address1,
                        'zip' => $request->zip,
                        'country' => $request->country,
                        'status' => 1,
                    ]);

                }
            

            }
    
            foreach($userCart->get() as $checkoutOrder){
                
                if(auth::check()){
                    $cartInfo = UserCart::find($checkoutOrder->id);
                    $userID = auth()->user()->id;
                }else{
                    $cartInfo = GuestCart::find($checkoutOrder->id);
                    $userID = request()->cookie('purehappilife_session');
                }

                $cartInfo->delete();
    
                $product = new ProductOrder;
                $product->user_id = $userID;
                $product->user_type = auth::check() ? 'USER' : 'GUEST';
                $product->order_id = $generatedOrderNumber;
                $product->pid = $checkoutOrder->pid;
                $product->quantity = $checkoutOrder->quantity;
                $product->total_price = $checkoutOrder->total_price;
                $product->payment_method = 'COD';
                $product->payment_status = 'PENDING';
                $product->status = 1;
                $product->save();
    
            }
    
            NotificationBell::createNotification('admin', 'New order #'.$generatedOrderNumber, 'New order arrived!', 'order');

            return response()->json([
                'success' => true,
                'messages' => 'Order created successfully!'
            ], 200);
        

    }


    /**
    * Make order by cod
    *
    * @param  Request  $request
    * @return Response
    */
    public function makeOrderManual(Request $request){

        $userCart = UserCart::where('user_id', auth()->user()->id);
        $generatedOrderNumber = mt_rand(1000000, 9999999);

        if($request->hasFile('proof')){
            $lorikeetFilenameWithExt = $request->file('proof')->getClientOriginalName();
            $lorikeetFileName = pathinfo($lorikeetFilenameWithExt, PATHINFO_FILENAME);
            $lorikeetExtension = $request->file('proof')->getClientOriginalExtension();
            $lorikeetFileNameToStore = $lorikeetFileName.'_'.time().'.'.$lorikeetExtension;
            $path = $request->file('proof')->storeAs('public/proof_of_payment', $lorikeetFileNameToStore);
            
            if(config('app.env') == 'local'){
                $lorikeet_image = '/storage/proof_of_payment/'.$lorikeetFileNameToStore;
            }else{
                $lorikeet_image = '/proof_of_payment/'.$lorikeetFileNameToStore;
            }
                
            $storeproofOfPayment = ProductOrderPaymentProof::insert([
                    'order_id' => $generatedOrderNumber,
                    'proof_order_file' => $lorikeet_image,
                    'status' => 'PENDING'
            ]);
        }

        $findUserAddress = UserAddress::whereIn('user_id', [auth()->user()->id]);

        if($findUserAddress->count() != 0){
            $findUserAddress->update([
                'address' => $request->address1,
                'address_complement' => $request->address2,
                'city' => $request->city,
                'state' => $request->address1,
                'zip' => $request->zip,
                'country' => $request->country,
                'status' => 1,
            ]);
        }else{
            $insertUserAddress = UserAddress::insert([
                'user_id' => auth()->user()->id,
                'address' => $request->address1,
                'address_complement' => $request->address2,
                'city' => $request->city,
                'state' => $request->address1,
                'zip' => $request->zip,
                'country' => $request->country,
                'status' => 1,
            ]);
        }

        foreach($userCart->get() as $checkoutOrder){
            
            $cartInfo = UserCart::find($checkoutOrder->id);
            $cartInfo->delete();

            $product = new ProductOrder;
            $product->user_id = auth()->user()->id;
            $product->order_id = $generatedOrderNumber;
            $product->pid = $checkoutOrder->pid;
            $product->quantity = $checkoutOrder->quantity;
            $product->total_price = $checkoutOrder->total_price;
            $product->payment_method = 'MANUAL';
            $product->payment_status = 'PENDING';
            $product->status = 1;
            $product->save();

        }

        NotificationBell::createNotification('admin', 'New order #'.$generatedOrderNumber, 'New order arrived!', 'order');

        return response()->json([
            'success' => true,
            'messages' => 'Order created successfully!'
        ], 200);
    

}



    /**
    * Create product comment.
    *
    * @param  Request  $request
    * @return Response
    */
    public function createUserComment(Request $request){

        $productID = $request->pid;
        $points = $request->points;

        $comment = new UserComment;
        $comment->user_id = auth()->user()->id;
        $comment->pid = $productID;
        $comment->points = $points;
        $comment->subject = $request->subject;
        $comment->description = $request->comment;
        $comment->save();

        if($comment->save()){
            return response()->json([
                'success' => true,
                'messages' => 'Thankyou for rating '.$points.' our product! We will hope you will be come back and buy again thankyou!'
            ], 200);
        }

    }

    /**
    * Delete cart item.
    *
    * @param  Request  $request
    * @return Response
    */
    public function removeCartItem(Request $request){
        
        if(auth::check()){
            
            $deleteCartItem = UserCart::find($request->id);
            $updatedCartInfo = UserCart::where('user_id', auth()->user()->id);
            $updatedWishlistInfo = UserWishlist::where('user_id', auth()->user()->id);
            if($deleteCartItem->delete()){
                return response()->json([
                    'success' => true,
                    'messages' => 'Cart item deleted successfully!',
                    'total_cart_price' => number_format($updatedCartInfo->sum('total_price')),
                    'total_cart_item' => $updatedCartInfo->sum('quantity')
                ], 200);
            }else{
                return response()->json([
                    'success' => false,
                    'messages' => 'Something went wrong in deleting this cart item!'
                ], 200);
            }

        }else{
            
            $deleteCartItem = GuestCart::find($request->id);
            $updatedCartInfo = GuestCart::where('guest_id', request()->cookie('purehappilife_session'));
            if($deleteCartItem->delete()){
                return response()->json([
                    'success' => true,
                    'messages' => 'Cart item deleted successfully!',
                    'total_cart_price' => number_format($updatedCartInfo->sum('total_price')),
                    'total_cart_item' => $updatedCartInfo->sum('quantity')
                ], 200);
            }else{
                return response()->json([
                    'success' => false,
                    'messages' => 'Something went wrong in deleting this cart item!'
                ], 200);
            }

        }

    }


    /**
    * Delete cart item.
    *
    * @param  Request  $request
    * @return Response
    */
    public function removeWishlistItem(Request $request){

        $deleteWishlistItem = UserWishlist::find($request->id);
        $updatedWishlistInfo = UserWishlist::where('user_id', auth()->user()->id);
        if($deleteWishlistItem->delete()){
            return response()->json([
                'success' => true,
                'messages' => 'Wishlist item deleted successfully!',
                'total_wishlist_item' => $updatedWishlistInfo->count()
            ], 200);
        }else{
            return response()->json([
                'success' => false,
                'messages' => 'Something went wrong in deleting this wishlist item!'
            ], 200);
        }

    }

    /**
    * Add item to cart.
    *
    * @param  Request  $request
    * @return Response
    */
    public function addItemToCart(Request $request){

        $cartinfo = UserCart::where('id', $request->id)->get()->first();
        $productInfo = Product::where('id', $cartinfo->pid)->get()->first();

        $updateCartItemQuantity = UserCart::where('id', $request->id)->update([
            'quantity' => $cartinfo->quantity + 1
        ]);

    }

    /**
    * Minus item to cart.
    *
    * @param  Request  $request
    * @return Response
    */
    public function minusItemToCart(Request $request){

        $cartinfo = UserCart::where('id', $request->id)->get()->first();
        $productInfo = Product::where('id', $cartinfo->pid)->get()->first();

        if($cartinfo->quantity != 1){
            $updateCartItemQuantity = UserCart::where('id', $request->id)->update([
                'quantity' => $cartinfo->quantity - 1
            ]);
        }

    }

    /**
    * Add item to cart input.
    *
    * @param  Request  $request
    * @return Response
    */
    public function addItemToCartInput(Request $request){

        $cartinfo = UserCart::where('id', $request->id)->get()->first();
        $productInfo = Product::where('id', $cartinfo->pid)->get()->first();

        $totalPrice = $productInfo->product_price * $request->value;

        $updateCartItemQuantity = UserCart::where('id', $request->id)->update([
            'quantity' => $request->value,
            'total_price' => $totalPrice
        ]);

        $newcartinfo = UserCart::where('id', $request->id)->get()->first();
        $updatedCartInfo = UserCart::where('user_id', auth()->user()->id);

        return response()->json([
            'success' => true,
            'messages' => 'Added successfully',
            'id' => $request->id,
            'total_cart_price' => number_format($updatedCartInfo->sum('total_price')),
            'total_cart_item' => $updatedCartInfo->sum('quantity'),
            'this_total_price' => number_format($newcartinfo->total_price)
        ], 200);

    }

    /**
    * Get payment Method
    *
    * @param  Request  $request
    * @return Response
    */
    public function getPaymentMethods(Request $request){

        $client = new \Adyen\Client();
        $client->setXApiKey("AQEohmfuXNWTK0Qc+iSAh3Y9j+WLWIJBBJVPOK2ie+xYWqBjKJXgIpygehDBXVsNvuR83LVYjEgiTGAH-VwKxFWXbXzEfoC7iWLUcmrgZYLx0kENTJqygvgHBbHM=-,U{xI$4.<2dc%6HY"); 
        $client->setEnvironment(\Adyen\Environment::TEST);    
        $service = new \Adyen\Service\Checkout($client);

        error_log("Request for getPaymentMethods $request");

        $params = array(
            "merchantAccount" => "PureHappilifeECOM",
            "channel" => "Web"
        );

        $response = $service->paymentMethods($params);

        return $response;

    }

    /**
    * Initiate payment
    *
    * @param  Request  $request
    * @return Response
    */
    public function initiatePayment(Request $request){

        $client = new \Adyen\Client();
        $client->setXApiKey("AQEohmfuXNWTK0Qc+iSAh3Y9j+WLWIJBBJVPOK2ie+xYWqBjKJXgIpygehDBXVsNvuR83LVYjEgiTGAH-VwKxFWXbXzEfoC7iWLUcmrgZYLx0kENTJqygvgHBbHM=-,U{xI$4.<2dc%6HY"); 
        $client->setEnvironment(\Adyen\Environment::TEST);    
        $service = new \Adyen\Service\Checkout($client);

        error_log("Request for initiatePayment $request");

        $orderRef = uniqid();

        $userCart = UserCart::where('user_id', $request->get('id'));
        $findUserAddress = UserAddress::whereIn('user_id', [$request->get('id')]);
        $generatedOrderNumber = mt_rand(1000000, 9999999);

        if($findUserAddress->count() != 0){
            $findUserAddress->update([
                'address' => $request->get('address1'),
                'address_complement' => $request->get('address2'),
                'city' => $request->get('city'),
                'state' => $request->get('address1'),
                'zip' => $request->get('zip'),
                'country' => $request->get('country'),
                'status' => 1,
            ]);
        }else{
            $insertUserAddress = UserAddress::insert([
                'user_id' => $request->get('id'),
                'address' => $request->get('address1'),
                'address_complement' => $request->get('address2'),
                'city' => $request->get('city'),
                'state' => $request->get('address1'),
                'zip' => $request->get('zip'),
                'country' => $request->get('country'),
                'status' => 1,
            ]);
        }

        $totalPrice = $userCart->sum('total_price').'00';

        if($request->get('type') == 'gcash'){
            
            $params = array(
                "amount" => array(
                  "currency" => "PHP",
                  "value" => $totalPrice
                ),
                "reference" => $orderRef,
                "paymentMethod" => array(
                  "type" => "gcash"
                ),
                "returnUrl" => config('app.url')."/api/validate-payment?id=".$request->get('id')."&order_id=".$generatedOrderNumber,
                "merchantAccount" => "PureHappilifeECOM"
            );

        }

        if($request->get('type') == 'paymaya'){
            
            $params = array(
                "amount" => array(
                  "currency" => "PHP",
                  "value" => $totalPrice
                ),
                "reference" => $orderRef,
                "paymentMethod" => array(
                  "type" => "paymaya_wallet"
                ),
                "returnUrl" => config('app.url')."/api/validate-payment?id=".$request->get('id')."&order_id=".$generatedOrderNumber,
                "merchantAccount" => "PureHappilifeECOM"
            );

        }


        $response = $service->payments($params);

        return $response;
    }


    /**
    * Validate transaction
    *
    * @param  Request  $request
    * @return Response
    */
    public function validatePayment(Request $request){

        if($request->get('resultCode') == 'authorised'){

            $userCart = UserCart::where('user_id', $request->get('id'));
    
            foreach($userCart->get() as $checkoutOrder){
                
                $cartInfo = UserCart::find($checkoutOrder->id);
                $cartInfo->delete();
    
                $product = new ProductOrder;
                $product->user_id = $request->get('id');
                $product->order_id = $request->get('order_id');
                $product->pid = $checkoutOrder->pid;
                $product->quantity = $checkoutOrder->quantity;
                $product->total_price = $checkoutOrder->total_price;
                $product->payment_method = 'ADYEN PAYMENT';
                $product->payment_status = 'PAID';
                $product->status = 1;
                $product->save();
    
            }

            NotificationBell::createNotification('admin', 'New order #'.$generatedOrderNumber, 'New order arrived!', 'order');
    
            return redirect('home/my-orders');

        }

        
        if($request->get('resultCode') == 'pending'){

            return redirect('home/my-orders');

        }

        
        if($request->get('resultCode') == 'received'){

            return redirect('home/my-orders');

        }

        
        if($request->get('resultCode') == 'refused'){

            return redirect('home/my-orders');

        }
        

    }


    /**
    * Submit additional payment
    *
    * @param  Request  $request
    * @return Response
    */
    public function submitAdditionalDetails(Request $request){
        $client = new \Adyen\Client();
        $client->setXApiKey("AQEohmfuXNWTK0Qc+iSAh3Y9j+WLWIJBBJVPOK2ie+xYWqBjKJXgIpygehDBXVsNvuR83LVYjEgiTGAH-VwKxFWXbXzEfoC7iWLUcmrgZYLx0kENTJqygvgHBbHM=-,U{xI$4.<2dc%6HY"); 
        $client->setEnvironment(\Adyen\Environment::TEST);    
        $service = new \Adyen\Service\Checkout($client);

        error_log("Request for submitAdditionalDetails $request");

        $payload = array("details" => $request->details, "paymentData" => $request->paymentData);

        $response = $service->paymentsDetails($payload);

        return $response;
    }

    
}
