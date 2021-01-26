<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCart extends Model
{
    use HasFactory;

    protected $table = 'user_cart';

    public function productInfo(){
        return $this->hasOne('App\Models\Product', 'id', 'pid');
    }

}
