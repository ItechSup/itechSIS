<?php

namespace ItechSup\ItechSisBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertTrue($crawler->filter('html:contains("Bienvenue sur l\'administration de ItechSup !")')->count() > 0);
        $this->assertTrue($crawler->filter('a:contains("Page d\'accueil")')->count() > 0);
        $this->assertTrue($crawler->filter('a:contains("Formations")')->count() > 0);
        $this->assertTrue($crawler->filter('a:contains("Sessions")')->count() > 0);
        $this->assertTrue($crawler->filter('a:contains("Etudiants")')->count() > 0);
        $this->assertTrue($crawler->filter('a:contains("Salles")')->count() > 0);
        $this->assertTrue($crawler->filter('a:contains("Profs")')->count() > 0);
    }
}
