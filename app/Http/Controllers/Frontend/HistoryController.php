<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CategoryItem;
use App\Models\PurchaseOrder;
use App\Traits\ResponseStatus;

class HistoryController extends Controller
{
  use ResponseStatus;

  public function index()
  {

    $purchaseOrder = PurchaseOrder::with('purchase_order_item.item')
      ->where('user_id', auth()->id())
      ->latest()
      ->get();
    $categoryMenu = CategoryItem::orderBy('name')->get();
    $cart = Cart::with('item')->where('user_id', auth()->id())->get();

    $config['form'] = (object)[
      'method' => 'POST',
      'action' => route('profiles.store')
    ];

    $data = [
      'purchaseOrder' => $purchaseOrder,
      'categoryMenu' => $categoryMenu,
      'cart' => $cart
    ];

    return view('pages.frontend.history', compact('config', 'data'));
  }
}
