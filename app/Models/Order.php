<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['total_price', 'shipping_price', 'payment_type', 'user_id', 'shipping_address_id', 'is_paid'];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
