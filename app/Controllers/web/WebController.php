<?php

namespace app\Controllers\web;

use app\Controllers\Controller;
use app\Middlewares\Middleware;
use app\Models\Membresia;
use app\Models\Persona;
use app\Models\User;
use app\Providers\Auth;
use app\Providers\Rule;

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
        $modelMembresia = new Membresia();
        $id = Auth::user()->id;
        $persona = $model->where('users_id', $id)->first();
        if (!empty($persona)) {
            $existe = 'registrado';
        } else {
            $existe = 'no_registrado';
        }

        $membresias = $modelMembresia->all();

        $data = [
            'modulo' => 'membresia',
            'persona' => $existe,
            'membresias' => $membresias
        ];
        return $this->view('web.membresias.view', $data);
    }

    public function saveMembresia()
    {
        try {
            $model = new Persona();
            $modelUsers = new User();

            $rules = [
                'cedula' => ['required', 'integer', 'unique' => Rule::unique('personas', 'cedula')],
                'name' => 'required|valid_name|max_len,50|min_len,3',
                'telefono' => 'required',
                'direccion' => 'required',
            ];

            $messages = [
                'name' => [
                    'required' => 'El campo nombre es requerido.',
                    'valid_name' => 'El campo nombre debe contener un nombre humano válido.',
                    'max_len' => 'El campo nombre no puede tener más de 50 caracteres de longitud.',
                    'min_len' => 'El campo nombre debe tener al menos 3 caracteres de longitud.'
                ],
                'cedula' => [
                    'required' => 'El campo cédula es requerido.',
                    'integer' => 'El campo cédula debe ser un número entero.',
                ],
                'telefono' => [
                    'required' => 'El campo teléfono es requerido.'
                ],
                'direccion' => [
                    'required' => 'El campo dirección es requerido.'
                ]


            ];

            $filter = [
                'name' => 'trim',
                'email' => 'sanitize_email'
            ];

            $user = $modelUsers->where('id', Auth::user()->id)->first();


            $this->validate($rules, $messages, $filter);
            $data = array_values($this->VALID_DATA);

            $data = [
                'users_id' => $user->id,
                'nombre' => $this->VALID_DATA['name'],
                'cedula' => $this->VALID_DATA['cedula'],
                'telefono' => $this->VALID_DATA['telefono'],
                'direccion' => $this->VALID_DATA['direccion'],
                'token' => generarStringAleatorio(16, true),
                'rowquid' => getRowquid($model)
            ];

            $row = $model->save($data);

            if ($row) {
                $row->ok = true;
            }


            return $this->json($row);

        } catch (\Error|\Exception $e) {
            $this->showError('Error en el Controller', $e);
        }

    }
}