<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOrderPaymentProof extends Model
{
    use HasFactory;

    protected $table = 'product_order_payment_proof';

    public function orderPaymentProof(){
        return $this->hasOne('App\Models\ProductOrder', 'order_id', 'order_id');
    }

}
