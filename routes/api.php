<?php

use App\Http\Controllers\ListProduct;
use App\Http\Controllers\RegisterRequest;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('/register', [RegisterRequest::class, 'register']);
Route::post('/login', [RegisterRequest::class, 'login']);
Route::get('/list', [ListProduct::class, 'list'])->name('list');
Route::post('/addProduct', [ListProduct::class, 'addProduct']);
Route::get('/updateProduct/{id}', [ListProduct::class, 'edit']);
Route::post('/updateProduct/{id}', [ListProduct::class, 'updateProduct']);
Route::post('/deleteProduct/{id}', [ListProduct::class, 'deleteProduct']);

