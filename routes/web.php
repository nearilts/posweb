<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RolePermission;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TransactionDetailController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/login', [UserController::class, 'logins']);
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/home', [TransactionDetailController::class, 'grafik_owner'])->name('home');
Route::get('/homes', [TransactionDetailController::class, 'grafik_owners'])->name('homes');


Route::middleware(['auth'])->group(function () {
    Route::resource('category', CategoryController::class);
    Route::resource('product', ProductController::class);
    Route::resource('transaction', TransactionController::class);
    Route::resource('users', UserController::class);
});

Route::get('/report', [TransactionController::class, 'report'])->name('report');
Route::get('/gantipassword', [UserController::class, 'gantipassword'])->name('gantipassword');
Route::post('/gantipassword_act', [UserController::class, 'gantipassword_act'])->name('gantipassword_act');


 // Menu Role
Route::get('/Role', [RolePermission::class, 'role'])->name('role');
Route::post('/createrole', [RolePermission::class, 'createrole'])->name('create.role');
Route::get('/givepermission/{role}', [RolePermission::class, 'givepermission'])->name('give.permission');
Route::post('/givepermission/{role}', [RolePermission::class, 'givepermissions'])->name('give.permission');

Route::get('/Permission', [RolePermission::class, 'permission'])->name('permission');
Route::post('/createpermission', [RolePermission::class, 'createpermission'])->name('create.permission');

 // sub menu Role (give user role)
Route::get('/giveuserrole', [RolePermission::class, 'giveuserrole'])->name('giveuserrole');
Route::get('/giverole/{user}', [RolePermission::class, 'giverole'])->name('give.role');
Route::post('/giverole/{user}', [RolePermission::class, 'giveroles'])->name('give.role');
Route::get('/user-detail/{user}', [RolePermission::class, 'user_detail'])->name('user.detail');
Route::post('/user-detail/{user}', [RolePermission::class, 'user_mapping'])->name('user.ctype');

