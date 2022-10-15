<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CategoryItem;
use App\Models\User;
use App\Traits\ResponseStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
  use ResponseStatus;

  public function index()
  {

    $profile = User::with('profile')->find(auth()->id());
    $categoryMenu = CategoryItem::orderBy('name')->get();

    $config['form'] = (object)[
      'method' => 'POST',
      'action' => route('profiles.store')
    ];

    $data = [
      'profile' => $profile,
      'categoryMenu'=> $categoryMenu
    ];

    return view('pages.frontend.profile', compact('config', 'data'));
  }


  public function store(Request $request)
  {
    DB::beginTransaction();
    try {
      $data = User::with('profile')->find(auth()->id());
      $data->update([
        'name' => $request['name'],
      ]);
      $request->except('_method');
      $data->profile()->updateOrCreate(
        ['user_id' => $data->id],
        [
          'city' => $request['city'],
          'address' => $request['address'],
          'phone' => $request['phone'],
          'postcode' => $request['postcode']
        ]
      );

      DB::commit();
      $response = response()->json($this->responseStore(true, NULL, route('home.index')));
    } catch (\Throwable $throw) {
      DB::rollBack();
      Log::error($throw);
      $response = response()->json(['error' => $throw->getMessage()]);
    }
    return $response;
  }
}
