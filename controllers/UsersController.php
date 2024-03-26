<?php
// namespace Controllers;

class UsersController
{
    public function __construct()
    {
        
    }

    public function index(): void
    {
        require __DIR__ . '/../views/users/index.php';
    }
}