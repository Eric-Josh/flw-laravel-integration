<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionsController;
use App\Jobs\DeGuideJob;

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



Route::get('/', [TransactionsController::class, 'index'])->name('billing');
Route::post('/billing-send', [TransactionsController::class, 'store'])->name('billing.store');
Route::get('/webhook', [TransactionsController::class, 'webhook'])->name('webhook');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
