<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
  use HasFactory;

  protected $fillable = [
    'user_id',
    'name',
    'slug',
  ];
  // join child model into parent model
  // which match brands table primary id
  // with categories table foreignId brand_id
  public function categories () {
    return $this->hasMany(Category::class);
  }

}
