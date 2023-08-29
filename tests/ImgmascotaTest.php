<?php

namespace App\Tests;

// Modifico para probar con un naevador real
//use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


//class ImgmascotaTest extends TestCase
class ImgmascotaTest extends WebTestCase
{
    public function testSomething(): void
    {
        //$this->assertTrue(true);
        $client = static::createClient();
        $crawler = $client->request('GET', '/imgmascota/');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Imgmascota index');
    }
}
