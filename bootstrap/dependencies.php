<?php

// di
$injector = new \Auryn\Injector;

// request and response
$injector->alias('Http\Response', 'Http\HttpResponse');
$injector->share('Http\HttpRequest');
$injector->define('Http\HttpRequest', [
    ':get'     => $_GET,
    ':post'    => $_POST,
    ':cookies' => $_COOKIE,
    ':files'   => $_FILES,
    ':server'  => $_SERVER,
]);

$injector->alias('Http\Request', 'Http\HttpRequest');
$injector->share('Http\HttpResponse');

// session
$injector->alias('App\Session\Session', 'App\Session\NativeSession');
$injector->share('App\Session\Session');

// blade
$injector->alias('duncan3dc\Laravel\BladeInstance', 'duncan3dc\Laravel\BladeInstance');
$injector->share('duncan3dc\Laravel\BladeInstance');
$injector->define('duncan3dc\Laravel\BladeInstance', [
    ':path'     => getenv('VIEWS_DIRECTORY'),
    ':cache'    => getenv('CACHE_DIRECTORY')
]);

// monolog
$injector->define('Monolog\Logger', [
    ':name'     => 'applogger'
]);

return $injector;
