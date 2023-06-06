@extends('layouts.app')
@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $titulo}}</title>
@endsection
@section('titulo')
{{ $titulo}}
@endsection
@section('content')
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link menu-reporte active" aria-current="page" href="#" data-action="{{ route('reportes.reportepromediofinal.index') }}">Boleta de notas</a>
        </li>
        <li class="nav-item">
            <a class="nav-link menu-reporte" href="#" data-action="{{ route('reportes.reportepromediofinal.index') }}">Consolidado</a>
        </li>
        <li class="nav-item">
            <a class="nav-link menu-reporte" href="#" data-action="{{ route('reportes.reportepromediofinal.index') }}">Promedios</a>
        </li>
        <li class="nav-item">
            <a class="nav-link menu-reporte" href="#" data-action="{{ route('reportes.reportepromediofinal.index') }}">Promedio Final</a>
        </li>
    </ul>
    <div id="PageContenido"></div>
@endsection
@section('footer_scripts')
    <script>
        $('.menu-reporte').on('click', function() {
            $('.menu-reporte').removeClass('active');
            $(this).addClass('active');
            var action = $(this).data('action');
            $.ajax({
                url: action,
                type: 'GET',
                success: function(response) {
                    $("#PageContenido").html(response);
                }
            });
        });
    </script>
@endsection