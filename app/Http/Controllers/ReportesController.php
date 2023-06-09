<?php

namespace App\Http\Controllers;

use App\Models\Boleta;

use App\Models\Evaluacion;
use App\Models\Estudiante;
use App\Models\Materia;
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


    public function indexConsolidado(Request $request)
    {

    }

    public function indexPromedios(Request $request){
        
    }
    public function indexBoletaNotas(){
        $titulo = 'Boleta de Notas';
        $estudiantes = Estudiante::all();
        return view('reportes.reporte.reporteBoletaNotas',compact('titulo','estudiantes'));
    }
    public function tablaBoletaNotas(Request $request){
        $datas = Boleta::getDataBoleta($request->id);
        $materias = Materia::all();
        $estudiante = Estudiante::where('nie',$request->id)->first('nombre');
        $info = [];
        $cont = 0;
        $trimestre1 = ['Enero','Febrero','Marzo','Abril'];
        $trimestre2 = ['Mayo','Junio','Julio'];
        $trimestre3 = ['Agosto','Septiembre','Octubre'];
        foreach($materias as $materia){
            $cont = 0;
            $entre = 0;
            $promedioFinal = 0;
            foreach($datas as $data){
                if($materia->id == $data->idMateria){
                    $info[$materia->nombre][$data->mes][] = $data->sumaNotas; 
                    $cont += $data->sumaNotas; 
                    if(strtolower($data->tipoEvaluacion)=='recuperacion1'&&strtolower($data->mes) == 'abril'){
                        $cont = 0;
                        $entre = 0;
                        foreach($trimestre1 as $tri){
                            $cont += $info[$materia->nombre][$tri][0];
                            $entre += 1;
                            if(count($info[$materia->nombre][$tri])>1){
                                $recu = $info[$materia->nombre][$tri][1];$prom = 1;
                                $prom = 1;
                                if($recu>0){
                                    $prom = 2;
                                }
                            }
                        }
                        $info[$materia->nombre][$data->mes][] = number_format((($cont/$entre)+$recu)/$prom,2);
                        $promedioFinal += number_format((($cont/$entre)+$recu)/$prom,2);
                    }elseif(strtolower($data->tipoEvaluacion)=='recuperacion2'&&strtolower($data->mes) == 'julio' ){
                        $cont = 0;
                        $entre = 0;
                        foreach($trimestre2 as $tri){
                            $cont += $info[$materia->nombre][$tri][0];
                            $entre += 1;
                            if(count($info[$materia->nombre][$tri])>1){
                                $recu = $info[$materia->nombre][$tri][1];
                                $prom = 1;
                                if($recu>0){
                                    $prom = 2;
                                }
                            }
                        }
                        $info[$materia->nombre][$data->mes][] = number_format((($cont/$entre)+$recu)/$prom,2);
                        $promedioFinal += number_format((($cont/$entre)+$recu)/$prom,2);
                    }elseif(strtolower($data->tipoEvaluacion)=='recuperacion3'&&strtolower($data->mes) == 'octubre'){
                        $cont = 0;
                        $entre = 0;
                        foreach($trimestre3 as $tri){
                            $cont += $info[$materia->nombre][$tri][0];
                            $entre += 1;
                            if(count($info[$materia->nombre][$tri])>1){
                                $recu = $info[$materia->nombre][$tri][1];
                                $prom = 1;
                                if($recu>0){
                                    $prom = 2;
                                }
                            }
                        }
                        $info[$materia->nombre][$data->mes][] = number_format((($cont/$entre)+$recu)/$prom,2);
                        $promedioFinal += number_format((($cont/$entre)+$recu)/$prom,2);
                    }
                }
                    
            }
            $info[$materia->nombre][$data->mes][] = number_format($promedioFinal/3);
        }
        
        //$info[$materia->nombre][$data->mes][] = '';
        $meses = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre'];
       // dd($info);
        return view('reportes.reporte.tablaBoleta',compact('datas','materias','info','meses','estudiante'));
    }

    public function dataBoletaNotas(Request $request){
        if ($request->ajax()) {
            $valores = Boleta::getDataBoleta($request->id);
            $data = [];
            return Datatables::of($data)
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
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
