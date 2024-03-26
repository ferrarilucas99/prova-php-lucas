<?php

require_once __DIR__ . '/controllers/UsersController.php';
require_once __DIR__ . '/controllers/ColorsController.php';

$user = new UsersController();
$color = new ColorsController();

if($_SERVER['REQUEST_URI'] === '/colors'){
    $color->index();
}else{
    $user->index();
}