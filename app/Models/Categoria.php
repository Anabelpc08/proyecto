<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categoria_art_alm';

    protected $primaryKey = 'id_cat_art_alm';

    use HasFactory;

}
