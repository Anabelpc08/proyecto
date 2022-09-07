<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servicio;
use Illuminate\Validation\Rule;

class ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('can:operaciones.servicios')->only('edit','update','destroy');
    }

    public function index()
    {
        $servicio = Servicio::all();
        return view('servicio.index')
            ->with('servicio', $servicio);
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
        $servicio_crear = new Servicio();

        $rules = ['clave' => ['unique:servicio_alm,clave']];
        $messages = ['clave.unique' => 'El servicio ingresado ya existe.'];

        $this -> validate ($request, $rules, $messages);
        $request->session()->flash('alert-success', 'El servicio ingresado ha sido registrado exitosamente.');

        $servicio_crear->clave = $request->get('clave');
        $servicio_crear->nombre = $request->get('nombre');

        // dd($servicio_crear);
        $servicio_crear->save();

        return redirect('panel/servicio');
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
    public function edit($id_servicio)
    {
        $servicio_editar = Servicio::find($id_servicio);

        return view('servicio.modal')
            ->with('servicio', $servicio_editar);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_servicio)
    {
        $servicio_actualizar = Servicio::find($id_servicio);

        $rules = [
            'clave' => [Rule::unique('servicio_alm','clave')
            ->ignore($servicio_actualizar->id_servicio,'id_servicio')],
        ];

        $messages = ['clave.unique' => 'El servicio ingresado ya existe.'];

        $this -> validate ($request, $rules, $messages);

        $servicio_actualizar->clave= $request->get('clave');
        $servicio_actualizar->nombre = $request->get('nombre');

        $request->session()->flash('alert-warning', 'El servicio ha sido modificado exitosamente.');


        $servicio_actualizar -> save(); 

        return redirect('panel/servicio');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id_servicio)
    {
        $servicio_borrar = Servicio::find($id_servicio);


        try {
            //code...
            $servicio_borrar -> delete();
    
            $request->session()->flash('alert-danger', 'El servicio ha sido borrado exitosamente.');
        } catch (\Illuminate\Database\QueryException $e) {
            //throw $th;
            $request->session()->flash('alert-danger', 'El servicio no puede borrarse debido a que tiene operaciones relacionadas a él.');
        }


        // al ejecturase la funcion destroy redirige a la vista index de proveedor
        return redirect('/panel/servicio');
    }
}
