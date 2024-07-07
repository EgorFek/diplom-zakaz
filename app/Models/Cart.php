<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('count');
    }

    public function getTotal()
    {
        if ($this) {
            return $this->products->reduce(function ($carry, $product) {
                $price = $product->discount ? $product->discount : $product->price;
                return $carry + $price * $product->pivot->count;
            }, 0);
        } else {
            return 0;
        }
    }

    public function clear()
    {
        $this->products()->detach();
    }
}
