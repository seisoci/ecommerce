<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Traits\ResponseStatus;
use Illuminate\Http\Request;

class ResiController extends Controller
{
  use ResponseStatus;

  function __construct()
  {
    $this->middleware('can:items-list', ['only' => ['index', 'show']]);
    $this->middleware('can:items-create', ['only' => ['create', 'store']]);
    $this->middleware('can:items-edit', ['only' => ['edit', 'update']]);
    $this->middleware('can:items-delete', ['only' => ['destroy']]);
  }

  public function show($id)
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
}
