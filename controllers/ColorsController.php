<?php
// namespace Controllers;

class ColorsController
{
    public function __construct()
    {
        
    }

    public function index(): void
    {
        require __DIR__ . '/../views/colors/index.php';
    }
}