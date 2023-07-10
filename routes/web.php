<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
    return view('landing-page');
});


// LOGIN & REGISTER
Auth::routes();
Route::get('/home', [Controller::class, 'home_user'])->name('user.home');
Route::get('/admin', [Controller::class, 'dashboard_admin'])->name('admin.home')->middleware('role');

// USER
Route::get('/admission', [Controller::class, 'view_admission']);
Route::get('/admission/create-admission-utbk', [Controller::class, 'create_admission_utbk']);
Route::get('/admission/create-admission-utul', [Controller::class, 'create_admission_utul']);
Route::post('/admission/store-admission-utbk', [Controller::class, 'store_admission_utbk']);
Route::post('/admission/store-admission-utul', [Controller::class, 'store_admission_utul']);
Route::get('/admission/create-payment/{id}', [Controller::class, 'create_payment'])->name('admission.create-payment');
Route::post('/admission/store-payment', [Controller::class, 'store_payment']);

// ADMIN
Route::get('/admin/data-user', [Controller::class, 'view_user']);
Route::delete('/admin/data-user/delete-user/{id}', [Controller::class, 'delete_user'])->name('user.delete');
Route::get('/admin/data-user/edit-user/{id}', [Controller::class, 'edit_user'])->name('user.edit');
Route::post('/admin/data-user/store-user-edited', [Controller::class, 'store_user_edited']);
Route::get('/admin/data-user/create-user', [Controller::class, 'create_user'])->name('user.create');
Route::post('/admin/data-user/store-user', [Controller::class, 'store_user'])->name('user.stores');
