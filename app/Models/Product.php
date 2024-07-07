<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'image',
        'description',
        'price',
        'discount',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'product_user');
    }
}
