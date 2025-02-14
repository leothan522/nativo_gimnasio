<?php

namespace app\Models;

class PersonaMembresia extends Model
{
    protected bool $softDelete = true;
    protected string $table = "personas_membresias";

    protected array $fillable = [
        'personas_id',
        'membresias_id',
        'fecha',
        'rowquid',
    ];
}