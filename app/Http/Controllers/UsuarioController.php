<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\Rule;

use Spatie\Permission\Models\Role;


class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function _construct()
    {
        $this->middleware('can:panel.usuarios')->only('index');
    }

    public function index()
    {
        $usuario = User::all();
        $roles = Role::all();
        // $status = Status::all();


        return view('usuario.index')
            ->with('usuario', $usuario)
            ->with('roles', $roles);
            // ->with('status', $status)
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
        $usuario = new User();

        // reglas de para campos
        $rules = [
            'user' => ['required','unique:users,user'],
            'email' => ['required', 'unique:users,email'],
        ];

        // mensajes en caso de duplicidad
        $messages = [
            'user.unique' => 'El usuario ya se encuentra registrado',
            'email.unique' => 'El correo electrónico ya se encuentra registrado'
        ];

        $this->validate($request,$rules,$messages);
        $request->session()->flash('alert-success', 'El usuario ha sido registrado exitosamente.');

        // se recogen datos del formulario y se envian al objeto usuario
        $usuario->nombre = $request->get('nombre');
        $usuario->apellidoPat = $request->get('apellidoPat');
        $usuario->apellidoMat = $request->get('apellidoMat');
        $usuario->n_empleado = $request->get('n_empleado');
        $usuario->email = $request->get('email');
        // $usuario->id_rango = $request->get('rango');
        // $usuario->id_status = $request->get('status');
        $usuario->user = $request->get('user');
        $usuario->password = Hash::make($request->get('password')); // se encripta constraseña con  metodo HASH

        $roles = $request->input('rango', []);
        $usuario->syncRoles($roles);


        $usuario->save();
        return redirect('/panel/usuario');
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
    public function edit($id_usuario)
    {
        $usuario = User::find($id_usuario);
        $roles = Role::all();
        // $status = Status::all();

        return view('usuario.modal')
        ->with('usuario',$usuario)
        ->with('roles', $roles);
        // ->with('status', $status)
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_usuario)
    {

        $usuario_editar = User::find($id_usuario);


        $rules = [
            'user' => [Rule::unique('users','user')
            ->ignore($usuario_editar->id_usuario,'id_usuario')],
            'email' => [Rule::unique('users','email')
            ->ignore($usuario_editar->id_usuario,'id_usuario')]
        ];

        $messages = [
            'user.unique' => 'El usuario ya se encuentra registrado',
            'email.unique' => 'El correo electrónico ya se encuentra registrado'
        ];

        $this->validate($request, $rules, $messages);


        $request->session()->flash('alert-warning', 'El usuario ha sido modificado exitosamente.');

        // se recogen datos del formulario y se envian al objeto usuario
        $usuario_editar->nombre = $request->get('nombre');
        $usuario_editar->apellidoPat = $request->get('apellidoPat');
        $usuario_editar->apellidoMat = $request->get('apellidoMat');
        $usuario_editar->n_empleado = $request->get('n_empleado');
        $usuario_editar->email = $request->get('email');
        $usuario_editar->user = $request->get('user');
        $usuario_editar->password = Hash::make($request->get('password')); // se encripta constraseña con  metodo HASH


        $roles = $request->input('rango', []);
        $usuario_editar->syncRoles($roles);

        $usuario_editar->save(); #KdVE0iP cWVqXIGa 6yHdW6R0
        return redirect('/panel/usuario');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id_usuario)
    {
        $usuario_borrar = User::find($id_usuario);

        try {
            //code...
            $usuario_borrar->delete();
            $request->session()->flash('alert-danger', 'El usuario ha sido borrado exitosamente.');
        } catch (\Illuminate\Database\QueryException $e) {
            //throw $th;
            $request->session()->flash('alert-danger', 'El usuario no puede borrarse debido a que tiene operaciones relacionadas a él.');

        }



        return redirect('/panel/usuario');
    }
}
