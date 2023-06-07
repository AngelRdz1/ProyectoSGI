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
        return view('reportes.reporte.tablaBoleta',compact('datas','materias'));
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
