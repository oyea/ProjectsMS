<?php
class router
{
    public function route($uri, $routes)
    {
        if (array_key_exists($uri, $routes)) {
            require "$routes[$uri]";
        } else {
            require "404.php";
        }
    }
}