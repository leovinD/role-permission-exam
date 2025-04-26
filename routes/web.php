<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\SaleCategoryController;
use App\Http\Controllers\SaleController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth','verified'])
    ->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


});


Route::group(['middleware' => ['auth','role:admin|editor']], function () {

    Route::resource('posts', PostController::class)->names('posts');

    // Roles Routes
    Route::resource('roles', RoleController::class)->names('roles');

    // Permissions Routes
    Route::resource('permissions', PermissionController::class)->names('permissions');

    Route::resource('users', UserController::class)->names('users');

    Route::resource('sales', SaleController::class);
Route::resource('sale_categories', SaleCategoryController::class);
Route::resource('products', ProductController::class);
Route::resource('regions', RegionController::class);

});


require __DIR__.'/auth.php';
