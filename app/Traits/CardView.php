<?php

namespace app\Traits;

use app\Models\Parametro;

trait CardView
{
    public string $MODULO = "dashboard";
    public int $limitRows = 0;
    public bool $btnDisabled = true;

    public function setMODULO(string $MODULO): void
    {
        $this->MODULO = $MODULO;
    }

    public function setLimit($limit = 0, array $limits = []): void
    {
        if (empty($limits)){
            if ($limit){
                $this->limitRows = $limit + $this->numRowsPaginate();
            }else{
                $this->limitRows = $this->limitRows + $this->numRowsPaginate();
            }
        }else{
            foreach ($limits as $key){

                if ($limit){
                    $this->$key = $limit + $this->numRowsPaginate();
                }else{
                    $this->$key = $this->$key + $this->numRowsPaginate();
                }
            }
        }
    }

    public function btnVerMas($limitRows, $totalRows, array $buttons = []): void
    {
        if ($totalRows > $limitRows) {
            if (empty($buttons)){
                $this->btnDisabled = false;
            }else{
                foreach ($buttons as $button){
                    $this->$button = false;
                }
            }

        }else{
            if (empty($buttons)){
                $this->btnDisabled = true;
            }else{
                foreach ($buttons as $button){
                    $this->$button = true;
                }
            }
        }
    }

    public function numRowsPaginate(): int
    {
        $num = 1;
        $model = new Parametro();
        $parametro = $model->where('nombre', "numRowsPaginate")->first();
        if ($parametro){
            if (intval($parametro->valor)){
                $num = intval($parametro->valor);
            }
        }
        return $num;
    }

}