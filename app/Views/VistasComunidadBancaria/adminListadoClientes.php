<main>
		</br>
        <div class="container">
        <h3 class=" text-center">Clientes</h3>
		<hr>
        <!-- <form class="row g-3"> -->
            <form class="row g-3" method="post" action="<?php echo base_url().'/ControladorCliente/consultaUsuario' ?>">
              <div class="form-floating col-md-3">
                  <input type="text" class="form-control" id="id" name="id" placeholder="text" >
                  <label for="id">Filtrado por Usuario</label>
              </div>
              <div class="col-md-1 text-center">
                  <button type="submit" id= "filtroUsuario" class="btn btn-primary py-3" onclick="buscar();" >Buscar</button>
              </div>
            </form>
            <br>
			      
            <form class="row g-3" method="post" action="<?php echo base_url().'/ControladorCliente/consultaBanco' ?>">
              <div class="form-floating col-md-2">
                <select id="banco" name="banco" class="form-select">
                    <!-- <option value="Banco1" selected>Banco 1</option>
                    <option value="Banco2">Banco 2</option>
                    <option value="Banco4">Banco 3</option> -->
                </select>
                <label for="nombreBanco" class="form-label">Filtrado por banco</label>
              </div>
              <div class="col-md-1 text-center">
                  <button type="submit" id= "filtrarPorNombre" class="btn btn-primary py-3" onclick="buscar();">Buscar</button>
              </div>
            </form>
			<!– Tabla para cuando se ingresa –>
            <table class="table" id="tabla1">
            <script> 

            function cancelar(){
              window.location.href = "http://localhost/Ej4/AdminControlador";
            }

                var cliente = <?php echo json_encode($cliente); ?>;
                var banco = <?php echo json_encode($banco); ?>;
                  ///Tabla principal donde muestro todo  
                let contenido="";
                document.getElementById("tabla1").innerHTML = "";
                contenido = contenido + '<thead> '+
                    '<tr>'+
                    '<th scope="col">Nombre</th>'+
                    '<th scope="col">Apellido</th>'+
                    '<th scope="col">Dirección</th>'+
                    '<th scope="col">Telefono</th>'+
                    '<th scope="col">Fecha de Nacimiento</th>'+
                    '<th scope="col">DNI</th>'+
                    '<th scope="col">CUIT/CUIL</th>'+
                  '</tr>' +
                '</thead>';
                for (var i = 0; i < cliente.length;i=i+1) {
                  contenido = contenido + '<tr><td>' + cliente[i].C_Nombre  + 
                  '</td><td>'+cliente[i].C_Apellido+'</td><td>'+cliente[i].C_Direccion+ '</td><td>'+cliente[i].C_Telefono+
                  '</td><td>'+cliente[i].C_Fecha_Nacimiento +'</td><td>'+cliente[i].C_DNI + '</td><td>'+cliente[i].C_CUIL__C_CUIT +
                  '</td></tr>';   
                }
                document.getElementById("tabla1").innerHTML = contenido;

                let contenido1="";
                document.getElementById("banco").innerHTML = "";
                for (var i = 0; i < banco.length;i=i+1) {
                  contenido1 = contenido1 + '<option value='+ (i+1)+ '>'+banco[i].B_nombre+'</option>';
                }
                document.getElementById("banco").innerHTML = contenido1;
                
              </script>
            </table>

          <div class="col-12 text-center">
            <button type="button" class="btn btn-primary" onclick="cancelar()">Cancelar</button>
          </div>
			  
              
        <!-- </form> -->
        </div>
      </main>
    </header>
    </div>