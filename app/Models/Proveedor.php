<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    // se especifica la tabla a la que se representa el objeto
    protected $table = 'proveedor_alm';

    // se indica que la llave primaria de la tabla proveedor es 'id_proveedor'
    protected $primaryKey = 'id_proveedor';

    

    use HasFactory;
}
