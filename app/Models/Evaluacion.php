<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public static function getNotas($anio, $grado, $seccion) {
        return DB::select("SELECT g.numero AS grado, g.seccion, b.anio AS anio, b.mes,
                                    m.nombre AS nombre_materia, e.nie_estudiante,
                                    ROUND(SUM(e.nota * (e.porcentaje/100)), 1) AS nota
                            FROM evaluaciones e
                            JOIN boletas b ON e.boleta_id = b.id
                            JOIN grados g ON b.grado_id = g.id
                            JOIN materias m ON e.materia_id = m.id
                            WHERE g.numero = '$grado' AND g.seccion = '$seccion' AND b.anio = '$anio'
                            GROUP BY g.numero, g.seccion, b.anio, b.mes, e.materia_id, m.nombre, e.nie_estudiante");
    }

    public static function getEstudiantes() {
        return DB::select("SELECT DISTINCT e.nie_estudiante, est.nombre
                            FROM evaluaciones e
                            JOIN estudiantes est ON e.nie_estudiante = est.nie");
    }

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
