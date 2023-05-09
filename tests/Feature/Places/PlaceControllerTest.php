<?php

/*

Here, you can create tests for the BeerController. Meaning a test for each operation that the controller can do.

To create a test, please use the ` it()` function like the following :

it('ensures that the /beers route retreive data', function () {});

*/


it('ensures that the /places route is accessible and returns data', function () {
    $response = $this->get('/fr/places');
    $response->assertStatus(200);

    $data = json_decode($response->getContent());

    expect($data->places->total)->toBeGreaterThanOrEqual(1);
});

it('ensures that the data returned is translated in the asked locale', function () {
    $response = $this->get('/fr/places');
    $response->assertStatus(200);

    $data = json_decode($response->getContent());

    expect($data->places->data[0]->translations[0]->locale)->toBe('fr');
});
