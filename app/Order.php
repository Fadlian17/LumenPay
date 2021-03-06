<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'user_id', 'status',
    ];


    public function customer()
    {
        return $this->belongsTo("App\Customer");
    }

    public function orderitem()
    {
        return $this->hasMany("App\OrderItem");
    }
    public function payment()
    {
        return $this->hasMany("App\Payment");
    }
}
