<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class itemSalida extends Model
{
    use HasFactory;

    protected $table = 'item_serv_sal_art_alm';

    protected $fillable = ['cantidad', 'precio_unit', 'subtotal', 'id_articulo', 'id_salida'];

    public $timestamps = false;

    public function articulo()
    {
        return $this->belongsTo(Articulo::class, 'id_articulo');
    }
    public function salida()
    {
        return $this->belongsTo(Salida::class, 'id_salida');
    }
}

