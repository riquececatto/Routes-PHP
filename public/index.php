<?php

require_once('../vendor/autoload.php');

try {
    $router = \RiqueCecatto\Src\Router\Router::getRouter();

    extract($router['data']);

    $view = $router['view'];

    require_once VIEWS . 'master.php';
} catch (\Exception $e) {
    echo ($e->getMessage() . PHP_EOL);
    echo ($e->getTrace());
}
