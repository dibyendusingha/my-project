<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\admincontroller;
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
    return view('auth.login');
});

Auth::routes();


//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/home', [admincontroller::class,'index_page'])->name('home');
    Route::get('/form', [admincontroller::class,'form_page']);
    Route::get('/edit-user/{user_id}', [admincontroller::class,'edit_page']);
    Route::post('/add-user', [admincontroller::class,'add_user']);
    Route::get('/delete-user/{user_id}', [admincontroller::class,'delete_user_list']);
    Route::post('/update-user/{user_id}', [admincontroller::class,'update_user']);   
});


