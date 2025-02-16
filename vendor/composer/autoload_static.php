<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit3b990a3b161733a00017ceac743f1b7a
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\Kernel\\' => 11,
            'App\\Controllers\\' => 16,
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\Kernel\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Kernel',
        ),
        'App\\Controllers\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/Controllers',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit3b990a3b161733a00017ceac743f1b7a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit3b990a3b161733a00017ceac743f1b7a::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit3b990a3b161733a00017ceac743f1b7a::$classMap;

        }, null, ClassLoader::class);
    }
}
