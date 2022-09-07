<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultaEntrada extends Model
{
    use HasFactory;
    protected $table = 'entrada_alm';

    protected $primaryKey = 'id_entrada';

}
