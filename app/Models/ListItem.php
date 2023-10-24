<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'nacimiento',
        'ingresos',
    ];

    static $rules = [
        'nombre' => 'required',
        'max:50',
        'nacimiento' => 'required',
        'ingresos' => 'unique:numeric',
    ];
}
