<main>
		</br>
        <div class="container">
        <h3 class=" text-center">Modificar Cliente</h3>
		<hr>
    <?php
       echo form_open('ControladorCliente/modificarMuestraCliente',array('class' => "row g-3"));
      ?>
        <!--<form class="row g-3">-->
		  <div class="form-floating col-md-3">
          <input type="number" class="form-control" id="dnicliente" name="dnicliente" placeholder="text" required>
          <label for="dnicliente">DNI del cliente</label>
      </div>
      <div class="col-md-1 text-center">
          <button type="submit" id= "filtrarPorNombre" class="btn btn-primary py-3"onclick="BuscarCliente()">Buscar</button>
      </div>
      <?php
        echo form_close();
      ?>
			<hr>

			<h3 class=" text-center">Datos actuales</h3>
			<hr>
      <?php
       echo form_open('ControladorCliente/modificaCliente',array('class' => "row g-3"));
      ?>
            <div class="col-md-4">
            <label for="nomobrecliente" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombrecliente" name="nombrecliente" required>
          </div>
		  <div class="col-md-4">
            <label for="apellidocliente" class="form-label">Apellido</label>
            <input type="text" class="form-control" id="apellidocliente" name="apellidocliente" required>
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
            <input type="text" class="form-control" id="telefonocliente" name="telefonocliente" required>
          </div>
			<div class="col-md-4">
            <label for="dnicliente2" class="form-label">DNI</label>
            <input type="text" class="form-control" id="dnicliente2" name="dnicliente2" required readonly>
          </div>
		  <div class="col-md-4">
            <label for="cuitcuilcliente" class="form-label">CUIT/CUIL</label>
            <input type="text" class="form-control" id="cuitcuilcliente" name="cuitcuilcliente" required readonly>
          </div>
		  <div class="col-md-4">
            <label for="usuariocliente" class="form-label">Usuario</label>
            <input type="text" class="form-control" id="usuariolcliente" name="usuariolcliente" required>
          </div>
          <input type="hidden" class="form-control" id="idCliente" style="display:none" name = "idCliente">
          <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary">Modificar</button>
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

             
              var cliente =<?php echo json_encode($cliente); ?>;

              document.getElementById("nombrecliente").value =  cliente[0].C_Nombre;
              document.getElementById("apellidocliente").value = cliente[0].C_Apellido;
              document.getElementById("fnacimiento").value = cliente[0].C_Fecha_Nacimiento;
              document.getElementById("direccioncliente").value = cliente[0].C_Direccion;
              document.getElementById("telefonocliente").value = cliente[0].C_CUIL__C_CUIT;
              document.getElementById("dnicliente2").value = cliente[0].C_DNI;
              document.getElementById("cuitcuilcliente").value = cliente[0].C_Telefono;
              document.getElementById("idCliente").value= cliente[0].idCliente;
              document.getElementById("usuariolcliente").value = cliente[0].U_usuario;

              if(document.getElementById("usuariolcliente").value != ""){
                document.getElementById("dnicliente").setAttribute("readonly" , "readonly" , false);
                document.getElementById('filtrarPorNombre').setAttribute("disabled",false);
              }

                    
            </script>
        <!--</form>-->
        <?php
          echo form_close();
        ?>
        </div>
      </main>
    </header>
    </div>
	</br>