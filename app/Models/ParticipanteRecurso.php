<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParticipanteRecurso extends Model
{
    protected $fillable = [
        'participante_id',
        'titulo',
        'url',
    ];

    public function participante()
    {
        return $this->belongsTo(Participante::class);
    }
}