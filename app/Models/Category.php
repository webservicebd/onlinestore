<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  use HasFactory;

  protected $fillable = [
    'brand_id',
    'name',
    'slug',
  ];
  // relation child model to parent model
  // which categories table foreignId brand_id
  // with match brands table primary id
  public function brand () {
    return $this->belongsTo(Brand::class);
  }

}
