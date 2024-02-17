# Mon Projet Symfony

Ce projet est une application web développée en utilisant le framework Symfony.

## Prérequis

Assurez-vous d'avoir installé les éléments suivants avant de commencer :

- [PHP >= 8.3](https://windows.php.net/download#php-8.3)
  - pour vérifier l'installation, cmd **php -v**
  - si ereur MVCR110.dll : [Visual c++](https://learn.microsoft.com/fr-fr/cpp/windows/latest-supported-vc-redist?view=msvc-170)
  - activer extension curl (décommenter extension=curl)

- [Composer](https://getcomposer.org/download/)
  - pour vérifier l'installation, cmd **composer -v**
- [Symfony CL I (pour une installation plus rapide)](https://symfony.com/download)
  - pour windows, installer [scoop](https://scoop.sh/) puis lancer cmd **scoop install symfony-cli**
  - Debian/ubuntu :
      - **curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.deb.sh' | sudo -E bash**
      - **sudo apt install symfony-cli**
  - pour vérifier l'installation, cmd **symfony -v**

## Développement

- ouvrir le projet dans votre IDE
- démarrer serveur local avec **symfony server:start**
    - [OK] Web server listening                                                                                              
    - "The Web server is using PHP CLI 8.3.2                                                                             
    - "http://127.0.0.1:8000   

## Obtenir de nouveaux packages

- [packagelist](https://packagist.org/?)

- Le tilde (~) signifie que la version spécifiée est une version "approximative". Pour les versions compatibles avec la version spécifiée, le chiffre de niveau le plus élevé (sauf la version majeure) est autorisé à changer.
- Le signe ^ indique que la bibliothèque ou le package requiert version xxx ou une version ultérieure, mais exclut toute version majeure.

## Countries

- Basé sur les données de l'api https://restcountries.com/
- Les données all sont copiées en local pour le développement. Elles sont disponibles en ligne à l'adresse https://restcountries.com/v3.1/all


## Mise à jour (facultatif)

- Pour mettre à jour les packages, cmd **composer update**

## Symfony

- [Page Setup](https://symfony.com/doc/current/setup.html)
