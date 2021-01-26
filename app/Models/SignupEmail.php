<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SignupEmail extends Model
{
    use HasFactory;

    protected $table = 'signup_email';

    protected $fillable = [
        'email'
    ];

}
