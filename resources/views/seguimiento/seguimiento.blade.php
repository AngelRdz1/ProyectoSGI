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
            <th class="d-none">Id</th>
            <th>Fecha</th>
            <th>Usuario</th>
            <th>Accción</th>
            <th>Descripción</th>
        @endslot
    @endcomponent
    @component('components.modal')
        @slot('bodyForm')

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
                ajax: '{!! route('seguimiento.index.data') !!}',
                columns: [
                    {
                        data: 'id',
                        name: 'id',
                        className: 'd-none',
                    },
                    {
                        data: 'fecha_realizacion',
                        name: 'fecha_realizacion',
                    },
                    {
                        data: 'name_usuario',
                        name: 'name_usuario',
                    },
                    {
                        data: 'accion',
                        name: 'accion',
                    },
                    {
                        data: 'descripcion',
                        name: 'descripcion',
                    },
                ]
            });
        });
    </script>
@endsection
