<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit599b10702d8253b4474f8d31790c924f
{
    public static $prefixLengthsPsr4 = array (
        'D' => 
        array (
            'Dotenv\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Dotenv\\' => 
        array (
            0 => __DIR__ . '/..' . '/vlucas/phpdotenv/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit599b10702d8253b4474f8d31790c924f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit599b10702d8253b4474f8d31790c924f::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}