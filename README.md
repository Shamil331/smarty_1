Начальная установка

# Собираем и запускаем контейнеры
docker-compose up -d --build

#composer install
docker run --rm -v %cd%:/app composer install

#seeder
docker-compose exec php php /var/www/html/seeders/seeder.php
