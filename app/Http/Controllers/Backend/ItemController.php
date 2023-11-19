<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\FileUpload;
use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\ProductImage;
use App\Models\Review;
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
      $data = Item::with('category');
      return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
          $actionBtn = '<div class="btn-group dropend">
                            <button type="button" class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                Aksi
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="' . route('items.show', $row->id) . '">Lihat Review</a></li>
                                <li><a class="dropdown-item" href="' . route('items.edit', $row->id) . '">Edit</a></li>
                                <li><a class="dropdown-item btn-delete" href="#" data-id ="' . $row->id . '" >Hapus</a></li>
                            </ul>
                          </div>';
          return $actionBtn;
        })->make();
    }
    return view('pages.backend.items.index', compact('config'));
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

        $product =Item::create($data);

        foreach ($request['product_images'] as $key => $item):
          $image = isset($item) && !empty($item) ? FileUpload::uploadImage("product_images.$key", $dimensions) : NULL;
          $product->product_images()->create([
            'sort_number' => ++$key,
            'url' => $image,
          ]);
        endforeach;

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

  public function edit($id)
  {
    $config['title'] = "Edit Produk";
    $config['breadcrumbs'] = [
      ['url' => route('items.index'), 'title' => "Produk"],
      ['url' => '#', 'title' => "Edit Produk"],
    ];
    $data = Item::with('category', 'product_images')->findOrFail($id);
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
        $product = Item::findOrFail($id);
        $img = $product['poster'];
        if (isset($request['poster']) && !empty($request['poster'])) {
          $img = Fileupload::uploadImage('poster', $dimensions, 'storage', $product['poster']);
        }
        $dataRequest = $request->except('poster');
        $dataRequest['poster'] = $img;
        $product->update($dataRequest);
        $countProductImage = $product->product_images()->count();
        if (count(($request['product_images'] ?? array())) + $countProductImage <= 5) {
          foreach ($request['product_images'] ?? array() as $key => $item):
            $image = isset($item) && !empty($item) ? FileUpload::uploadImage("product_images.$key", $dimensions) : NULL;
            $product->product_images()->create([
              'sort_number' => ++$countProductImage,
              'url' => $image,
            ]);
          endforeach;
        } else {
          return response()->json($this->responseStore(false, '', 'Gambar yang diupload lebih dari 5'));
        }

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

  public function show($id, Request $request){
    $config['title'] = "Review";
    $config['breadcrumbs'] = [
      ['url' => '#', 'title' => "Review"],
    ];

    if ($request->ajax()) {
      $data = Review::where('item_id', $id);

      return DataTables::of($data)
        ->addIndexColumn()
        ->make();
    }

    return view('pages.backend.items.show', compact('config'));
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

  public function deleteProduct($id)
  {
    $data = ProductImage::find($id);
    $response = response()->json($this->responseDelete(false));
    if ($data->delete()) {
      $reOrder = ProductImage::where('item_id',$data['item_id'])->orderBy('sort_number', 'asc')->get();
      foreach ($reOrder as $key => $item):
        ProductImage::find($item['id'])->update([
          'sort_number' => ++$key
        ]);
      endforeach;
      Storage::disk('public')->delete(["images/original/$data->url", "images/thumbnail/$data->url"]);
      $response = response()->json($this->responseDelete(true));
    }
    return $response;
  }

}
