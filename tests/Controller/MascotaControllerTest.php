<?php

namespace App\Test\Controller;

use App\Entity\Mascota;
use App\Repository\MascotaRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
//use Doctrine\ORM\EntityManagerInterface;

class MascotaControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private MascotaRepository $repository;
    private string $path = '/mascota/';
    //private EntityManagerInterface $manager;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Mascota::class);

        //Inicializar la propiedad $manager antes de usarla. En el caso de que la utilice
        // $this->manager = static::getContainer()->get('doctrine')->getManager();

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
            //$this->manager->remove($object);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Mascota index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'mascota[name]' => 'Testing',
            'mascota[edad]' => 3,
            'mascota[created][hour]' => 0,
            'mascota[created][minute]' => 0,
        ]);

        self::assertResponseRedirects('/mascota/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

    }

    public function testShow(): void
    {
        $fixture = new Mascota();
        $fixture->setName('My Title');
        $fixture->setEdad(1);
        $fixture->setCreated(new \DateTimeImmutable());

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Mascota');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $fixture = new Mascota();
        $fixture->setName('My Title');
        $fixture->setEdad('2');
        $fixture->setCreated(new \DateTimeImmutable());

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'mascota[name]' => 'Something New',
            'mascota[edad]' => 4,
            'mascota[created][hour]' => 0,
            'mascota[created][minute]' => 0,
        ]);

        self::assertResponseRedirects('/mascota/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getName());
        self::assertSame('Something New', $fixture[0]->getEdad());
        self::assertSame('Something New', $fixture[0]->getCreated());
    }

    public function testRemove(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Mascota();
        $fixture->setName('My Title');
        $fixture->setEdad(5);
        $fixture->setCreated(new \DateTimeImmutable());

        $this->repository->save($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/mascota/');
    }
}
