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
            'itechsup_itechsisbundle_session[startDate][month]'  => '1',
            'itechsup_itechsisbundle_session[startDate][day]'  => '1',
            'itechsup_itechsisbundle_session[startDate][year]'  => '2010',
            'itechsup_itechsisbundle_session[endDate][month]'  => '2',
            'itechsup_itechsisbundle_session[endDate][day]'  => '2',
            'itechsup_itechsisbundle_session[endDate][year]'  => '2016',
            'itechsup_itechsisbundle_session[formation]'  => "2",

            // ... other fields to fill
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check data in the show view
        $this->assertGreaterThan(0, $crawler->filter('td:contains("01-Jan-2010")')->count(), 'Missing element td:contains("01-Jan-2010")');
        $this->assertGreaterThan(0, $crawler->filter('td:contains("02-Feb-2016")')->count(), 'Missing element td:contains("02-Feb-2016")');
        $this->assertGreaterThan(0, $crawler->filter('td:contains("CGO")')->count(), 'Missing element td:contains("CGO")');

        // Edit the entity
        $crawler = $client->click($crawler->selectLink('Editer')->link());

        $form = $crawler->selectButton('Update')->form(array(
            'itechsup_itechsisbundle_session[startDate][month]'  => '1',
            'itechsup_itechsisbundle_session[startDate][day]'  => '1',
            'itechsup_itechsisbundle_session[startDate][year]'  => '2015',
            'itechsup_itechsisbundle_session[endDate][month]'  => '3',
            'itechsup_itechsisbundle_session[endDate][day]'  => '3',
            'itechsup_itechsisbundle_session[endDate][year]'  => '2017',
            'itechsup_itechsisbundle_session[formation]'  => "1",
            // ... other fields to fill
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check the element contains an attribute with value equals "Foo"
        $this->assertGreaterThan(0, $crawler->filter('td:contains("01-Jan-2015")')->count(), 'Missing element [value="01-Jan-2015"]');
        $this->assertGreaterThan(0, $crawler->filter('td:contains("03-Mar-2017")')->count(), 'Missing element [value="03-Mar-2017"]');
        $this->assertGreaterThan(0, $crawler->filter('td:contains("SIO")')->count(), 'Missing element [value="1"]');

        // Delete the entity
        $crawler = $client->click($crawler->selectLink('Editer')->link());
        $client->submit($crawler->selectButton('Delete')->form());
        $crawler = $client->followRedirect();

        // Check the entity has been delete on the list
        $this->assertNotRegExp('/SIO/', $client->getResponse()->getContent());
    }
}
