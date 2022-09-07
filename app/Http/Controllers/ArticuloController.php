<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articulo;
use App\Models\Categoria;
use App\Models\Subcategoria;
use App\Models\UnidadMedida;

class ArticuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('articulo.index', [
            'articulo' => Articulo::all(),
            'umc' => UnidadMedida::all()
        ]);
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
        $articulo_crear = new Articulo();

        $rules = [
            'clave' => ['required','unique:articulo_alm,clave']
        ];

        $messages = [
            'clave.unique' => 'La clave ingresada ya se encuentra registrada.'
        ];

        $this->validate($request, $rules, $messages);

        $request->session()->flash('alert-success', 'El artículo ha sido registrado exitosamente.');

        $articulo_crear->clave = $request->get('clave');
        $articulo_crear->descripcion = $request->get('descripcion');
        $articulo_crear->id_umc = $request->get('umc');
        $articulo_crear->id_subcat_art_alm = $request->get('subcategoria');

        // dd($articulo_crear);
        $articulo_crear->save();

        return redirect('/panel/articulo');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id_articulo)
    // {
    //     $articulo = Articulo::find($id_articulo);
    //     $umc = UnidadMedida::all();
    //     $categoria = Categoria::all();
    //     $subcategoria = Subcategoria::all();

    //     return view('articulo.modal')
    //             ->with('articulo', $articulo)
    //             ->with('umc', $umc)
    //             ->with('categoria', $categoria)
    //             ->with('subcategoria', $subcategoria);
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id_articulo)
    // {
    //     $articulo_editar = Articulo::find($id_articulo);

    //     $request->session()->flash('alert-warning', 'El artículo ha sido modificado exitosamente.');

    //     $articulo_editar->clave = $request->get('clave');
    //     $articulo_editar->descripcion = $request->get('descripcion');
    //     $articulo_editar->id_umc = $request->get('umc');
    //     $articulo_editar->id_subcat_art_alm = $request->get('subcategoria');

    //     $articulo_editar->save();

    //     return redirect('/panel/articulo');

    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Request $request, $id_articulo)
    // {
    //     $articulo_borrar = Articulo::find($id_articulo);

    //     $articulo_borrar->delete();

    //     $request->session()->flash('alert-danger', 'El artículo ha sido borrado exitosamente.');

    //     return redirect('/panel/articulo');

    // }
}
