<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Criterio extends Model
{
    protected $fillable = [
        'categoria_id',
        'nombre',
        'descripcion',
        'puntaje_maximo',
        'estado',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
    public function concursoCriterios()
    {
        return $this->hasMany(ConcursoCriterio::class);
    }
}