<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
  public function index()
  {
    $config['title'] = "Permission";
    $config['breadcrumbs'] = [
      ['url' => '#', 'title' => "Permission"],
      ['url' => '#', 'title' => "Permission Data"],
      ['url' => '#', 'title' => "Permission Data 2"],
    ];
    return view('pages.index', compact('config'));
  }
}
