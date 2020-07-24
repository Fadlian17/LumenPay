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

    public function order()
    {
        return $this->hashMany("App\Order");
    }
    public function payment()
    {
        return $this->hashMany("App\Payment");
    }
}
