<?php

namespace ItechSup\ItechSisBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SessionControllerTest extends WebTestCase
{

    public function testCompleteScenario()
    {
        // Create a new client to browse the application
        $client = static::createClient();

        // Create a new entry in the database
        $crawler = $client->request('GET', '/session/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /session/");
        $crawler = $client->click($crawler->selectLink('Créer une nouvelle entrée')->link());

        // Fill in the form and submit it
        $form = $crawler->selectButton('Create')->form(array(
            'itechsup_itechsisbundle_session[startDate]'  => '01-Jan-2010',
            'itechsup_itechsisbundle_session[endDate]'  => '01-Jan-2010',
            'itechsup_itechsisbundle_session[formation]'  => "SIO",

            // ... other fields to fill
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check data in the show view
        $this->assertGreaterThan(0, $crawler->filter('td:contains("01-Jan-2010")')->count(), 'Missing element td:contains("01-Jan-2010")');
        $this->assertGreaterThan(0, $crawler->filter('td:contains("01-Jan-2010")')->count(), 'Missing element td:contains("01-Jan-2010")');
        $this->assertGreaterThan(0, $crawler->filter('td:contains("SIO")')->count(), 'Missing element td:contains("SIO")');

        // Edit the entity
        $crawler = $client->click($crawler->selectLink('Editer')->link());

        $form = $crawler->selectButton('Update')->form(array(
            'itechsup_itechsisbundle_session[startDate]'  => '02-Jan-2012',
            'itechsup_itechsisbundle_session[endDate]'  => '01-Jan-2013',
            'itechsup_itechsisbundle_session[formation]'  => "CGO",
            // ... other fields to fill
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check the element contains an attribute with value equals "Foo"
        $this->assertGreaterThan(0, $crawler->filter('[value="02-Jan-2012"]')->count(), 'Missing element [value="02-Jan-2012"]');
        $this->assertGreaterThan(0, $crawler->filter('[value="01-Jan-2013"]')->count(), 'Missing element [value="01-Jan-2013"]');
        $this->assertGreaterThan(0, $crawler->filter('[value="CGO"]')->count(), 'Missing element [value="CGO"]');

        // Delete the entity
        $client->submit($crawler->selectButton('Delete')->form());
        $crawler = $client->followRedirect();

        // Check the entity has been delete on the list
        $this->assertNotRegExp('/Foo/', $client->getResponse()->getContent());
    }
}
