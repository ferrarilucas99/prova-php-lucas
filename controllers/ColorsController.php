<?php
// namespace Controllers;

class ColorsController
{
    public function __construct()
    {
        
    }

    public function index(): void
    {
        $title = 'Cores';
        $view_path = '/colors/index.php';
        require __DIR__ . '/../views/layouts/main.php';
    }
}