<?php

namespace App\Component;

class Kernel {

    protected $container;

    function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function getContainer()
    {
       return $this->container;
    }

    public static function classLoader($class)
    {
        $ds = DIRECTORY_SEPARATOR;
        $class = strtr($class, [
            'App' => 'src',
            '\\'  => $ds,
        ]);

        $path = ROOT . DIRECTORY_SEPARATOR . $class . '.php';

        if (is_file($path)) {
            include_once($path);
        }
    }

    public function run()
    {
        $routes = $this->container->get(Router::class);
        echo $routes->run();
    }
}