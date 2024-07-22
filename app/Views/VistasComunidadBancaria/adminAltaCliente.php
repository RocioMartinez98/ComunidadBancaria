<main>
		</br>
        <div class="container">
        <h3 class=" text-center">Cargar nuevo cliente</h3>
		<hr>

    <h2></h2>
        <!-- <form class="row g-3"> -->
      <?php
        echo form_open('ControladorCliente/cargaCliente',array('class' => "row g-3"));
      ?>
            <div class="col-md-4">
            <label for="nomobrecliente" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombrecliente" name="nombrecliente" pattern="^[A-Z a-z\u00C0-\u017F]+$" required>
          </div>
		  <div class="col-md-4">
            <label for="apellidocliente" class="form-label">Apellido</label>
            <input type="text" class="form-control" id="apellidocliente" name="apellidocliente" pattern="^[A-Z a-z\u00C0-\u017F]+$" required>
          </div>
          <div class="col-md-4">
            <label for="inputZip" class="form-label">Fecha de nacimiento</label>
            <input type="date" class="form-control" id="fnacimiento" name="fnacimiento" required>
          </div>
		  <div class="col-md-4">
            <label for="direccioncliente" class="form-label">Dirección</label>
            <input type="text" class="form-control" id="direccioncliente" name="direccioncliente" required>
          </div>
		  <div class="col-md-4">
            <label for="telefonocliente" class="form-label">Teléfono</label>
            <input type="number" class="form-control" id="telefonocliente" name="telefonocliente" required>
          </div>
			<div class="col-md-4">
            <label for="dnicliente" class="form-label">DNI</label>
            <input type="number" class="form-control" id="dnicliente" name="dnicliente" required maxlength = "9">
          </div>
		  <div class="col-md-4">
            <label for="cuitcuilcliente" class="form-label">CUIT/CUIL</label>
            <input type="number" class="form-control" id="cuitcuilcliente" name="cuitcuilcliente" required maxlength = "12">
          </div>
		  <div class="col-md-4">
            <label for="usuariocliente" class="form-label">Usuario</label>
            <input type="text" class="form-control" id="usuariocliente" name="usuariocliente" required>
          </div>
		  <div class="col-md-4">
            <label for="clavecliente" class="form-label">Contraseña</label>
            <input type="text" class="form-control" id="clavecliente" name="clavecliente" required>
      </div>
          <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary" id="Confirmar">Confirmar</button>
            <button type="button" class="btn btn-primary" onclick="cancelar();">Cancelar</button>
          </div>

          <script> 
              function isEqual(str1, str2)
              {
                  return str1.toUpperCase() === str2.toUpperCase()
              }

              /* var flag = "<?php echo $confirmacionCliente;?>"
              if(isEqual(flag, '1')){
                  alert("El cliente ha sido ingresado con exito");
                  window.location.href = "http://localhost/Ej4/AdminControlador";
              } */

              function cancelar(){
                window.location.href = "http://localhost/Ej4/AdminControlador";
              }

              var flag1; 
              var flag2; 

              let confirm = document.getElementById("Confirmar"); // Encuentra el elemento "p" en el sitio
              confirm.addEventListener('click',controlLongDNI);
              confirm.addEventListener('click',controlLongCUIT);
    
              function controlLongDNI(evento) {
                let value = document.getElementById("dnicliente").value;
                console.log("Value tiene "+ value);
                flag1 = true; 
                if(value.length != 0 && value.length <= 6){
                  window.alert("¡El DNI como minimo debe tener 7 digitos!");
                  flag1 = false; 
                  return;  
                }
              }

              function controlLongCUIT(evento) {
                let value = document.getElementById("cuitcuilcliente").value;
                console.log("Value tiene "+ value);
                flag2 = true;
                if(value.length != 0 && value.length <= 9){
                  window.alert("¡El CUIT/CUIL como minimo debe tener 10 digitos!");
                  flag2 = false; 
                  return;  
                }
              }

              
              let formu = document.querySelector("form");
              formu.addEventListener("submit",(e)=>{
                e.preventDefault();

                if(flag1 === true && flag2 === true){
                  formu.submit();
                }
              })

            </script>
       <!--  </form> -->
      <?php
        echo form_close();
      ?>

      <script>

        window.addEventListener("load",iniciar);

        function iniciar(){
            lista = document.getElementsByClassName("form-control"); 
            /* let nombre = document.getElementById("nombrecliente");
            let apellido = document.getElementById("apellidocliente"); */
				    lista[0].addEventListener("input",comprobarN);
            lista[5].addEventListener("input",comprobarDNI);
            lista[6].addEventListener("input",comprobarCUIT);
            lista[1].addEventListener("input",comprobarA); 
          }
          

          function comprobarN(evento){
            var elemento = evento.target; 
            if(elemento.validity.patternMismatch){  
              document.getElementById("nombrecliente").value=""; 
              window.alert("¡Ingrese unicamente letras! Reintente");
            }
          }

          function comprobarA(evento){
            var elemento = evento.target; 
            if(elemento.validity.patternMismatch){  
              document.getElementById("apellidocliente").value="";   
              window.alert("¡Ingrese unicamente letras! Reintente");     
            }
          }

          function comprobarDNI(evento){
            var elemento = evento.target; 
            var longitud = elemento.value.length;
            console.log("La longitud es:"+longitud);
            if(longitud > 8){  
              
              let dni = document.getElementById("dnicliente"); 

              var value = dni.value;
              var newValue = value.substring(0,value.length - 1);
              dni.value = newValue;

              window.alert("¡El DNI solo debe tener como máximo 8 digitos!");   
            }
          }




          function comprobarCUIT(evento){
            var elemento = evento.target; 
            var longitud = elemento.value.length;
            console.log("La longitud es:"+longitud);
            if(longitud > 11){  
              let cuit = document.getElementById("cuitcuilcliente"); 
              var value = cuit.value;
              var newValue = value.substring(0,value.length - 1);
              cuit.value = newValue;
              window.alert("¡El CUIT solo debe tener como máximo 11 digitos!");   
            }
          }
          

      </script>


        </div>
      </main>
    </header>
    </div>
	</br>