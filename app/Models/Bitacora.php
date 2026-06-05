<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model
{
    protected $fillable = [
        'user_id',
        'accion',
        'modulo',
        'detalle',
        'ip',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}