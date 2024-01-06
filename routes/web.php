<?php

use App\Models\Visitor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisitorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    // return view('welcome');
    $visitors = Visitor::all();
    return view('visitors.index', ['visitors' => $visitors]);
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/* Visitor- Card Routes with admin access*/
Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::resource('/visitors', VisitorController::class);
});
