<?php

namespace App\Component;

class Container {

    protected $container = [];

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function get($name) {
        if(!$this->has($name)) {
            return new $name();
        }
        return $this->container[$name]($this);
    }

    public function has($name) {
        return isset($this->container[$name]);
    }

    public function set($name, callable $callable) {
        $this->container[$name] = $callable;
    }
}