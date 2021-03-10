<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/inc/controller.php';
require __DIR__ . '/inc/sql.php';

/**
 * Setup router with base path
 */
$router = new \Delight\Router\Router();

require __DIR__ . '/inc/routes.php';

\app\Controller::res(401);