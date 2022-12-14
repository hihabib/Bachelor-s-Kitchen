<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7d01c2c972f72ce87fb755059bbf14c2
{
    public static $prefixLengthsPsr4 = array (
        'k' => 
        array (
            'kitchen\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'kitchen\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Class',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit7d01c2c972f72ce87fb755059bbf14c2::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7d01c2c972f72ce87fb755059bbf14c2::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit7d01c2c972f72ce87fb755059bbf14c2::$classMap;

        }, null, ClassLoader::class);
    }
}
