<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aspecto extends Model
{
    protected $fillable = [
        'categoria_id',
        'nombre',
        'descripcion',
        'es_general',
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