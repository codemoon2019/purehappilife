<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravelista\Comments\Commentable;

class WebsiteBlog extends Model
{
    use HasFactory, Commentable;

    protected $table = 'website_blogs';

}
