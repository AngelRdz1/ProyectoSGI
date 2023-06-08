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
                scrollY: '400px',
                autoWidth: false,
                responsive: true,
                dom:'<"row mb-3"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' +
                    '<"row"<"col-sm-12"t>>' +
                    '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
                language: {
                    url: '{{ asset('Spanish.json') }}'
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
