<input type="hidden" id="nombre" value="{{ $estudiante->nombre }}">
<table class="table table-sm" id="datatable" style="width:100%">
    <thead class="table-dark">
        <tr class="fw-bold">
            <th>Materia</th>
            <th>E</th>
            <th>F</th>
            <th>M</th>
            <th>A</th>
            <th>R</th>
            <th>PT</th>
            <th>M</th>
            <th>J</th>
            <th>J</th>
            <th>R</th>
            <th>PT</th>
            <th>A</th>
            <th>S</th>
            <th>O</th>
            <th>R</th>
            <th>PT</th>
            <th>PF</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($materias as $materia)
            <tr>
                <td>{{ $materia->nombre }}</td>
                @foreach ($meses as $mes)
                    @foreach ($info[$materia->nombre][$mes] as $notas)
                        <td>{{ $notas }}</td>
                    @endforeach
                @endforeach

            </tr>
        @endforeach

    </tbody>
</table>

<script>
    $(document).ready(function() {
        var nombre = $('#nombre').val();
        var table = $('#datatable').DataTable({
            processing: true,
            serverSide: false,
            stateSave: true,
            scrollX: true,
            scrollY: true,
            autoWidth: false,
            responsive: true,
            dom: '<"row mb-3"<"col-sm-12 col-md-6"><"col-sm-12 col-md-6 text-md-end text-sm-center"B>>' +
                '<"row mb-3"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' +
                '<"row"<"col-sm-12"t>>' +
                '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
            language: {
                url: '{{ asset('Spanish.json') }}'
            },
            buttons: [{
                    extend: 'excelHtml5',
                    text: '<i class="fa fa-file-excel"></i>',
                    titleAttr: 'Exportar a Excel',
                    className: 'btn btn-success',
                    exportOptions: {
                        columns: ':visible'
                    },
                    customize: function(xlsx) {
                        var sheet = xlsx.xl.worksheets['sheet1.xml'];

                        // Modificar la fila que contiene la información del colegio y la boleta
                        $('row c[r^="A"]', sheet).each(function() {
                            if ($('is t', this).text().trim() === 'Reportes') {
                                $('is t', this).text('COLEGIO “LUZ DE ISRAEL” ' +
                                    '\nBOLETA MES DE  SEPTIEMBRE AÑO 2022                              Modalidad: PRESENCIAL' +
                                    '\nMAESTRA ORIENTADORA:' +
                                    '\nALUMNO(A): ' + nombre);
                            }
                        });
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: '<i class="fa fa-file-pdf"></i>',
                    titleAttr: 'Exportar a PDF',
                    className: 'btn btn-danger',
                    orientation: 'landscape',
                    pageSize: 'letter',
                    exportOptions: {
                        columns: ':visible'
                    },
                    customize: function(doc) {
                        doc.defaultStyle.fontSize = 11;
                        doc.pageMargins = [40, 60, 40, 60]; 
                        doc.content.splice(0,1,{ 
                            text: [
                                'COLEGIO “LUZ DE ISRAEL”',
                                'BOLETA MES DE  SEPTIEMBRE AÑO 2022   Modalidad: PRESENCIAL',
                                'MAESTRA ORIENTADORA:',
                                'ALUMNO(A): ' + nombre
                            ].join('\n'),
                            alignment: 'left',
                            margin: [40, 30, 0, 0]
                        });
                    }
                }

            ],
        });
    });
</script>
