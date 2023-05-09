<?php

/*

Here, you can create tests for the BeerController. Meaning a test for each operation that the controller can do.

To create a test, please use the ` it()` function like the following :

it('ensures that the /beers route retreive data', function () {});

*/

it('ensures that if an asked locale isn’t available the returned data is in its default language', function () {
    $beersResponse = $this->get('/azerty/beers');
    $brandsResponse = $this->get('/azerty/brands');
    $placesResponse = $this->get('/azerty/places');

    $beersResponse->assertStatus(200);
    $brandsResponse->assertStatus(200);
    $placesResponse->assertStatus(200);

    $beersData = json_decode($beersResponse->getContent());
    $brandsData = json_decode($brandsResponse->getContent());
    $placesData = json_decode($placesResponse->getContent());

    expect($beersData->beers->data[0]->translations[0]->locale)->toBe('fr');
    expect($brandsData->brands->data[0]->translations[0]->locale)->toBe('fr');
    expect($placesData->places->data[0]->translations[0]->locale)->toBe('fr');
});
