<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subcategoria;
use App\Models\Categoria;
use Illuminate\Validation\Rule;

class SubcategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function __construct()
    {
        $this->middleware('can:operaciones.categoria_articulos')->only('edit','update','destroy');
    }
    
    public function index()
    {
        $subcategoria = Subcategoria::all();
        $categoria =Categoria::all();
        
        

        return view('subcategoria.index')
                ->with('subcategoria', $subcategoria)
                ->with('categoria', $categoria)
                ;
               
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subcategoria_crear = new Subcategoria();

        $rules = [
            'inicial' => [ 'unique:subcategoria_alm,inicial'],
            'partida_presupuestal' => ['unique:subcategoria_alm,partida_presupuestal']
        ];

        $messages = [
            'inicial.unique' => 'La inicial ingresada ya existe.',
            'partida_presupuestal.unique' => 'La partida presupuestal ya se encuentra registrada.'
        ];

        $this->validate($request, $rules, $messages);
        $request->session()->flash('alert-success', 'Se ha registrado la subcategoría exitosamente.');
    
        $subcategoria_crear->inicial= $request->get('inicial');
        $subcategoria_crear->partida_presupuestal = $request->get('partida_presupuestal');
        $subcategoria_crear->nombre = $request->get('nombre');
        $subcategoria_crear->id_cat_art_alm= $request->get('categoria');

        // dd($subcategoria_crear);
        $subcategoria_crear -> save();

        return redirect('panel/subcategoria');
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
    public function edit($id_subcat_art_alm)
    {
        $subcategoria_editar = Subcategoria::find($id_subcat_art_alm);
        $categoria =Categoria::all();

        return view('subcategoria.modal')
                ->with('subcategoria', $subcategoria_editar)
                ->with('categoria', $categoria);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_subcat_art_alm)
    {
        $subcategoria_actualizar = Subcategoria::find($id_subcat_art_alm);

        $rules = [
            'inicial' => [Rule::unique('subcategoria_alm','inicial')
            ->ignore($subcategoria_actualizar->id_subcat_art_alm,'id_subcat_art_alm')],
            'partida_presupuestal' => [Rule::unique('subcategoria_alm','partida_presupuestal')
            ->ignore($subcategoria_actualizar->id_subcat_art_alm,'id_subcat_art_alm')]
        ];

        $messages = [
            'inicial.unique' => 'La inicial ingresada ya existe.',
            'partida_presupuestal.unique' => 'La partida presupuestal ya se encuentra registrada.'
        ];

        $this->validate($request, $rules, $messages);

        $subcategoria_actualizar->inicial= $request->get('inicial');
        $subcategoria_actualizar->partida_presupuestal = $request->get('partida_presupuestal');
        $subcategoria_actualizar->nombre = $request->get('nombre');
        $subcategoria_actualizar->id_cat_art_alm= $request->get('categoria');

        $request->session()->flash('alert-warning', 'La subcategoria ha sido modificada exitosamente.');


        $subcategoria_actualizar -> save(); 

        return redirect('panel/subcategoria');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id_subcat_art_alm)
    {
        $subcategoria_borrar = Subcategoria::find($id_subcat_art_alm);


        try{
            $subcategoria_borrar -> delete();

            $request->session()->flash('alert-danger', 'La subcategoria ha sido borrada exitosamente.');
        } catch (\Illuminate\Database\QueryException $e) {

            $request->session()->flash('alert-error', 'La subcategoria no puede borrarse debido a que existen artículos relacionados a ella. Para poder borrarla primero elimine los articulos relacionados');

        }
        
        return redirect('/panel/subcategoria');


        // al ejecturase la funcion destroy redirige a la vista index de proveedor
    }
}
