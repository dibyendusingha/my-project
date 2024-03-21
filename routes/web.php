<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\admincontroller;
use App\Http\Controllers\LoginController;
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

Auth::routes();

Route::get('/', [LoginController::class,'login_page'])->name('admin-page');
Route::post('/user-reg', [LoginController::class,'save_reg']);
Route::post('/user-login', [LoginController::class,'save_login']);


//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('admin')->group(function () {
    Route::get('/home', [admincontroller::class,'index_page'])->name('home');
    Route::get('/form', [admincontroller::class,'form_page']);
    Route::get('/edit-user/{user_id}', [admincontroller::class,'edit_page']);
    Route::post('/add-user', [admincontroller::class,'add_user']);
    Route::get('/delete-user/{user_id}', [admincontroller::class,'delete_user_list']);
    Route::post('/update-user/{user_id}', [admincontroller::class,'update_user']);   
});


