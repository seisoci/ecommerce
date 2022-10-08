<?php

namespace App\Models;

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
      'description',
      'published',
      'created_at',
    ];

    public function category(){
      return $this->belongsTo(CategoryItem::class, 'category_item_id');
    }

  public function getSlugOptions() : SlugOptions
  {
    return SlugOptions::create()
      ->generateSlugsFrom('title')
      ->saveSlugsTo('slug');
  }

  protected function serializeDate(\DateTimeInterface $date)
  {
    return $date->format('Y-m-d H:i:s');
  }
}
