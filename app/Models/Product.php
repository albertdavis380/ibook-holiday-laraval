<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\User;

class Product extends Model
{
    // app/Models/Product.php

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'user_favorites', 'product_id', 'user_id');
    }




}