<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = ['category_id', 'name', 'price', 'short_description', 'description', 'information', 'sizes', 'colors', 'available_quantity', 'image_one', 'image_two', 'image_three'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'product_sizes');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('quantity');
    }
}
