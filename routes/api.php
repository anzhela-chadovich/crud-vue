<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('products',ProductController::class);
Route::get('/get_products', [ProductController::class, 'get_products']);
Route::post('/add_product', [ProductController::class, 'add_product']);
Route::get('/get_edit_product/{id}',[ProductController::class,'get_edit_product']);
Route::post('/update_product/{id}',[ProductController::class, 'update_product']);
Route::get('/delete_product/{id}', [ProductController::class, 'delete_product']);
Route::get('/search_products', [ProductController::class, 'search_products']);

