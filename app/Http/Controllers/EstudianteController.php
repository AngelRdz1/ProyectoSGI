<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use Illuminate\Http\Request;
use DataTables;
use League\Csv\Reader;
use League\Csv\Statement;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $titulo = 'Estudiantes';
        return view('administracion.estudiante',compact('titulo'));
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $data = Estudiante::getData();
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
        $file = $request->file('estudianteCsv');

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
                $nie = $elementos['nie'];
                $nombre = $elementos['nombre'];//se coloca el nombre de la columna, si se tiene mas crear otra variable
                $numero_lista = $elementos['numero_lista'];
                $grado_id = $elementos['grado_id'];

                $estudiante = new Estudiante();//crear un nuevo objeto estudiante
                $estudiante->nie = $nie;//asignar el valor
                $estudiante->nombre = $nombre;
                $estudiante->numero_lista = $numero_lista;
                $estudiante->grado_id = $grado_id;
                $estudiante->save();//guardar el estudiante
            }
            
            return response()->json(['message' => 'Archivo CSV procesado correctamente'], 200);
        }
        return response()->json(['message' => 'Error al subir el archivo CSV'], 400);
    }
}
