<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class OrderItem extends Model
{
    protected $table = 'order_items';

    protected $fillable = [
        'order_id', 'product_id', 'quantity',
    ];


    public function product()
    {
        return $this->belongsTo("App\Product");
    }
}
