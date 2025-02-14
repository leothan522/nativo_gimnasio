<?php

namespace app\Models;

class Cargo extends Model
{
    protected bool $softDelete = true;
    protected string $table = "cargos";

    protected array $fillable = [
        'cargo',
        'sueldo',
        'moneda',
        'rowquid',
    ];
}