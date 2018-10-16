<?php

namespace Nam\Bundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProductControllerTest extends WebTestCase
{
    public function testCreate()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/product/create');
    }

    public function testUpdate()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/product/update');
    }

    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/product');
    }

}
