<img src="https://jorgebenitezlopez.com/github/symfony.jpg">

# Symfony y test

Instalación de Symfony y creación de test

# Requisitos

- Symfony CLI: https://symfony.com/download
- PHP: PHP 8.2.3 (cli). Por ejemplo se puede descargar en OSX con: https://formulae.brew.sh/formula/php
- Composer: https://getcomposer.org/download/


# Pasos para la instalación de Symfomy y paquetes

- symfony new test  --version=5.4
- composer require symfony/orm-pack (Sin docker)
- composer require symfony/maker-bundle
- composer require form validator twig-bundle security-csrf annotations
- composer require --dev symfony/test-pack
- composer require symfony/panther --dev
- composer require --dev dbrekelmans/bdi


# Configuración y creación de entidades

- Modificamos el .env para que genere un sqlite (https://www.sqlite.org/index.html)
- php bin/console make:entity (Creamos mascota con nombre, edad y fecha de creación)
- php bin/console make:crud (Creamos el CRUD de la entidad mascota) Cuando creas el CRUD la entidad puedes crearla con Tests. Añade: $this->markTestIncomplete(); hay que revisarlos.
- php bin/console doctrine:schema:update --force (Actualizamos la base de datos) 
- php bin/console make:entity Imgmascota (Con un campo mascota tipo relación OneToMany)
- Para generar un entorno propio para los test: Añadimos una nueva conexión a la base de datos en el .env.test y actualizamos su esquema: php bin/console --env=test doctrine:schema:create


# Comando para hacer y ejectuar test
- Comando para actualizar drivers: vendor/bin/bdi detect drivers (En el caso de que no se descarguen las últimas versiones: Bajar el chromedriver a mano: https://chromedriver.chromium.org/downloads)
- Hacer: php bin/console make:test (Con la opción: PantherTestCase)
- Ejecutar: php bin/phpunit. Interesante poner el --verbose para más información

# Posibles errores
- Error: Typed property App\Test\Controller\CoderControllerTest::$manager must not be accessed before initialization. En este caso inicializar la propiedad $manager antes de usarla. Ver comentarios del test: MascotaControllerTest


# Rutas de la aplicación:

| URL path                    | Description           | 
| :--------------------------:|:---------------------:|
| /mascota                    |  Listado de mascotas  | 
| /mascota/new                |  Nueva mascota        |
| /mascota/1/edit             |  Editar mascota 1     |
| /imgmascota                 |  Listado de imágenes de mascotas  | 
| /imgmascota/new             |  Añadir nueva imágen de mascotas        |
| /imgmascota/1/edit          |  Editar imagen de mascota    |


# Referencias

- PHP Unit: https://phpunit.de/
- Documentación de Symfony: https://symfony.com/doc/5.4/testing.html
- Info sobre Panther: https://github.com/symfony/panther#testing-usage
- Info sobre el Crawler: https://diego.com.es/el-objeto-crawler-en-testing-en-symfony
