<?php

namespace Controllers;

use Models\Color;

class ColorsController
{
    private $color;

    public function __construct()
    {
        $this->color = new Color();
    }

    public function index(): void
    {
        $colors = $this->color->get();
        $title = 'Cores';
        $view_path = '/colors/index.php';
        require __DIR__ . '/../views/layouts/main.php';
    }
}