<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    function Catagory()
    {
        return $this->belongsTo(Catagory::class, 'catagory_id');
    }
    function Subcatagory()
    {
        return $this->belongsTo(Subcatagory::class, 'catagory_id');
    }
    function Attribute()
    {
        return $this->hasMany(Attribute::class, 'product_id');
    }
    function Gallery()
    {
        return $this->hasMany(Gallery::class, 'product_id');
    }
    function Flavour()
    {
        return $this->hasMany(Flavour::class, 'product_id');
    }
   
}
