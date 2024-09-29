<?php

use Core\router;

require 'vendor/autoload.php';

$router = new router();
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];


$routes = include 'routes.php';

$router->route($uri, $routes);


use Core\Db;
use Core\validate;
