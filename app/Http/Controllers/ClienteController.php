<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{
    

    public function listarClientes(Request $request){
        $clientesBD = Cliente::where("activo",1)
                            ->get(); 
        return $clientesBD;
    }

    public function crearCliente(Request $request){
        
        $nuevoCliente = new Cliente();
        
        if($request->hasFile('file'))
        {
            $filename=$request->file->getClientOriginalName();
            $nuevoCliente->imagen=$request->file('file')->store('public');
        }else{
            return "No! It's not a File";
        }
        $nuevoCliente->latitud = $request->latitud;
        $nuevoCliente->longitud = $request->longitud;
        $nuevoCliente->nombre_ubicacion = $request->nombre_ubicacion;
        $nuevoCliente->fecha = $request->fecha;
        $nuevoCliente->direccion = $request->direccion;
        $nuevoCliente->numero_contacto = $request->numero_contacto;
        $nuevoCliente->nota = $request->nota;
        $nuevoCliente->id_grupo = $request->id_grupo;
        return $nuevoCliente->save();
    }
}
