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
  Route::resource('themes', Backend\ThemeController::class);

  /* Category Product Route */
  Route::get('category-items/select2', [Backend\CategoryItemController::class, 'select2'])->name('category-items.select2');
  Route::resource('category-items', Backend\CategoryItemController::class);

  /* Product Route */
  Route::post('items/uploadimagecke', [Backend\ItemController::class, 'uploadimagecke'])->name('items.uploadimagecke');
  Route::resource('items', Backend\ItemController::class);

});

Route::get('/', [Frontend\HomeController::class, 'index'])->name('home.index');
Route::resource('products', Frontend\ProductController::class);


//MenuStyle Page Routs
Route::get('horizontal', [HomeController::class, 'horizontal'])->name('menu-style.horizontal');
Route::get('dual-horizontal', [HomeController::class, 'dualHorizontal'])->name('menu-style.dual-horizontal');
Route::get('dual-compact', [HomeController::class, 'dualCompact'])->name('menu-style.dual-compact');
Route::get('boxed', [HomeController::class, 'boxed'])->name('menu-style.boxed');
Route::get('boxed-fancy', [HomeController::class, 'boxedFancy'])->name('menu-style.boxed-fancy');


