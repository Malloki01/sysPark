<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SysParking</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="bg-light">
        <!-- Navbar -->
        <nav class="navbar navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand d-flex align-items-center" href="#">
                    <img src="http://127.0.0.1:8000/images/syslogo.png" alt="SysParking Logo" class="me-2" style="width: 40px; height: 40px;">
                    <span>SysParking</span>
                </a>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="container d-flex flex-column align-items-center justify-content-center vh-100 text-center">
            <div class="mb-4">
                <img src="http://127.0.0.1:8000/images/syslogo.png" alt="Logo Estacionamiento" class="img-fluid" style="width: 19.5rem; height: 19.5rem;">
            </div>
            <h1 class="mb-4" style="font-size: 3rem; font-weight: bold;">Estacionamiento</h1>
            <div class="d-flex flex-column flex-md-row gap-3">
                <a href="{{ url('clientes') }}" class="btn btn-dark btn-lg px-4">Registrarse</a>
                <a href="{{ url('login') }}" class="btn btn-outline-dark btn-lg px-4">Iniciar Sesión</a>
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
