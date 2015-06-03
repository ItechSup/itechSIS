<?php

namespace ItechSup\ItechSisBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EventControllerTest extends WebTestCase
{

    public function testCompleteScenario()
    {
        // Create a new client to browse the application
        $client = static::createClient();

        // Create a new entry in the database
        $crawler = $client->request('GET', '/event/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /event/");
        $crawler = $client->click($crawler->selectLink('Créer une nouvelle entrée')->link());

        // Fill in the form and submit it
        $form = $crawler->selectButton('Create')->form(array(
            'itechsup_itechsisbundle_event[startTime][date][month]'  => '1',
            'itechsup_itechsisbundle_event[startTime][date][day]'  => '1',
            'itechsup_itechsisbundle_event[startTime][date][year]'  => '2016',
            'itechsup_itechsisbundle_event[startTime][time][hour]'  => '10',
            'itechsup_itechsisbundle_event[startTime][time][minute]'  => '0',
            'itechsup_itechsisbundle_event[endTime][date][month]'  => '3',
            'itechsup_itechsisbundle_event[endTime][date][day]'  => '3',
            'itechsup_itechsisbundle_event[endTime][date][year]'  => '2017',
            'itechsup_itechsisbundle_event[endTime][time][hour]'  => '11',
            'itechsup_itechsisbundle_event[endTime][time][minute]'  => '30',
            'itechsup_itechsisbundle_event[title]'  => "test",
            'itechsup_itechsisbundle_event[session]'  => "1",
            'itechsup_itechsisbundle_event[room]'  => "1",
            'itechsup_itechsisbundle_event[teacher]'  => "1",


                        // ... other fields to fill
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check data in the show view
        $this->assertGreaterThan(0, $crawler->filter('td:contains("01-Jan-2016 10:00")')->count(), 'Missing element [value="01-Jan-2016 10:00"]');
        $this->assertGreaterThan(0, $crawler->filter('td:contains("03-Mar-2017 11:30")')->count(), 'Missing element [value="03-Mar-2017 11:30"]');
        $this->assertGreaterThan(0, $crawler->filter('td:contains("test")')->count(), 'Missing element [value="test"]');


        // Edit the entity
        $crawler = $client->click($crawler->selectLink('Edit')->link());

        $form = $crawler->selectButton('Update')->form(array(
            'itechsup_itechsisbundle_event[startTime][date][month]'  => '2',
            'itechsup_itechsisbundle_event[startTime][date][day]'  => '2',
            'itechsup_itechsisbundle_event[startTime][date][year]'  => '2018',
            'itechsup_itechsisbundle_event[startTime][time][hour]'  => '8',
            'itechsup_itechsisbundle_event[startTime][time][minute]'  => '0',
            'itechsup_itechsisbundle_event[endTime][date][month]'  => '4',
            'itechsup_itechsisbundle_event[endTime][date][day]'  => '4',
            'itechsup_itechsisbundle_event[endTime][date][year]'  => '2019',
            'itechsup_itechsisbundle_event[endTime][time][hour]'  => '15',
            'itechsup_itechsisbundle_event[endTime][time][minute]'  => '30',
            'itechsup_itechsisbundle_event[title]'  => "Foo",
            'itechsup_itechsisbundle_event[session]'  => "1",
            'itechsup_itechsisbundle_event[room]'  => "1",
            'itechsup_itechsisbundle_event[teacher]'  => "1",

            // ... other fields to fill
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check the element contains an attribute with value equals "Foo"
        $this->assertGreaterThan(0, $crawler->filter('[value="Foo"]')->count(), 'Missing element [value="Foo"]');

        // Delete the entity
        $client->submit($crawler->selectButton('Delete')->form());
        $crawler = $client->followRedirect();

        // Check the entity has been delete on the list
        $this->assertNotRegExp('/Foo/', $client->getResponse()->getContent());
    }
}
