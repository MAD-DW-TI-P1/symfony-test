<?php

namespace App\Tests;

use Symfony\Component\Panther\PantherTestCase;

class HomeTest extends PantherTestCase
{
    public function testSomething(): void
    {
        // Crea el 'navegador'
        $client = static::createPantherClient();
        // Carga una ruta
        $crawler = $client->request('GET', '/');
        // Hace captura de pantalla
        $client->takeScreenshot('tests/imgs/screen.png'); 
        // Comprueba que el título de la página es el esperado  
        $this->assertSelectorTextContains('h1', 'Welcome to');

        $client->clickLink('Create your first page');
        // Wait for an element to be present in the DOM (even if hidden)
        $crawler = $client->waitFor('.prose-title');
        $this->assertSelectorTextContains('h1', 'Create your First Page in Symfony');
        $client->takeScreenshot('tests/imgs/screen2.png'); 

    }
}
