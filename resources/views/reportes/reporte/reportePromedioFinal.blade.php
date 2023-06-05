@component('components.table')
    @slot('tituloTabla')
    <div class="row">
        <form id="formPromedioFinal" action="" method="GET">
            <div class="row">
                <div class="col-md-12">
                    <h5 class="mb-4">Filtros</h5>
                    <div class="row col-md-12 align-items-end">
                        <!-- Año -->
                        <div class="form-group col-md-2 mb-2">
                            <label for="Periodo">Año</label>
                            <select class="form-select" id="anio" name="anio" required>
                                <option value="">Seleccione el año</option>
                                @foreach ($anios as $eAnio)
                                    <option value="{{ $eAnio->anio }}" {{ old('anio', $request->anio) == $eAnio->anio ? 'selected' : '' }}>
                                        {{ $eAnio->anio }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Grado -->
                        <div class="form-group col-md-2 mb-2">
                            <label for="Grado">Grado</label>
                            <select class="form-select" id="grado" name="grado" required>
                                <option value="">Seleccione el grado</option>
                                @foreach ($grados as $eGrado)
                                    <option value="{{ $eGrado->grado }}" {{ old('grado', $request->grado) == $eGrado->grado ? 'selected' : '' }}>
                                        {{ $eGrado->grado }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Seccion -->
                        <div class="form-group col-md-2 mb-2">
                            <label for="Seccion">Sección</label>
                            <select class="form-select" id="seccion" name="seccion" required>
                                <option value="">Seleccione la sección</option>
                                @foreach ($secciones as $eSeccion)
                                    <option value="{{ $eSeccion->seccion }}" {{ old('seccion', $request->seccion) == $eSeccion->seccion ? 'selected' : '' }}>
                                        {{ $eSeccion->seccion }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Boton -->
                        <div class="form-group col-md-2 mb-2">
                            <button type="submit" class="btn btn-outline-secondary w-50">Extraer</button>
                        </div>
                        <!-- Botones Excel y PDF -->
                        <div class="col-md-4 mb-2">
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-outline-success w-25" id="btnReporteExcel">
                                    <i class="bi bi-file-spreadsheet-fill"></i> Excel
                                </button>
                                <button type="button" class="btn btn-outline-danger ms-2 w-25" id="btnReportePDF">
                                    <i class="bi bi-file-pdf-fill"></i> PDF
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <hr>    
    @endslot
    @slot('thead')
        <td>Estudiante</td>
        @foreach ($headers  as $header)
            <td>{{$header->nombre}}</td>
        @endforeach
    @endslot
    @slot('tbody')
    @endslot
@endcomponent
<script>
$(function() {
    $("#gnlError").hide();
    $("#gnlSuccess").hide();
    var total_columns = $("#datatable thead").find("tr")[0].cells.length;
    var table = $('#datatable').DataTable({
        processing: true,
        serverSide: false,
        stateSave: true,
        scrollX: false,
        autoWidth: false,
        responsive: true,
        dom: '<"row mb-3"<"col-sm-12 col-md-6"><"col-sm-12 col-md-6 text-md-right text-sm-center"B>>' +
            '<"row mb-3"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' +
            '<"row"<"col-sm-12"t>>' +
            '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
        language: {
            url: '{{ asset('Spanish.json') }}'
        },
        buttons: [
            {
                extend: 'excel',
                text: '<i class="bi bi-file-excel"></i> Excel',
                className: 'btn btn-success d-none',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdf',
                text: '<i class="bi bi-file-pdf"></i> PDF',
                className: 'btn btn-danger d-none',
                exportOptions: {
                    columns: ':visible'
                }
            }
        ]
    });
});
$(document).ready(function() {
    $("#btnReporteExcel").on("click", function() {
        $(".dt-button.buttons-excel").click();
    });
    $("#btnReportePDF").on("click", function() {
        $(".dt-button.buttons-pdf").click();
    });
});
</script>
