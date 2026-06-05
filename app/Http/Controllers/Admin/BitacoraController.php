<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bitacora;
use Illuminate\Http\Request;

class BitacoraController extends Controller
{
    public function index(Request $request)
    {
        $query = Bitacora::with('usuario')->latest();

        if ($request->filled('buscar')) {
            $buscar = $request->buscar;

            $query->where(function ($q) use ($buscar) {
                $q->where('accion', 'like', "%{$buscar}%")
                  ->orWhere('modulo', 'like', "%{$buscar}%")
                  ->orWhere('detalle', 'like', "%{$buscar}%")
                  ->orWhereHas('usuario', function ($u) use ($buscar) {
                      $u->where('name', 'like', "%{$buscar}%")
                        ->orWhere('email', 'like', "%{$buscar}%");
                  });
            });
        }

        $bitacoras = $query->paginate(15);

        return view('admin.bitacoras.index', compact('bitacoras'));
    }
}