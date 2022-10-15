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

  public function purchase_order_item()
  {
    return $this->hasMany(PurchaseOrderItem::class);
  }
}
