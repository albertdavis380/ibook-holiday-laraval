<?php

namespace App\Models;
use App\Models\Product;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    // Other User model code...


    public function favoriteProducts()
    {
        return $this->belongsToMany(Product::class, 'user_favorites', 'user_id', 'product_id');
    }


}