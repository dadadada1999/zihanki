<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
    ];

    public static function createSale($product_id)
    {
        return self::create([
            'product_id' => $product_id,
        ]);
    }
}