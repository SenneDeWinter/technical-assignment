<?php

use App\Models\Comic;
use Illuminate\Support\Facades\Artisan;

beforeEach(function () {
    Artisan::call('retrieve-comics');
    $this->comic = Comic::inRandomOrder()->pluck('marvel_id')->first();
});

it('can list comics', function () {
    $response = $this->get('/list-comics');

    $response->assertStatus(200);
    $response->assertJsonFragment(['marvelId' => $this->comic]);
});

it('can show the comics', function() {
    $response = $this->get('/');
    $response->assertStatus(200);
    $response->assertViewIs('list');
});
