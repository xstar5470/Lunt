<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable
{
    protected $primaryKey = 'id';
    protected $guarded = [];
    protected $table = 'users';
}
