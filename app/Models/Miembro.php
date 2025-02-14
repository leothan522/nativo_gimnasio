<?php

namespace app\Models;

class Miembro extends Model
{
    protected bool $softDelete = true;
    protected string $table = "miembros";

    protected array $fillable = [
        'personas_id',
        'inscripcion',
        'rowquid',
    ];

}