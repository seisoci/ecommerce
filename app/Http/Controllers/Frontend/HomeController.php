<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CategoryItem;
use App\Models\Item;

class HomeController extends Controller
{
  public function index()
  {
    $products = Item::with('category')->where('published', 1)->oldest()->get();
    $slider = Item::inRandomOrder()->limit(5)->get();
    $categoryMenu = CategoryItem::orderBy('name')->get();
    $data = [
      'products' => $products,
      'slider' => $slider,
      'categoryMenu'=> $categoryMenu
    ];

    return view('pages.frontend.home', compact('data'));
  }
}
