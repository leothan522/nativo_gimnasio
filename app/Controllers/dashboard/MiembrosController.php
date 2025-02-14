<?php

namespace app\Controllers\dashboard;

use app\Controllers\Controller;
use app\Middlewares\Middleware;
use app\Models\Miembro;
use app\Models\Parametro;
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
        $totalRows = $model->where('id', '!=', 0)->count();

        if (empty($keyword)){
            $parametros = $model->limit($this->limitRows)->orderBy('created_at', 'DESC')->all();
            $limitRows = $model->limit($this->limitRows)->count();
        }else{
            $sql = "SELECT * FROM `miembros` WHERE deleted_at IS NULL AND `personas_id` LIKE '%$keyword%' OR `id` LIKE '%$keyword%' ORDER BY `created_at` DESC LIMIT 100;";
            $parametros = $model->query($sql)->get();
            $limitRows = $model->query($sql)->count();
        }

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
        $model = new Miembro();
        $parametro = $model->orderBy('created_at', 'DESC')->where('id', '!=', 0)->first();
        if ($parametro){
            return $parametro;
        }else{
            return null;
        }
    }

}