<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CategoryItem;
use App\Models\Item;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;
use App\Models\Review;
use App\Models\User;
use App\Traits\ResponseStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
  use ResponseStatus;

  public function index()
  {

    $profile = User::with('profile')->find(auth()->id());
    $categoryMenu = CategoryItem::orderBy('name')->get();
    $cart = Cart::with('item')->where('user_id', auth()->id())->get();

    $config['form'] = (object)[
      'method' => 'POST',
      'action' => route('cart.store')
    ];

    $data = [
      'profile' => $profile,
      'categoryMenu' => $categoryMenu,
      'cart' => $cart
    ];

    return view('pages.frontend.cart', compact('config', 'data'));
  }

  public function store(Request $request)
  {
    $purchaseOrder = PurchaseOrder::create([
      'user_id' => auth()->id(),
      'origin_province' => $request['origin_province'],
      'origin_city' => $request['origin_city'],
      'destination_province' => $request['destination_province'],
      'destination_city' => $request['destination_city'],
      'total_ongkir' => $request['total_ongkir'],
      'total_gram' => $request['weight'],
    ]);
    DB::beginTransaction();
    try {
      $totalPembelian = 0;
      foreach ($request['items'] ?? [] as $item):
        $totalPembelian += $item['total_price'];
        PurchaseOrderItem::create([
          'purchase_order_id' => $purchaseOrder['id'],
          'item_id' => $item['item_id'],
          'qty' => $item['qty'],
          'price' => $item['price'],
          'total_price' => $item['total_price'],
        ]);

        $itemBarang = Item::find($item['item_id']);
        $itemBarang->update([
          'qty' => $itemBarang['qty'] - $item['qty']
        ]);
      endforeach;

      $grandTotal = $totalPembelian + $request['total_ongkir'];
      $purchaseOrder->update([
        'total_pembelian' => $totalPembelian,
        'grand_total' => $grandTotal
      ]);
      Cart::where('user_id', auth()->id())->delete();
      DB::commit();
      return view('pages.frontend.payment-details', compact('grandTotal'));
    } catch (\Throwable $throw) {
      Log::error($throw);
      DB::rollBack();
      $response = response()->json(['error' => $throw->getMessage()]);
    }

  }

  public function addItem($id, Request $request)
  {
    $cart = Cart::updateOrCreate([
      'user_id' => auth()->id(),
      'item_id' => $id
    ]);
    if ($cart->wasRecentlyCreated) {
      $cart->qty = $request['qty_item'];
    } else {
      $cart->qty += $request['qty_item'];
    }
    $cart->save();
    return response()->json('success');
  }

  public function updateItem($id, Request $request)
  {
    Cart::updateOrCreate([
      'user_id' => auth()->id(),
      'item_id' => $id
    ], ['qty' => $request['qty_item']]);
    return response()->json('success');
  }

  public function deleteItem($id)
  {
    $cart = Cart::where('user_id', auth()->id())
      ->where('item_id', $id);
    if ($cart->delete()) {
      return response()->json('success');
    } else {
      return response()->json('failed');
    }
  }

  public function review(Request $request)
  {

    DB::beginTransaction();
    try {
      Review::create([
        'user_id' => auth()->id(),
        'item_id' => $request->item_id,
        'description' => $request->description,
        'score' => $request->score ?? 0,
      ]);
      DB::commit();
      $response = response()->json($this->responseStore(true, NULL, route('history.index')));

    } catch (\Throwable $throw) {
      Log::error($throw);
      DB::rollBack();
      $response = response()->json(['error' => $throw->getMessage()]);
    }
    return $response;
  }


}
