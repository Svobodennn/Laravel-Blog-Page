<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticable; // config->auth-> change users to admins

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;

class Admin extends Authenticable // extends model
{
    use HasFactory;
}
