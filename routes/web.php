<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProjectController;
use App\Models\Portfolio;
use App\Models\Project;
use App\Models\User;
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
    $users = User::where('role', '!=', 'admin')->paginate(5);
    $portfolio = Portfolio::where('user_id', Auth::id())->first(); // Fetch only the logged-in user's portfolio
    $projects = Project::where('user_id', Auth::id())->get(); // Fetch only the logged-in user's portfolio
    return view('portfolio.index', compact('portfolio','users','projects')); // ✅ Use singular variable
})->name('/');



require __DIR__.'/auth.php';


Route::post('portfolios', [PortfolioController::class, 'store'])->name('portfolios.store'); // Store Route
Route::put('portfolios/{portfolio}', [PortfolioController::class, 'update'])->name('portfolios.update'); // Update Route
Route::delete('portfolios/{portfolio}', [PortfolioController::class, 'destroy'])->name('portfolios.destroy'); // Update Route

Route::post('projects', [ProjectController::class, 'store'])->name('projects.store'); // Store Route
Route::put('projects/{project}', [ProjectController::class, 'update'])->name('projects.update'); // Update Route
Route::delete('projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy'); // Update Route