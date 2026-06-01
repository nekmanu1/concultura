<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConcursoJuradoAspecto extends Model
{
    protected $table = 'concurso_jurado_aspectos';

    protected $fillable = [
        'concurso_id',
        'user_id',
        'aspecto_id',
    ];

    public function concurso()
    {
        return $this->belongsTo(Concurso::class);
    }

    public function jurado()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function aspecto()
    {
        return $this->belongsTo(Aspecto::class);
    }
}