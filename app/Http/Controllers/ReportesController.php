<?php

namespace App\Http\Controllers;

use App\Models\Boleta;
use App\Models\Materia;
use App\Models\Evaluacion;
use Illuminate\Http\Request;
use DataTables;
use League\Csv\Reader;
use League\Csv\Statement;

class ReportesController extends Controller
{
    public function index()
    {
        $titulo = 'Reportes';
        return view('reportes.reportes',compact('titulo'));
    }

    public function indexBoletaNotas(Request $request)
    {

    }

    public function indexConsolidado(Request $request)
    {

    }

    public function indexPromedios(Request $request)
    {

    }

    public function indexPromedioTrimestral(Request $request)
    {

    }

    public function indexPromedioFinal(Request $request)
    {
        $anio = $request->anio;
        $grado = $request->grado;
        $seccion = $request->seccion;

        $headers = Materia::getHeaderMateria();
        $anios = Boleta::getAnios();
        $grados = Boleta::getGrados();
        $secciones = Boleta::getSecciones();
        $notas = Evaluacion::getNotas($anio, $grado, $seccion);
        $matrizPromedioFinal = array();
        $estudiantes = array();

        if (count($notas) > 0) {
            $estudiantes = Evaluacion::getEstudiantes();
            $matrizPromedioFinal = array();

            foreach ($estudiantes as $estudiante) {
                $fila = array();
                $fila['estudiante'] = $estudiante->nombre;
                foreach ($headers as $header) {
                    $total = 0;
                    $contador = 0;
                    $promedio = 0;
                    foreach ($notas as $nota) {
                        if (strtolower($nota->mes) !== 'enero' && $nota->nombre_materia == $header->nombre && $nota->nie_estudiante == $estudiante->nie_estudiante) {
                            $total += $nota->nota;
                            $contador++;
                        }
                    }
                    $promedio = $contador > 0 ? $total / $contador : 0;
                    $fila[$header->nombre] = $promedio;
                }
                $matrizPromedioFinal[$estudiante->nie_estudiante] = $fila;
            }
        }

        return view('reportes.reporte.reportePromedioFinal', compact('headers', 'anios', 'grados', 'secciones', 'matrizPromedioFinal', 'estudiantes', 'request'));
    }

    public function reportePDF(Request $request)
    {

    }

    public function reporteExcel(Request $request)
    {

    }

}
