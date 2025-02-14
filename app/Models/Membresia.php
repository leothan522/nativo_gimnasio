<?php

namespace app\Models;
class Membresia extends Model
{
    protected bool $softDelete = true;
    protected string $table = "membresias";

    protected array $fillable = [
        'nombre',
        'duracion',
        'precio',
        'status',
        'rowquid',
    ];

}