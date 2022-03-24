# Projet de site web de restaurant

Projet de la formation Cnam

## media
Photo by <a href="https://unsplash.com/@djenta?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Marie-Christelle Attila</a> on <a href="https://unsplash.com/?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Unsplash</a>
  
git clone https://github.com/jibundeyare/cnam-nfa021-laravel-2021-2022.git
cd cnam-nfa021-laravel-2021-2022
# complétez le fichier ".env" avec les codes d'accès à la BDD
composer install
php artisan migrate
php artisan db:seed --class=SqlFileSeeder
Utilisation
Dans un terminal, tapez :

php artisan serve
Dans votre navigateur, ouvrez l'url http://127.0.0.1/.