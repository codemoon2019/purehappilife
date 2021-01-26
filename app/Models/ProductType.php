<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ProductType extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'product_types';

}
