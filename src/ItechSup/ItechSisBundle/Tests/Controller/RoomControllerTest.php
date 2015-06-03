<?php

namespace ItechSup\ItechSisBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RoomControllerTest extends WebTestCase
{

    public function testCompleteScenario()
    {
        // Create a new client to browse the application
        $client = static::createClient();

        // Create a new entry in the database
        $crawler = $client->request('GET', '/room/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /room/");
        $crawler = $client->click($crawler->selectLink('Créer une nouvelle entrée')->link());

        // Fill in the form and submit it
        $form = $crawler->selectButton('Create')->form(array(
            'itechsup_itechsisbundle_room[number]'  => 5,
            'itechsup_itechsisbundle_room[seatsCount]'  => 20,
            'itechsup_itechsisbundle_room[computersCount]'  => 15,
            // ... other fields to fill
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check data in the show view
        $this->assertGreaterThan(0, $crawler->filter('td:contains("5")')->count(), 'Missing element td:contains("5")');
        $this->assertGreaterThan(0, $crawler->filter('td:contains("20")')->count(), 'Missing element td:contains("20")');
        $this->assertGreaterThan(0, $crawler->filter('td:contains("15")')->count(), 'Missing element td:contains("15")');

        // Edit the entity
        $crawler = $client->click($crawler->selectLink('Editer')->link());

        $form = $crawler->selectButton('Update')->form(array(
            'itechsup_itechsisbundle_room[number]'  => 6,
            'itechsup_itechsisbundle_room[seatsCount]'  => 22,
            'itechsup_itechsisbundle_room[computersCount]'  => 14,
            // ... other fields to fill
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        $this->assertGreaterThan(0, $crawler->filter('[value="6"]')->count(), 'Missing element [value="6"]');
        $this->assertGreaterThan(0, $crawler->filter('[value="22"]')->count(), 'Missing element [value="22"]');
        $this->assertGreaterThan(0, $crawler->filter('[value="14"]')->count(), 'Missing element [value="14"]');

        // Delete the entity
        $client->submit($crawler->selectButton('Delete')->form());
        $crawler = $client->followRedirect();

        // Check the entity has been delete on the list
        $this->assertNotRegExp('/test/', $client->getResponse()->getContent());
    }
}
