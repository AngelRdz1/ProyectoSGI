<?php

namespace App\Http\Controllers;

use App\Models\Boleta;
use App\Models\Estudiante;
use App\Models\Materia;
use Illuminate\Http\Request;
use DataTables;
use League\Csv\Reader;
use League\Csv\Statement;

class ReportesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $titulo = 'Reportes';
        return view('reportes.reportes',compact('titulo'));
    }

    public function indexPromedioFinal()
    {
        $titulo = 'Reporte Promedio Final';
        return view('reportes.reporte.reportePromedioFinal',compact('titulo'));
    }

    public function dataPromedioFinal(Request $request)
    {
        if ($request->ajax()) {
            $data = Boleta::getDataPromedioFinal();
            return Datatables::of($data)
                ->make(true);
        }
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
