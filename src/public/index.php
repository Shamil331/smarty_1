<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Smarty\Smarty;

$smarty = new Smarty();

$smarty->setTemplateDir(__DIR__ . '/../templates');
$smarty->setCompileDir(__DIR__ . '/../templates_c');
$smarty->setCacheDir(__DIR__ . '/../cache');

$requestUri = $_SERVER['REQUEST_URI'];
$path = parse_url($requestUri, PHP_URL_PATH);

switch (true) {
    case $path === '/' || $path === '':
        require_once __DIR__ . '/../controllers/HomeController.php';
        $controller = new HomeController($smarty);
        $controller->index();
        break;
        
    case preg_match('/^\/category\/(\d+)$/', $path, $matches):
        require_once __DIR__ . '/../controllers/CategoryController.php';
        $controller = new CategoryController($smarty);
        $controller->view($matches[1]);
        break;
        
    case preg_match('/^\/post\/(\d+)$/', $path, $matches):
        require_once __DIR__ . '/../controllers/PostController.php';
        $controller = new PostController($smarty);
        $controller->view($matches[1]);
        break;
        
    default:
        header('HTTP/1.0 404 Not Found');
        echo '404 - Page not found';
        break;
}
