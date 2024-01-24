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
    // join parent model into child model
    // which match categories table foreignId
    // brand_id with brands table primary id
    public function brand () {
      return $this->belongsTo(Brand::class);
  }

}
