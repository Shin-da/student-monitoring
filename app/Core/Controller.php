<?php
declare(strict_types=1);

namespace Core;

abstract class Controller
{
    protected View $view;

    public function __construct()
    {
        $this->view = new View();
    }
}


