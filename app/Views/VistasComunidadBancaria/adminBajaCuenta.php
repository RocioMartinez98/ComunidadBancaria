<main>
		</br>
        <div class="container">
        <h3 class=" text-center">Dar de baja una cuenta</h3>
		<hr>
        <?php
          echo form_open('cuentaControlador/bajaCuenta',array('class' => "row g-3"));
        ?>
        <!-- <form class="row g-3"> -->
            <div class="col-md-4 text-center">
				<input type="number" class="form-control" id="numerocuenta" name="numerocuenta" required>
				<label for="numerocuenta" class="form-label">Por favor, ingrese el número de cuenta</label>
			</div>
			<div class="col-md-1 text-center">
				<button type="button" class="btn btn-primary" onclick="buscar();">Buscar</button>
			</div>
      <input type="hidden" class="form-control" id="idCuenta" style="display:none" name = "idCuenta">
		  <hr><h3 class=" text-center">Datos de la cuenta</h3><hr>
		  <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Número de cuenta</th>
                    <th scope="col">Tipo de cuenta</th>
                    <th scope="col">Fecha de creación</th>
                    <th scope="col">Moneda</th>
                    <th scope="col">Monto actual</th>
                    <th scope="col">Titular</th>
                    <th scope="col">Banco</th>
                  </tr>
                </thead>
                <tbody id = "tbody_tabla">
                  <!-- <tr>
                    <th scope="row">1554123</th>
                    <td>Caja de ahorros</td>
                    <td>25/01/1999</td>
                    <td>Peso</td>
                    <td>$1000</td>
                    <td>Lolo Perez</td>
                    <td>Nación</td>
                  </tr> -->
                  <?php 
                    
                  ?>
                  <script>

                    function cancelar(){
                      window.location.href = "http://localhost/Ej4/AdminControlador";
                    }
                        
                    function buscar() {
                        var numeroCuenta = document.getElementById("numerocuenta").value;
                        var cuentas =<?php echo json_encode($cuentas); ?>;

                        let yaentro = 0; 

                        if(numeroCuenta === ""){
                          yaentro = 1; 
                          alert("Complete el campo para poder buscar la cuenta");
                        }
                        
                        let contenido="";
                        let idBanco;
                        let flag = 0; 
                        document.getElementById("tbody_tabla").innerHTML = "";
                        for (var i = 0; i < cuentas.length;i=i+1) {
                            if (numeroCuenta == cuentas[i].Cu_Numero) {
                                flag = 1; // Al menos encontro uno.
                                contenido = contenido + '<tr><td>' + cuentas[i].Cu_Numero  + 
                                '</td><td>'+cuentas[i].Cu_Tipo+
                                '</td><td>'+cuentas[i].Cu_Fecha_Creacion+
                                '</td><td>'+cuentas[i].Cu_Tipo+
                                '</td><td>'+cuentas[i].Cu_Moneda+
                                // '</td><td>'+cuentas[i].Cu_Monto_Actual+
                                '</td><td>'+cuentas[i].Cliente_idCliente+
                                '</td><td>'+cuentas[i].Banco_idBanco+
                                '</td></tr>';
                                 document.getElementById("idCuenta").value= cuentas[i].idCuenta;
                                // document.getElementById("direccionbanco").value= usuarios[i].B_Direccion;
                              }
                        }
                        document.getElementById("tbody_tabla").innerHTML = contenido;
                        //document.getElementById("tabla1").innerHTML = document.getElementById("tbody_tabla").innerHTML;
                        if(flag === 0 && yaentro != 1){ // Es porque nunca entro 
                        alert("No se encontro la cuenta ingresada");
                      }
                    }
  
                    </script>
                </tbody>
              </table>
          <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary">Eliminar</button>
            <button type="button" class="btn btn-primary" onclick="cancelar();">Cancelar</button>
          </div>
        <!-- </form> -->
        <?php
          echo form_close();
        ?>
        </div>
      </main>
    </header>
    </div>
	</br>