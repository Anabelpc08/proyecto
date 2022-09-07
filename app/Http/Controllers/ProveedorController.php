<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Proveedor;

class ProveedorController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // trae todos los registro de la base de datos
        $proveedor = Proveedor::all();


        // aparte de retornar la vista se envia la variable $ proveedor
        // para que se pueda emplear dentro de la vista
        return view('proveedor.index')->with('proveedor',$proveedor);


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
        // se llama a la clase proveedor y se crea el nuevo objeto
        $proveedor_crear = new Proveedor();

        $rules = [
            'RFC' => ['required','unique:proveedor_alm,RFC'],
            'correo' => ['required', 'unique:proveedor_alm,correo']
        ];

        $messages = [
            'RFC.unique' => 'El RFC ingresado ya existe.',
            'correo.unique' => 'El correo ingresado ya se encuentra registrado.'
        ];

        $this->validate($request, $rules, $messages);


        $request->session()->flash('alert-success', 'El proveedor ha sido registrado exitosamente.');

        // desde el formulario se jalan los datos de los campos con su nombre por el metodo get()
        // y se almacenan en los atributos del objeto
        $proveedor_crear->nombre = $request->get('nombre');
        $proveedor_crear->RFC = $request->get('RFC');
        $proveedor_crear->telefono = $request->get('telefono');
        $proveedor_crear->direccion = $request->get('direccion');
        $proveedor_crear->correo = $request->get('correo');

        // por ultimo se le asigna el metodo save() al objeto
        // proveedor para que se genere la consulta del tipo input dentro de la base de datos
        // asignandole valores dentro a cada campo en su tabla correspondiente
        $proveedor_crear->save();

        // se direcciona a la pantalla principal para mostrar resultado
        return redirect('/panel/proveedor');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_proveedor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id_proveedor
     * @return \Illuminate\Http\Response
     */
    public function edit($id_proveedor)
    {
        // permite buscar al proveedor mediante su ID
        $proveedor = Proveedor::find($id_proveedor);
        // retorna la vista edit de proveedor y envia los datos del proveedor buscado
        return view('proveedor.modal')->with('proveedor',$proveedor);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_proveedor)
    {
         // busca al proveedor y almacena los datos en $proveedor_editar
        $proveedor_editar = Proveedor::find($id_proveedor);


        $request->session()->flash('alert-warning', 'El proveedor ha sido modificado exitosamente.');


        // desde el formulario se jalan los datos de los campos con su nombre por el metodo get()
        // y se almacenan en los atributos del objeto
        $proveedor_editar->nombre = $request->get('nombre');
        $proveedor_editar->RFC = $request->get('RFC');
        $proveedor_editar->telefono = $request->get('telefono');
        $proveedor_editar->direccion = $request->get('direccion');
        $proveedor_editar->correo = $request->get('correo');

        // por ultimo se le asigna el metodo save() al objeto
        // proveedor para que se genere la consulta del tipo input dentro de la base de datos
        // asignandole valores dentro a cada campo en su tabla correspondiente
        $proveedor_editar->save();

        // se direcciona a la pantalla principal para mostrar resultado
        return redirect('/panel/proveedor');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id_proveedor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_proveedor)
    {
        // se busca proveedor por ID
        $proveedor_borrar = Proveedor::find($id_proveedor);
        // se elimina ejecutando el metodo delete()
        $proveedor_borrar->delete();
        // al ejecturase la funcion destroy redirige a la vista index de proveedor
        return redirect('/panel/proveedor')->with('eliminar','ok');
    }



}
