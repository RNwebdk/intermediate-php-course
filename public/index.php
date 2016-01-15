<?php
require __DIR__ . '/../bootstrap/start.php';
require __DIR__ . '/../bootstrap/functions.php';
require __DIR__ . '/../bootstrap/db.php';

// create our injector from dependencies
$injector = include __DIR__ . '/../bootstrap/dependencies.php';

// inject request & response
$request = $injector->make('Http\HttpRequest');
$response = $injector->make('Http\HttpResponse');

// inject blade
$injector->make('duncan3dc\Laravel\BladeInstance');

// inject session
$session = $injector->make('App\Session\Session');

// logger
$injector->make('Monolog\Logger');
$injector->make('App\Logging\Log');

// inject page model
$injector->make('App\Models\Page');

// set up our routes
$routeDefinitionCallback = function (\FastRoute\RouteCollector $r) {
    $routes = include(__DIR__ . '/../src/routes.php');
    foreach ($routes as $route) {
        $r->addRoute($route[0], $route[1], $route[2]);
    }
};

// dispatch to route
$dispatcher = \FastRoute\simpleDispatcher($routeDefinitionCallback);
$routeInfo = $dispatcher->dispatch($request->getMethod(), $request->getPath());

switch ($routeInfo[0]) {
    case \FastRoute\Dispatcher::NOT_FOUND:
        $response->setContent('404 - Page not found');
        $response->setStatusCode(404);
        break;
    case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $response->setContent('405 - Method not allowed');
        $response->setStatusCode(405);
        break;
    case \FastRoute\Dispatcher::FOUND:
        $className = $routeInfo[1][0];
        $method = $routeInfo[1][1];
        $vars = $routeInfo[2];
        $class = $injector->make($className);
        $class->$method($vars);
        break;
}

// set response headers
foreach ($response->getHeaders() as $header) {
    header($header, false);
}

// show final page to user
echo $response->getContent();
