<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;
use App\Models\Portfolio;
use Illuminate\Support\Facades\Auth;


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
Route::get('/', function () {
    $portfolio = Portfolio::where('user_id', Auth::id())->first(); // Fetch only the logged-in user's portfolio
    return view('portfolio.index', compact('portfolio')); // ✅ Use singular variable
})->middleware(['auth', 'verified'])->name('/');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::post('portfolios', [PortfolioController::class, 'store'])->name('portfolios.store'); // Store Route
Route::put('portfolios/{portfolio}', [PortfolioController::class, 'update'])->name('portfolios.update'); // Update Route

