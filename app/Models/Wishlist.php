<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;
    function Product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    function Color()
    {
        return   $this->belongsTo(Color::class, 'color_id');
    }
    function Size()
    {
        return $this->belongsTo(Size::class, 'size_id');
    }
    function Flavour()
    {
        return $this->belongsTo(Flavour::class, 'flavour_id');
    }
    function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
