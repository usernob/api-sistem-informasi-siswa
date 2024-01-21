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

Route::apiResource('kelas', App\Http\Controllers\KelasController::class)->parameters([
    "kelas" => "kelas"
])->missing(function () {
    return response(['message' => 'data tidak ditemukan'], 404);
});


Route::apiResource('siswa', \App\Http\Controllers\SiswaController::class)->missing(function () {
    return response(['message' => 'data tidak ditemukan'], 404);
});

Route::get('/siswa/{siswa}/nilai', [\App\Http\Controllers\NilaiController::class, "show"])->name("siswa.nilai")->missing(function () {
    return response(['message' => 'data tidak ditemukan'], 404);
});

Route::post('/siswa/{siswa}/nilai', [\App\Http\Controllers\NilaiController::class, "store"])->name("siswa.nilai.store")->missing(function () {
    return response(['message' => 'data tidak ditemukan'], 404);
});

Route::put('/siswa/{siswa}/nilai', [\App\Http\Controllers\NilaiController::class, "update"])->name("siswa.nilai.update")->missing(function () {
    return response(['message' => 'data tidak ditemukan'], 404);
});

Route::delete('/siswa/{siswa}/nilai/{mapel}', [\App\Http\Controllers\NilaiController::class, "destroy"])->name("siswa.nilai.destroy")->missing(function () {
    return response(['message' => 'data tidak ditemukan'], 404);
});
