<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JogadorController;
use App\Http\Controllers\PartidaController;

Route::get('/user', function(Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/', function() {
    return Response()->json(['Sucesso'=>true]);
});

Route::get('/jogador',[JogadorController::class,'index']);
Route::get('/jogador/{id}',[JogadorController::class,'show']);
Route::post('/jogador',[JogadorController::class,'store']);
Route::put('/jogador/{id}',[JogadorController::class,'update']);
Route::delete('/jogador/{id}',[JogadorController::class,'destroy']);

Route::get('/partida',[PartidaController::class,'index']);
Route::get('/partida/{id}',[PartidaController::class,'show']);
Route::post('/partida',[PartidaController::class,'store']);
Route::put('/partida/{id}',[PartidaController::class,'update']);
Route::delete('/partida/{id}',[PartidaController::class,'destroy']);

