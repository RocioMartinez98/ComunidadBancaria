<main>
		</br>
      <div class="container">
        <h3 class=" text-center">Cargar nuevo banco</h3>
		  <hr>
        <?php
          echo form_open('banco/cargaBanco',array('class' => "row g-3"));
        ?>
        <!-- <form class="row g-3"> -->
            <div class="col-md-4">
              <label for="nombrebanco" class="form-label">Nombre</label>
              <input type="text" class="form-control" id="nombrebanco" name="nombrebanco" required>
            </div>
		        <div class="col-md-4">
              <label for="direccionbanco" class="form-label">Dirección</label>
              <input type="text" class="form-control" id="direccionbanco" name="direccionbanco" required>
            </div>
			      <div class="col-md-4">
              <label for="numerosucursal" class="form-label">Número de sucursal</label>
              <input type="number" class="form-control" id="numerosucursal" name="numerosucursal" required>
            </div>
            <div class="col-12 text-center">
              <button type="submit" class="btn btn-primary">Confirmar</button>
              <button type="button" class="btn btn-primary" onclick="cancelar();">Cancelar</button>
            </div>
            <script> 
              function isEqual(str1, str2)
              {
                  return str1.toUpperCase() === str2.toUpperCase()
              }

              function cancelar(){
                window.location.href = "http://localhost/Ej4/AdminControlador";
              }

              /* var flag = "<?php echo $confirmacionBanco;?>"
              if(isEqual(flag, '1')){
                  alert("El banco ha sido ingersado con exito");
                  window.location.href = "http://localhost/Ej4/AdminControlador";
              } */

            </script>
        <!-- </form> -->
        <?php
          echo form_close();
        ?>
      </div>
</main>
</header>
</div> 
</br>