<?php

namespace RiqueCecatto\Src\Controllers;

class ExceptionController
{
    public function index()
    {
        return [
            'view' => 'pages/home/home.php',
            'data' => ['title' => '404 Not Found']
        ];
    }
}
