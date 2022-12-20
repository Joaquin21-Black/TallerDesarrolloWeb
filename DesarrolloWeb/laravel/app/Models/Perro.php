<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Perro extends Model
{

    public $table = "perro";
    protected $primaryKey = 'perro_id';
    public $incrementing = true;

    public $fillable = [
        'perro_id',
        'nombre',
        'url_foto',
        'descripcion'
    ];

    use HasFactory;
}
