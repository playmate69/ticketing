<?php

$router->get(
    '/tickets/:id', 
    [ 'app\Controller', 'handle' ], 
    [ './api/tickets.php' ]
) && die();
