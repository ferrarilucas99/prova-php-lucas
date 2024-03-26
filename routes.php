<?php

use Classes\Router;

$router = new Router();

$router->addRoute('GET', '/', function() {
    header('Location: /users');
    exit;
});

$router->addRoute('GET', '/users', 'UsersController@index');
$router->addRoute('GET', '/users/ajax', 'UsersController@ajax');
$router->addRoute('POST', '/users/create', 'UsersController@create');
$router->addRoute('POST', '/users/update/(\d+)', 'UsersController@update');
$router->addRoute('POST', '/users/delete/(\d+)', 'UsersController@destroy');

$router->addRoute('GET', '/colors', 'ColorsController@index');