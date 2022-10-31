<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOrder;
use App\Traits\ResponseStatus;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class LaporanHistoryController extends Controller
{
  use ResponseStatus;

  public function index(Request $request)
  {
    $config['title'] = "Laporan History Pembelian Pelanggan";
    $config['breadcrumbs'] = [
      ['url' => '#', 'title' => "Laporan History Pembelian Pelanggan"],
    ];
    if ($request->ajax()) {
      $data = PurchaseOrder::with('user');


      if ($request->filled('tgl_awal')) {
        $data->whereDate('purchase_orders.created_at', '>=', $request['tgl_awal']);
      }
      if ($request->filled('tgl_akhir')) {
        $data->whereDate('purchase_orders.created_at', '<=', $request['tgl_akhir']);
      }


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
    return view('pages.backend.laporan-history.index', compact('config'));
  }
}
