<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlbumController;

Route::get('/albums', [AlbumController::class, 'index']);

// Route::get('/', function () {
//     return view('welcome');
// });
