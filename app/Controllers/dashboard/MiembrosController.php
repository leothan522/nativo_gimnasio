<?php

namespace app\Controllers\dashboard;

use app\Controllers\Controller;
use app\Middlewares\Middleware;
use app\Models\Membresia;
use app\Models\Miembro;
use app\Models\Persona;
use app\Models\PersonaMembresia;
use app\Models\User;
use app\Providers\Rule;
use app\Traits\CardView;

class MiembrosController extends Controller
{
    use CardView;

    public function __construct()
    {
        $this->setMODULO("miembros");
    }

    function index()
    {
        try {
            Middleware::auth('/');
            $data = $this->initData();

            $data['title'] = "Miembros";

            if ($data['totalRows'] > 0){
                $data['ocultarShow'] = false;
                $data['ocultarForm'] = true;

                $row = $this->lastRegistro();
                $data['lastRegistro'] = $row;
                $this->setActualRowquid($row->rowquid);
                $data['actualRowquid'] = $this->getActualRowquid();
            }else{
                $data['ocultarShow'] = true;
                $data['ocultarForm'] = false;
                $data['lastRegistro'] = null;
                $data['actualRowquid'] = null;
            }

            return $this->view('dashboard.miembros.view', $data);

        }catch (\Error|\Exception $e){
            $this->showError('Error en el Controller', $e);
        }
    }

    public function limit()
    {
        try {
            $limit = $_POST['limit'] ?? 0;
            $data = $this->initData();
            return $this->view('dashboard.miembros.table', $this->initData($limit));

        }catch (\Error|\Exception $e){
            $this->showError('Error en el Controller', $e);
        }
    }

    public function refresh()
    {
        try {
            $limit = $_POST['limit'] ?? 0;
            $data = $this->initData($limit, true);
            $data['actualRowquid'] = $this->getActualRowquid();
            return $this->view('dashboard.miembros.table', $data);

        }catch (\Error|\Exception $e){
            $this->showError('Error en el Controller', $e);
        }
    }

    function save()
    {
        try {

            $rules = [
                "cedula" => ['required', 'integer', 'unique' => Rule::unique('personas', 'cedula')],
                "email" => ['required', 'valid_email', 'unique' => Rule::unique('users', 'email')],
                "nombre" => "required",
                "telefono" => "required",
                "direccion" => "required",
                "inscripcion" => "required",
                "membresia" => "required",
                "inicio" => "required",
                "status" => "required",
            ];

            $messages = [
                //"nombre" => ["alpha_numeric_dash" => "alpha_numeric_dash"]
            ];

            $filter = [
                "nombre" => "trim|sanitize_string",
                "telefono" => "trim|sanitize_string",
                "email" => "trim|sanitize_email|lower_case",
                "direccion" => "sanitize_string"
            ];

            $this->validate($rules, $messages, $filter);

            $initData = $this->VALID_DATA;

            $modelUser = new User();
            $dataUser = [
                $initData['nombre'],
                $initData['email'],
                password_hash($initData['cedula'], PASSWORD_DEFAULT),
                getRowquid($modelUser),
            ];
            $user = $modelUser->save($dataUser);

            $modelPersona = new Persona();
            $dataPersona = [
                $user->id,
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
                $initData['inscripcion'],
                getRowquid($modelMiembro),
            ];
            $miembro = $modelMiembro->save($dataMiembro);

            $modelPersonaMembresia = new PersonaMembresia();
            $dataMembresia = [
                $persona->id,
                $initData['membresia'],
                $initData['inicio'],
                $initData['status'],
                getRowquid($modelPersonaMembresia),
            ];
            $personaMembresia = $modelPersonaMembresia->save($dataMembresia);

            $modelmembresia = new Membresia();
            $membresia = $modelmembresia->find($personaMembresia->membresias_id);

            $this->setActualRowquid($miembro->rowquid);

            $status = 0;

            if ($personaMembresia->status == 0){
                $status = "Pendiente por Pago";
            }

            if ($personaMembresia->status == 1){
                $status = "Activa";
            }

            if ($personaMembresia->status == 2){
                $status = "Inactiva";
            }

            $data = [
                "users_id"=> $user->id,
                "nombre"=> $persona->nombre,
                "cedula"=> $persona->cedula,
                "ver_cedula"=> formatoMillares($persona->cedula, 0),
                "telefono"=> $persona->telefono,
                "direccion"=> $persona->direccion,
                "token"=> $persona->token,
                "inscripcion"=> $miembro->inscripcion,
                "ver_inscripcion"=> getFecha($miembro->inscripcion),
                "rowquid"=> $miembro->rowquid,
                "email"=> $user->email,
                "inicio"=> $personaMembresia->fecha,
                "ver_inicio"=> getFecha($personaMembresia->fecha),
                "status"=> $personaMembresia->status,
                "ver_status"=> $status,
                "membresia_id"=> $personaMembresia->membresias_id,
                "membresia_nombre"=> $membresia->nombre,
                "membresia_duracion"=> $membresia->duracion,
                "membresia_precio"=> $membresia->precio,
                "ok"=> true,
                "actualRowquid"=> $this->getActualRowquid()
            ];

            return $this->json($data);

        }catch (\Error|\Exception $e){
            $this->showError('Error en el Controller', $e);
        }

    }

