<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boleta extends Model
{
    use HasFactory;

    protected $table = 'boletas';

    protected $fillable = [
        'mes',
        'anio',
        'numero',
        'seccion',
    ];

    public function evaluaciones() {
        return $this->hasMany(Evaluacion::class);
    }

    public function comportamientos() {
        return $this->hasMany(Comportamiento::class);
    }

    public function grado() {
        return $this->belongsTo(Grado::class);
    }
}
