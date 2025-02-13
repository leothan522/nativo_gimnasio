<?php

namespace app\Traits;

trait CardView
{
    public string $MODULO = "dashboard";
    public array $data = [];

    public function setMODULO(string $MODULO): void
    {
        $this->MODULO = $MODULO;
    }

    public function getData(): void
    {
        $this->data = [
            "MODULO" => $this->MODULO,
        ];
    }
}