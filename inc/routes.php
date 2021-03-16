<?php

$dependencies = [
    "res" => \app\Response::create(),
    "db" => \app\DB::create([
        "Response" => \app\Response::create()
    ])
];

$router->get(
    '/tickets', 
    [ 'app\Controller', 'handle' ], 
    [ './api/tickets/get.php', $dependencies ]  
) && die();

$router->post(
    '/tickets', 
    [ 'app\Controller', 'handle' ], 
    [ './api/tickets/order.php', $dependencies ]
) && die();