<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\FileUpload;
use App\Http\Controllers\Controller;
use App\Models\CategoryItem;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

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

  public function register(){
    return view('auth.register');
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required',
      'username' => 'required|alpha_dash|unique:users',
      'password' => 'required|between:6,255|confirmed',
      'email' => 'required|unique:users,email|email',
    ]);
    if ($validator->passes()) {
      DB::beginTransaction();
      $dimensions = [array('300', '300', 'thumbnail')];
      try {
        $img = isset($request->image) && !empty($request->image) ? FileUpload::uploadImage('image', $dimensions) : NULL;
        $data = User::create([
          'role_id' => 2,
          'name' => ucwords($request['name']),
          'image' => $img,
          'email' => $request['email'],
          'username' => $request['username'],
          'password' => Hash::make($request['password']),
          'active' => 1,
        ]);

        $data->app_settings()->create([
          'user_id' => $data->id,
          'type' => 'setting',
          'name' => 'layout_setting',
          'status' => 1,
          'value' => json_encode(config('app_settings')),
          'is_global' => 1,
        ]);

        DB::commit();
        return Redirect::to('/')->with(['message' => "Data Berhasil Dibuat"]);
      } catch (\Throwable $throw) {
        DB::rollBack();
        Log::error($throw);
        return Redirect::back()->with(['errors' => $throw->getMessage()])->withInput();
      }
    } else {
      return Redirect::back()->with(['errors' => $validator->errors()])->withInput();
    }
  }
}
