<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
  use HasFactory;

  protected $fillable = [
    'user_id',
    'grand_total',
    'status',
  ];


  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function purchase_order_item()
  {
    return $this->hasMany(PurchaseOrderItem::class);
  }

  protected function serializeDate(\DateTimeInterface $date)
  {
    return $date->format('Y-m-d H:i:s');
  }
}
