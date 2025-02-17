<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'user_id',
        'product_id',
    ];

    public function user()
    {
        return $this->belongsTo(user::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
