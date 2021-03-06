<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit457d714c6c914b00f21ce52323c3e03e
{
    public static $prefixLengthsPsr4 = array (
        'D' => 
        array (
            'Delight\\Router\\' => 15,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Delight\\Router\\' => 
        array (
            0 => __DIR__ . '/..' . '/delight-im/router/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit457d714c6c914b00f21ce52323c3e03e::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit457d714c6c914b00f21ce52323c3e03e::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
