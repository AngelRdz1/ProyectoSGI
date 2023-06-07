<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Bitacora;

class LogBitacora
{
    public function handle(Request $request, Closure $next)
    {
        // Obtener la URL de la solicitud actual
        //$url = $request->url();

        // Verificar si la URL coincide con la ruta que deseas omitir
        /*if ($url === route('login')) {
            return $next($request);
        }*/
        
        $response = $next($request);

        //Verificar si el usuario está autenticado
        //if (auth()->check()) {
            // Registrar la acción en la tabla de bitácora
            $bitacora = new Bitacora();
            $bitacora->user_id = 1;//auth()->user()->id;
            $bitacora->accion =  $this->getAccion($request);
            $bitacora->descripcion = $this->getDescripcion($request,"Gustavo");
            $bitacora->fecha_realizacion = now();
            $bitacora->save();
        //}

        return $response;
    }

    //Método para obtener la acción realizada
    private function getAccion($request){
        switch ($request->route()->getName()) {
            //Inicio al sistema
            case 'home':
                return 'Ver Inicio';

            //Roles
            case 'roles.index':
                return 'Ver Roles';
            case 'roles.create':
                return 'Crear Rol';
            case 'roles.store':
                return 'Guardar Rol';
            case 'roles.edit':
                return 'Editar Rol';
            case 'roles.update':
                return 'Actualizar Rol';
            case 'roles.destroy':
                return 'Eliminar Rol';
            
            //Usuarios
            case 'usuarios.index':
                return 'Ver Usuarios';
            case 'usuarios.create':
                return 'Crear Usuario';
            case 'usuarios.store':
                return 'Guardar Usuario';
            case 'usuarios.edit':
                return 'Editar Usuario';
            case 'usuarios.update':
                return 'Actualizar Usuario';
            case 'usuarios.destroy':
                return 'Eliminar Usuario';

            //Tablas Administración
            case 'docente.index':
                return 'Ver Docentes';
            case 'estudiante.index':
                return 'Ver Estudiantes';
            case 'grado.index':
                return 'Ver Grados';
            case 'materia.index':
                return 'Ver Materias';
            case 'reportes.index':
                return 'Ver Reportes';

            //Carga de datos en administración
            case 'docente.upload.csv':
                return 'Carga de Docentes';
            case 'estudiante.upload.csv':
                return 'Carga de Estudiantes';
            case 'grado.upload.csv':
                return 'Carga de Grados';
            case 'materia.upload.csv':
                return 'Carga de Materias';          

            //Reportes
            case 'reportes.reporteboletanotas.index':
                return 'Ver Reporte de Boleta de Notas';
            case 'reportes.reporteconsolidado.index':
                return 'Ver Reporte de Consolidado';
            case 'reportes.reportepromedios.index':
                return 'Ver Reporte de Promedios';
            case 'reportes.reportepromediotrimestral.index':
                return 'Ver Reporte de Promedio Trimestral';
            case 'reportes.reportepromediofinal.index':
                return 'Ver Reporte de Promedio Final';
            
            //Descarga de reportes
            case 'reportes.reporteboletanotas.pdf':
                return 'Descargar Reporte de Boleta de Notas';
            case 'reportes.reporteboletanotas.excel':
                return 'Descargar Reporte de Boleta de Notas';
            case 'reportes.reporteconsolidado.pdf':
                return 'Descargar Reporte de Consolidado';
            case 'reportes.reporteconsolidado.excel':
                return 'Descargar Reporte de Consolidado';
            case 'reportes.reportepromedios.pdf':
                return 'Descargar Reporte de Promedios';
            case 'reportes.reportepromedios.excel':
                return 'Descargar Reporte de Promedios';
            case 'reportes.reportepromediotrimestral.pdf':
                return 'Descargar Reporte de Promedio Trimestral';
            case 'reportes.reportepromediotrimestral.excel':
                return 'Descargar Reporte de Promedio Trimestral';
            case 'reportes.reportepromediofinal.pdf':
                return 'Descargar Reporte de Promedio Final';
            case 'reportes.reportepromediofinal.excel':
                return 'Descargar Reporte de Promedio Final';  

            //Bitacora
            case 'seguimiento.index':
                return 'Ver Bitacora';
                
            default:
                return 'Recarga de Vista';
        }
    }

