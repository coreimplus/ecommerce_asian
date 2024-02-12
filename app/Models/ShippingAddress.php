<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'mobile_number', 'address', 'country', 'city', 'state', 'zip_code', 'user_id'];
}
