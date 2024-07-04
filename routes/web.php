<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ComicController;
use App\Http\Controllers\DeletedItemController;
use Illuminate\Support\Facades\Route;

//Comics
Route::get('/', [ComicController::class, 'showComics']);
Route::get('/list-comics', [ComicController::class, 'listComics']);

//Cart
Route::post('/add-to-cart/{comic_id}', [CartController::class, 'addToBasket']);
Route::post('/remove-from-cart/{comic_id}', [CartController::class, 'removeFromBasket']);
Route::get('/list-cart', [CartController::class, 'getCart']);
Route::get('/cart', [CartController::class, 'showCart']);

//Deleted Items
Route::get('/deleted-items', [DeletedItemController::class, 'getDeletedItems']);
