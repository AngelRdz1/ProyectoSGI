<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{
    use HasFactory;

    protected $table = 'evaluaciones';

    protected $fillable = [
        'nie_estudiante',
        'materia_id',
        'boleta_id',
        'nombre',
        'porcentaje',
        'nota'
    ];

    public function estudiante() {
        return $this->belongsTo(Estudiante::class);
    }

    public function boleta() {
        return $this->belongsTo(Boleta::class);
    }

    public function materia() {
        return $this->belongsTo(Materia::class);
    }
}
