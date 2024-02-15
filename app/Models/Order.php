<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'shipping_address_id', 'payment_type', 'is_paid', 'sub_total', 'shipping'];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
