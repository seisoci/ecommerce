<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\FileUpload;
use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Traits\ResponseStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Throwable;
use Yajra\DataTables\DataTables;

class ItemController extends Controller
{
  use ResponseStatus;

  function __construct()
  {
    $this->middleware('can:items-list', ['only' => ['index', 'show']]);
    $this->middleware('can:items-create', ['only' => ['create', 'store']]);
    $this->middleware('can:items-edit', ['only' => ['edit', 'update']]);
    $this->middleware('can:items-delete', ['only' => ['destroy']]);
  }

  public function index(Request $request)
  {
    $config['title'] = "Produk";
    $config['breadcrumbs'] = [
      ['url' => '#', 'title' => "Produk"],
    ];
    if ($request->ajax()) {
      $data = Item::with('category')->get();
      return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
          $actionBtn = '<div class="btn-group dropend">
                            <button type="button" class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                Aksi
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="' . route('items.edit', $row->id) . '">Edit</a></li>
                                <li><a class="dropdown-item btn-delete" href="#" data-id ="' . $row->id . '" >Hapus</a></li>
                            </ul>
                          </div>';
          return $actionBtn;
        })->make();
    }
    return view('pages.backend.items.index', compact('config'));
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'title' => 'required|string',
      'poster' => 'image|mimes:jpg,png,jpeg|max:5000',
      'published' => 'in:0,1',
    ]);
    if ($validator->passes()) {
      DB::beginTransaction();
      $dimensions = [array('640', '480', 'thumbnail')];
      try {
        $img = isset($request->poster) && !empty($request->poster) ? FileUpload::uploadImage('poster', $dimensions) : NULL;
        $data = $request->except('poster');
        $data['poster'] = $img;

        Item::create($data);

        DB::commit();
        $response = response()->json($this->responseStore(true, NULL, route('items.index')));
      } catch (Throwable $throw) {
        DB::rollBack();
        Log::error($throw);
        $response = response()->json(['error' => $throw->getMessage()]);
      }
    } else {
      $response = response()->json(['error' => $validator->errors()->all()]);
    }
    return $response;
  }

  public function create()
  {
    $config['title'] = "Tambah Produk";
    $config['breadcrumbs'] = [
      ['url' => route('items.index'), 'title' => "Produk"],
      ['url' => '#', 'title' => "Tambah Produk"],
    ];
    $config['form'] = (object)[
      'method' => 'POST',
      'action' => route('items.store')
    ];
    return view('pages.backend.items.form', compact('config'));
  }

  public function edit($id)
  {
    $config['title'] = "Edit Produk";
    $config['breadcrumbs'] = [
      ['url' => route('items.index'), 'title' => "Produk"],
      ['url' => '#', 'title' => "Edit Produk"],
    ];
    $data = Item::with('category')->findOrFail($id);
    $config['form'] = (object)[
      'method' => 'PUT',
      'action' => route('items.update', $id)
    ];
    return view('pages.backend.items.form', compact('config', 'data'));
  }

  public function update(Request $request, $id)
  {
    $validator = Validator::make($request->all(), [
      'title' => 'required|string',
      'poster' => 'image|mimes:jpg,png,jpeg|max:5000',
      'published' => 'in:0,1',
    ]);
    if ($validator->passes()) {
      DB::beginTransaction();
      $dimensions = [array('640', '480', 'thumbnail')];
      try {
        $data = Item::findOrFail($id);
        $img = $data['poster'];
        if (isset($request['poster']) && !empty($request['poster'])) {
          $img = Fileupload::uploadImage('poster', $dimensions, 'storage', $data['poster']);
        }
        $dataRequest = $request->except('poster');
        $dataRequest['poster'] = $img;
        $data->update($dataRequest);

        DB::commit();
        $response = response()->json($this->responseStore(true, NULL, route('items.index')));
      } catch (Throwable $throw) {
        Log::error($throw);
        DB::rollBack();
        $response = response()->json(['error' => $throw->getMessage()]);
      }
    } else {
      $response = response()->json(['error' => $validator->errors()->all()]);
    }
    return $response;
  }

  public function destroy($id)
  {

    $data = Item::find($id);
    DB::beginTransaction();
    try {
      if (!$data->delete()) {
        return response()->json([
          'status' => 'error',
          'message' => 'Data gagal dihapus'
        ]);
      }
      Storage::disk('public')->delete(["images/original/{$data['poester']}", "images/thumbnail/{$data['poester']}"]);

      DB::commit();
      $response = response()->json([
        'status' => 'success',
        'message' => 'Data berhasil dihapus'
      ]);
    } catch (Throwable $throw) {
      Log::error($throw);
      $response = response()->json(['error' => $throw->getMessage()]);
    }
    return $response;
  }

  public function uploadimagecke(Request $request)
  {
    if ($request->hasFile('upload')) {
      $originName = $request->file('upload')->getClientOriginalName();
      $fileName = pathinfo($originName, PATHINFO_FILENAME);
      $extension = $request->file('upload')->getClientOriginalExtension();
      $fileName = $fileName . '_' . time() . '.' . $extension;
      $dimensions = [['1280', '720', 'thumbnail']];
      $image = isset($request['upload']) && !empty($request['upload']) ? FileUpload::uploadImage('upload', $dimensions) : NULL;

      return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => asset("/storage/images/original/" . $image)]);
    }
  }
}
