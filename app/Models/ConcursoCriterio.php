<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConcursoCriterio extends Model
{
    protected $table = 'concurso_criterios';

    protected $fillable = [
        'concurso_id',
        'criterio_id',
        'aspecto_id',
    ];

    public function concurso()
    {
        return $this->belongsTo(Concurso::class);
    }

    public function criterio()
    {
        return $this->belongsTo(Criterio::class);
    }

    public function aspecto()
    {
        return $this->belongsTo(Aspecto::class);
    }
}