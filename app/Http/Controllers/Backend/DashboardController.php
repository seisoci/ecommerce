<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
  public function index()
  {
    $config['title'] = "Permission";
    $config['breadcrumbs'] = [
    ];
    return view('pages.index', compact('config'));
  }

  public function search(\Request $request)
  {
    $config['title'] = "Permission";
    $config['breadcrumbs'] = [
    ];


    return view('pages.search', compact('config'));
  }
}
