<?php

namespace App\Http\Controllers;


use App\Models\Proveedor;
use Illuminate\Http\Request;
use App\Models\Entrada;
use App\Models\itemEntrada;
use Illuminate\Support\Facades\DB;

class Consulta_EntradaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $proveedor = Proveedor::all();
        $folio = trim($request->get('folio_interno'));
        $contrato = trim($request->get('id_contrato'));
        $from =  trim($request->input('from'));
        $to =  trim($request->input('to'));
        $modo_entrada = trim($request->get('modo_entrada'));
        $proveedores = trim($request->get('nombre'));
        $status = trim($request->get('estado'));
        $entrada = DB::table('entrada_alm')
            ->leftJoin('proveedor_alm', 'entrada_alm.id_proveedor', '=', 'proveedor_alm.id_proveedor')->distinct()
            ->where(function ($query) use ($folio, $contrato, $modo_entrada, $status, $proveedores) {
                $query
                    ->orWhere('folio_interno', 'like', "%$folio%")
                    ->where('id_contrato', 'like', "%$contrato%")
                    ->where('modo_entrada', 'like', "%$modo_entrada%")
                    ->where('estado', 'like', "%$status%")
                    ->where('nombre', 'like', "%$proveedores%");
            })->where(function ($query1) use ($from, $to) {
                $query1
                    ->orWhere('fecha_ingreso', 'like', "%$from%")
                    ->orWhereBetween('fecha_ingreso',[$from,$to]);
            })->orderBy('id_entrada', 'asc')->get();
        return view('consulta_entrada.index')
            ->with('entrada', $entrada)
            ->with('folio_interno', $folio)
            ->with('modo_entrada', $modo_entrada)
            ->with('estado', $status)
            ->with('proveedor', $proveedor)
            ->with('nombre', $proveedores)
            ->with('id_contrato', $contrato)
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
     * @param  int  $id_entrada
     * @return \Illuminate\Http\Response
     */
    public function show(int $id_entrada)
    {
        $entrada_detalle = Entrada::find($id_entrada);
        $item_entrada = itemEntrada::where('id_entrada', $id_entrada)->get();
        // retorna la vista show de detalle de entrada y envia los datos de la entrads buscado el Id
        return view(
            'consulta_entrada.show',
            compact('entrada_detalle',  $entrada_detalle),
            compact('item_entrada', $item_entrada)
        );
    }
}
