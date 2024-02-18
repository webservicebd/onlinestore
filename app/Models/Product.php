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
    'slug',
    'code',
    'unit',
    'buy_price',
    'sale_price',
    'discount',
    'qty',
    'image',
    'video',
    'descript',
  ];

  // relation child model to parent model
  // which categories table foreignId brand_id
  // with match brands table primary id
  public function brand () {
    return $this->belongsTo(Brand::class);
  }

  public function category () {
    return $this->belongsTo(Category::class);
  }

}
