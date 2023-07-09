<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

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
Route::get('/admission', [Controller::class, 'view_admission']);
Route::get('/admission/create-admission-utbk', [Controller::class, 'create_admission_utbk']);
Route::get('/admission/create-admission-utul', [Controller::class, 'create_admission_utul']);
Route::post('/admission/store-admission-utbk', [Controller::class, 'store_admission_utbk']);
Route::post('/admission/store-admission-utul', [Controller::class, 'store_admission_utul']);
Route::get('/admission/create-payment/{id}', [Controller::class, 'create_payment'])->name('admission.create-payment');
Route::post('/admission/store-payment', [Controller::class, 'store_payment']);