<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConcursoJurado extends Model
{
    protected $table = 'concurso_jurados';

    protected $fillable = [
        'concurso_id',
        'user_id',
    ];

    public function concurso()
    {
        return $this->belongsTo(Concurso::class);
    }

    public function jurado()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}