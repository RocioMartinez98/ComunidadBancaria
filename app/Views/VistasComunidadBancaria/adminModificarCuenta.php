<main>
		</br>
        <div class="container">
        <h3 class=" text-center">Modificar cuenta</h3>
		<hr>

		<?php
          echo form_open('cuentaControlador/modificarMuestraCuenta',array('class' => "row g-3"));
        ?>
        <!-- <form class="row g-3"> -->
			<div class="form-floating col-md-3">
                <input type="number" class="form-control" id="numerocuenta" name="numerocuenta" placeholder="text" required>
                <label for="numerocuenta">Número de cuenta</label>
            </div>
            <div class="col-md-1 text-center">
                <button type="submit" id= "filtrarPorNombre" class="btn btn-primary py-3">Buscar</button>
            </div>
		<!-- </form> -->
		<?php
          echo form_close();
        ?>
		<hr>
		<h3 class=" text-center">Datos actuales</h3>
		<hr>
		<?php
          echo form_open('cuentaControlador/modificarCuenta',array('class' => "row g-3"));
        ?>
        <div class="col-md-4">
            <label for="numerocuenta" class="form-label">Número de cuenta</label>
            <input type="text" class="form-control" id="numerocuenta1" name = "numerocuenta1" readonly>
			<input type="hidden" class="form-control" id="idCuenta" style="display:none" name = "idCuenta">
        </div>
		<div class="col-md-4">
		<label for="tipocuenta" class="form-label">Tipo de cuenta</label>
				<select id="tipocuenta" name="tipocuenta" class="form-select">
					<option value="Tipo1" selected>Caja de Ahorros</option>
					<option value="Tipo2">Cuenta Sueldo/ Cuenta de Seguridad Social</option>
					<option value="Tipo3">Cuenta Corriente</option>
					<option value="Tipo4">Cuenta Universal Gratuita</option>
				</select>
		</div>
		<div class="col-md-4">
		<label for="inputZip" class="form-label">Fecha de creación</label>
		<input type="date" class="form-control" id="fechacreacion" name="fechacreacion" readonly>
		</div>
		<div class="col-md-4">
		<label for="tipomoneda" class="form-label">Tipo de moneda</label>
			<select id="tipomoneda" name="tipomoneda" class="form-select">
				<option value="Tipo1" selected>Peso</option>
				<option value="Tipo2">Euro</option>
				<option value="Tipo3">Dolar</option>
				<option value="Tipo4">Real</option>
			</select>
		</div>
		<div class="col-md-4">
		<label for="monto" class="form-label">Monto actual</label>
		<input type="text" class="form-control" id="monto" name="monto" required>
		</div>
		<div class="col-md-4">
			<label for="titular" class="form-label">DNI</label>
			<input type="text" class="form-control" id="DNI" name="DNI" required>
		</div>
		<div class="col-md-4">
			<label for="titular" class="form-label">Nombre</label>
			<input type="text" class="form-control" id="nombreCliente" name="nombreCliente" required>
		</div>
		<div class="col-md-4">
			<label for="titular" class="form-label">Apellido</label>
			<input type="text" class="form-control" id="apellidoCliente" name="apellidoCliente" required>
		</div>
		<div class="col-md-4">
			<label for="titular" class="form-label">Banco</label>
			<input type="text" class="form-control" id="banco" name="banco" required>
		</div>
		  <!-- <div class="col-md-4">
		  <label for="banco" class="form-label">Banco</label>
					<select id="banco" name="banco" class="form-select">
						<option value="Tipo1" selected>Banco 1</option>
						<option value="Tipo2">Banco 2</option>
						<option value="Tipo3">Banco 3</option>
						<option value="Tipo4">Banco 4</option>
					</select>
		  </div> -->
		<div class="col-12 text-center">
			<button type="submit" class="btn btn-primary">Modificar</button>
			<button type="button" class="btn btn-primary" onclick="cancelar()">Cancelar</button>
		</div>
		<script> 

			function cancelar(){
                window.location.href = "http://localhost/Ej4/AdminControlador";
            }

			
			var usuarios =<?php echo json_encode($cuentas); ?>;
			
			console.log("Lo que trae usuario es:" + usuarios);
				
			function tipoCuenta(tipocuenta){
				if(tipocuenta == "Caja de Ahorros"){
					document.getElementById("tipocuenta").value = "Tipo1";
				}else{
					if(tipocuenta == "Cuenta Sueldo/ Cuenta de Seguridad Social"){
						document.getElementById("tipocuenta").value = "Tipo2";
					}
					else{
						if(tipocuenta == "Cuenta Corriente"){
							document.getElementById("tipocuenta").value = "Tipo3";
						}
						else{
							if(tipocuenta == "Cuenta Universal Gratuita"){
								document.getElementById("tipocuenta").value = "Tipo4";
							}
						}
					}
				}
			}

			function tipoMoneda(tipomoneda){
				if(tipomoneda == "Peso"){
					document.getElementById("tipomoneda").value = "Tipo1";
				}else{
					if(tipomoneda == "Euro"){
						document.getElementById("tipomoneda").value = "Tipo2";
					}
					else{
						if(tipomoneda == "Dolar"){
							document.getElementById("tipomoneda").value = "Tipo3";
						}
						else{
							if(tipomoneda == "Real"){
								document.getElementById("tipomoneda").value = "Tipo4";
							}
						}
					}
				}
			}
			
			document.getElementById("numerocuenta").value = usuarios[0].Cu_Numero;
			document.getElementById("numerocuenta1").value = usuarios[0].Cu_Numero;
			// document.getElementById("tipocuenta").value = usuarios[0].Cu_Tipo;
			tipoCuenta(usuarios[0].Cu_Tipo);
			document.getElementById("fechacreacion").value = usuarios[0].Cu_Fecha_Creacion;
			// document.getElementById("tipomoneda").value = usuarios[0].Cu_Moneda;
			tipoMoneda(usuarios[0].Cu_Moneda);
			document.getElementById("monto").value = usuarios[0].Cu_Monto_Actual;
			document.getElementById("DNI").value = usuarios[0].C_DNI;
			document.getElementById("nombreCliente").value = usuarios[0].C_Nombre;
			document.getElementById("apellidoCliente").value = usuarios[0].C_Apellido;
			document.getElementById("banco").value = usuarios[0].B_nombre;

			if(document.getElementById("numerocuenta1").value != ""){
                document.getElementById("numerocuenta").setAttribute("readonly" , "readonly" , false);
                document.getElementById('filtrarPorNombre').setAttribute("disabled",false);
              }


			
		
		</script>
		<?php
          echo form_close();
        ?>
        <!-- </form>  -->
        </div>
      </main>
    </header>
    </div>
	</br>