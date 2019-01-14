<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DomCrawler\Crawler;

abstract class AControllerTest extends WebTestCase
{
    const BASE_URI    = '';
    const BASE_METHOD = 'GET';

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return static::createClient();
    }

    /**
     * @param string $method
     * @param string $uri
     * @return Crawler
     */
    public function getCrawler(string $method = null, string $uri = null): Crawler
    {
        return $this->getClient()->request($method ?? static::BASE_METHOD, $uri ?? static::BASE_URI);
    }

    public function testGetBaseUri()
    {
        $client = $this->getClient();
        $client->request(static::BASE_METHOD, static::BASE_URI);

        $this->assertEquals(
            200,
            $client->getResponse()->getStatusCode(),
            'Status code uri `' . static::BASE_URI . '` with method `GET` not expected'
        );
    }

    /**
     * @dataProvider provideElements
     * @param string $selector
     */
    public function testElementPresent(string $selector)
    {
        $crawler = $this->getCrawler();

        $this->assertGreaterThan(
            0,
            $crawler->filter($selector)->count(),
            "Can't find element with selector `$selector`"
        );
    }

    /**
     * @return array
     */
    public function provideElements()
    {
        return [];
    }
}