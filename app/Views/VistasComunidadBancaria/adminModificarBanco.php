<main>
		</br>
        <div class="container">
        <h3 class=" text-center">Modificar Banco</h3>
		<hr>

      <!-- <form class="row g-3"> -->
      <?php
       echo form_open('Banco/modificaMuestraBanco',array('class' => "row g-3"));
      ?>

			<div class="form-floating col-md-2">
                <select id="banco" name="banco" class="form-select" onclick="cambiar();" required>

                    <script>
                      ///Para el selector
                      let contenido="";
                      var bancoPHP = <?php echo json_encode($bancos); ?>;
                      document.getElementById("banco").innerHTML = "";
                      for (var i = 0; i < bancoPHP.length;i++) {
                        
                        contenido = contenido + '<option value='+ bancoPHP[i].idBanco + '>'+bancoPHP[i].B_nombre+'</option>';
                      }
                      document.getElementById("banco").innerHTML = contenido;
                  </script>
                </select>
                <label for="nombreBanco" class="form-label">Filtrado por banco</label>
                
      </div>
      <div class="form-floating col-md-2">
                <select id="numSucursal" name="numSucursal" class="form-select" required>

                    <script>
                      ///Para el selector
                      function cambiar(){
                        let contenido1="";
                        var bancosPHP = <?php echo json_encode($allBancos);?>;
                        document.getElementById("numSucursal").innerHTML = "";
                        for (var i = 0; i < bancosPHP.length;i++) {
                          if( document.getElementById("banco").value === bancosPHP[i].idBanco){
                            contenido1 = contenido1 + '<option value='+ bancosPHP[i].B_Numero_Sucursal+ '>'+bancosPHP[i].B_Numero_Sucursal+'</option>';}
                        }
                        document.getElementById("numSucursal").innerHTML = contenido1;
                      }
                      
                  </script>
                </select>
                <label for="nombreBanco" class="form-label">Filtrado por numero Surcusal</label>
                
      </div>
            <div class="col-md-1 text-center">
                <button type="submit" id= "filtrarPorNombre" class="btn btn-primary py-3" onclick="buscar();">Buscar</button>
            </div>
        <?php
          echo form_close();
        ?>
			<hr>
			<h3 class=" text-center">Datos actuales</h3>
			<hr>
      <?php
       echo form_open('Banco/modificaBanco',array('class' => "row g-3"));
      ?>
            <div class="col-md-4">
            <label for="nombrebanco" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombrebanco" name="nombrebanco"  required readonly onmousedown="return false;">
          </div>
		  <div class="col-md-4">
            <label for="direccionbanco" class="form-label">Dirección</label>
            <input type="text" class="form-control" id="direccionbanco" name="direccionbanco" required>
          </div>
			<div class="col-md-4">
            <label for="numerosucursal" class="form-label">Número de sucursal</label>
            <input type="text" class="form-control" id="numerosucursal" name="numerosucursal" required readonly onmousedown="return false;" >
            <input type="hidden" class="form-control" id="idBanco" style="display:none" name = "idBanco">
          </div>
          <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary">Modificar</button>
            <button type="button" class="btn btn-primary" onclick="cancelar()">Cancelar</button>
          </div>

          <script>
            function isEqual(str1, str2)
            {
                return str1.toUpperCase() === str2.toUpperCase()
            }

            function cancelar(){
                window.location.href = "http://localhost/Ej4/AdminControlador";
            }

          
            var bancosPHP = <?php echo json_encode($datoBanco);?>

              
            document.getElementById("banco").value = bancosPHP[0].B_nombre;
            document.getElementById("numSucursal").value = bancosPHP[0].B_Numero_Sucursal;
            document.getElementById("nombrebanco").value =  bancosPHP[0].B_nombre;
            document.getElementById("direccionbanco").value = bancosPHP[0].B_Direccion;
            document.getElementById("numerosucursal").value = bancosPHP[0].B_Numero_Sucursal;
            document.getElementById("idBanco").value = bancosPHP[0].idBanco;

            
            
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