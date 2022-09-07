<?php

namespace App\Http\Controllers;

use App\Models\itemSalida;
use App\Models\Salida;
use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Consulta_SalidaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $servicios = Servicio::all();
        $from =  trim($request->input('from'));
        $to =    trim($request->input('to'));
        $folio = trim($request->get('folio_salida'));
        $id_servicio = trim($request->get('nombre'));
        $salida = DB::table('salida_alm')
            ->leftJoin('servicio_alm', 'salida_alm.id_servicio', '=', 'servicio_alm.id_servicio')
            ->where(function ($query) use ($folio, $id_servicio) {
                $query
                    ->where('nombre', 'like', "%$id_servicio%")
                    ->where('folio_salida', 'like', "%$folio%");
            })->where(function ($query1) use ($from, $to) {
                $query1
                    ->orWhere('fecha', 'like', "%$from%")
                    ->orWhereBetween('fecha', [$from, $to]);
            })->orderBy('id_salida', 'asc')->get();
        return view('consulta_salida.index')
            ->with('salida', $salida)
            ->with('nombre', $id_servicio)
            ->with('servicios', $servicios)
            ->with('from', $from)
            ->with('to', $to);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //code
    }




    /**
     * Display the specified resource.
     *
     * @param  int  $id_salida
     * @return \Illuminate\Http\Response
     */
    public function show($id_salida)
    {
        $salida_detalle = Salida::find($id_salida);
        $item_salida = itemSalida::where('id_salida', $id_salida)->get();
        //code para ver detalle de salida
        return view('consulta_salida.show', compact('salida_detalle',  $salida_detalle), compact('item_salida', $item_salida));
    }
}
