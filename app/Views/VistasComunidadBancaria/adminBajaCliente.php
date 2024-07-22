<main>
		</br>
        <div class="container">
        <h3 class=" text-center">Dar de baja un cliente</h3>
		<hr>
        <!-- <form class="row g-3"> -->
        <?php
          echo form_open('controladorcliente/bajaCliente',array('class' => "row g-3"));
        ?>

            <div class="col-md-4 text-center">
				<input type="number" class="form-control" id="numerodocumento" name="numerodocumento" placeholder="Numero de documento" required>
				
			</div>
			<div class="col-md-1 text-center">
				<button id="BtnBuscar" type="button" class="btn btn-primary" onclick="BuscarCliente()">Buscar</button>
			</div>
      <input type="hidden" class="form-control" id="idCliente" style="display:none" name = "idCliente">
		  <hr><h3 class=" text-center">Datos del cliente</h3><hr>
		  <table class="table">

                <thead>
                  <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido </th>
                    <th scope="col">Fecha de Nacimiento</th>
                    <th scope="col">DNI</th>
                    <th scope="col">CUIT/CUIL</th>
                    <th scope="col">Direccion</th>
                    <th scope="col">Telefono</th>
                  </tr>
                </thead>
                <tbody id="TablaCliente">
                  <!-- <tr>
                    <th scope="row">1554123</th>
                    <td>Caja de ahorros</td>
                    <td>25/01/1999</td>
                    <td>Peso</td>
                    <td>$1000</td>
                    <td>Lolo Perez</td>
                    <td>Nación</td>
                  </tr> -->
                  <script>
                    function BuscarCliente() {

                      let bus = document.getElementById("numerodocumento").value;
                      let yaentro = 0; 
                      
                      if(bus === ""){
                        yaentro = 1; 
                        alert("Complete el campo para poder buscar el documento");
                      }
                      
                      var dni = document.getElementById("numerodocumento").value;
                      var cliente =<?php echo json_encode($cliente); ?>;
                      
                      let contenido="";
                      document.getElementById("TablaCliente").innerHTML = "";
                      let flag = 0; 
                      for (var i = 0; i < cliente.length;i=i+1) {
                          if (dni == cliente[i].C_DNI) {
                            flag = 1; // Al menos encontro uno.
                              contenido = contenido + '<tr><td>' + cliente[i].C_Nombre  + '</td><td>'+cliente[i].C_Apellido+'</td><td>'+cliente[i].C_Fecha_Nacimiento+'</td><td>'+ cliente[i].C_DNI+'</td><td>'+ cliente[i].C_CUIL__C_CUIT+'</td><td>'+ cliente[i].C_Direccion +'</td><td>'+ cliente[i].C_Telefono +'</td></tr>';
                              document.getElementById("idCliente").value= cliente[i].idCliente;
                          }
                      }
                      document.getElementById("TablaCliente").innerHTML = contenido;

                      if(flag === 0 && yaentro != 1){ // Es porque nunca entro 
                        alert("No se encontro el documento ingresado");
                      }

                      //document.getElementById("tabla1").innerHTML = document.getElementById("tbody_tabla").innerHTML;
                      
                   }
                    
                  </script>

                </tbody>

              </table>
       <!--  </form> -->
          <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary">Eliminar</button>
            <button type="button" class="btn btn-primary" onclick="cancelar();">Cancelar</button>
          </div>

          <script>
            function cancelar(){
                window.location.href = "http://localhost/Ej4/AdminControlador";
              }
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