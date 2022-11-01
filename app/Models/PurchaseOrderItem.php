<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderItem extends Model
{
    use HasFactory;

  protected $fillable = [
    'purchase_order_id',
    'item_id',
    'qty',
    'price',
    'total_price',
  ];

  public function item(){
    return $this->belongsTo(Item::class);
  }

  public function po(){
    return $this->belongsTo(PurchaseOrder::class, 'purchase_order_id');
  }

  protected function serializeDate(\DateTimeInterface $date)
  {
    return $date->format('Y-m-d H:i:s');
  }
}
