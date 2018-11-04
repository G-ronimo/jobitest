# Test Jobi-Joba

## SPECIFICATIONS
- Exercice réalisé sous Symfony 4.1
- Utilisation de Doctrine
- Utilisation de Twig
- Utilisation de l'api Offre d'Emploi V2 de Pôle Emploi via un service

## INSTALLATION
- copier et clone en HTTPS ce repository dans le répertoire local souhaité avec "git clone https://github.com/G-ronimo/jobitest.git"
- "cd jobitest" puis "composer install"
- modifier le fichier .env afin de configurer l'accès database au niveau de "DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name"
- "php bin/console doctrine:database:create"
- "php bin/console doctrine:migrations:migrate"
- "php bin console server:start
 
 A priori à ce stade, le projet pourra être visible en http://127.0.0.1:8000
 

Merci.

Et _ :wink:_


