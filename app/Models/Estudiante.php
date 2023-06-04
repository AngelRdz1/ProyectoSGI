<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public static function getData(){
        return DB::select('SELECT e.nie, e.nombre, e.numero_lista, g.numero, g.seccion
                          FROM estudiantes e
                          JOIN grados g ON e.grado_id = g.id');
    }

    public function grado() {
        return $this->belongsTo(Grado::class);
    }

    public function evaluaciones() {
        return $this->hasMany(Evaluacion::class);
    }
}
