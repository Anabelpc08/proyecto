<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salida;
use App\Models\Articulo;
use App\Models\itemSalida;
use App\Models\Servicio;
use Illuminate\Support\Facades\DB;


class SalidaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articulo = Articulo::all();
        $servicio = Servicio::all();
        $salida = Salida::all();
        return view('salida.index')->with('salida', $salida)->with('articulo', $articulo)
            ->with('servicio', $servicio);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            try {
                $salida = new Salida();
                $salida->id_salida = $request->get('id_salida');
                $salida->folio_salida = $request->get('folio_salida');
                $salida->fecha = $request->get('fecha');
                $salida->hora = $request->get('hora');
                $salida->observacion = $request->get('observacion');
                $salida->id_servicio = $request->get('id_servicio');
                $salida->id_usuario = $request->get('id_usuario');
                $salida->save();
                //Array de Insercion para tabla ITEM SALIDA
                //code...
                foreach ($request->cantidad as $key => $id_articulo) {
                    $data = new itemSalida();
                    $data->cantidad = $id_articulo;
                    $data->precio_unit = $request->precio[$key];
                    $data->subtotal = $request->subtotal[$key];
                    $data->id_salida = $salida->id_salida;
                    $data->id_articulo = $request->id_articulo[$key];
                    $data->save();
                }
                $request->session()->flash('alert-success', "La salida ha sido registrada existosamente con el Folio: {$salida->folio_salida}");
            } catch (\Illuminate\Database\QueryException $e) {
                //throw $th;
                //evita que envie registros forzosos al cometer una excepcion.
                DB::rollBack();
                $request->session()->flash('alert-error', 'La cantidad solicitada no puede exceder del valor disponible en stock.');
            }
        });
        return redirect()->route('salida.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_salida)
    {
        //implemenar un consulta que permita eliminar el id de la tabla entrada_alm foreanea de la tabla item_entrada_alm
        if ($id_salida) {
            $quitar = itemSalida::where('id_salida', $id_salida);
            $quitar->delete();
        }
        // al ejecturase la funcion destroy redirige a la vista index de proveedor
        return redirect('/panel/salida')->with('eliminar', 'ok');
    }
}
