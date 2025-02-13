<?php

namespace app\Models;

class Horario extends Model
{
    protected bool $softDelete = true;
    protected string $table = "horarios";

    protected array $fillable = [
        'dias',
        'horas',
        'nombre',
        'created_at',
    ];
}