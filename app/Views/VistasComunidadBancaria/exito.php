<main>
		</br>
        <div class="container">
       
        <h2 id="mensajeExito" class="text-center"></h2>
        
		<hr>

        <!-- <form class="row g-3"> -->
          <div class="col-12 text-center">
            <button type="button" class="btn btn-primary" onclick="volver();">Volver</button>
          </div>
        </div>

        <script>

            var exito = <?php echo json_encode($mensajeExito); ?>;
            var controlador = <?php echo json_encode($controlador); ?>;

            function volver(){
                window.location.href = "http://localhost/Ej4/"+`${controlador}`; 
            }

            document.getElementById("mensajeExito").innerHTML = exito;

            

        </script>

      </main>
    </header>
    </div>
	</br>