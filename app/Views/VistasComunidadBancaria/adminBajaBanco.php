<main>
		</br>
        <div class="container">
        <h3 class=" text-center">Dar de baja un banco</h3>
		<hr>
        <?php
          echo form_open('bancobaja/bajaBanco',array('class' => "row g-3"));
        ?>
        <!-- s<form class="row g-3"> -->
          <div class="col-md-4 text-center">
            <input type="text" class="form-control" id="nombrebanco" name="nombrebanco" placeholder="Ingrese el nombre del banco">
           
          </div>
          <div class="col-md-4 text-center">
            <input type="text" class="form-control" id="numerosucursal" name = "numerosucursal" placeholder="Ingrese el número de sucursal">
            
          </div>
          <div class="col-md-1 text-center">
            <button type="button" class="btn btn-primary" onclick="buscar();">Buscar</button>
          </div>
          <input type="hidden" class="form-control" id="idBanco" style="display:none" name = "idBanco">
          <input type="hidden" class="form-control" id="direccionbanco" style="display:none" name = "direccionbanco">
          <hr><h3 class=" text-center">Datos del banco</h3><hr>
          <table class="table text-center" id = "tabla1">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Dirección</th>
                        <th scope="col">Surcusal</th>
                    </tr>
                </thead>
                <tbody id="tbody_tabla">
                    <!-- <tr>
                        <th scope="row">Nombre de ejemplo</th>
                        <td>Direccion de ejemplo</td>
                    </tr> -->
                    <script>

                        function cancelar(){
                          window.location.href = "http://localhost/Ej4/AdminControlador";
                        }
                        
                        function buscar() {
                            var nombreBanco = document.getElementById("nombrebanco").value;
                            var surcusal = document.getElementById("numerosucursal").value;
                            var usuarios =<?php echo json_encode($bancos); ?>;


                            let yaentro = 0; 
                            if(nombreBanco === "" || surcusal === ""){
                              yaentro = 1; 
                              alert("Complete los campo para poder buscar el banco");
                            }

                            let contenido="";
                            let flag = 0; 
                            document.getElementById("tbody_tabla").innerHTML = "";
                            for (var i = 0; i < usuarios.length;i=i+1) {
                                if (nombreBanco == usuarios[i].B_nombre && surcusal == usuarios[i].B_Numero_Sucursal ) {
                                   flag = 1;    
                                  contenido = contenido + '<tr><td>' + usuarios[i].B_nombre  + '</td><td>'+usuarios[i].B_Direccion+'</td><td>'+usuarios[i].B_Numero_Sucursal+'</td></tr>';
                                    document.getElementById("idBanco").value= usuarios[i].idBanco;
                                    document.getElementById("direccionbanco").value= usuarios[i].B_Direccion;
                                  }
                            }
                            document.getElementById("tbody_tabla").innerHTML = contenido;
                            //document.getElementById("tabla1").innerHTML = document.getElementById("tbody_tabla").innerHTML;
                            if(flag === 0 && yaentro != 1){ // Es porque nunca entro 
                              alert("No se encontro el banco");
                            }
                        }
  
                    </script>
                    <?php 
                      // var_dump($bancos);
                    ?>
                    
                </tbody>
            </table>
            <span id="span1"></span>
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