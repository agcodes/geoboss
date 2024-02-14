# Mon Projet Symfony

Ce projet est une application web développée en utilisant le framework Symfony.

- [Setup](https://symfony.com/doc/current/setup.html)

## Prérequis

Assurez-vous d'avoir installé les éléments suivants avant de commencer :

- [PHP >= 8.2](https://windows.php.net/download#php-8.3)
- -- pour vérifier l'installation, cmd **php -v**
- -- si ereur MVCR110.dll : [Visual c++](https://learn.microsoft.com/fr-fr/cpp/windows/latest-supported-vc-redist?view=msvc-170)
- -- activer extension curl (décommenter extension=curl)
- -- 
- [Composer](https://getcomposer.org/download/)
- -- pour vérifier l'installation, cmd **composer -v**
- [Symfony CL I (pour une installation plus rapide)](https://symfony.com/download)
- -- utiliser [scoop](https://scoop.sh/) 
- -- pour vérifier l'installation, cmd **symfony -v**
- 
## Installation

- Pour mettre à jour les packages, cmd **composer update**

## Développement

- démarrer serveur local avec **symfony server:start**
- "OK] Web server listening                                                                                              
- "The Web server is using PHP CLI 8.3.2                                                                             
- "http://127.0.0.1:8000   

## Obtenir des packages

- [packagelist](https://packagist.org/?)

- Le tilde (~) signifie que la version spécifiée est une version "approximative". Pour les versions compatibles avec la version spécifiée, le chiffre de niveau le plus élevé (sauf la version majeure) est autorisé à changer.
- ^ indique que la bibliothèque ou le package requiert version xxx ou une version ultérieure, mais exclut toute version majeure.

## Install linux

- sudo apt install php8.2-xml
- sudo apt install php8.3-xml
- sudo apt install php8.3-xdebug
