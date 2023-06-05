<?php

namespace App\Http\Controllers;

use App\Models\Boleta;
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

    public function indexPromedioFinal(Request $request)
    {
        $titulo = 'Reporte Promedio Final';
        $headers = Materia::getHeaderMateria();
        $anios=Boleta::getAnios();
        $grados=Boleta::getGrados();
        $secciones=Boleta::getSecciones();
        return view('reportes.reporte.reportePromedioFinal',compact('titulo','headers','anios','grados','secciones','request'));
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
