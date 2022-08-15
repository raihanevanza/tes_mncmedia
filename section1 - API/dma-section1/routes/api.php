<?php

use Illuminate\Http\Request;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\InvoiceController;
// use App\Http\Controllers\API\ProductDetailsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/index', [InvoiceController::class, 'index']);
    Route::get('/show/{date}', [InvoiceController::class, 'show']);
    Route::delete('/delete/{invoice_no}', [InvoiceController::class, 'delete']);
    Route::post('/store', [InvoiceController::class, 'store']);
    Route::post('/update', [InvoiceController::class, 'update']);
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
