<?php
// namespace Controllers;

class UsersController
{
    public function __construct()
    {
        
    }

    public function index(): void
    {
        $title = 'Usuários';
        $view_path = '/users/index.php';
        require __DIR__ . '/../views/layouts/main.php';
    }
}