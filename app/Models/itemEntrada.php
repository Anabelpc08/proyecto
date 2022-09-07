<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class itemEntrada extends Model
{
    use HasFactory;

    protected $table = 'item_entrada_alm';

    protected $fillable = ['cantidad', 'precio_unit','IVA','precio_iva', 'subtotal', 'id_entrada', 'id_articulo'];

    public $timestamps = false;

    //*Funcion Articulo
    public function articulo()
    {
        return $this->belongsTo('App\Models\Articulo', 'id_articulo');
    }
    public function entrada()
    {
        return $this->hasMany(Entrada::class, 'id_entrada');
    }

    public function umc()
    {
        return $this->belongsToMany(UnidadMedida::class);
    }
}
