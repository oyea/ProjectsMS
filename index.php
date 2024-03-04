<?php

spl_autoload_register(function ($class) {
    require "$class.class.php";
});
$router = new router();
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$routes = include 'routes.php';

$router->route($uri, $routes);
