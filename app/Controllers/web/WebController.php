<?php

namespace app\Controllers\web;

use app\Controllers\Controller;
use app\Middlewares\Middleware;

class WebController extends Controller
{
    public function __construct()
    {
        Middleware::auth('login');
        Middleware::verifyEmail('verify/email');
    }

    public function index()
    {
        $data = [
            'modulo' => 'inicio'
        ];
        return $this->view('web.inicio.view', $data);

    }

    public function membresia()
    {
        $data = [
            'modulo' => 'inicio'
        ];
        return $this->view('web.inicio.view', $data);
    }
}