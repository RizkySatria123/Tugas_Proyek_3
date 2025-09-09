<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class HelloWorld extends Controller
{
    public function index()
    {
        return '<h1>Hello World!</h1>';
    }
}