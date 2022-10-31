<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOrder;
use App\Traits\ResponseStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class HistoryController extends Controller
{
  use ResponseStatus;

  public function index(Request $request)
  {
    $config['title'] = "History Pembelian Pelanggan";
    $config['breadcrumbs'] = [
      ['url' => '#', 'title' => "History Pembelian Pelanggan"],
    ];
    if ($request->ajax()) {
      $data = PurchaseOrder::with('user');
      return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
          $actionBtn = '<div class="btn-group dropend">
                            <button type="button" class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                Aksi
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="' . route('backend.history.show', $row->id) . '">Detail</a></li>
                                 <li><a href="#" data-bs-toggle="modal" data-bs-target="#modalEdit" data-bs-id="' . $row->id . '"
                                        data-bs-status="' . $row->status . '" class="dropdown-item">Ubah</a></li>
                            </ul>
                          </div>';
          return $actionBtn;
        })->make();
    }
    return view('pages.backend.history.index', compact('config'));
  }

  public function update(Request $request, $id)
  {
    $validator = Validator::make($request->all(), [
      'status' => 'required|string',
    ]);
    if ($validator->passes()) {
      DB::beginTransaction();
      try {
        $data = PurchaseOrder::findOrFail($id);
        $data->update($request->all());

        DB::commit();
        $response = response()->json($this->responseUpdate(true));
      } catch (\Throwable $throw) {
        Log::error($throw);
        DB::rollBack();
        $response = response()->json(['error' => $throw->getMessage()]);
      }
    } else {
      $response = response()->json(['error' => $validator->errors()->all()]);
    }
    return $response;
  }

  public function show($id)
  {
    $config['title'] = "Detail History Pembelian Pelanggan";
    $config['breadcrumbs'] = [
      ['url' => route('items.index'), 'title' => "History Pembelian Pelanggan"],
      ['url' => '#', 'title' => "Detail History Pembelian Pelanggan"],
    ];

    $data = PurchaseOrder::with('purchase_order_item.item', 'user.profile')->findOrFail($id);
//dd($data->toArray());
    return view('pages.backend.history.show', compact('config', 'data'));
  }


}
