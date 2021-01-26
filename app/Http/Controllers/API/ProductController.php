<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductOrder;
use App\Models\ProductType;
use App\Models\User;

class ProductController extends Controller
{
    
    public $successStatus = 200;

    /**
    * Create product.
    *
    * @param  Request  $request
    * @return Response
    */
    public function createProduct(Request $request){
        
        $product = new Product;
        $product->product_name = $request->product_name;
        $product->product_type = $request->product_type;
        $product->product_description = $request->product_description;
        $product->product_price = $request->product_original_price;
        $product->product_retail_price = $request->product_retail_price;
        $product->gift_points = $request->gift_points;  
        $product->product_image_url = $request->main_image;
        $product->lorikeet = $request->lorikeet_image;
        $product->product_status = $request->product_status;
        $product->stocks = $request->product_stock;
        $product->save();

        if(count($request->additional_images) != 0){
            for($i = 0; $i < count($request->additional_images); $i++){
                $productImages = new ProductImage;
                $productImages->pid = $product->id;
                $productImages->product_image_url = $request->additional_images[$i];
                $productImages->save();
            }
        }

        return response()->json([
            'internalMessage' => 'Product created successfully!'
        ], $this->$successStatus);

    }

    public function retrieveSingleProductInfo(Request $request){

        $productInfo = Product::with('productImages')->where('id', $request->id)->get();

        return $productInfo;
    }


    public function deleteProductImage(Request $request){

        $productInfo = ProductImage::find($request->id);
        $productInfo->delete();

        return 'success';

    }


    public function updateProduct(Request $request){
   
        $product = Product::find($request->id);
        $product->product_name = $request->product_name;
        $product->product_type = $request->product_type;
        $product->product_description = $request->product_description;
        $product->product_price = $request->product_original_price;
        $product->product_retail_price = $request->product_retail_price;
        $product->gift_points = $request->gift_points; 

        if($request->main_image != 'no-path'){
            $product->product_image_url = $request->main_image;
        } 
        if($request->lorikeet_image != 'no-path'){
            $product->lorikeet = $request->lorikeet_image;
        }

        $product->product_status = $request->product_status;
        $product->stocks = $request->product_stock;
        $product->save();

        if(count($request->additional_images) != 0){
            for($i = 0; $i < count($request->additional_images); $i++){
                $productImages = new ProductImage;
                $productImages->pid = $product->id;
                $productImages->product_image_url = $request->additional_images[$i];
                $productImages->save();
            }
        }

        return response()->json([
            'internalMessage' => 'Product updated successfully!'
        ], 200);

    }

    public function deleteProduct(Request $request){

        $product = Product::find($request->id);
        $product->delete();

        return 'success';
    }