    function update()
    {
        try {

            $persona = null;
            $rowquid = $_POST['rowquid'] ?? 'NULL';
            $model = new Miembro();
            $modelPersona = new Persona();
            $modelPersonaMembresia = new PersonaMembresia();
            $existe = $model->where('rowquid', $rowquid)->first();
            if ($existe){
                $initPersona = $modelPersona->find($existe->personas_id);
                $initPersonaMembresia = $modelPersonaMembresia->where('personas_id', $initPersona->id)->first();
            }

            $rules = [
                "cedula" => ['required', 'integer', 'unique' => Rule::unique('personas', 'cedula', $initPersona->id)],
                "email" => ['required', 'valid_email', 'unique' => Rule::unique('users', 'email', $initPersona->users_id)],
                "nombre" => "required",
                "telefono" => "required",
                "direccion" => "required",
                "inscripcion" => "required",
                "membresia" => "required",
                "inicio" => "required",
                "status" => "required",
            ];

            $messages = [
                //"nombre" => ["alpha_numeric_dash" => "alpha_numeric_dash"]
            ];

            $filter = [
                "nombre" => "trim|sanitize_string",
                "telefono" => "trim|sanitize_string",
                "email" => "trim|sanitize_email|lower_case",
                "direccion" => "sanitize_string"
            ];

            $this->validate($rules, $messages, $filter);

            unset($this->VALID_DATA['rowquid']);

            if ($existe){

                $initData = $this->VALID_DATA;

                $modelUser = new User();
                $dataUser = [
                    'name' => $initData['nombre'],
                    'email' => $initData['email'],
                ];
                $user = $modelUser->update($initPersona->users_id, $dataUser);

                $modelPersona = new Persona();
                $dataPersona = [
                    'nombre' => $initData['nombre'],
                    'cedula' => $initData['cedula'],
                    'telefono' => $initData['telefono'],
                    'direccion' => $initData['direccion'],
                ];
                $persona = $modelPersona->update($initPersona->id, $dataPersona);

                $modelMiembro = new Miembro();
                $dataMiembro = [
                    'inscripcion' => $initData['inscripcion'],
                ];
                $miembro = $modelMiembro->update($existe->id, $dataMiembro);

                $modelPersonaMembresia = new PersonaMembresia();
                $dataMembresia = [
                    'membresias_id' => $initData['membresia'],
                    'fecha' => $initData['inicio'],
                    'status' => $initData['status'],
                ];
                $personaMembresia = $modelPersonaMembresia->update($initPersonaMembresia->id, $dataMembresia);

                $modelmembresia = new Membresia();
                $membresia = $modelmembresia->find($personaMembresia->membresias_id);

                $this->setActualRowquid($miembro->rowquid);

                $status = 0;

                if ($personaMembresia->status == 0){
                    $status = "Pendiente por Pago";
                }

                if ($personaMembresia->status == 1){
                    $status = "Activa";
                }

                if ($personaMembresia->status == 2){
                    $status = "Inactiva";
                }

                $row = [
                    "users_id"=> $user->id,
                    "nombre"=> $persona->nombre,
                    "cedula"=> $persona->cedula,
                    "ver_cedula"=> formatoMillares($persona->cedula, 0),
                    "telefono"=> $persona->telefono,
                    "direccion"=> $persona->direccion,
                    "token"=> $persona->token,
                    "inscripcion"=> $miembro->inscripcion,
                    "ver_inscripcion"=> getFecha($miembro->inscripcion),
                    "rowquid"=> $miembro->rowquid,
                    "email"=> $user->email,
                    "inicio"=> $personaMembresia->fecha,
                    "ver_inicio"=> getFecha($personaMembresia->fecha),
                    "status"=> $personaMembresia->status,
                    "ver_status"=> $status,
                    "membresia_id"=> $personaMembresia->membresias_id,
                    "membresia_nombre"=> $membresia->nombre,
                    "membresia_duracion"=> $membresia->duracion,
                    "membresia_precio"=> $membresia->precio,
                    "ok"=> true,
                    "actualRowquid"=> $this->getActualRowquid()
                ];

            }else{
                $row = crearResponse('Token de seguridad vencido por favor actualice.', null);
            }

            return $this->json($row);

        }catch (\Error|\Exception $e){
            $this->showError('Error en el Controller', $e);
        }

    }

