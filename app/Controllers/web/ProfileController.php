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

            $id = 0;
            $rowquid = $_POST['rowquid'] ?? 'NULL';
            $model = new User();
            $existe = $model->where('rowquid', $rowquid)->first();
            if ($existe){
                $id = $existe->id;
            }

            $rules = [
                'email'       => ['required', 'valid_email', 'unique' => Rule::unique('users', 'email', $id)],
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

            $db_password = $existe->password;
            $db_email = $existe->email;
            $db_name = $existe->name;
            $cambios = false;

            if (password_verify($this->VALID_DATA['password'], $db_password)){
                if ($this->VALID_DATA['email'] != $db_email){
                    $cambios = true;
                    $model->update($existe->id, ['email' => $this->VALID_DATA['email']]);
                }

                if ($this->VALID_DATA['name'] != $db_name){
                    $cambios = true;
                    $model->update($existe->id, ['name' => $this->VALID_DATA['name']]);
                }

                if ($cambios){
                    $user = $model->find($existe->id);
                    $response =crearResponse(
                        'Datos actualizados exitosamente.',
                        'Datos Actualizados.',
                        true
                    );
                    $response['name'] = $user->name;
                    $response['email'] = $user->email;
                }else{
                    $response = crearResponse(
                        'No se realizó ningun cambio.',
                        'Sin Cambios.',
                        false,
                        'info'
                    );
                }

            }else{
                $response =  crearResponse(
                    'La contraseña es incorrecta.',
                    'Contraseña Incorrecta.',
                    false,
                    'warning'
                );
            }


            return $this->json($response);

        }catch (\Error|\Exception $e){
            $response = $e->getMessage();
        }

    }

}