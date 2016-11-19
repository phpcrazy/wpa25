<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4ffe7ccf04641ee814ad2439c76544fe
{
    public static $classMap = array (
        'Config' => __DIR__ . '/../..' . '/wpa25/provider/ConfigProvider.php',
        'DB' => __DIR__ . '/../..' . '/wpa25/provider/Database.php',
        'MsDB' => __DIR__ . '/../..' . '/wpa25/provider/MsDB.php',
        'WmDB' => __DIR__ . '/../..' . '/wpa25/provider/WmDB.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInit4ffe7ccf04641ee814ad2439c76544fe::$classMap;

        }, null, ClassLoader::class);
    }
}
