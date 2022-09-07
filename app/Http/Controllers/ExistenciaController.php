<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExistenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //!CONSULTA DE EXISTENCIAS NO MOVER !!
    public function index(Request $request)
    {

        $clave = trim($request->get('clave'));
        $subcategoria = trim($request->get('subcategoria'));
        $descripcion = trim($request->get('descripcion'));
        $existencia = DB::table('articulo_alm')->leftJoin('umc_alm', 'articulo_alm.id_umc', '=', 'umc_alm.id_umc')->distinct()->where(
            function ($query) use ($clave, $subcategoria, $descripcion) {
                $query
                    ->orWhere('clave', 'like', "%$clave%")
                    ->where('id_subcat_art_alm', 'like', "%$subcategoria%")
                    ->where('descripcion', 'like', "%$descripcion%");
            })->get();
        return view('existencia.index')->with('existencia', $existencia)->with('clave', $clave)->with('subcategoria', $subcategoria)->with('descripcion', $descripcion);
    }
}
