<?php
require 'vendor/autoload.php';

use Illuminate\Config\Repository;
use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Log\LogManager;
use Illuminate\Support\Facades\Facade;

// 1. Create a custom container to handle the storagePath() method
class CustomAppContainer extends Container {
    public function storagePath($path = '') {
        return __DIR__ . '/logs' . ($path ? DIRECTORY_SEPARATOR . $path : '');
    }
}

$config = new Repository(include __DIR__.'/config.php');

$container = new CustomAppContainer();
$container->instance('config', $config);
$container->instance('app', $container);
$container->singleton('events', function ($container) {
    return new Dispatcher($container);
});
$container->singleton('log', function ($container) {
    return new LogManager($container);
});

Facade::setFacadeApplication($container);

if (!class_exists('Log')) {
    class_alias(\Illuminate\Support\Facades\Log::class, 'Log');
}