<?php

namespace App\Http\Controllers;

use App\Models\Comportamiento;
use Illuminate\Http\Request;
use DataTables;
use League\Csv\Reader;
use League\Csv\Statement;

class ComportamientoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $titulo = 'Comportamientos';
        return view('administracion.comportamiento', compact('titulo'));
    }

    public function data(Request $request) {
        if ($request->ajax()) {
            $data = Comportamiento::getData();
            return Datatables::of($data)
                ->make(true);
        }
    }

    public function uploadCSV(Request $request){
        $file = $request->file('comportamientoCsv');

        if ($file->isValid()) {
            $path = $file->path();

            $csv = Reader::createFromPath($path, 'r');
            $csv->setHeaderOffset(0);

            $modelColumns = ['tipo', 'nombre', 'valor', 'boleta_id']; // Nombres de columna de la tabla
            $csvColumns = $csv->getHeader(); // Encabezados del archivo CSV

            if (count(array_diff($modelColumns, $csvColumns)) > 0) {//validar si las columnas sin iguales a las esperadas
                return response()->json(['message' => 'El archivo CSV no tiene el formato requerido'], 400);
            }

            $elementos = (new Statement())->process($csv);
            foreach ($elementos as $elementos) {
                $tipo = $elementos['tipo'];
                $nombre = $elementos['nombre'];//se coloca el nombre de la columna, si se tiene mas crear otra variable
                $valor = $elementos['valor'];
                $boleta_id = $elementos['boleta_id'];
                $comportamiento = new Comportamiento();//crear un nuevo objeto docente
                $comportamiento->tipo = $tipo;//asignar el valor
                $comportamiento->nombre = $nombre;//asignar el valor
                $comportamiento->valor = $valor;//asignar el valor
                $comportamiento->boleta_id = $boleta_id;//asignar el valor
                $comportamiento->save();//guardar el comportamiento
            }

            return response()->json(['message' => 'Archivo CSV procesado correctamente'], 200);
        }
        return response()->json(['message' => 'Error al subir el archivo CSV'], 400);
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
        //
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
