<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnidadMedida extends Model
{
    use HasFactory;
    
    protected $table = 'umc_alm';

    protected $primaryKey = 'id_umc';
    
    protected $fillable = ['id_umc','nombre'];
}
