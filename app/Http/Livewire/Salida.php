<?php

namespace App\Http\Livewire;

use App\Models\Articulo;
use App\Models\UnidadMedida;
use App\Models\Subcategoria;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Salida extends Component
{
    public $articulo = '';
    public $descripcion = '';
    public $clave = '';
    public function render()
    {
        $insertar = DB::table('salida_alm')->select('id_salida')->skip(2)->take(2)->get();
        return view(
            'livewire.salida',
            [
                'umc' => UnidadMedida::all(),
                'sub' => Subcategoria::all(),
                'articulo' => $this->articulo
            ]
        )->with('insertar', $insertar);
    }
    public function buscar()
    {
        $this->validate([
            'clave' => 'required|exists:articulo_alm,clave'
        ]);
        $this->articulo = Articulo::where('clave', $this->clave)->get();
        // dd($this->articulo);
    }
}

