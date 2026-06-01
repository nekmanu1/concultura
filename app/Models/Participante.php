<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participante extends Model
{
    protected $fillable = [
        'concurso_id',
        'nombre',
        'cedula',
        'telefono',
        'correo',
        'descripcion',
    ];

    public function concurso()
    {
        return $this->belongsTo(Concurso::class);
    }
    public function evaluaciones()
    {
    return $this->hasMany(Evaluacion::class);
    }
}