    public function show()
    {
        try {

            $rowquid = $_POST['rowquid'];
            $model = new Miembro();
            $modelPersona = new Persona();
            $modelUser = new User();
            $modelPersonaMembresia = new PersonaMembresia();
            $modelMembreseia = new Membresia();
            $parametro = $model->where('rowquid', $rowquid)->first();
            if ($parametro){

                $miembros = null;
                $id = $parametro->personas_id;
                $persona = $modelPersona->find($id);
                if ($persona){

                    $myObj = new \stdClass();
                    $myObj->users_id = $persona->users_id;
                    $myObj->nombre = $persona->nombre;
                    $myObj->cedula = $persona->cedula;
                    $myObj->ver_cedula = formatoMillares($persona->cedula, 0);
                    $myObj->telefono = $persona->telefono;
                    $myObj->direccion = $persona->direccion;
                    $myObj->token = $persona->token;
                    $myObj->inscripcion = $parametro->inscripcion;
                    $myObj->ver_inscripcion = getFecha($parametro->inscripcion);
                    $myObj->rowquid = $parametro->rowquid;

                    $user = $modelUser->find($persona->users_id);
                    $myObj->email = $user->email;

                    $personaMembresia = $modelPersonaMembresia->where('personas_id', $persona->id)->first();
                    if ($personaMembresia){
                        $idMembresia = $personaMembresia->membresias_id;
                        $myObj->inicio = $personaMembresia->fecha;
                        $myObj->ver_inicio = getFecha($personaMembresia->fecha);

                        $myObj->status = $personaMembresia->status;

                        if ($personaMembresia->status == 0){
                            $myObj->ver_status = "Pendiente por Pago";
                        }

                        if ($personaMembresia->status == 1){
                            $myObj->ver_status = "Activa";
                        }

                        if ($personaMembresia->status == 2){
                            $myObj->ver_status = "Inactiva";
                        }

                        $membresia = $modelMembreseia->find($idMembresia);
                        $myObj->membresia_id = $membresia->id;
                        $myObj->membresia_nombre = $membresia->nombre;
                        $myObj->membresia_duracion = $membresia->duracion;
                        $myObj->membresia_precio = $membresia->precio;


                    }else{
                        $myObj->inicio = '-';
                        $myObj->ver_inicio = '-';
                        $myObj->status = '';
                        $myObj->ver_status = '';
                        $myObj->membresia_id = '';
                        $myObj->membresia_nombre = '-';
                        $myObj->membresia_duracion = '-';
                        $myObj->membresia_precio = '-';
                    }
                    $miembros = $myObj;

                    $miembros->ok = true;
                    $miembros->noToast = true;
                    $data = $miembros;
                    $this->setActualRowquid($miembros->rowquid);
                    $data->actualRowquid = $this->getActualRowquid();

                }else{
                    $data['ok'] = false;
                    $data['noToast'] = true;
                    $data['actualRowquid'] = null;
                }
            }else{
                $data['ok'] = false;
                $data['noToast'] = true;
                $data['actualRowquid'] = null;
            }

            return $this->json($data);

        }catch (\Error|\Exception $e){
            $this->showError('Error en el Controller', $e);
        }
    }

    public function destroy()
    {
        try {

            $rowquid = $_POST['rowquid'];
            $model = new Miembro();
            $parametro = $model->where('rowquid', $rowquid)->first();
            if ($parametro){
                /*$data = [
                    'nombre' => "*".$parametro->nombre,
                ];
                $model->update($parametro->id, $data);*/
                $model->delete($parametro->id);
                $data['ok'] = true;
            }else{
                $data['ok'] = false;
                $data['noToast'] = true;
            }
            if ($this->lastRegistro()){
                $ultimo = $this->lastRegistro();
                $data['lastRegistro'] = true;
                $data['rowquid'] = $ultimo->rowquid;
            }else{
                $data['lastRegistro'] = false;
            }

            return $this->json($data);

        }catch (\Error|\Exception $e){
            $this->showError('Error en el Controller', $e);
        }
    }

