<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;
use App\Traits\ResponseStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class LaporanHistoryDetailController extends Controller
{
  use ResponseStatus;

  public function index(Request $request)
  {
    $config['title'] = "Laporan History Pembelian Pelanggan";
    $config['breadcrumbs'] = [
      ['url' => '#', 'title' => "Laporan History Pembelian Pelanggan"],
    ];
    if ($request->ajax()) {
      $data = PurchaseOrderItem::with('item', 'po.user');


      if ($request->filled('tgl_awal')) {
        $data->whereDate('created_at', '>=', $request['tgl_awal']);
      }
      if ($request->filled('tgl_akhir')) {
        $data->whereDate('created_at', '<=', $request['tgl_akhir']);
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
    return view('pages.backend.laporan-history-detail.index', compact('config'));
  }
}
