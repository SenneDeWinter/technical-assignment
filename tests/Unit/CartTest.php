<?php

use App\Models\Comic;
use Illuminate\Support\Facades\Artisan;

beforeEach(function () {
    Artisan::call('retrieve-comics');
    $this->comic = Comic::inRandomOrder()->pluck('marvel_id')->first();
    $this->secondComic = Comic::inRandomOrder()->pluck('marvel_id')->first();
});

it('can add a comic to the cart', function () {
    $response = $this->post('/add-to-cart/'. $this->comic);

    $response->assertStatus(200);
    $response->assertJson(['message' => 'Comic added to cart']);
});

it('can add a comic to the cart multiple times', function () {
    $response = $this->post('/add-to-cart/'. $this->comic);
    $response = $this->post('/add-to-cart/'. $this->comic);

    $response->assertStatus(200);
    $response->assertJson(['message' => 'Comic added to cart']);
});

it('can delete a comic from the cart', function () {
    $response = $this->post('/add-to-cart/'. $this->comic);
    $response = $this->post('/remove-from-cart/'. $this->comic);

    $response->assertStatus(200);
    $response->assertJson(['message' => 'Comic removed from cart']);
});

it('cannot delete a comic from the cart, that is not in the cart', function () {
    $response = $this->post('/remove-from-cart/'. $this->comic);

    $response->assertStatus(404);
    $response->assertJson(['message' => 'Comic not found in cart']);
});

it('can get the cart from the session', function() {
    $response = $this->post('/add-to-cart/'. $this->comic);
    $response->assertStatus(200);

    $response = $this->get('/list-cart');
    $response->assertStatus(200);
    $response->assertJsonFragment(['marvelId' => $this->comic]);
});

it('can show the cart view', function() {
    $response = $this->get('/cart');
    $response->assertStatus(200);
    $response->assertViewIs('cart');
});