    /**
    * Product Order List
    *
    * @param  Request  $request
    * @return Response
    */
    public function orderList(Request $request){

        $columns = array(
            0 => 'id',
            1 => 'order_id', 
            2 => 'id', 
            3 => 'id', 
            4 => 'id', 
            5 => 'id', 
            6 => 'id', 
        );

        $totalData = ProductOrder::with('productInfo', 'customerInfo')->where('user_type','USER')->get()->groupBy('order_id')->count();

        $totalFiltered = $totalData;

        $limit = $request->length;
        $start = $request->start;
        $order = $columns[$request->orderColumn];
        $dir = $request->orderDirectory;

        if(empty($request->search)){

        $orders = ProductOrder::with('productInfo', 'customerInfo')->where('user_type','USER')->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->groupBy('product_orders.order_id')
                ->get();

        }else{

        $search = $request->search; 

        $orders =  ProductOrder::with('productInfo', 'customerInfo')->where('user_type','USER')->where('id','LIKE',"%{$search}%")
                    ->orWhere('order_id', 'LIKE',"%{$search}%")
                    ->offset($start)
                    ->limit($limit)
                    ->groupBy('product_orders.order_id')
                    ->get();

        $totalFiltered = ProductOrder::with('productInfo', 'customerInfo')->where('user_type','USER')->where('id','LIKE',"%{$search}%")
                    ->orWhere('order_id', 'LIKE',"%{$search}%")
                    ->get()->groupBy('order_id')->count();
        }

        $data = array();

        if(!empty($orders)){

            foreach ($orders as $orders){
            
                $groupOrder = ProductOrder::whereIn('order_id', [$orders->order_id]);

                $nestedData['id'] = $orders->id;
                $nestedData['order_id'] = '<a href="/order/order-details/'.$orders->order_id.'">#'.$orders->order_id.'</a>';
                $nestedData['customer_name'] = $orders->customerInfo->first_name.' '.$orders->customerInfo->last_name;
                $nestedData['customer_type'] = $orders->user_type;
                $nestedData['total_item_orders'] = $groupOrder->sum('quantity');
                $nestedData['total_price'] = '₱ '.number_format($groupOrder->sum('total_price'));
                $nestedData['created_at'] = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $orders->created_at)->format('m-d-Y').' ('.$orders->created_at->diffForHumans().')';
                $nestedData['payment_status'] = $orders->payment_status;
                $nestedData['payment_method'] = $orders->payment_method;

                if(ProductOrder::whereIn('order_id', [$orders->order_id])->whereIn('status', [1])->get()->count() == ProductOrder::whereIn('order_id', [$orders->order_id])->get()->count()){
                    $orderStatus = 'PENDING';
                }

                if(ProductOrder::whereIn('order_id', [$orders->order_id])->whereIn('status', [1])->get()->count() != ProductOrder::whereIn('order_id', [$orders->order_id])->get()->count()){
                    $orderStatus = 'PREPARING';
                }
                
                if(ProductOrder::whereIn('order_id', [$orders->order_id])->whereIn('status', [3])->get()->count() == ProductOrder::whereIn('order_id', [$orders->order_id])->get()->count()){
                    $orderStatus = 'DELIVERING';
                }

                if(ProductOrder::whereIn('order_id', [$orders->order_id])->whereIn('status', [4])->get()->count() == ProductOrder::whereIn('order_id', [$orders->order_id])->get()->count()){
                    $orderStatus = 'DELIVERED';
                }

                $nestedData['order_status'] = $orderStatus;

                $data[] = $nestedData;

            }
        
        }

        $json_data = array(
            "draw"            => intval($request->draw),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
            );
 
