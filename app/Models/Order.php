<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'address1',
        'address2',
        'city',
        'country',
        'pin_code',
        'status',
        'state',
        'message',
        'tracking_number',
        'total_price'
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
