<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salida extends Model
{
    use HasFactory;

    protected $table = 'salida_alm';

    protected $primaryKey = 'id_salida';

    protected $fillable = ['id_salida','folio_salida', 'fecha', 'hora', 'observacion', 'total', 'id_servicio', 'id_usuario'];

    public $timestamps = false;

    public function itemsalida()
    {
        return $this->belongsTo(itemSalida::class, 'id_salida');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
    public function servicio()
    {
        return $this->belongsTo(Servicio::class, 'id_servicio');
    }
}
