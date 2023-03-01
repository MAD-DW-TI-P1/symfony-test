<img src="https://jorgebenitezlopez.com/github/symfony.jpg">

# Symfony y test

Instalación de Symfony y creación de test

# Requisitos

- Symfony CLI: https://symfony.com/download
- PHP: PHP 8.2.3 (cli). Por ejemplo se puede descargar en OSX con: https://formulae.brew.sh/formula/php
- Composer: https://getcomposer.org/download/


# Pasos para la instalación de Symfomy y paquetes

- new symfony  --version=5.4
- composer require symfony/orm-pack (Sin docker)
- composer require symfony/maker-bundle
- composer require form validator twig-bundle security-csrf annotations
- composer require --dev symfony/test-pack
- composer require symfony/panther --dev
- composer require --dev dbrekelmans/bdi

# Configuración y creación de entidades

- Modificamos el .env para que genere un sqlite (https://www.sqlite.org/index.html)
- php bin/console make:entity (Creamos mascota con nombre, edad y fecha de creación)
- php bin/console make:crud (Creamos el CRUD de la entidad mascota)
- php bin/console doctrine:schema:update --force (Actualizamos la base de datos) 
- php bin/console make:entity imgmascota (Con un campo mascota tipo relación OneToMany)


# Rutas de la aplicación:

| URL path                    | Description           | 
| :--------------------------:|:---------------------:|
| /mascota                    |  Listado de mascotas  | 
| /mascota/new                |  Nueva mascota        |
| /mascota/1/edit             |  Editar mascota 1     |
| /imgmascota                 |  Listado de imaágenes de mascotas  | 
| /imgmascota/new             |  Añadir nueba imágen de mascotas        |
| /imgmascota/1/edit          |  Editar imagen de mascota    |
