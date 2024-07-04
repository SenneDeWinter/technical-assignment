<?php

use App\Models\Comic;
use Illuminate\Support\Facades\Artisan;

beforeEach(function () {
    Artisan::call('retrieve-comics');
    $this->comic = Comic::inRandomOrder()->pluck('marvel_id')->first();
});

it('can show the deleted items', function () {
    $response = $this->post('/add-to-cart/'. $this->comic);
    $response->assertStatus(200);

    $response = $this->post('/remove-from-cart/'. $this->comic);
    $response->assertStatus(200);

    $response = $this->post('/add-to-cart/'. $this->comic);
    $response->assertStatus(200);

    $response = $this->post('/remove-from-cart/'. $this->comic);
    $response->assertStatus(200);

    $response = $this->get('/deleted-items');
    $response->assertStatus(200);
    $response->assertJsonFragment(['marvelId' => $this->comic, 'timesDeleted' => 2]);
});
