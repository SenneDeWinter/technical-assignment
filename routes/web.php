<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ComicController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ComicController::class, 'showComics']);

Route::get('/list-comics', [ComicController::class, 'listComics']);
Route::post('/add-to-cart/{comic_id}', [CartController::class, 'addToBasket']);
Route::get('/cart', [CartController::class, 'getCart']);
