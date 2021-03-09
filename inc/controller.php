<?php

namespace app;

class Controller {

    public static function handle404() {
        echo "Bestand niet gevonden";
        die();
    }

    public static function handle( string $path, string $param ) {

        if( !file_exists($path) ) self::handle404();

        include $path;
    }

}