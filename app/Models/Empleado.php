<?php

namespace app\Models;

class Empleado extends Model
{
    protected bool $softDelete = true;
    protected string $table = "empleados";
    protected array $fillable = [
        'personas_id',
        'cargos_id',
        'horarios_id',
        'fecha',
        'created_at'
    ];
}