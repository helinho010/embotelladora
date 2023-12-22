<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grupo;

class GrupoController extends Controller
{
    public function listarGrupos(Request $request){
        $listaGruposBD = Grupo::where('activo',1)
                               ->get();
        return $listaGruposBD;
    }
}
