<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entrada;
use App\Models\itemEntrada;
use App\Models\tipo;
use App\Models\Proveedor;
use Illuminate\Support\Facades\DB;

class EntradaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $entrada = Entrada::all();
        $tipo = tipo::all();
        $item = itemEntrada::all();
        $proveedor = Proveedor::all();
        $item = DB::table('item_entrada_alm')->distinct()->leftJoin('articulo_alm', 'item_entrada_alm.id_articulo', '=', 'articulo_alm.id_articulo')
            ->leftJoin('umc_alm', 'articulo_alm.id_umc', '=', 'umc_alm.id_umc')->paginate(10);
        return view('entrada.index')->with('entrada', $entrada)->with('tipo', $tipo)->with('proveedor', $proveedor)->with('item', $item);
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            $entrada_crear = new Entrada();
            //FORMULARIO 1 ENTRADA ALM
            $entrada_crear->id_entrada = $request->get('id_entrada');
            $entrada_crear->folio_interno = $request->get('folio_interno');
            $entrada_crear->modo_entrada = $request->get('modo_entrada');
            $entrada_crear->estado = $request->get('estado');
            $entrada_crear->fecha_ingreso = $request->get('fecha_ingreso');
            $entrada_crear->hora = $request->get('hora');
            $entrada_crear->id_proveedor = $request->get('id_proveedor');
            $entrada_crear->id_te = $request->get('id_te');
            $entrada_crear->id_contrato = $request->get('id_contrato');
            $entrada_crear->id_usuario = $request->get('id_usuario');
            $entrada_crear->save();

            //FORMULARIO PARA ITEM ENTRADA No tocar
            foreach ($request->cantidad as $key => $id_articulo) {
                $data = new itemEntrada();
                $data->cantidad = $id_articulo;
                $data->precio_unit = $request->precio[$key];
                $data->IVA = $request->iva[$key];
                $data->precio_iva = $request->precioiva[$key];
                $data->subtotal = $request->subtotal[$key];
                $data->id_entrada = $entrada_crear->id_entrada;
                $data->id_articulo = $request->id_articulo[$key];
                $data->save();

                
                //dd($data);
            }
            $request->session()->flash('alert-success', "La entrada ha sido registrada exitosamente con el Folio: {$entrada_crear->folio_interno}");
        });
        return redirect()->route('entrada.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_entrada)
    {
        //implemenar un consulta que permita eliminar el id de la tabla entrada_alm foreanea de la tabla item_entrada_alm
        if ($id_entrada) {
            $quitar = itemEntrada::where('id_entrada', $id_entrada);
            $quitar->delete();
        }
        // al ejecturase la funcion destroy redirige a la vista index de proveedor
        return redirect('/panel/entrada')->with('eliminar', 'ok');
    }
}