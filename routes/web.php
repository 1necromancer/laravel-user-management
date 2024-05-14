<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserManagement;
use App\Http\Controllers\RoleController;

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
    return view('index');
});

// Route::match(array('GET','POST'),'register', 'AuthController@login');


Route::post('/register', [AuthController::class, 'register']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');

Route::post('/login', [AuthController::class, 'login']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

Route::post('/user_management', [UserManagement::class, 'user_management']);
Route::get('/user_management', [UserManagement::class, 'home_page'])->name('user_management');

Route::get('/role_management', [RoleController::class, 'show'])->name('role_management');
Route::post('/save_new_roles', [RoleController::class, 'create']);
Route::post('/delete_selected_roles', [RoleController::class, 'delete']);
