<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class Payment extends Model
{
    protected $table = 'payments';

    protected $fillable = [
        'order_id', 'transaction_id', 'payment_type', 'grass_amount',
        'transaction_time', 'transaction_status',
    ];


    public function Order()
    {
        return $this->belongsTo("App\Order");
    }
}
