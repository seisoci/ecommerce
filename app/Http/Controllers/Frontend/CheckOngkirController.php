<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CheckOngkirController extends Controller
{
  public function test()
  {
    $key = env('RAJAONGKIR_API_KEY');
    $province = Http::withHeaders([
      'key' => $key
    ])->get('https://api.rajaongkir.com/starter/province')
      ->json();

//    foreach ($province['rajaongkir']['results'] as $item):
//      $province = Province::create([
//        'id' => $item['province_id'],
//        'name' => $item['province']
//      ]);
//    endforeach;

    $province = Province::all();
    foreach ($province as $item):
      if($item['id'] >= 9){

      $city = Http::withHeaders([
        'key' => $key
      ])->get('https://api.rajaongkir.com/starter/city', ['province' => $item['id']])
        ->json();

      foreach ($city['rajaongkir']['results'] as $itemCity):
        City::updateOrCreate([
          'id' => $itemCity['city_id'],
        ], [
          'province_id' => $item['id'],
          'name' => $itemCity['city_name']
        ]);
      endforeach;
      }
    endforeach;
    dd("success");
  }

  public function province(Request $request)
  {
    try {
      $provinces = Province::where('name', 'like', '%' . $request->keyword . '%')->select('id', 'name')->get();
      $data = [];
      foreach ($provinces as $province) {
        $data[] = [
          'id' => $province->id,
          'text' => $province->name
        ];
      }

      return response()->json($data);
    } catch (\Throwable $th) {
      return response()->json([
        'success' => false,
        'message' => 'Data Fetch Failed',
        'data' => []
      ]);
    }
  }

  public function city(Request $request)
  {
    try {
      $cities = City::where('province_id', $request->province_id)
        ->where('name', 'like', '%' . $request->keyword . '%')
        ->select('id', 'name')->get();

      $data = [];
      foreach ($cities as $city) {
        $data[] = [
          'id' => $city->id,
          'text' => $city->name
        ];
      }

      return response()->json($data);
    } catch (\Throwable $th) {
      return response()->json([
        'success' => false,
        'message' => 'Data Fetch Failed',
        'data' => []
      ]);
    }
  }

  public function checkOngkir(Request $request)
  {
    try {
      $response = Http::withOptions(['verify' => false,])->withHeaders([
        'key' => env('RAJAONGKIR_API_KEY')
      ])->post('https://api.rajaongkir.com/starter/cost', [
        'origin' => $request->origin,
        'destination' => $request->destination,
        'weight' => $request->weight,
        'courier' => $request->courier
      ])
        ->json()['rajaongkir']['results'][0]['costs'];

      return response()->json($response);
    } catch (\Throwable $th) {
      return response()->json([
        'success' => false,
        'message' => $th->getMessage(),
        'data' => []
      ]);
    }
  }
}
