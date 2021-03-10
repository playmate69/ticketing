<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/inc/controller.php';

$router = new \Delight\Router\Router();

$router->get('/tickets/:id', [ 'app\Controller', 'handle' ], [ __DIR__ . "/api/tickets.php" ]) && die();

\app\Controller::res(401);