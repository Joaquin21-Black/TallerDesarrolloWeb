<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interaccion extends Model
{

    public $table = "interaccion";

    public $fillable = [
        'perro_interesado_id',
        'perro_candidato_id',
        'preferencia',
    ];

    use HasFactory;
}
