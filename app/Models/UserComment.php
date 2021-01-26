<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserComment extends Model
{
    use HasFactory;

    protected $table = 'user_comment';

    public function customerInfo(){
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

}
