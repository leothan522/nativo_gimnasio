<?php

namespace app\Models;

class Notificacion extends Model
{
    protected bool $softDelete = true;
    protected string $table = "notificaciones";

    protected array $fillable = [
        'asunto',
        'mensaje',
        'users_id',
        'created_at',
    ];
}