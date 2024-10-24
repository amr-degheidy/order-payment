<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'name',
        'quantity',
        'price',
        'status',
    ];

    protected static function booted(): void
    {
       static::creating(function (Order $order) {
          $order->user_id = auth()->id();
       });
    }
}
