<?php

namespace ItechSup\ItechSisBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class StudentControllerTest extends WebTestCase
{

    public function testCompleteScenario()
    {
        // Create a new client to browse the application
        $client = static::createClient();

        // Create a new entry in the database
        $crawler = $client->request('GET', '/student/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /student/");
        $crawler = $client->click($crawler->selectLink('Créer une nouvelle entrée')->link());

        // Fill in the form and submit it
        $form = $crawler->selectButton('Create')->form(array(
            'itechsup_itechsisbundle_student[name]'  => 'Test',
            'itechsup_itechsisbundle_student[surname]'  => 'Retest',
            'itechsup_itechsisbundle_student[session]'  => 'CGO',
            // ... other fields to fill
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check data in the show view
        $this->assertGreaterThan(0, $crawler->filter('td:contains("Test")')->count(), 'Missing element td:contains("Test")');

        // Edit the entity
        $crawler = $client->click($crawler->selectLink('Editer')->link());

        $form = $crawler->selectButton('Update')->form(array(
            'itechsup_itechsisbundle_student[name]'  => 'Foo',
            'itechsup_itechsisbundle_student[surname]'  => 'ReFoo',
            'itechsup_itechsisbundle_student[session]'  => 'SIO',

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
