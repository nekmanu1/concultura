<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{
    protected $table = 'evaluacions';

    protected $fillable = [
        'concurso_id',
        'participante_id',
        'jurado_id',
        'criterio_id',
        'aspecto_id',
        'puntaje',
        'observacion',
    ];

    public function concurso()
    {
        return $this->belongsTo(Concurso::class);
    }

    public function participante()
    {
        return $this->belongsTo(Participante::class);
    }

    public function jurado()
    {
        return $this->belongsTo(User::class, 'jurado_id');
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