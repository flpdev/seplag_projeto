<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
