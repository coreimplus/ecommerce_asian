<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = ['name', 'price', 'short_description', 'description', 'information', 'sizes', 'colors', 'available_quantity', 'image_one', 'image_two', 'image_three'];
}
