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


# Rutas de la aplicación:

| URL path                    | Description           | 
| :--------------------------:|:---------------------:|
| /                           |  Home page            | 
