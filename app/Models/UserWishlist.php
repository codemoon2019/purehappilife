<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserWishlist extends Model
{
    use HasFactory;

    protected $table = 'user_wishlist';

    public function productInfo(){
        return $this->hasOne('App\Models\Product', 'id', 'pid');
    }

}
