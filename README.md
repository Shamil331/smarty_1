# Начальная установка
docker-compose up -d --build
docker run --rm -v %cd%:/app composer install
docker-compose exec php php /var/www/html/seeders/seeder.php
