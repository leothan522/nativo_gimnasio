<?php

namespace app\Controllers\web;

use app\Controllers\Controller;
use app\Middlewares\Middleware;
use app\Models\Persona;
use app\Providers\Auth;

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
        $model = new Persona();
        $existe = $model->where('')
        $data = [
            'modulo' => 'inicio'

        ];
        return $this->view('web.membresias.view', $data);
    }
}