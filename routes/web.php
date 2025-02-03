<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/',[AdminController::class,'home']);

/* Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
}); */

route::get('/home',[AdminController::class,'index'])->name('home');
route::get('/logout',[AdminController::class,'logout'])->name('logout');
Route::get('/add-estate', [UserController::class, 'addEstate'])->name('add-estate');
Route::post('/store-estate', [UserController::class, 'storeEstate'])->name('store-estate');
Route::get('/estates-list/{category_id}', [UserController::class, 'estateList'])->name('estates-list');
Route::get('/estate-detail/{id}', [UserController::class, 'estateDetail'])->name('estate-detail');

Route::post('/testForm', function (Request $request) {
    dd("Form works", $request->all());
})->name('testForm');



Route::middleware(['admin'])->group(function () {
    // admin operations 
    Route::get('/categories', [AdminController::class, 'categories'])->name('categories');
    Route::get('/add-category', [AdminController::class, 'addCategory'])->name('add-category');
    Route::post('/store-category', [AdminController::class, 'storeCategory'])->name('storeCategory');
    Route::delete('/delete-category/{id}', [AdminController::class, 'deleteCategory'])->name('deleteCategory');
    Route::get('/admin-estates-list/{category_id}', [AdminController::class, 'estateList'])->name('admin-estates-list');
    Route::get('/admin-estates-list', [AdminController::class, 'AllEstateList'])->name('admin-Allestates');
    Route::get('/admin-users-list', [AdminController::class, 'UsersList'])->name('admin-UsersList');

});