    public function search()
    {
        try {
            $keyword = $_POST['keyword'] ?? '';
            $data = $this->initData(0, false, $keyword);
            $data['keyword'] = $keyword;
            $data['actualRowquid'] = $this->getActualRowquid();
            return $this->view('dashboard.miembros.table', $data);

        }catch (\Error|\Exception $e){
            $this->showError('Error en el Controller', $e);
        }
    }

    protected function initData($limit = 0, $refresh = false, $keyword = ''): array
    {
        if ($refresh){
            $this->limitRows = $limit;
        }else{
            $this->setLimit($limit);
        }

        $model = new Miembro();
        $modelPersona = new Persona();
        $modelMembresia = new Membresia();
        $membresias = $modelMembresia->all();

        $totalRows = $model->where('id', '!=', 0)->count();

        if (empty($keyword)){
            $parametros = $model->limit($this->limitRows)->orderBy('created_at', 'DESC')->all();
            $limitRows = $model->limit($this->limitRows)->count();

            $miembros = array();
            $i = 0;
            foreach ($parametros as $parametro){
                $id = $parametro->personas_id;
                $persona = $modelPersona->find($id);
                if ($persona){
                    $myObj = new \stdClass();
                    $myObj->cedula = $persona->cedula;
                    $myObj->nombre = $persona->nombre;
                    $myObj->rowquid = $parametro->rowquid;
                    $miembros[] = $myObj;
                }
            }


        }else{
            $sql = "SELECT * FROM `personas` WHERE deleted_at IS NULL AND `cedula` LIKE '%$keyword%' OR `nombre` LIKE '%$keyword%' ORDER BY `created_at` DESC LIMIT 100;";
            $parametros = $model->query($sql)->get();
            $limitRows = $model->query($sql)->count();
            $miembros = array();
            foreach ($parametros as $parametro){
                $miembro = $model->where('personas_id', $parametro->id)->first();
                if ($miembro){
                    $myObj = new \stdClass();
                    $myObj->cedula = $parametro->cedula;
                    $myObj->nombre = $parametro->nombre;
                    $myObj->rowquid = $miembro->rowquid;
                    $miembros[] = $myObj;
                }
            }
        }

        $this->btnVerMas($limitRows, $totalRows);

        $data =[
            "MODULO" => $this->MODULO,
            "totalRows" => $totalRows,
            "limitRows" => $limitRows,
            "limit" => $this->limitRows,
            "btnDisabled" => $this->btnDisabled,
            "listarRegistros" => $miembros,
            "listarMembresias" => $membresias,
        ];
        return $data;
    }

    protected function lastRegistro()
    {
        $model = new Miembro();
        $modelPersona = new Persona();
        $modelUser = new User();
        $modelPersonaMembresia = new PersonaMembresia();
        $modelMembreseia = new Membresia();

        $parametro = $model->orderBy('created_at', 'DESC')->where('id', '!=', 0)->first();
        if ($parametro){
            $miembros = null;
            $id = $parametro->personas_id;
            $persona = $modelPersona->find($id);
            if ($persona){

                $myObj = new \stdClass();
                $myObj->users_id = $persona->users_id;
                $myObj->nombre = $persona->nombre;
                $myObj->cedula = $persona->cedula;
                $myObj->telefono = $persona->telefono;
                $myObj->direccion = $persona->direccion;
                $myObj->token = $persona->token;
                $myObj->inscripcion = $parametro->inscripcion;
                $myObj->rowquid = $parametro->rowquid;

                $user = $modelUser->find($persona->users_id);
                $myObj->email = $user->email;

                $personaMembresia = $modelPersonaMembresia->where('personas_id', $persona->id)->first();
                if ($personaMembresia){
                    $idMembresia = $personaMembresia->membresias_id;
                    $myObj->inicio = $personaMembresia->fecha;

                    if ($personaMembresia->status == 0){
                        $myObj->status = "Esperando Aprobación";
                    }

                    if ($personaMembresia->status == 1){
                        $myObj->status = "Activa";
                    }

                    if ($personaMembresia->status == 0){
                        $myObj->status = "Inactiva";
                    }

                    $membresia = $modelMembreseia->find($idMembresia);
                    $myObj->membresia_nombre = $membresia->nombre;
                    $myObj->membresia_duracion = $membresia->duracion;
                    $myObj->membresia_precio = $membresia->precio;


                }else{
                    $myObj->inicio = '-';
                    $myObj->status = '-';
                    $myObj->membresia_nombre = '-';
                    $myObj->membresia_duracion = '-';
                    $myObj->membresia_precio = '-';
                }




                $miembros = $myObj;
            }
            return $miembros;
        }else{
            return null;
        }
    }

}