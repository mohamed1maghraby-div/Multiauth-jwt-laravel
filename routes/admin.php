<?php

use App\Http\Controllers\Admin\AdminController;
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
Route::get('/', function(){
    return view('admin.auth.login');
});

define('ADMIN_DASHBOARD', 'admin/dashboard');
Route::middleware('admin:admin')->group(function(){
    Route::get('/admin/login', [AdminController::class, 'loginForm']);
    Route::Post('/admin/login', [AdminController::class, 'store'])->name('admin.login');
});
Route::middleware(['auth:sanctum,admin',config('jetstream.auth_session'), 'verified'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard')->middleware('auth:admin');
});