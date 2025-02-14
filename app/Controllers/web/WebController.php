<?php

namespace app\Controllers\web;

use app\Controllers\Controller;
use app\Middlewares\Middleware;
use app\Models\Membresia;
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
        Middleware::auth('/');
        $model = new Persona();
        $id = Auth::user()->id;
        $persona = $model->where('users_id', $id)->first();
        if (!empty($persona)) {
            $existe = 'registrado';
        }else{
            $existe = 'no_registrado';
        }

        $data = [
            'modulo' => 'membresia',
            'persona' => $existe
        ];
        return $this->view('web.membresias.view', $data);
    }
}