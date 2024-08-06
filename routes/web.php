<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AffiliateController;
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
    return view('welcome');
});
Route::get('add-user', function () {
    return view('add_user', ['users' => \App\Models\User::all()]);
})->name('addUserForm');

Route::post('add-user', [AffiliateController::class, 'addUser'])->name('addUser');

Route::get('record-sale', function () {
    return view('record_sale', ['users' => \App\Models\User::all()]);
})->name('recordSaleForm');

Route::post('record-sale', [AffiliateController::class, 'recordSale'])->name('recordSale');