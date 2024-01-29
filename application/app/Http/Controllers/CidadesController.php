<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estado;
use App\Models\Cidade;

class CidadesController extends Controller
{
    public function getCidadesPorEstado($estado_id)
    {
        $cidades = Cidade::where('estado_id', $estado_id)->get();
        return response()->json($cidades);
    }
}
