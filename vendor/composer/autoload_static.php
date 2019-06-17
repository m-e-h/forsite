<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit73cfed49f316cd89c4d40feddfb2c04d
{
    public static $files = array (
        '77c7b76f4dcd3556a40cd339441c5cce' => __DIR__ . '/..' . '/justintadlock/hybrid-core/src/bootstrap-hybrid.php',
    );

    public static $prefixLengthsPsr4 = array (
        'H' => 
        array (
            'Hybrid\\Breadcrumbs\\' => 19,
            'Hybrid\\' => 7,
        ),
        'F' => 
        array (
            'Forsite\\' => 8,
        ),
        'C' => 
        array (
            'Composer\\Installers\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Hybrid\\Breadcrumbs\\' => 
        array (
            0 => __DIR__ . '/..' . '/justintadlock/hybrid-breadcrumbs/src',
        ),
        'Hybrid\\' => 
        array (
            0 => __DIR__ . '/..' . '/justintadlock/hybrid-core/src',
        ),
        'Forsite\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
        'Composer\\Installers\\' => 
        array (
            0 => __DIR__ . '/..' . '/composer/installers/src/Composer/Installers',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit73cfed49f316cd89c4d40feddfb2c04d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit73cfed49f316cd89c4d40feddfb2c04d::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
