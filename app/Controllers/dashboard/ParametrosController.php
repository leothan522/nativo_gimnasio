<?php

namespace app\Controllers\dashboard;

use app\Controllers\Controller;
use app\Middlewares\Middleware;
use app\Models\Parametro;
use app\Providers\Mail;
use app\Providers\Rule;
use app\Traits\CardView;
use lib\Facades\GUMP;
use PHPMailer\PHPMailer\Exception;

class ParametrosController extends Controller
{
    use CardView;

    public function __construct()
    {
        $this->setMODULO("parametros");
    }

    function index()
    {
        try {
            Middleware::auth('/');
            $data = $this->initData();

            if ($data['totalRows'] > 0){
                $data['ocultarShow'] = false;
                $data['ocultarForm'] = true;
                $data['title'] = "Editar Parametro";
                $data['lastRegistro'] = $this->lastRegistro();
            }else{
                $data['ocultarShow'] = true;
                $data['ocultarForm'] = false;
                $data['title'] = "Crear Parametro";
                $data['lastRegistro'] = null;
            }

            return $this->view('dashboard.parametros.view', $data);

        }catch (\Error|\Exception $e){
            $this->showError('Error en el Controller', $e);
        }
    }

    public function limit()
    {
        try {
            $limit = $_POST['limit'] ?? 0;
            return $this->view('dashboard.parametros.table', $this->initData($limit));

        }catch (\Error|\Exception $e){
            $this->showError('Error en el Controller', $e);
        }
    }

    public function refresh()
    {
        try {
            $limit = $_POST['limit'] ?? 0;
            return $this->view('dashboard.parametros.table', $this->initData($limit, true));

        }catch (\Error|\Exception $e){
            $this->showError('Error en el Controller', $e);
        }
    }

    function store()
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
            $row->ok = true;

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
            }else{
                $data['ok'] = false;
                $data['noToast'] = true;
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

    protected function initData($limit = 0, $refresh = false): array
    {
        if ($refresh){
            $this->limitRows = $limit;
        }else{
            $this->setLimit($limit);
        }
        $model = new Parametro();
        $totalRows = $model->where('id', '!=', 0)->count();
        $parametros = $model->limit($this->limitRows)->all();
        $limitRows = $model->limit($this->limitRows)->count();
        $this->btnVerMas($limitRows, $totalRows);

        $data =[
            "MODULO" => $this->MODULO,
            "totalRows" => $totalRows,
            "limitRows" => $limitRows,
            "limit" => $this->limitRows,
            "btnDisabled" => $this->btnDisabled,
            "listarRegistros" => $parametros,
        ];
        return $data;
    }

    protected function lastRegistro()
    {
        $model = new Parametro();
        $parametro = $model->where('id', '!=', 0)->orderBy('created_at', 'desc')->first();
        if ($parametro){
            return $parametro;
        }else{
            return null;
        }
    }

}