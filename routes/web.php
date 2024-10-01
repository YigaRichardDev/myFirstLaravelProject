<?php

use App\Http\Controllers\ClientContoller;
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

Route::get('/', [ClientContoller::class, 'index'])->name('home');
Route::get('/add-client', [ClientContoller::class, 'create'])->name('client.add');
Route::post('/add-client-save', [ClientContoller::class, 'store'])->name('client.store');
Route::get('/edit-client/{id}', [ClientContoller::class, 'edit'])->name('client.edit');
Route::put('/update-client/{id}', [ClientContoller::class, 'update'])->name('client.update');
Route::delete('/delete-client/{id}', [ClientContoller::class, 'destroy'])->name('client.destroy');
