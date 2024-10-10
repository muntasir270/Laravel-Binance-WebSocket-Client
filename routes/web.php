<?php

use App\Ws\BinanceWebSocketClient;
use Illuminate\Support\Facades\Route;

Route::get('/ws', function () {
    return (new BinanceWebSocketClient())->connect();
});

Route::get('/', function () {
    return view('welcome');
});
