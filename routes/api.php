<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AlbumController;

Route::get('/albums', [AlbumController::class, 'index']);
