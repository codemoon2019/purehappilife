<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuestCart extends Model
{
    use HasFactory;

    protected $table = 'guest_cart';

    public function productInfo(){
        return $this->hasOne('App\Models\Product', 'id', 'pid');
    }

}
