<?php

namespace App\Component;

class Router {

    private $routes;
    private $container;

    public function __construct(Container $container, $routes) {
        $this->container = $container;
        $this->routes = $routes;
    }

    private function getUri() {

        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    public function run() {
        $uri = $this->getUri();

        foreach ($this->routes as $route => $callable) {

            if (preg_match("~$route~", $uri, $matches)) {

                if(count($callable) === 2){
                    $callable[0] = $this->container->get($callable[0]);
                }

                $result = call_user_func_array($callable, $matches);
                return $result;
            }
        }

        throw new \HttpException('Not found', 404);
    }
}