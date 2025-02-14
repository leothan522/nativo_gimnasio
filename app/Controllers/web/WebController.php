<?php

namespace app\Controllers\web;

use app\Controllers\Controller;
use app\Middlewares\Middleware;
use app\Models\Membresia;
use app\Models\Miembro;
use app\Models\Persona;
use app\Models\PersonaMembresia;
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
        $modelPersona = new PersonaMembresia();
        $modelMembresia = new Membresia();
        $modelMiembro =  new Miembro();
        $id = Auth::user()->id;

        $miembro = false;
        $inscripcion = null;
        $membresia = '-';
        $duracion = '-';
        $precio = '-';
        $inicio = null;
        $estatus = '-';

        $persona = $model->where('users_id', $id)->first();
        if ($persona) {
            $miembro = true;
            $personaMiembro = $modelMiembro->where('personas_id', $persona->id)->first();
            $personaMembresia = $modelPersona->where('personas_id', $persona->id)->first();
            $plan = $modelMembresia->find($personaMembresia->membresias_id);

            $inscripcion = $personaMiembro->inscripcion;
            $membresia = $plan->nombre;
            $duracion = $plan->duracion;
            $precio = $plan->precio;
            $inicio = $personaMembresia->fecha;

            if ($personaMembresia->status == 0){
                $estatus = "Pendiente por Pago";
            }

            if ($personaMembresia->status == 1){
                $estatus = "Activa";
            }

            if ($personaMembresia->status == 2){
                $estatus = "Inactiva";
            }
        }

        $membresias = $modelMembresia->all();

        $data = [
            'modulo' => 'membresia',
            'miembro' => $miembro,
            'inscripcion' => $inscripcion,
            'membresia' => $membresia,
            'duracion' => $duracion,
            'precio' => $precio,
            'inicio' => $inicio,
            'estatus' => $estatus,
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
                'membresia' => 'required',
                'inicio' => 'required',
                'nombre' => 'required|valid_name|max_len,50|min_len,3',
                'cedula' => ['required', 'integer', 'unique' => Rule::unique('personas', 'cedula')],
                'telefono' => 'required',
                'direccion' => 'required',
            ];

            $messages = [
                'nombre' => [
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
                'nombre' => 'trim',
                'email' => 'sanitize_email'
            ];

            $this->validate($rules, $messages, $filter);

            $initData = $this->VALID_DATA;

            $modelPersona = new Persona();
            $dataPersona = [
                Auth::user()->id,
                $initData['nombre'],
                $initData['cedula'],
                $initData['telefono'],
                $initData['direccion'],
                generarStringAleatorio(16, true),
                getRowquid($modelPersona),
            ];
            $persona = $modelPersona->save($dataPersona);

            $modelMiembro = new Miembro();
            $dataMiembro = [
                $persona->id,
                getFecha(),
                getRowquid($modelMiembro),
            ];
            $miembro = $modelMiembro->save($dataMiembro);

            $modelPersonaMembresia = new PersonaMembresia();
            $dataMembresia = [
                $persona->id,
                $initData['membresia'],
                $initData['inicio'],
                0,
                getRowquid($modelPersonaMembresia),
            ];
            $personaMembresia = $modelPersonaMembresia->save($dataMembresia);

            $modelmembresia = new Membresia();
            $membresia = $modelmembresia->find($personaMembresia->membresias_id);

            $data = [
                'modulo' => 'membresia',
                'miembro' => true,
                'inscripcion' => $miembro->inscripcion,
                'membresia' => $membresia->nombre,
                'duracion' => $membresia->duracion,
                'precio' => $membresia->precio,
                'inicio' => $personaMembresia->fecha,
                'estatus' => $personaMembresia->status,
                'ok' => true
            ];

            return $this->json($data);

        } catch (\Error|\Exception $e) {
            $this->showError('Error en el Controller', $e);
        }

    }
}