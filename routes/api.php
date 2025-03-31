<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServidorEfetivoController;
use App\Http\Controllers\ServidorTemporarioController;
use App\Http\Controllers\UnidadeController;
use App\Http\Controllers\LotacaoController;
use App\Http\Controllers\PessoaController;

Route::post('/login', function (Request $request) {
    $credentials = $request->only('email', 'password');
    if (!$token = auth('api')->attempt($credentials)) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }
    return response()->json(['token' => $token]);
});

Route::post('/refresh', function () {
    return response()->json(['token' => auth('api')->refresh()]);
});

Route::middleware('auth:api')->get('/me', function (Request $request) {
    return response()->json(auth('api')->user());
});

Route::middleware('auth:api')->group(function () {
    Route::apiResource('pessoas', PessoaController::class)->only(['index', 'store', 'update', 'show']);

    Route::middleware('auth:api')->get('/servidores-efetivos/unidade/{unid_id}', [ServidorEfetivoController::class, 'porUnidade']);
    Route::middleware('auth:api')->get('/servidores-efetivos/endereco-funcional', [ServidorEfetivoController::class, 'enderecoFuncionalPorNome']);
    Route::apiResource('servidores-efetivos', ServidorEfetivoController::class)->only(['index', 'store', 'update', 'show']);

    Route::apiResource('servidores-temporarios', ServidorTemporarioController::class)->only(['index', 'store', 'update', 'show']);
    Route::apiResource('unidades', UnidadeController::class)->only(['index', 'store', 'update', 'show']);
    Route::apiResource('lotacoes', LotacaoController::class)->only(['index', 'store', 'update', 'show']);
});
