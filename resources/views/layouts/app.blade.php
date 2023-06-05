    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        @yield('head')
    </head>

    <body class="antialiased">
        <div class="min-h-screen">
            <div class="container-fluid">
                <div class="row flex-nowrap">
                    <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0">
                        <div class="d-flex flex-column align-items-sm-start px-3 pt-2 min-vh-100">
                            <a href="/" class="d-flex align-items-center ms-4 pb-3 mb-md-0 me-md-auto">
                                <img src="{{ asset('img/logo.png') }}" alt="Mi imagen" width="120" height="120"
                                    class="img-fluid">
                            </a>
                            <ul class="nav nav-pills flex-column mb-sm-auto mt-2 align-items-center align-items-sm-start"
                                id="menu">
                                <li>
                                    <a href="#administracion" class="nav-link px-0 align-middle"
                                        data-bs-toggle="collapse">
                                        <span class="text-dark ms-1 d-none d-sm-inline">Administración</span>
                                    </a>
                                    <div class="collapse" id="administracion">
                                        <ul class="collapse show nav flex-column ms-1" data-bs-parent="#administracion">
                                            <li>
                                                <a href="#" class="nav-link px-2"> <span
                                                        class="d-none d-sm-inline text-dark">Docentes</span></a>
                                            </li>
                                            <li>
                                                <a href="{{route('estudiante.index')}}" class="nav-link px-2"> <span
                                                        class="d-none d-sm-inline text-dark">Estudiantes</span></a>
                                            </li>
                                            <li>
                                                <a href="#" class="nav-link px-2"> <span
                                                        class="d-none d-sm-inline text-dark">Grados</span></a>
                                            </li>
                                            <li>
                                                <a href="{{route('materia.index')}}" class="nav-link px-2"> <span
                                                        class="d-none d-sm-inline text-dark">Materias</span></a>
                                            </li>
                                            <li>
                                                <a href="#" class="nav-link px-2"> <span
                                                        class="d-none d-sm-inline text-dark">Evaluaciones</span></a>
                                            </li>
                                            <li>
                                                <a href="#" class="nav-link px-2"> <span
                                                        class="d-none d-sm-inline text-dark">Comportamientos</span></a>
                                            </li>
                                            <li>
                                                <a href="#" class="nav-link px-2"> <span
                                                        class="d-none d-sm-inline text-dark">Boletas de Notas</span></a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a href="{{route('reportes.index')}}" class="nav-link px-0 align-middle">
                                        <span class="text-dark ms-1 d-none d-sm-inline">Reportes</span></a>
                                </li>
                                <li>
                                    <a href="#adminUsuarios" class="nav-link px-0 align-middle"
                                        data-bs-toggle="collapse">
                                        <span class="text-dark ms-1 d-none d-sm-inline">Usuarios</span>
                                    </a>
                                    <div class="collapse" id="adminUsuarios">
                                        <ul class="collapse show nav flex-column ms-1" data-bs-parent="#adminUsuarios">
                                            <li>
                                                <a href="#" class="nav-link px-2"> <span
                                                        class="d-none d-sm-inline text-dark">Usuarios</span></a>
                                            </li>
                                            <li>
                                                <a href="/admin/roles" class="nav-link px-2"> <span
                                                        class="d-none d-sm-inline text-dark">Roles</span></a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a href="{{route('seguimiento.index')}}" class="nav-link px-0 align-middle">
                                        <span class="text-dark ms-1 d-none d-sm-inline">Seguimiento</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col py-3 bg-primary bg-opacity-10 text-dark">
                        <div class="card card-docs mb-3">
                            <div class="card-body fs-8 fs-xxl-4 py-3 px-5 text-gray-700">
                                <h1>@yield('titulo')</h1>
                            </div>
                        </div>
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>

    </body>

    </html>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>



    
    @yield('footer_scripts')

    <style>
        label.error {
            color: red;
            font-size: 12px;
            margin-top: 5px;
        }
    </style>
