<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Finca;
use App\Models\User;
class FincaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            return Finca::where('user_id', auth()->id())->get();
        } else {
            return view('mapa');
        }
    }
    public function indexfincas(Request $request)
    {
        if ($request->wantsJson()) {


             return  Finca::where('user_id', auth()->id())->get();


        } else {
            return view('mapa');
        }
    }
    public function crear(Request $request)
    {
        $finca= new Finca();
        $finca->nombre = $request->nombre;

        $finca->municipio = $request->municipio;
        $finca->departamento  = $request->departamento;
        $finca->direccion = $request->direccion;
        $finca->user_id = auth()->id();
        $finca->save();

        return $finca ;
    }
    public function update(Request $request, $id)
    {
        $finca = Finca::find($id);
        $finca->nombre = $request->nombre;
        $finca->municipio = $request->municipio;
        $finca->departamento = $request->departamento;

        $finca->save();
        return $finca;
    }
    public function traerUsuario(Request $request, $id){
        if ($request->wantsJson()) {
            return Finca::where('user_id', $id)->get();
        } else {
            return view('mapa');
        }

    }
    public function traerFinca(Request $request, $id){
        if ($request->wantsJson()) {
            return Finca::where('id', $id)->get();
        } else {
            return view('mapa');
        }

    }

}
