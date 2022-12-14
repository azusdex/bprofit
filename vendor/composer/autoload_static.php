<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit98bdeea6846ed796cb48a53f21498fbe
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/App',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit98bdeea6846ed796cb48a53f21498fbe::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit98bdeea6846ed796cb48a53f21498fbe::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit98bdeea6846ed796cb48a53f21498fbe::$classMap;

        }, null, ClassLoader::class);
    }
}