        return response()->json($json_data); 

    }


    /**
    * Product Order List
    *
    * @param  Request  $request
    * @return Response
    */
    public function guestOrderList(Request $request){

        $columns = array(
            0 => 'id',
            1 => 'order_id', 
            2 => 'id', 
            3 => 'id', 
            4 => 'id', 
            5 => 'id', 
            6 => 'id', 
        );

        $totalData = ProductOrder::with('productInfo', 'guestInfo')->where('user_type','GUEST')->get()->groupBy('order_id')->count();

        $totalFiltered = $totalData;

        $limit = $request->length;
        $start = $request->start;
        $order = $columns[$request->orderColumn];
        $dir = $request->orderDirectory;

        if(empty($request->search)){

        $orders = ProductOrder::with('productInfo', 'guestInfo')->where('user_type','GUEST')->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->groupBy('product_orders.order_id')
                ->get();

        }else{

        $search = $request->search; 

        $orders =  ProductOrder::with('productInfo', 'guestInfo')->where('user_type','GUEST')->where('id','LIKE',"%{$search}%")
                    ->orWhere('order_id', 'LIKE',"%{$search}%")
                    ->offset($start)
                    ->limit($limit)
                    ->groupBy('product_orders.order_id')
                    ->get();

        $totalFiltered = ProductOrder::with('productInfo', 'guestInfo')->where('user_type','GUEST')->where('id','LIKE',"%{$search}%")
                    ->orWhere('order_id', 'LIKE',"%{$search}%")
                    ->get()->groupBy('order_id')->count();
        }

        $data = array();

        if(!empty($orders)){

            foreach ($orders as $orders){
            
                $groupOrder = ProductOrder::whereIn('order_id', [$orders->order_id]);

                $nestedData['id'] = $orders->id;
                $nestedData['order_id'] = '<a href="/order/guest-order-details/'.$orders->order_id.'">#'.$orders->order_id.'</a>';
                $nestedData['customer_name'] = $orders->guestInfo->first_name.' '.$orders->guestInfo->last_name;
                $nestedData['customer_type'] = $orders->user_type;
                $nestedData['total_item_orders'] = $groupOrder->sum('quantity');
                $nestedData['total_price'] = '₱ '.number_format($groupOrder->sum('total_price'));
                $nestedData['created_at'] = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $orders->created_at)->format('m-d-Y').' ('.$orders->created_at->diffForHumans().')';
                $nestedData['payment_status'] = $orders->payment_status;
                $nestedData['payment_method'] = $orders->payment_method;

                if(ProductOrder::whereIn('order_id', [$orders->order_id])->whereIn('status', [1])->get()->count() == ProductOrder::whereIn('order_id', [$orders->order_id])->get()->count()){
                    $orderStatus = 'PENDING';
                }

                if(ProductOrder::whereIn('order_id', [$orders->order_id])->whereIn('status', [1])->get()->count() != ProductOrder::whereIn('order_id', [$orders->order_id])->get()->count()){
                    $orderStatus = 'PREPARING';
                }
                
                if(ProductOrder::whereIn('order_id', [$orders->order_id])->whereIn('status', [3])->get()->count() == ProductOrder::whereIn('order_id', [$orders->order_id])->get()->count()){
                    $orderStatus = 'DELIVERING';
                }

                if(ProductOrder::whereIn('order_id', [$orders->order_id])->whereIn('status', [4])->get()->count() == ProductOrder::whereIn('order_id', [$orders->order_id])->get()->count()){
                    $orderStatus = 'DELIVERED';
                }

                $nestedData['order_status'] = $orderStatus;

                $data[] = $nestedData;

            }
        
        }

        $json_data = array(
            "draw"            => intval($request->draw),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
            );
 
        return response()->json($json_data); 

    }



    /**
    * Get order list of driver.
    *
    * @param  Request  $request
    * @return Response
    */
    public function orderListDriver(Request $request){

        $columns = array(
            0 => 'id',
            1 => 'order_id', 
            2 => 'id', 
            3 => 'id', 
            4 => 'id', 
            5 => 'id', 
            6 => 'id', 
        );

        $totalData = ProductOrder::with('productInfo', 'customerInfo')->where('assigned_driver', $request->driverID)->get()->groupBy('order_id')->count();

        $totalFiltered = $totalData;

        $limit = $request->length;
        $start = $request->start;
        $order = $columns[$request->orderColumn];
        $dir = $request->orderDirectory;

        if(empty($request->search)){

        $orders = ProductOrder::with('productInfo', 'customerInfo')->where('assigned_driver', $request->driverID)->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->groupBy('product_orders.order_id')
                ->get();

        }else{

        $search = $request->search; 

        $orders =  ProductOrder::with('productInfo', 'customerInfo')->where('assigned_driver', $request->driverID)->where('id','LIKE',"%{$search}%")
                    ->orWhere('order_id', 'LIKE',"%{$search}%")
                    ->offset($start)
                    ->limit($limit)
                    ->groupBy('product_orders.order_id')
                    ->get();

        $totalFiltered = ProductOrder::with('productInfo', 'customerInfo')->where('assigned_driver', $request->driverID)->where('id','LIKE',"%{$search}%")
                    ->orWhere('order_id', 'LIKE',"%{$search}%")
                    ->get()->groupBy('order_id')->count();
        }

        $data = array();

        if(!empty($orders)){

            foreach ($orders as $orders){
            
                $groupOrder = ProductOrder::whereIn('order_id', [$orders->order_id]);

                $nestedData['id'] = $orders->id;
                $nestedData['order_id'] = '<a href="/order/order-details/'.$orders->order_id.'">#'.$orders->order_id.'</a>';
                $nestedData['customer_name'] = $orders->customerInfo->first_name.' '.$orders->customerInfo->last_name;
                $nestedData['total_item_orders'] = $groupOrder->sum('quantity');
                $nestedData['total_price'] = '₱ '.number_format($groupOrder->sum('total_price'));
                $nestedData['created_at'] = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $orders->created_at)->format('m-d-Y').' ('.$orders->created_at->diffForHumans().')';
                $nestedData['payment_status'] = $orders->payment_status;
                $nestedData['payment_method'] = $orders->payment_method;

                if(ProductOrder::whereIn('order_id', [$orders->order_id])->whereIn('status', [1])->get()->count() == ProductOrder::whereIn('order_id', [$orders->order_id])->get()->count()){
                    $orderStatus = 'PENDING';
                }

                if(ProductOrder::whereIn('order_id', [$orders->order_id])->whereIn('status', [1])->get()->count() != ProductOrder::whereIn('order_id', [$orders->order_id])->get()->count()){
                    $orderStatus = 'PREPARING';
                }
                
                if(ProductOrder::whereIn('order_id', [$orders->order_id])->whereIn('status', [3])->get()->count() == ProductOrder::whereIn('order_id', [$orders->order_id])->get()->count()){
                    $orderStatus = 'DELIVERING';
                }

                if(ProductOrder::whereIn('order_id', [$orders->order_id])->whereIn('status', [4])->get()->count() == ProductOrder::whereIn('order_id', [$orders->order_id])->get()->count()){
                    $orderStatus = 'DELIVERED';
                }

                $nestedData['order_status'] = $orderStatus;

                $data[] = $nestedData;

            }
        
        }

        $json_data = array(
            "draw"            => intval($request->draw),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
            );
 
        return response()->json($json_data); 

    }



    /**
    * Product list
    *
    * @param  Request  $request
    * @return Response
    */
    public function productList(Request $request){

        $columns = array(
            0 => 'id',
            1 => 'product_name',
            2 => 'stocks',
            3 => 'id',
            4 => 'id',
            5 => 'id'
        );

        $totalData = Product::get()->count();

        $totalFiltered = $totalData;

        $limit = $request->length;
        $start = $request->start;
        $order = $columns[$request->orderColumn];
        $dir = $request->orderDirectory;

        if(empty($request->search)){

        $products = Product::offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();

        }else{

        $search = $request->search; 

        $products =  Product::where('id','LIKE',"%{$search}%")
                    ->orWhere('product_name', 'LIKE',"%{$search}%")
                    ->offset($start)
                    ->limit($limit)
                    ->get();

        $totalFiltered = Product::where('id','LIKE',"%{$search}%")
                    ->orWhere('product_name', 'LIKE',"%{$search}%")
                    ->get()
                    ->count();
        }

        $data = array();

        if(!empty($products)){

            foreach ($products as $product){

                $nestedData['id'] = $product->id;
                $nestedData['product_name'] = $product->product_name;
                $nestedData['product_image'] = '<div class="product-img bg-transparent border">
                                                    <img src="'.$product->product_image_url.'" width="35" height="35" alt="">
                                                </div>';
                $nestedData['product_price'] = '₱ '.number_format($product->product_price);
                $nestedData['product_stock'] = $product->stocks;
                if($product->stocks == 0){
                    $status = '<span class="btn btn-sm btn-dark radius-30">No stocks available</span>';   
                }
                elseif($product->stocks <= 100){
                    $status = ' <span class="btn btn-sm btn-danger radius-30">Very low</span>';
                }
                elseif($product->stocks <= 500){
                    $status = '<span class="btn btn-sm btn-warning radius-30">Low</span>';
                }
                else{
                    $status = '<span class="btn btn-sm btn-success radius-30">Safe</span>';
                }
                $nestedData['product_status'] =  $status;
                $nestedData['action'] = '<span class="btn btn-sm btn-warning radius-30 btn-edit" id="'.$product->id.'"><i class="fadeIn animated bx bx-edit"></i></span>
                                        <span class="btn btn-sm btn-danger radius-30 btn-delete" id="'.$product->id.'"><i class="fadeIn animated bx bx-trash-alt"></i></span>';
                $data[] = $nestedData;

            }
        
        }

        $json_data = array(
            "draw"            => intval($request->draw),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
            );
 
        return response()->json($json_data); 

    }

    /**
    * Retrieve order details.
    *
    * @param  Request  $request
    * @return Response
    */
    public function orderDetails(Request $request){

        $orderDetails = ProductOrder::with('productInfo', 'customerInfo', 'driverInfo', 'customerAddress', 'orderPaymentProof')
                        ->where('order_id', $request->order_id)
                        ->get();

        return array(['data' => $orderDetails, 'total_price' => $orderDetails->sum('total_price')]);

    }


    /**
    * Retrieve order details guest.
    *
    * @param  Request  $request
    * @return Response
    */
    public function orderDetailsGuest(Request $request){

        $orderDetails = ProductOrder::with('productInfo', 'guestInfo', 'driverInfo', 'guestAddress', 'orderPaymentProof')
                        ->where('order_id', $request->order_id)
                        ->get();

        return array(['data' => $orderDetails, 'total_price' => $orderDetails->sum('total_price')]);

    }

    /**
    * Update order status.
    *
    * @param  Request  $request
    * @return Response
    */
    public function updateOrderStatus(Request $request){
                     
        $updateOrderStatus = ProductOrder::where('id', $request->id)->update([
            'status' => $request->status,
        ]);


        return array(['status' => 'success']);

    }

    /**
    * Update all order status.
    *
    * @param  Request  $request
    * @return Response
    */
    public function updateAllOrderStatus(Request $request){

        if($request->status == 4){
            
            $getOrders = ProductOrder::where('order_id', $request->order_id);

            foreach($getOrders->get() as $orders){

                $totalPoints = 0;

                $productInfo = Product::where('id', $orders->pid);

                $totalPoints = $productInfo->get()->first()->gift_points * $orders->quantity;

                $customerInfo = User::where('id', $orders->user_id);

                $customerInfo->update([
                    'tokens' => $customerInfo->get()->first()->tokens + $totalPoints
                ]);

            }

            $updateOrderStatus = ProductOrder::where('order_id', $request->order_id)->update([
                'status' => $request->status,
                'payment_status' => 'PAID'
            ]);    
            return array(['status' => 'success']);
        }else{

            $updateOrderStatus = ProductOrder::where('order_id', $request->order_id)->update([
                'status' => $request->status
            ]);

            return array(['status' => 'success']);
        }

    }


    /**
    * Update multiple selected order.
    *
    * @param  Request  $request
    * @return Response
    */
    public function updateMultipleOrderStatus(Request $request){

       $selectAllTheSelectedProduct = ProductOrder::whereIn('id', $request->orderList)->get();

       return $selectAllTheSelectedProduct;

    }


    /**
    * Show dashboard details.
    *
    * @param  Request  $request
    * @return Response
    */
    public function dashBoardReport(Request $request){

        $totalNumberOfUser = User::count();

        $productOrders = ProductOrder::count();

        $totalSales = ProductOrder::where('status', 4)->sum('total_price');

        $totalOverallSales = ProductOrder::sum('total_price');

        $recentOrders = ProductOrder::with('productInfo', 'customerInfo') 
        ->where('user_type', 'USER')  
        ->orderBy('id', 'DESC')
        ->groupBy('product_orders.order_id')
        ->limit(5)
        ->get();

        $productList = Product::limit(5)
        ->orderBy('stocks', 'ASC')
        ->get();

        return array([
            'recentOrder' => $recentOrders,
            'totalNumberOfUser' => $totalNumberOfUser,
            'productOrders' => $productOrders,
            'totalSales' => $totalSales,
            'totalOverallSales' => $totalOverallSales,
            'productList' => $productList
        ]); 

    }

      /**
    * Show dashboard details.
    *
    * @param  Request  $request
    * @return Response
    */
    public function guestDashBoardReport(Request $request){

        $totalNumberOfUser = User::count();

        $productOrders = ProductOrder::count();

        $totalSales = ProductOrder::where('status', 4)->sum('total_price');

        $totalOverallSales = ProductOrder::sum('total_price');

        $recentOrders = ProductOrder::with('productInfo', 'guestInfo') 
        ->where('user_type', 'GUEST')  
        ->orderBy('id', 'DESC')
        ->groupBy('product_orders.order_id')
        ->limit(5)
        ->get();

        $productList = Product::limit(5)
        ->orderBy('stocks', 'ASC')
        ->get();

        return array([
            'recentOrder' => $recentOrders,
            'totalNumberOfUser' => $totalNumberOfUser,
            'productOrders' => $productOrders,
            'totalSales' => $totalSales,
            'totalOverallSales' => $totalOverallSales,
            'productList' => $productList
        ]); 

    }


    /**
    * Update order driver.
    *
    * @param  Request  $request
    * @return Response
    */
    public function updateDriver(Request $request){

        $selectOrder = ProductOrder::whereIn('order_id', [$request->order_id])->update([
            'assigned_driver' => $request->id
        ]);

        return array(['status' => 'success']);
            
    }



}
