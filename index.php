<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/inc/controller.php';

$router = new \Delight\Router\Router();

$router->get('/', function () {
    echo "home";
}) && die();

$router->get('/tickets/:id', [ 'Controller', 'handle' ], [ __DIR__ . "/api/tickets.php" ]) && die();

\app\Controller::handle404();