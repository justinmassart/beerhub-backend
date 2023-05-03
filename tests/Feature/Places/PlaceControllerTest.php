<?php

/*

Here, you can create tests for the BeerController. Meaning a test for each operation that the controller can do.

To create a test, please use the ` it()` function like the following :

it('ensures that the /beers route retreive data', function () {});

*/


it('ensures that the /places route is accessible and returns data', function () {
    $response = $this->get('/fr/places');
    $response->assertStatus(200);

    $response_content = json_decode($response->getContent());

    expect($response_content->places->total)->toBeGreaterThanOrEqual(1);
});
