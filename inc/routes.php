<?php

$router->get(
    '/tickets', 
    [ 'app\Controller', 'handle' ], 
    [ './api/tickets/get.php' ]
) && die();

$router->post(
    '/tickets', 
    [ 'app\Controller', 'handle' ], 
    [ './api/tickets/order.php' ]
) && die();