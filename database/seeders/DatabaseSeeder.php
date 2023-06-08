<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Boleta;
use App\Models\Docente;
use App\Models\Estudiante;
use App\Models\Evaluacion;
use App\Models\Grado;
use App\Models\Materia;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // Crear un registro de docente
        $docente = Docente::create([
            'nombre' => 'Pepe'
        ]);

        // Crear registros de materias asociados al docente
        
        $materia[] = Materia::create([
                'nombre' => 'Lenguaje',
                'docente_id' => $docente->id
            ]);
            $materia[] = Materia::create([
                'nombre' => 'Matemática',
                'docente_id' => $docente->id
            ]);
            $materia[] = Materia::create([
                'nombre' => 'Ciencias',
                'docente_id' => $docente->id
            ]);
            $materia[] = Materia::create([
                'nombre' => 'Sociales',
                'docente_id' => $docente->id
            ]);
            $materia[] = Materia::create([
                'nombre' => 'Educación Física',
                'docente_id' => $docente->id
            ]);
            $materia[] = Materia::create([
                'nombre' => 'Inglés',
                'docente_id' => $docente->id
            ]);

        $grado = Grado::create([
            'numero' => 1,
            'seccion' => 'A', // Genera letras A, B, C, D, E
            'cant_ninos' => rand(20, 30),
            'cant_ninas' => rand(20, 30),
            'docente_id' => $docente->id,
        ]);
        $meses = [
            1 => 'Enero',
            2 => 'Febrero',
            3 => 'Marzo',
            4 => 'Abril',
            5 => 'Mayo',
            6 => 'Junio',
            7 => 'Julio',
            8 => 'Agosto',
            9 => 'Septiembre',
            10 => 'Octubre',
        ];
        
        // Crear registros en la tabla boletas para los meses de enero a octubre

        foreach ($meses as $nombreMes) {
            $boleta[] = Boleta::create([
                'mes' => $nombreMes,
                'anio' => date('Y'),
                'grado_id' => $grado->id,
            ]);
        }

        $estudiante = Estudiante::create([
            'nie' => 1,
            'nombre' => 'Luis Alejandro Cruz',
            'numero_lista' => 1,
            'grado_id' => $grado->id,
        ]);

        foreach($materia as $m){
            $evaluaciones = [];
            Evaluacion::insert($evaluaciones);
            $evaluaciones = [
                [
                    'nie_estudiante' => 1,
                    'materia_id' => $m->id, 
                    'boleta_id' => 1,
                    'nombre' => 'examen',
                    'porcentaje' => 1,
                    'nota' => 8,
                ],
                [
                    'nie_estudiante' => 1,
                    'materia_id' => $m->id, 
                    'boleta_id' => 2,
                    'nombre' => 'examen',
                    'porcentaje' => 1,
                    'nota' => 8,
                ],
                [
                    'nie_estudiante' => 1,
                    'materia_id' => $m->id, 
                    'boleta_id' => 3,
                    'nombre' => 'examen',
                    'porcentaje' => 1,
                    'nota' => 8,
                ],
                [
                    'nie_estudiante' => 1,
                    'materia_id' => $m->id, 
                    'boleta_id' => 4,
                    'nombre' => 'examen',
                    'porcentaje' => 1,
                    'nota' => 7,
                ],
                [
                    'nie_estudiante' => 1,
                    'materia_id' => $m->id, 
                    'boleta_id' => 5,
                    'nombre' => 'examen',
                    'porcentaje' => 1,
                    'nota' => 5,
                ],
                [
                    'nie_estudiante' => 1,
                    'materia_id' => $m->id, 
                    'boleta_id' => 6,
                    'nombre' => 'examen',
                    'porcentaje' => 1,
                    'nota' => 3,
                ],
                [
                    'nie_estudiante' => 1,
                    'materia_id' => $m->id, 
                    'boleta_id' => 7,
                    'nombre' => 'examen',
                    'porcentaje' => 1,
                    'nota' => 8,
                ],
                [
                    'nie_estudiante' => 1,
                    'materia_id' => $m->id, 
                    'boleta_id' => 8,
                    'nombre' => 'examen',
                    'porcentaje' => 1,
                    'nota' => 8,
                ],
                [
                    'nie_estudiante' => 1,
                    'materia_id' => $m->id, 
                    'boleta_id' => 9,
                    'nombre' => 'examen',
                    'porcentaje' => 1,
                    'nota' => 8,
                ],
                [
                    'nie_estudiante' => 1,
                    'materia_id' => $m->id, 
                    'boleta_id' => 10,
                    'nombre' => 'examen',
                    'porcentaje' => 1,
                    'nota' => 8,
                ],
                [
                    'nie_estudiante' => 1,
                    'materia_id' => $m->id, // Reemplaza con el ID de la materia correspondiente
                    'boleta_id' => 4,
                    'nombre' => 'recuperacion1',
                    'porcentaje' => 1,
                    'nota' => 0,
                ],
                [
                    'nie_estudiante' => 1,
                    'materia_id' => $m->id, // Reemplaza con el ID de la materia correspondiente
                    'boleta_id' => 7,
                    'nombre' => 'recuperacion2',
                    'porcentaje' => 1,
                    'nota' => 0,
                ],
                [
                    'nie_estudiante' => 1,
                    'materia_id' => $m->id, // Reemplaza con el ID de la materia correspondiente
                    'boleta_id' => 10,
                    'nombre' => 'recuperacion3',
                    'porcentaje' => 1,
                    'nota' => 0,
                ]
            ];
            Evaluacion::insert($evaluaciones);
        }
        
    }
}
