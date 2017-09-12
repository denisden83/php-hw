<?php

namespace FP2\Controllers;

use FP2\Views\View;

abstract class Controller
{
    protected $view;

    public function __construct()
    {
        $this->view = new View();
    }

    protected function access()
    {
        session_start();
        if (isset($_SESSION['access']) && $_SESSION['access'] === 'granted') {
            return 'granted';
        } else {
            return 'denied';
        }
    }
}
