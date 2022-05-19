<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PageController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

// Route::middleware(['auth'])->group(function () {
//     Route::get('/@/dashboard', [PageController::class, 'index'])->name('spa.dashboard');
//     Route::get('/@/{any}', [PageController::class, 'index'])->where('any', '.*');
// });

// require __DIR__.'/auth.php';

// Route::get('/login', function(){
//     return response()->json([
//         'status' => 200,
//         'message' => 'Redirected to Login',
//         'data' => null
//     ], 200);
// })->name('login');

Route::get('/', [PageController::class, 'setup2'])->name('spa.setup');
Route::get('/{any}', [PageController::class, 'setup2'])->where('any', '.*');
