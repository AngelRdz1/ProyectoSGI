<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use App\Models\Grado;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use DataTables;


class GradoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profesores = Docente::all();
        $titulo = 'Grados';
        return view('administracion.grados',compact('profesores','titulo'));
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $data = Grado::getData();
            //dd($data);
            return Datatables::of($data)
                /*->addColumn('action', function ($row) {
                    $actionBtn = '';
                    $actionBtn = '<a href="javascript:void(0)" class="edit-class pe-2" id="' . $row->id . '" title="Editar"><i class="bi bi-pencil-square fs-2x text-primary"></i></a>';
                    return $actionBtn;
                })*/
                //->rawColumns(['action'])
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
        $data = $request->all();
        $object = new Grado();
        $object->create($data);
        return 'OK';
    }

    /**
     * Display the specified resource.
     */
    public function show(Grado $grado)
    {
        
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $formEditData = Grado::where('id', $request->id)->first(['id', 'numero', 'seccion', 'cant_ninos', 'cant_ninas', 'docente_id']);
        return response()->json($formEditData);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $object = Grado::find($request->id);
        $object->fill($request->all());
        $object->update();
        return 'OK';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grado $grado)
    {
        //
    }
}
