<?php

session_start();

define('public', __DIR__);
define('ROOT', realpath(__DIR__.'/../'));

require_once(ROOT . '/src/Component/Kernel.php');
spl_autoload_register('\App\Component\Kernel::classLoader');

$container = require_once(ROOT . '/config/container.php');

$kernel = new \App\Component\Kernel(new \App\Component\Container($container));
$kernel->run();
