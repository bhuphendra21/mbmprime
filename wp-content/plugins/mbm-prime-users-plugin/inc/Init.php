<?php

/**
 * @package PrimeUsers
 */

namespace Inc;

final class Init
{
    public function __construct()
    {
    }

    /**
     * Initialize the class
     * @param $class // class from the services array
     * @return mixed
     */
    private static function instantiate($class)
    {
        return new $class();
    }

    /**
     * Define all the classes inside an array and return it.
     * Define los metodos que se necesitan ejecutar.
     * @return array Full list of classes
     */
    public static function getServices()
    {
        return [
            Api\User::class,
            Pages\SignUp::class,
            Base\Enqueue::class
        ];
    }

    /**
     * Loop through all defined classes, it intantiate them and
     * executes the register method if it is defined in the class.
     * Ejecuta el register method de cada una de las clases que necesita realizar su register en wp.
     * Ejemplo el Admin.php en su register registra el menu del admin panel.
     */
    static public function registerServices()
    {
        foreach (self::getServices() as $class) {
            $service = self::instantiate($class);
            if (method_exists($service, 'register')) {
                $service->register();
            }
        }
    }
}
