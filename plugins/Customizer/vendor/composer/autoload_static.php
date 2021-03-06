<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit1a4d3188031158859b352a6b53ee769d
{
    public static $prefixLengthsPsr4 = array (
        'l' => 
        array (
            'luizbills\\CSS_Generator\\' => 24,
        ),
        'M' => 
        array (
            'MatthiasMullie\\PathConverter\\' => 29,
            'MatthiasMullie\\Minify\\' => 22,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'luizbills\\CSS_Generator\\' => 
        array (
            0 => __DIR__ . '/..' . '/luizbills/css-generator/src',
        ),
        'MatthiasMullie\\PathConverter\\' => 
        array (
            0 => __DIR__ . '/..' . '/matthiasmullie/path-converter/src',
        ),
        'MatthiasMullie\\Minify\\' => 
        array (
            0 => __DIR__ . '/..' . '/matthiasmullie/minify/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit1a4d3188031158859b352a6b53ee769d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit1a4d3188031158859b352a6b53ee769d::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
