<?php

namespace app\Models;

class Persona extends Model
{
    protected bool $softDelete = true;
    protected string $table = "personas";

    protected array $fillable = [
        'users_id',
        'nombre',
        'cedula',
        'telefono',
        'direccion',
        'token',
        'rowquid',
    ];

}