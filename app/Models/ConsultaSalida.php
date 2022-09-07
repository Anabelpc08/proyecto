<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultaSalida extends Model
{
    use HasFactory;
    protected $table = 'salida_alm';

    protected $primaryKey = 'id_salida';
}
