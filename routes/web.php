<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
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

Route::get('/user_management', [UserController::class, 'index'])->name('user_management');
Route::post('/save_new_users', [UserController::class, 'create']);
Route::get('/get_all_roles', [UserController::class, 'roles'])->name('get_all_roles');
Route::post('/update_user_input_data', [UserController::class, 'update_input_element']);
Route::post('/update_user_select_data', [UserController::class, 'update_select_element']);

Route::get('/role_management', [RoleController::class, 'index'])->name('role_management');
Route::post('/save_new_roles', [RoleController::class, 'create']);
Route::post('/delete_selected_roles', [RoleController::class, 'delete']);
Route::post('/update_role_name', [RoleController::class, 'update']);

