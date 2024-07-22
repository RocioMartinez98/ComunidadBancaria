<main>
		</br>
        <div class="container">
        <h3 class=" text-center">Cargar nueva cuenta</h3>
		<hr>
		<?php
          echo form_open('cuentaControlador/cargaCuenta',array('class' => "row g-3"));
        ?>
        <!-- <form class="row g-3"> -->
            <div class="col-md-4">
            <label for="numerocuenta" class="form-label">Número de cuenta</label> 
            <input type="number" class="form-control" id="numerocuenta" name="numerocuenta" required>
          </div>
		  <div class="col-md-4">
		  <label for="tipocuenta" class="form-label">Tipo de cuenta</label>
				<select id="tipocuenta" name="tipocuenta" class="form-select">
					<option value="1" selected>Caja de Ahorros</option>
					<option value="2">Cuenta Sueldo/ Cuenta de Seguridad Social</option>
					<option value="3">Cuenta Corriente</option>
					<option value="4">Cuenta Universal Gratuita</option>
				</select>
		  </div>
          <div class="col-md-4">
            <label for="inputZip" class="form-label">Fecha de creación</label>
            <input type="date" class="form-control" id="fechacreacion" name="fechacreacion" required>
          </div>
		  <div class="col-md-4">
		  <label for="tipomoneda" class="form-label">Tipo de moneda</label>
					<select id="tipomoneda" name="tipomoneda" class="form-select">
						<option value="Peso" selected>Peso</option>
						<option value="Euro">Euro</option>
						<option value="Dolar">Dolar</option>
						<option value="Real">Real</option>
					</select>
		  </div>
		  <div class="col-md-4">
            <label for="monto" class="form-label">Monto actual</label>
            <input type="number" class="form-control" id="monto" name="monto" required>
          </div>
			<div class="col-md-4">
            <label for="titular" class="form-label">DNI del Titular</label>
            <input type="number" class="form-control" id="dni" name="dni" required maxlength = "9">
          </div>
		  <div class="col-md-4">
		  <input type="hidden" class="form-control" id="idBanco" style="display:none" name = "idBanco">
		  <label for="banco" class="form-label">Banco</label>
				<select id="banco" name="banco" class="form-select">
					<!-- <option value="Tipo1" selected>Banco 1</option>
					<option value="Tipo2">Banco 2</option>
					<option value="Tipo3">Banco 3</option>
					<option value="Tipo4">Banco 4</option> -->
					
					<script> 
						var banco =<?php echo json_encode($bancos); ?>;
						
						let contenido="";
						document.getElementById("banco").innerHTML = "";
						for (var i = 0; i < banco.length;i=i+1) {
							
							contenido = contenido + '<option value='+ (i+1)+ '>'+banco[i].B_nombre+'</option>';
						}
						document.getElementById("banco").innerHTML = contenido;
					</script>
				</select>
		  </div>
          <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary" id="Confirmar" onclick="bien()">Confirmar</button>
            <button type="button" class="btn btn-primary" onclick="cancelar()">Cancelar</button>
          </div>

		<script>
			function cancelar(){
                window.location.href = "http://localhost/Ej4/AdminControlador";
            }
			var flag; 

			let confirm = document.getElementById("Confirmar"); // Encuentra el elemento "p" en el sitio
            confirm.addEventListener('click',controlLongDNI);
    
              function controlLongDNI(evento) {
                let value = document.getElementById("dni").value;
				flag = true; 
                console.log("Value tiene "+ value);
                if(value.length != 0 && value.length <= 6){
                  window.alert("¡El DNI como minimo debe tener 7 digitos!");
				  flag = false; 
                  return false;  
                }
            }

			let formu = document.querySelector("form");
			formu.addEventListener("submit",(e)=>{
				e.preventDefault();

				if(flag === true){
					formu.submit();
				}
			})

		</script>
		
        <!-- </form> -->
		<?php
          echo form_close();
        ?>

		<script>
			window.addEventListener("load",iniciar);

			function iniciar(){
            	lista = document.getElementsByClassName("form-control"); 
           		lista[3].addEventListener("input",comprobarDNI);
          	}

			function comprobarDNI(evento){
            	var elemento = evento.target; 
            	var longitud = elemento.value.length;
				
				if(longitud > 8){  
					let dni = document.getElementById("dni"); 

					var value = dni.value;
					var newValue = value.substring(0,value.length - 1);
					dni.value = newValue;

					window.alert("¡El DNI solo debe tener como máximo 8 digitos!");   
				}
          	}

		</script>


        </div>
      </main>
    </header>
    </div>
	</br>