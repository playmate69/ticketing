<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/inc/controller.php';
require __DIR__ . '/inc/response.php';
require __DIR__ . '/inc/connection.php';
require __DIR__ . '/inc/db.php';

header("Access-Control-Allow-Origin: *");

/**
 * Setup router with base path
 */
$router = new \Delight\Router\Router("/v1/api");

require __DIR__ . '/inc/routes.php';

\app\Controller::res(401);