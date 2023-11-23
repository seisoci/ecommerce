<?php

use App\Http\Controllers\Auth as Auth;
use App\Http\Controllers\Backend as Backend;
use App\Http\Controllers\Frontend as Frontend;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::post('logout', [Auth\LoginController::class, 'logout'])->name('logout');
Route::prefix('backend')->group(function () {
  Route::get('/', [Auth\LoginController::class, 'showLoginForm']);
  Route::post('/', [Auth\LoginController::class, 'login'])->name('login');
  Route::get('forgot-password', [Auth\ResetsPasswordsController::class, 'showForgotPasswordResetForm'])->name('forgot-password');
  Route::post('sentresetpassword', [Auth\ResetsPasswordsController::class, 'getResetToken'])->name('sentresetpassword');
  Route::get('reset', [Auth\ResetsPasswordsController::class, 'showResetForm'])->name('password.reset');
  Route::post('reset-password', [Auth\ResetsPasswordsController::class, 'resetPassword'])->name('password.update');
  Route::get('dashboard', [Backend\DashboardController::class, 'index'])->name('dashboard');
});

Route::prefix('backend')->middleware(['auth:web'])->group(function () {
  /* Role Route */
  Route::get('roles/select2', [Backend\RoleController::class, 'select2'])->name('roles.select2');
  Route::resource('roles', Backend\RoleController::class);

  /* Menu Manager Route */
  Route::resource('menu-manager', Backend\MenuManagerController::class);
  Route::post('menu-manager/changeHierarchy', [Backend\MenuManagerController::class, 'changeHierarchy'])->name('menu-manager.changeHierarchy');

  /* User Route */
  Route::resource('users', Backend\UserController::class);
  Route::post('reset-password-users', [Backend\UserController::class, 'resetpassword'])->name('users.reset-password-users');
  Route::get('change-password', [Backend\UserController::class, 'changepassword'])->name('change-password');
  Route::post('update-change-password', [Backend\UserController::class, 'updatechangepassword'])->name('update-change-password');

  /* Theme Route */
  Route::resource('resi', Backend\ResiController::class);

  /* Theme Route */
  Route::resource('themes', Backend\ThemeController::class);

  /* Category Product Route */
  Route::get('category-items/select2', [Backend\CategoryItemController::class, 'select2'])->name('category-items.select2');
  Route::resource('category-items', Backend\CategoryItemController::class);

  /* Product Route */
  Route::post('items/uploadimagecke', [Backend\ItemController::class, 'uploadimagecke'])->name('items.uploadimagecke');
  Route::delete('delete-image/{id}', [Backend\ItemController::class, 'deleteProduct']);
  Route::resource('items', Backend\ItemController::class);

  /* History Route */
  Route::resource('history', Backend\HistoryController::class)->names('backend.history');

  /* Laporan History Route */
  Route::resource('laporan-history', Backend\LaporanHistoryController::class);
  Route::resource('laporan-history-detail', Backend\LaporanHistoryDetailController::class);

});

Route::prefix('/')->middleware(['auth:web'])->group(function () {
  Route::resource('profiles', Frontend\ProfileController::class);

});

Route::get('/', [Frontend\HomeController::class, 'index'])->name('home.index');
Route::get('search', [Frontend\HomeController::class, 'search'])->name('search');
Route::post('register', [Frontend\HomeController::class, 'store'])->name('home.register');
Route::get('register', [Frontend\HomeController::class, 'register'])->name('home.register');
Route::resource('products', Frontend\ProductController::class);
Route::resource('cart', Frontend\CartController::class);
Route::resource('history', Frontend\HistoryController::class);
Route::get('cart/{id}/add-item', [Frontend\CartController::class, 'addItem'])->name('cart.add-item');
Route::get('cart/{id}/update-item', [Frontend\CartController::class, 'updateItem'])->name('cart.update-item');
Route::get('cart/{id}/delete-item', [Frontend\CartController::class, 'deleteItem'])->name('cart.delete-item');
Route::post('cart/review', [Frontend\CartController::class, 'review'])->name('review');
Route::get('cart/review', [Frontend\CartController::class, 'review'])->name('review.data');

Route::get('test', [Frontend\CheckOngkirController::class, 'test'])->name('provinces');
Route::get('provinces', [Frontend\CheckOngkirController::class, 'province'])->name('provinces');
Route::get('cities', [Frontend\CheckOngkirController::class, 'city'])->name('cities');
Route::post('check-ongkir', [Frontend\CheckOngkirController::class, 'checkOngkir'])->name('check-ongkir');

//MenuStyle Page Routs
Route::get('horizontal', [HomeController::class, 'horizontal'])->name('menu-style.horizontal');
Route::get('dual-horizontal', [HomeController::class, 'dualHorizontal'])->name('menu-style.dual-horizontal');
Route::get('dual-compact', [HomeController::class, 'dualCompact'])->name('menu-style.dual-compact');
Route::get('boxed', [HomeController::class, 'boxed'])->name('menu-style.boxed');
Route::get('boxed-fancy', [HomeController::class, 'boxedFancy'])->name('menu-style.boxed-fancy');


