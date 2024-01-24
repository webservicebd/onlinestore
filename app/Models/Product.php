<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
      'brand_id',
      'category_id',
      'name',
      'code',
      'unit',
      'buy_price',
      'sale_price',
      'discount',
      'stock',
      'tag',
      'image',
      'video',
      'descript',
    ];

}
