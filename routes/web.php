<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;


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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/members', [App\Http\Controllers\MemberController::class, 'index']);


Route::resource('/catalogs', App\Http\Controllers\CatalogController::class);
Route::resource('/authors', App\Http\Controllers\AuthorController::class);
Route::resource('/publishers', App\Http\Controllers\PublisherController::class);
Route::resource('/books', App\Http\Controllers\BookController::class);
Route::resource('data/member', App\Http\Controllers\MemberController::class);

Route::get('api/authors', [App\Http\Controllers\AuthorController::class, 'api']);
Route::get('api/publishers', [App\Http\Controllers\publisherController::class, 'api']);
Route::get('api/books', [App\Http\Controllers\BookController::class, 'api']);

// Route::resource('transactions', App\Http\Controllers\TransactionController::class);
// Route::get('api/transactions', [App\Http\Controllers\TransactionController::class]);

Route::resource('transactions', TransactionController::class);
Route::get('api/transactions', [TransactionController::class, 'api'])->name('api.transactions');



