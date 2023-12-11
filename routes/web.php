<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;

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

Route::get('/', [FileController::class, 'index'])->name('home');
Route::get('/show/{id}', [FileController::class, 'show'])->name('show');
Route::get('/search', [FileController::class, 'search'])->name('search');
Route::get('/create', [FileController::class, 'create'])->name('create');
Route::post('/store', [FileController::class, 'store'])->name('store');
Route::delete('/destroy', [FileController::class, 'destroy'])->name('destroy');