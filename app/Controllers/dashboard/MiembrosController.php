<?php

namespace app\Controllers\dashboard;

use app\Controllers\Controller;
use app\Middlewares\Middleware;
use app\Models\Membresia;
use app\Models\Miembro;
use app\Models\Parametro;
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
                //"nombre" => "required|alpha_numeric_dash",
                "nombre" => ['required', 'alpha_numeric_dash', 'unique' => Rule::unique('parametros', 'nombre')],
                "tabla_id" => "required|integer",
                "valor" => "required"
            ];

            $messages = [
                "nombre" => ["alpha_numeric_dash" => "alpha_numeric_dash"]
            ];

            $filter = [
                "nombre" => "trim|sanitize_string|lower_case",
                "valor" => "trim|sanitize_string"
            ];

            $this->validate($rules, $messages, $filter);

            $model = new Parametro();
            $data = array_values($this->VALID_DATA);
            $data[] = getRowquid($model);
            $row = $model->save($data);
            $this->setActualRowquid($row->rowquid);
            $row->actualRowquid = $this->getActualRowquid();
            $row->ok = true;

            return $this->json($row);

        }catch (\Error|\Exception $e){
            $this->showError('Error en el Controller', $e);
        }

    }

    function update()
    {
        try {

            $id = 0;
            $rowquid = $_POST['rowquid'] ?? 'NULL';
            $model = new Parametro();
            $existe = $model->where('rowquid', $rowquid)->first();
            if ($existe){
                $id = $existe->id;
            }

            $rules = [
                //"nombre" => "required|alpha_numeric_dash",
                "nombre" => ['required', 'alpha_numeric_dash', 'unique' => Rule::unique('parametros', 'nombre', $id)],
                "tabla_id" => "required|integer",
                "valor" => "required"
            ];

            $messages = [
                "nombre" => ["alpha_numeric_dash" => "alpha_numeric_dash"]
            ];

            $filter = [
                "nombre" => "trim|sanitize_string|lower_case",
                "valor" => "trim|sanitize_string"
            ];

            $this->validate($rules, $messages, $filter);

            $data   = $this->VALID_DATA;
            $rowquid = $data['rowquid'];
            unset($data['rowquid']);

            if ($existe){
                $row = $model->update($existe->id, $data);
                $row->ok = true;
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
            $model = new Parametro();
            $parametro = $model->where('rowquid', $rowquid)->first();
            if ($parametro){
                $parametro->ok = true;
                $parametro->noToast = true;
                $data = $parametro;
                $this->setActualRowquid($parametro->rowquid);
                $data->actualRowquid = $this->getActualRowquid();
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
            $model = new Parametro();
            $parametro = $model->where('rowquid', $rowquid)->first();
            if ($parametro){
                $data = [
                    'nombre' => "*".$parametro->nombre,
                ];
                $model->update($parametro->id, $data);
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
            $sql = "SELECT * FROM `miembros` WHERE deleted_at IS NULL AND `personas_id` LIKE '%$keyword%' OR `id` LIKE '%$keyword%' ORDER BY `created_at` DESC LIMIT 100;";
            $parametros = $model->query($sql)->get();
            $limitRows = $model->query($sql)->count();
            $miembros = null;
        }

        $this->btnVerMas($limitRows, $totalRows);

        $data =[
            "MODULO" => $this->MODULO,
            "totalRows" => $totalRows,
            "limitRows" => $limitRows,
            "limit" => $this->limitRows,
            "btnDisabled" => $this->btnDisabled,
            "listarRegistros" => $miembros,
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