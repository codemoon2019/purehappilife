<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Product extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'products';

    public function productImages(){
        return $this->hasMany('App\Models\ProductImage', 'pid', 'id');
    }

}
