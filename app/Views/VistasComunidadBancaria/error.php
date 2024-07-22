<main>
		</br>
        <div class="container">
        <h2 class=" text-center">Error, por favor reintente!</h2>
        <h3 id="mensajeError" class="text-center"></h3>
        
		<hr>

        <!-- <form class="row g-3"> -->
          <div class="col-12 text-center">
            <button type="button" class="btn btn-primary" onclick="volver();">Volver</button>
          </div>
        </div>

        <script>
            function volver(){
                history.go(-1);
            }
            
            let error = <?php echo json_encode($mensajeError); ?>

            document.getElementById("mensajeError").innerHTML = error;

        </script>

      </main>
    </header>
    </div>
	</br>