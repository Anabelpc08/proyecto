<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategoria extends Model
{
    protected $table = 'subcategoria_alm';

    protected $primaryKey = 'id_subcat_art_alm';
    
    use HasFactory;

    public function categoria(){
        return $this->belongsTo('App\Models\Categoria', 'id_cat_art_alm');
    }

    public function articulo(){
        return $this->hasMany('App\Models\Articulo');
    }
}
