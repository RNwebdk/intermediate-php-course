<?php

// di
$injector = new \Auryn\Injector;

// requeest and response
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

return $injector;
