<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

<div class="container">
    <h2 class="text-center">Login</h2>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="{{ route('iniciar-sesion') }}" method="GET">
                @csrf
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>
                <div class="form-group">
                    <label for="contrasena">Contraseña:</label>
                    <input type="password" class="form-control" id="contrasena" name="contrasena" required>
                </div>
                <div>
                    <p>¿No tienes cuenta? <a href="{{route('registro')}}">Registrate</a></p>
                </div>
                <button type="submit" class="btn btn-primary mt-4">Login</button>
            </form>
        </div>
    </div>
</div>
