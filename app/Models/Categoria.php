<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'estado',
    ];

    public function aspectos()
    {
        return $this->hasMany(Aspecto::class);
    }
    public function criterios()
    {
    return $this->hasMany(Criterio::class);
    }
    public function concursos()
    {
    return $this->hasMany(Concurso::class);
    }
}