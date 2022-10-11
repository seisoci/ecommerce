<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CategoryItem;
use App\Models\Item;
use Illuminate\Http\Request;

class ProductController extends Controller
{

  public function index(Request $request){
    $categoryMenu = CategoryItem::orderBy('name')->get();
    if(isset($request['category'])){
      $category = CategoryItem::whereName($request['category'])->first();
      $products = Item::whereCategoryItemId($category['id'])->paginate(20);
    }else{
      $products = Item::paginate(20);
    }

    $data = [
      'products' => $products,
      'categoryMenu'=> $categoryMenu
    ];

    return view('pages.frontend.products', compact('data'));
  }

  public function show($id)
  {
    $product = Item::whereSlug($id)->firstOrFail();
    $categoryMenu = CategoryItem::orderBy('name')->get();
    $data = [
      'product' => $product,
      'categoryMenu'=> $categoryMenu
    ];

    return view('pages.frontend.product-details', compact('data'));
  }
}
