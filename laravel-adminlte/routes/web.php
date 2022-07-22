<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;


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

Route::get('/pivot', function () {
    return view('Pivot');
});

Route::get('/datetime', function () {
    return view('DateTime');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('users', \App\Http\Controllers\UserController::class);



Route::get('/data-member', function () {
    return view('Datamember');
});
Route::get('/export-unicharm-member', [App\Http\Livewire\Datamember\Index::class, 'export']);
Route::get('/ajax-unicharm-member', [App\Http\Controllers\DataMemberController::class, 'ajax'])->name('ajax-member');
// Route::get('/ajax-unicharm-member', [App\Http\Livewire\Datamember\Index::class, 'ajax']);



Route::get('/data-member-raw', function () {
    return view('Datamemberraw');
});
Route::get('/export-unicharm-member-raw', [App\Http\Livewire\Datamemberraw\Index::class, 'export']);
Route::get('/ajax-unicharm-member-raw', [App\Http\Livewire\Datamemberraw\Index::class, 'ajax']);



