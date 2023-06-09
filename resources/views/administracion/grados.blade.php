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
            <th>Grado</th>
            <th>Sección</th>
            <th>Niños</th>
            <th>Niñas</th>
            <th>Docente</th>
        @endslot
    @endcomponent
    @component('components.modal')
        @slot('bodyForm')
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="numero" class="form-label">Número</label>
                <input type="number" name="numero" id="numero" class="form-control"value="" />
            </div>
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="seccion" class="form-label">Seccion</label>
                <input type="text" name="seccion" id="seccion" class="form-control" maxlength="1" value="" />
            </div>
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="cant_ninos" class="form-label">Cantidad Niños</label>
                <input type="number" name="cant_ninos" id="cant_ninos" class="form-control" maxlength="40" value="" />
            </div>
            <div class="col-sm-12 col-md-6 mb-3">
                <label for="cant_ninas" class="form-label">Cantidad Niñas</label>
                <input type="number" name="cant_ninas" id="cant_ninas" class="form-control" maxlength="40" value="" />
            </div>
            <div class="col-sm-12 col-md-6 mb-3">
                <select class="form-select" data-control="select2" data-placeholder="Select an option" name="docente_id"
                    id="docente_id">
                    @foreach ($profesores as $profesor)
                        <option value="{{ $profesor->id }}">{{ $profesor->nombre }}</option>
                    @endforeach
                </select>
            </div>
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
                dom:'<"row mb-3"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' +
                    '<"row"<"col-sm-12"t>>' +
                    '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
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
                ajax: '{!! route('grados.index.data') !!}',
                columns: [{
                        data: 'numero',
                        name: 'numero'
                    },
                    {
                        data: 'seccion',
                        name: 'seccion',
                    },
                    {
                        data: 'cant_ninos',
                        name: 'cant_ninos'
                    },
                    {
                        data: 'cant_ninas',
                        name: 'cant_ninas'
                    },
                    {
                        data: 'nombre',
                        name: 'nombre'
                    },
                    /*{
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    }*/
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
                $('#modal-title').text('Agregar');
                $('#modal-body #numero').val('');
                $('#modal-body #seccion').val('');
                $('#modal-body #cant_ninos').val('');
                $('#modal-body #cant_ninas').val('');
                $('#modal-body #docente_id').val('');
            });
            //mostrar actualizar
            $('#datatable tbody').on('click', '.edit-class', function() {
                $("label.error").hide();
                $("#FormModal #gnlError").hide();
                $(".error").removeClass("error");

                var id = $(this).attr('id');
                $('#id').val(id);
                $('#FormModal').modal("show");
                $('#modal-title').text('Editar');

                $.ajax({
                    url: '{{ route('grado.edit') }}',
                    method: 'POST',
                    data: {
                        'id': id,
                        '_token': $("meta[name='csrf-token']").prop("content")
                    }
                }).done(function(data) {
                    $('#modal-footer #action_type').val('update');
                    $('#FormModal #modal-footer #id').val(data.id);
                    $('#modal-body #numero').val(data.numero);
                    $('#modal-body #seccion').val(data.seccion);
                    $('#modal-body #cant_ninos').val(data.cant_ninos);
                    $('#modal-body #cant_ninas').val(data.cant_ninas);
                    $('#modal-body #docente_id').val(data.docente_id);

                }).fail(function() {
                    $('#modal-body').html('<p>Error cargando datos.</p>');
                });
            });
            //agragar nueva regla
            $.validator.addMethod("enteroNoNegativo", function(value, element) {
                var regex = /^[0-9]+$/;
                return this.optional(element) || regex.test(value);
            }, "Por favor, ingrese un número entero no negativo.");

            //guardar
            $("#AForm").validate({
                rules: {
                    numero: {
                        "required": true,
                        "enteroNoNegativo": true
                    },
                    seccion: "required",
                    cant_ninos:{
                        "required":true,
                        "enteroNoNegativo": true
                    },
                    cant_ninas:{
                        "required":true,
                        "enteroNoNegativo": true
                    },
                    docente_id: "required",
                },
                messages:{
                    cant_ninos:{
                        required:"El campo es requerido"
                    }
                },
                submitHandler: function(form) {
                    var route_store = '{{ route('grado.store') }}';
                    var route_update = '{{ route('grado.update') }}';
                    var action_type = $('#FormModal #modal-footer #action_type').val();
                    var url = (action_type === 'store') ? route_store : route_update;
                    $.ajax({
                        url: url,
                        method: 'post',
                        data: $('#AForm').serialize(),
                        success: function(result) {
                            $('#FormModal').modal('hide');
                            $('#datatable').DataTable().ajax.reload();
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
                                $('#FormModal #gnlError').html(err.responseJSON);
                                $('#FormModal #gnlError').show();
                            }

                        }
                    });
                },
            });



        });
    </script>
@endsection
