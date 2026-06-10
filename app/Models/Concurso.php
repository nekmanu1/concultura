<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Concurso extends Model
{
    protected $fillable = [
        'categoria_id',
        'nombre',
        'descripcion',
        'fecha_inicio',
        'fecha_fin',
        'estado',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function participantes()
    {
    return $this->hasMany(Participante::class);
    }

    public function concursoCriterios()
    {
        return $this->hasMany(ConcursoCriterio::class);
    }

    public function criterios()
    {
        return $this->belongsToMany(Criterio::class, 'concurso_criterios')
          ->withPivot('aspecto_id')
          ->withTimestamps();
    }

    public function evaluaciones()
    {
    return $this->hasMany(Evaluacion::class);
    }

public function jurados()
{
    return $this->belongsToMany(User::class, 'concurso_jurados', 'concurso_id', 'user_id')
        ->withTimestamps();
}



}