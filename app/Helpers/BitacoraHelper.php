<?php

namespace App\Helpers;

use App\Models\Bitacora;

class BitacoraHelper
{
    public static function registrar($accion, $modulo, $detalle = null)
    {
        Bitacora::create([
            'user_id' => auth()->id(),
            'accion' => $accion,
            'modulo' => $modulo,
            'detalle' => $detalle,
            'ip' => request()->ip(),
        ]);
    }
}