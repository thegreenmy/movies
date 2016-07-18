<?php
require_once __DIR__.'/autoload.php';
//make the actual call
$request_uri = $_SERVER['REQUEST_URI'];
$router = new Router($request_uri);
$controller = $router->getController();
$method = $router->getMethod();
$caller = new Caller($controller, $method);
$caller->call();