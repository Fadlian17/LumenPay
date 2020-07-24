<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class Customer extends Model
{
    protected $table = 'customers';

    protected $fillable = [
        'full_name', 'username', 'email', 'phone_number',
    ];


    public function order()
    {
        return $this->belongsTo("App\Order");
    }
}
