<?php

use Classes\Router;

$router = new Router();

$router->addRoute('GET', '/', 'UsersController@index');

$router->addRoute('GET', '/colors', 'ColorsController@index');