<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipo extends model
{
    use HasFactory;
    protected $table = 'tipo_entrada_alm';

    protected $primaryKey = 'id_te';

    protected $fillable = ['id_te', 'nombre'];
    public $timestamps = false;
}
