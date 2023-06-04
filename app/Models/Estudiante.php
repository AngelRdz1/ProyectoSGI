<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;

    protected $table = 'estudiantes';

    protected $fillable = [
        'nie',
        'nombre',
        'numero_lista',
        'numero',
        'seccion'
    ];

    public function grado() {
        return $this->belongsTo(Grado::class);
    }

    public function evaluaciones() {
        return $this->hasMany(Evaluacion::class);
    }
}
