<?php

it('can retrieve comics from the Marvel API', function () {
    $this->artisan('retrieve-comics')
        ->assertExitCode(0);
});
