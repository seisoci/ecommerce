<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Item extends Model
{
  use HasFactory, HasSlug;

  protected $fillable = [
    'title',
    'slug',
    'category_item_id',
    'poster',
    'qty',
    'price',
    'description',
    'published',
    'created_at',
  ];

  public function product_images()
  {
    return $this->hasMany(ProductImage::class)->orderBy('sort_number', 'asc');
  }

  public function category()
  {
    return $this->belongsTo(CategoryItem::class, 'category_item_id');
  }

  public function review()
  {
    return $this->hasMany(Review::class);
  }

  public function getSlugOptions(): SlugOptions
  {
    return SlugOptions::create()
      ->generateSlugsFrom('title')
      ->saveSlugsTo('slug');
  }

  protected function serializeDate(DateTimeInterface $date)
  {
    return $date->format('Y-m-d H:i:s');
  }
}
