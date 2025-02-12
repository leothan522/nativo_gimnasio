<?php

namespace app\Controllers\web;

use app\Controllers\Controller;
use app\Middlewares\Middleware;

class GuestController extends Controller
{

    public function __construct()
    {
        Middleware::guest('/');
    }

    public function login($type = "miembros")
    {
        return $this->view('auth.login', ['type' => $type]);

    }

    public function register(){
        return $this->view('auth.register');
    }

    public function forgotPassword()
    {
        return $this->view('auth.forgot-password');
    }

    public function resetPassword()
    {
        return $this->view('auth.reset-password');
    }


}