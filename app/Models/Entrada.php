<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Entrada extends Model
{
    use HasFactory;

    //?TABLA PARA ALMACENAR DATOS DE ENTRADA_ALM
    protected $table = 'entrada_alm';
    protected $primaryKey = 'id_entrada';
    protected $fillable = ['id_entrada','folio_interno', 'fecha_ingreso', 'hora', 'modo_entrada', 'estado', 'total_entrada', 'id_contrato', 'id_te', 'id_proveedor', 'id_usuario'];

    public $timestamps = false;

    public function entrada()
    {
        return $this->hasMany(itemEntrada::class, 'id_entrada');
    }
    //*Funcion de llave Foranea Usuario
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id_usuario');
    }

    //*Funcion de Llave Foranea de Tipo de Entrada
    public function tipo()
    {
        return $this->belongsTo('App\Models\tipo', 'id_te');
    }
     //*Funcion de Llave Foranea de Proveedor
     public function proveedor()
     {
         return $this->belongsTo('App\Models\proveedor', 'id_proveedor');
     }
}
