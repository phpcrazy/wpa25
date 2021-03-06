<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4ffe7ccf04641ee814ad2439c76544fe
{
    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'Wpa25\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Wpa25\\' => 
        array (
            0 => __DIR__ . '/../..' . '/wpa25/src',
        ),
    );

    public static $classMap = array (
        'Config' => __DIR__ . '/../..' . '/wpa25/provider/ConfigProvider.php',
        'DB' => __DIR__ . '/../..' . '/wpa25/provider/Database.php',
        'HDB' => __DIR__ . '/../..' . '/wpa25/provider/Hdb.php',
        'HhDB' => __DIR__ . '/../..' . '/wpa25/provider/HhDB.php',
        'LogInterface' => __DIR__ . '/../..' . '/wpa25/Log/interface/LogInterface.php',
        'MsDB' => __DIR__ . '/../..' . '/wpa25/provider/MsDB.php',
        'WmDB' => __DIR__ . '/../..' . '/wpa25/provider/WmDB.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit4ffe7ccf04641ee814ad2439c76544fe::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit4ffe7ccf04641ee814ad2439c76544fe::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit4ffe7ccf04641ee814ad2439c76544fe::$classMap;

        }, null, ClassLoader::class);
    }
}
