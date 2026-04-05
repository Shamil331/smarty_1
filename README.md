# Блог на PHP + Smarty + MySQL

## Запуск проекта

### 1. Собираем и запускаем контейнеры
docker-compose up -d --build

### 2. Устанавливаем зависимости (composer install)
docker run --rm -v %cd%:/app composer install

### 3. Заполняем базу данных тестовыми данными
docker-compose exec php php /var/www/html/src/seeders/seeder.php

## Готово!

Сайт доступен по адресу: http://localhost:8080
