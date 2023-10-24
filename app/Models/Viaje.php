<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Viaje extends Model
{
    use HasFactory;

    static $rules = [
        'EVENTO' => 'required',
        'max:25',
        'CUIL' => 'required',
        'max:11',
        'TARJETA' => 'required',
        'max:10',
        'CANTIDAD' => 'required|numeric',
        'TARIFA' => 'required|numeric',
        'IMPORTE' => 'required|numeric',
        'TRAMO' => 'required',
        'max:40',
        'FECHA' => 'required',
        'LATITUD' => 'required|numeric',
        'LONGITUD' => 'required|numeric',
    ];

    protected $fillable = [
        'EVENTO',
        'CUIL',
        'TARJETA',
        'CANTIDAD',
        'TARIFA',
        'IMPORTE',
        'TRAMO',
        'FECHA',
        'LATITUD',
        'LONGITUD'
    ];


}
