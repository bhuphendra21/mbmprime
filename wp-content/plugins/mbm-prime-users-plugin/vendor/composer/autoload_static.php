<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit490c0060e9bd6da567f09c739c507d65
{
    public static $prefixLengthsPsr4 = array (
        'I' => 
        array (
            'Inc\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Inc\\' => 
        array (
            0 => __DIR__ . '/../..' . '/inc',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit490c0060e9bd6da567f09c739c507d65::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit490c0060e9bd6da567f09c739c507d65::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
