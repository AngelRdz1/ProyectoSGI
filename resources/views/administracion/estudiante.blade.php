@extends('layouts.app')
@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $titulo}}</title>
@endsection
@section('titulo')
{{ $titulo}}
@endsection
@section('content')
    @component('components.table')
        @slot('thead')
            <th>NIE</th>
            <th>Nombre</th>
            <th>Número Lista</th>
            <th>Grado</th>
            <th>Sección</th>
        @endslot
    @endcomponent
    @component('components.modal')
        @slot('bodyForm')
            <label>Estudiante CSV</label>
            <input type="file" id="estudianteCsv" class="form-control" name="estudianteCsv">
        @endslot
    @endcomponent
@endsection
@section('footer_scripts')
    <script>
        $(function() {
            $("#gnlError").hide();
            $("#gnlSuccess").hide();
            var total_columns = $("#datatable thead").find("tr")[0].cells.length;
            var initialLoad = false;
            var table = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                scrollX: false,
                autoWidth: false,
                responsive: true,
                "dom": "<'row'" +
                    "<'col-sm-12 d-flex align-items-center justify-content-start'l>" +
                    "<'col-sm-12 d-flex align-items-center justify-content-end'f>" +
                    ">" +
                    "<'table-responsive'tr>" +
                    "<'row'" +
                    "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                    "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                    ">",
                language: {
                    url: '{{ asset('Spanish.json') }}'
                },
                initComplete: function() {
                    table = $('#datatable').DataTable();
                    new $.fn.dataTable.Buttons(table, {
                        name: 'btnAdd',
                        buttons: [{
                            text: 'Agregar',
                            className: 'ms-10 btn btn-primary add-class'
                        }]
                    });
                    $('.dataTables_length').empty();
                    table
                        .buttons('btnAdd', null)
                        .containers()
                        .insertBefore('.dataTables_length');
                },
                order: [
                    [total_columns - 1, "desc"]
                ],
                ajax: '{!! route('estudiante.index.data') !!}',
                columns: [
                    {
                        data: 'nie',
                        name: 'nie',
                    },
                    {
                        data: 'nombre',
                        name: 'nombre',
                    },
                    {
                        data: 'numero_lista',
                        name: 'numero_lista',
                    },
                    {
                        data: 'numero',
                        name: 'numero',
                    },
                    {
                        data: 'seccion',
                        name: 'seccion',
                    },
                ]
            });
            //Abrir modal para agregar
            $('body').on('click', '.add-class', function() {
                $("label.error").hide();
                $("#FormModal #gnlError").hide();
                $(".error").removeClass("error");

                $('#FormModal').modal("show");
                $('#FormModal #modal-body #name').val('');

                $('#FormModal #modal-footer #action_type').val('store');
                $('#modal-title').text('Agregar Estudiantes');
                $('#estudianteCsv').val('');
            });
            //guardar
            $("#AForm").validate({
                rules: {
                    estudianteCsv: {
                        "required": true
                    }
                },
                messages: {
                    estudianteCsv: {
                        required: "El campo es requerido"
                    }
                },
                submitHandler: function(form) {
                    var url = '{{ route('estudiante.upload.csv') }}';
                    var formData = new FormData(
                        form); // Crear objeto FormData para enviar el formulario

                    $.ajax({
                        url: url,
                        method: 'post',
                        data: formData,
                        processData: false, // Evitar el procesamiento automático de los datos
                        contentType: false, // Evitar el establecimiento automático del encabezado Content-Type
                        success: function(result) {
                            $('#FormModal').modal('hide');
                            $('#gnlSuccess').html(result.message);
                            $('#gnlSuccess').show();
                            $('#datatable').DataTable().ajax.reload();
                            setTimeout(function() {
                                $('#gnlSuccess').hide();
                            }, 1000);
                        },
                        error: function(err) {
                            if (err.status == 422) {
                                $.each(err.responseJSON.errors, function(i, error) {
                                    var el = $(document).find('[name="' + i + '"]');
                                    el.after($('<label style="color: red;" class="error">' +
                                        error[0] + '</label>'));
                                });
                            }
                            if (err.status == 400) {
                                $('#FormModal #gnlError').html(err.responseJSON.message);
                                $('#FormModal #gnlError').show();
                                setTimeout(function() {
                                    $('FormModal #gnlError').hide();
                                }, 1000);
                            }
                        }
                    });
                },

            });
        });
    </script>
@endsection
