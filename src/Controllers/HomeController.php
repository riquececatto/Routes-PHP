<?php

namespace RiqueCecatto\Src\Controllers;

class HomeController
{
    public function index($params): array
    {
        return [
            'view' => 'pages/home/home.php',
            'data' => [
                'title' => 'Home'
            ]
        ];
    }
}
