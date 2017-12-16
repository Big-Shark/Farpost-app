<?php

return [
    \App\Component\Router::class => function($c) {
        return new \App\Component\Router($c, include(ROOT . '/config/routes.php'));
    },
    \App\Component\Db::class => function($c) {
        $dbConfig = include(ROOT . '/config/db_config.php');
        return new \App\Component\Db($dbConfig['host'], $dbConfig['dbname'], $dbConfig['user'], $dbConfig['password']);
    },

    \App\Controller\ImageController::class => function($c) {
        return new \App\Controller\ImageController($c->get(\App\Component\View::class), $c->get(\App\Service\ImageService::class));
    },
    \App\Controller\UserController::class => function($c) {
        return new \App\Controller\UserController($c->get(\App\Component\View::class), $c->get(\App\Service\UserService::class));
    },

    \App\Service\UserService::class => function($c) {
        return new \App\Service\UserService($c->get(\App\Component\Db::class));
    },
    \App\Service\ImageService::class => function($c) {
        return new \App\Service\ImageService($c->get(\App\Component\Db::class));
    },
];