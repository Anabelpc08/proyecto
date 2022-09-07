<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    protected $table = 'articulo_alm';

    protected $primaryKey = 'id_articulo';
    
    use HasFactory;


    public function subcategoria(){
        return $this->belongsTo('App\Models\Subcategoria','id_subcat_art_alm');
    }

    public function umc(){
        return $this->belongsTo('App\Models\UnidadMedida','id_umc');
    }
}
