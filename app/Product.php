<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'name', 'price',
    ];


    public function OrderItem()
    {
        return $this->belongsTo("App\OrderItem");
    }
}
