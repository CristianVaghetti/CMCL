<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\FornecedorController;
Route::get('/fornecedor', [FornecedorController::class, 'index'])->name('get-fornecedores');
Route::post('/fornecedor', [FornecedorController::class, 'storeUpdate'])->name('create-fornecedor');
Route::get('/fornecedor/toggle/{id}', [FornecedorController::class, 'toggle'])->name('toggle-fornecedor');

use App\Http\Controllers\LogController;
Route::get('/log', [LogController::class, 'index'])->name('get-logs');