<?php

namespace app;

class Controller {

    public static function res(int $code) {

        $allowed = [ 400, 401, 403];

        return !in_array($code, $allowed) ? header( "HTTP/1.0 500", true, 500 ) : header( "HTTP/1.0 {$code}", true, $code );
    }

    public static function handle( string $path = "", string $param ) {

        if( !file_exists($path) ) self::res(404);

        include $path;
    }

}