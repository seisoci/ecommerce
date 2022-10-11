<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CategoryItem;
use App\Models\User;
use App\Traits\ResponseStatus;
use Illuminate\Http\Request;

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
      'action' => route('profiles.store')
    ];

    $data = [
      'profile' => $profile,
      'categoryMenu'=> $categoryMenu,
      'cart' => $cart
    ];

    return view('pages.frontend.cart', compact('config', 'data'));
  }
}
