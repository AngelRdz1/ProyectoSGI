<div class="card" id="tablaPromedioFinal">
    <div class="fs-8 fs-xxl-6 py-5 px-5 text-gray-700">
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
                                <button id="btnExtraer" class="btn btn-outline-secondary w-50">Extraer</button>
                            </div>
                            <div class="form-group col-md-2 mb-2"></div>
                            <!-- Botones Excel y PDF -->
                            <div class="col-md-2 mb-2">
                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-outline-success w-25" id="btnReporteExcel">
                                        <i class="bi bi-file-spreadsheet-fill"></i>
                                    </button>
                                    <button type="button" class="btn btn-outline-danger ms-2 w-25" id="btnReportePDF">
                                        <i class="bi bi-file-pdf-fill"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <hr>
        <div class="table-container">
            <table class="table table-sm" id="datatable" style="width:100%; font-size: 14px;">
                <thead class="table-dark">
                    <tr class="fw-bold">
                        <th>Estudiante</th>
                        @foreach ($headers as $header)
                            <th>{{ $header->nombre }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($estudiantes as $estudiante)
                        <tr>
                            <td>{{ $estudiante->nombre }}</td>
                            @foreach ($headers as $header)
                                <td>{{ $matrizPromedioFinal[$estudiante->nie_estudiante][$header->nombre] }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $(function() {
        var anio = $("#anio").val();
        var grado = $("#grado").val();
        var seccion = $("#seccion").val();
        var total_columns = $("#datatable thead").find("tr")[0].cells.length;
        var table = $('#datatable').DataTable({
            processing: true,
            serverSide: false,
            stateSave: true,
            scrollX: false,
            scrollY: '300px',
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
                    extend: 'excelHtml5',
                    text: '<i class="bi bi-file-excel"></i> Excel',
                    className: 'btn btn-success d-none',
                    exportOptions: {
                        columns: ':visible'
                    },
                    customize: function(xlsx) {
                        var sheet = xlsx.xl.worksheets['sheet1.xml'];
                        $('row c[r^="A"]', sheet).each(function() {
                            if ($('is t', this).text().trim() === 'Reportes') {
                                $('is t', this).text('REPORTE PROMEDIO FINAL\nCOLEGIO LUZ DE ISRAEL\nAÑO: ' + anio + '    GRADO: ' + grado + '    SECCION: ' + seccion);
                            }
                        });
                    }
                },
                {
                    extend: 'pdf',
                    text: '<i class="bi bi-file-pdf"></i> PDF',
                    className: 'btn btn-danger d-none',
                    exportOptions: {
                        columns: ':visible'
                    },
                    title: grado + seccion + ' REPORTE PROMEDIO FINAL',
                    customize: function(doc) {
                        doc.defaultStyle.fontSize = 11;

                        // Personalizar el título del documento PDF
                        doc.content[0].text = 'REPORTE PROMEDIO FINAL\nCOLEGIO LUZ DE ISRAEL\nAÑO: ' + anio + '    GRADO: ' + grado + '    SECCION: ' + seccion;
                        doc.content[0].alignment = 'center';
                        doc.content[0].fontSize = 12;
                        doc.content[0].margin = [0, 0, 0, 10];

                        // Marcar los bordes de la tabla
                        var table = doc.content[1].table;
                        for (var i = 0; i < table.body.length; i++) {
                            var row = table.body[i];
                            for (var j = 0; j < row.length; j++) {
                                row[j].style = { cellBorder: '1px solid black' };
                            }
                        }

                        // Establecer el estilo de fuente para la tabla
                        doc.styles.tableBody = { fontSize: 10 };
                    }
                }
            ]
        });
    });
    $(document).ready(function() {
        $("#btnReporteExcel").on("click", function() {
            $(".dt-button.buttons-excel").click();
            $.ajax({
                url: "{{ route('reportes.reportepromediofinal.excel') }}",
                type: 'GET',
            });
        });
        $("#btnReportePDF").on("click", function() {
            $(".dt-button.buttons-pdf").click();
            $.ajax({
                url: "{{ route('reportes.reportepromediofinal.pdf') }}",
                type: 'GET',
            });
        });
        // Capturar el evento de clic en el botón "Extraer"
        $("#btnExtraer").on("click", function(event) {
            event.preventDefault();
            // Obtener los valores seleccionados en los campos de filtro
            var anio = $("#anio").val();
            var grado = $("#grado").val();
            var seccion = $("#seccion").val();

            // Realizar la solicitud AJAX al servidor
            $.ajax({
                url: "{{ route('reportes.reportepromediofinal.index') }}",
                type: 'GET',
                data: {
                    anio: anio,
                    grado: grado,
                    seccion: seccion
                },
                success: function(response) {
                    $("#tablaPromedioFinal").replaceWith(response);
                }
            });
        });
    });
</script>
