<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController;

// PUBLIC
use App\Http\Controllers\Public\SouvenirController as PublicSouvenirController;

// ADMIN
use App\Http\Controllers\Admin\SouvenirController as AdminSouvenirController;
use App\Http\Controllers\CategoryController;

use App\Models\Souvenir;
use App\Models\Category;

/*
|--------------------------------------------------------------------------
| PUBLIC / VIEWER
|--------------------------------------------------------------------------
*/

// LANDING PAGE
Route::get('/', function () {
    $souvenirs  = Souvenir::with('category')->latest()->take(8)->get();
    $categories = Category::orderBy('nama_kategori')->get();

    return view('home.index', compact('souvenirs', 'categories'));
})->name('home');

// KATALOG
Route::get('/souvenirs', [PublicSouvenirController::class, 'index'])
    ->name('souvenirs.index');

// DETAIL PRODUK
Route::get('/souvenirs/{souvenir}', [PublicSouvenirController::class, 'show'])
    ->name('souvenirs.show');


/*
|--------------------------------------------------------------------------
| AUTH USER (PEMBELI)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // CHECKOUT / ORDER
    Route::resource('orders', OrderController::class)
        ->only(['index', 'create', 'store', 'show']);

    // PROFILE
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::resource('categories', CategoryController::class);
        Route::resource('souvenirs', AdminSouvenirController::class);
    });

require __DIR__.'/auth.php';
