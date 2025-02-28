<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\MahasiswaController;
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

Route::group(['prefix' => 'v1'], function () {
    Route::get('mahasiswa', [MahasiswaController::class, 'listMahasiswa']);
    Route::get('mahasiswa/{id}', [MahasiswaController::class, 'listMahasiswaById']);
    Route::post('mahasiswa/create', [MahasiswaController::class, 'insertMahasiswa']);
    Route::put('mahasiswa/update', [MahasiswaController::class, 'updateMahasiswa']);
    Route::delete('mahasiswa/delete', [MahasiswaController::class, 'deleteMahasiswa']);
});

?>
