<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['category_id','title', 'description', 'image', 'quantity', 'price', 'discount_price'];

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }
}
