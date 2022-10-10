<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CategoryItem;
use App\Models\Item;
use Illuminate\Http\Request;

class ProductController extends Controller
{

  public function index(Request $request){

    if(isset($request['category'])){
      $category = CategoryItem::whereName($request['category'])->first();
      $data = Item::whereCategoryItemId($category['id'])->paginate(20);
    }else{
     $data = Item::paginate(20);
    }

    return view('pages.frontend.products', compact('data'));
  }

  public function show($id)
  {
    $data = Item::whereSlug($id)->firstOrFail();

    return view('pages.frontend.product-details', compact('data'));
  }
}