    //Método para obtener la descripción de la acción realizada
    private function getDescripcion($request, $user){
        switch ($request->route()->getName()) {
            //Inicio al sistema
            case 'home':
                return 'El usuario ' . $user . ' accedió al inicio.';

            //Roles
            case 'roles.index':
                return 'El usuario ' . $user . ' accedió al listado de los roles.';
            case 'roles.create':
                return 'El usuario ' . $user . ' creó un nuevo rol.';
            case 'roles.store':
                return 'El usuario ' . $user . ' registró un rol.';
            case 'roles.edit':
                return 'El usuario ' . $user . ' editó un rol.';
            case 'roles.update':
                return 'El usuario ' . $user . ' actualizó un rol.';
            case 'roles.destroy':
                return 'El usuario ' . $user . ' eliminó un rol.';
            
            //Usuarios
            case 'usuarios.index':
                return 'El usuario ' . $user . ' accedió al listado de los usuarios.';
            case 'usuarios.create':
                return 'El usuario ' . $user . ' creó un nuevo usuario.';
            case 'usuarios.store':
                return 'El usuario ' . $user . ' registró un usuario.';
            case 'usuarios.edit':
                return 'El usuario ' . $user . ' editó un usuario.';
            case 'usuarios.update':
                return 'El usuario ' . $user . ' actualizó un usuario.';
            case 'usuarios.destroy':
                return 'El usuario ' . $user . ' eliminó un usuario.';

            //Tablas Administración
            case 'docente.index':
                return 'El usuario ' . $user . ' accedió al listado de los docentes.';
            case 'estudiante.index':
                return 'El usuario ' . $user . ' accedió al listado de los estudiantes.';
            case 'grado.index':
                return 'El usuario ' . $user . ' accedió al listado de los grados.';
            case 'materia.index':
                return 'El usuario ' . $user . ' accedió al listado de las materias.';
            case 'reportes.index':
                return 'El usuario ' . $user . ' accedió a los reportes.';

            //Carga de datos en administración
            case 'docente.upload.csv':
                return 'El usuario ' . $user . ' cargo un archivo .csv con un listado de docentes.';
            case 'estudiante.upload.csv':
                return 'El usuario ' . $user . ' cargo un archivo .csv con un listado de estudiantes.';
            case 'grado.upload.csv':
                return 'El usuario ' . $user . ' cargo un archivo .csv con un listado de grados.';
            case 'materia.upload.csv':
                return 'El usuario ' . $user . ' cargo un archivo .csv con un listado de materias.';         

            //Reportes
            case 'reportes.reporteboletanotas.index':
                return 'El usuario ' . $user . ' accedió al reporte de boleta de notas.';
            case 'reportes.reporteconsolidado.index':
                return 'El usuario ' . $user . ' accedió al reporte de consolidado.';
            case 'reportes.reportepromedios.index':
                return 'El usuario ' . $user . ' accedió al reporte de promedios.';
            case 'reportes.reportepromediotrimestral.index':
                return 'El usuario ' . $user . ' accedió al reporte de promedio trimestral.';
            case 'reportes.reportepromediofinal.index':
                return 'El usuario ' . $user . ' accedió al reporte de promedio final.';
            
            //Descarga de reportes
            case 'reportes.reporteboletanotas.pdf':
                return 'El usuario ' . $user . ' descargo el reporte de boleta de notas en un archivo de pdf.';
            case 'reportes.reporteboletanotas.excel':
                return 'El usuario ' . $user . ' descargo el reporte de boleta de notas en un archivo de excel.';
            case 'reportes.reporteconsolidado.pdf':
                return 'El usuario ' . $user . ' descargo el reporte de consolidado en un archivo de pdf.';
            case 'reportes.reporteconsolidado.excel':
                return 'El usuario ' . $user . ' descargo el reporte de consolidado en un archivo de excel.';
            case 'reportes.reportepromedios.pdf':
                return 'El usuario ' . $user . ' descargo el reporte de promedios en un archivo de pdf.';
            case 'reportes.reportepromedios.excel':
                return 'El usuario ' . $user . ' descargo el reporte de promedios en un archivo de excel.';
            case 'reportes.reportepromediotrimestral.pdf':
                return 'El usuario ' . $user . ' descargo el reporte de promedio trimestral en un archivo de pdf.';
            case 'reportes.reportepromediotrimestral.excel':
                return 'El usuario ' . $user . ' descargo el reporte de promedio trimestral en un archivo de excel.';
            case 'reportes.reportepromediofinal.pdf':
                return 'El usuario ' . $user . ' descargo el reporte de promedio final en un archivo de pdf.';
            case 'reportes.reportepromediofinal.excel':
                return 'El usuario ' . $user . ' descargo el reporte de promedio final en un archivo de excel.';

            //Bitacora
            case 'seguimiento.index':
                return 'El usuario ' . $user . ' accedió a la bitacora.';
                
            default:
                return 'El usuario ' . $user . ' se le recargó la vista para la actualización de los datos.';
        }
    }
}