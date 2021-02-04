<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Finca;
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
    public function crear(Request $request)
    {
        $finca= new Finca();
        $finca->nombre = $request->nombre;

        $finca->municipio = $request->municipio;
        $finca->departamento  = $request->departamento;
        $finca->user_id = auth()->id();
        $finca->save();

        return $finca ;
    }

}
