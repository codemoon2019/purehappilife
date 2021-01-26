<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOrder extends Model
{
    use HasFactory;

    protected $table = 'product_orders';

    public function productInfo(){
        return $this->hasOne('App\Models\Product', 'id', 'pid');
    }

    public function customerInfo(){
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function guestInfo(){
        return $this->hasOne('App\Models\Guest', 'guest_id', 'user_id');
    }

    public function driverInfo(){
        return $this->hasOne('App\Models\User', 'id', 'assigned_driver');
    }

    public function customerAddress(){
        return $this->hasOne('App\Models\UserAddress', 'user_id', 'user_id');
    }

    public function guestAddress(){
        return $this->hasOne('App\Models\GuestAddress', 'guest_id', 'user_id');
    }

    public function orderPaymentProof(){
        return $this->hasOne('App\Models\ProductOrderPaymentProof', 'order_id', 'order_id');
    }
    

}
