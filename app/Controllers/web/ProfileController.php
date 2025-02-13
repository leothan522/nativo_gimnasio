<?php

namespace app\Controllers\web;

use app\Controllers\Controller;
use app\Middlewares\Middleware;
use app\Providers\Auth;

class ProfileController extends Controller
{
    public function __construct()
    {
        Middleware::auth('login');
    }

    public function index(){
        $data = [
            'modulo' => 'profile',
        ];
        return $this->view('web.profile.view', $data);
    }

}