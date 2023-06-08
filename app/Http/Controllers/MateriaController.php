<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use Illuminate\Http\Request;
use DataTables;
use League\Csv\Reader;
use League\Csv\Statement;

class MateriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $titulo = 'Materias';
        return view('administracion.materia',compact('titulo'));
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $data = Materia::getData();
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

    public function uploadCSV(Request $request){
        $file = $request->file('materiaCsv');

        if ($file->isValid()) {
            $path = $file->path();

            $csv = Reader::createFromPath($path, 'r');
            $csv->setHeaderOffset(0); 

            $modelColumns = ['nombre']; // Nombres de columna de la tabla
            $csvColumns = $csv->getHeader(); // Encabezados del archivo CSV

            if (count(array_diff($modelColumns, $csvColumns)) > 0) {//validar si las columnas sin iguales a las esperadas
                return response()->json(['message' => 'El archivo CSV no tiene el formato requerido'], 400);
            }

            $elementos = (new Statement())->process($csv);
            foreach ($elementos as $elementos) {
                $nombre = $elementos['nombre'];//se coloca el nombre de la columna, si se tiene mas crear otra variable
                $docente_id = $elementos['docente_id'];

                $materia = new Materia();//crear un nuevo objeto materia
                $materia->nombre = $nombre;
                $materia->docente_id = $docente_id;
                $materia->save();//guardar la materia
            }
            
            return response()->json(['message' => 'Archivo CSV procesado correctamente'], 200);
        }
        return response()->json(['message' => 'Error al subir el archivo CSV'], 400);
    }
}
