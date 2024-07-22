<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Comunidad BANCARIA</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="estilo.css">
        <style>
            .btn-primary, .btn-primary:hover, .btn-primary:active, .btn-primary:visited {
              background-color: #FF0000 !important;
              border: #FF0000;
            }
			
			html{
				min-height: 100%;
				position: relative;
			}
			body {
				margin: 0;
				margin-bottom: 3rem;
			}
			.footer{
				background-color: black;
				position: absolute;
				bottom: 0;
				width: 100%;
				height: 40px;
				color: white;
			}
            </style>
    </head>
    <body style="background-color: white">
        <header>
            <div class="jumbotron text-center" style="background: black">
				<img src="img/Logo.png" class="rounded mx-auto d-block" width="200" height="100" alt="...">
                <hr class="my-0" />
            </div>
            <nav class="navbar navbar-expand-lg " style="background-color: white">
                <div class="container-fluid">
                    <!-- Si colapsa lo quiero en el medio en lo posible-->
                    <a class="navbar-brand mx-auto" href="#">
                        
                        Comunidad BANCARIA
                    </a>
                    <button
                        class="navbar-toggler"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent"
                        aria-expanded="false"
                        aria-label="Toggle navigation"
                    >
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item mx-auto">
                                <a class="nav-link active" aria-current="page" href="#">Inicio</a>
                            </li>
                            <li class="nav-item mx-auto">
                                <a class="nav-link active" aria-current="page" href="#sucursales">Sucursales</a>
                            </li>
                        </ul>
                        <a class="nav-link active text-center" data-bs-toggle="modal" data-bs-target="#exampleModal" href="#">Ingresar al sistema</a>
                    </div>
                </div>
            </nav>
        </header>