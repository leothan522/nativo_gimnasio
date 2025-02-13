<?php

namespace app\Controllers\web;

use app\Controllers\Controller;
use app\Middlewares\Middleware;
use app\Models\User;
use app\Providers\Auth;
use app\Providers\Rule;

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

    public function update()
    {
        try {
            $rules = [
                'email'       => 'required'|'valid_email',
                'name'    => 'required|valid_name|max_len,50|min_len,3',
                'password'    => 'required|max_len,50|min_len,8'
            ];

            $messages = [
                'name' => [
                    'required' => 'El campo nombre es requerido.',
                    'valid_name' => 'El campo nombre debe contener un nombre humano válido.',
                    'max_len' => 'El campo nombre no puede tener más de 50 caracteres de longitud.',
                    'min_len' => 'El campo nombre debe tener al menos 3 caracteres de longitud.'
                ],
                'email' => [
                    'required' => 'El campo correo electrónico es requerido.',
                    'valid_email' => 'Correo electrónico no válido.'
                ],
                'password' => [
                    'required' => 'El campo contraseña es requerido.',
                    'max_len' => 'El campo contraseña no puede tener más de 50 caracteres de longitud',
                    'min_len' => 'El campo contraseña debe tener al menos 8 caracteres de longitud'
                ]

            ];

            $filter = [
                'name' => 'trim',
                'email' => 'sanitize_email'
            ];

            $this->validate($rules, $messages, $filter);

            $model = new User();
            $row = [];

            $user = $model->where('rowquid', $this->VALID_DATA['rowquid'])->first();
            $id = $user->id;

            $db_password = $user->password;
            $cambios = false;
            $db_nombre = $user->name;
            $db_email = $user->email;
            if (password_verify($this->VALID_DATA['password'], $db_password)){

                if ($this->VALID_DATA['name'] != $db_nombre){
                    $cambios = true;
                    $model->update($id, ['name' => $this->VALID_DATA['name']]);
                }

                if ($this->VALID_DATA['email'] != $db_email){
                    $cambios = true;
                    $model->update($id, ['email' => $this->VALID_DATA['email']]);
                }

                if ($cambios){
                    $row = crearResponse(
                        'Datos Actualizados',
                        'Se ha actualizado los datos de su cuenta.',
                        true,
                        'success'
                    );
                }else{
                    $row = crearResponse(
                        'No se realizó ningún cambio.',
                        'Sin Cambios.',
                        false,
                        'info'
                    );
                }

            }else{
                $row = crearResponse();
                $row['errors'] = ['password' => 'La contraseña es incorrecta.'];
            }

            return $this->json($row);

        }catch (\Error|\Exception $e){
            $response = $e->getMessage();
        }

    }

}