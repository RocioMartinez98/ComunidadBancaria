<main>
		</br>
        <div class="container">
        <h3 class=" text-center">Clientes que pertenecen a un banco</h3>
		<hr>
        <form class="row g-3" method="post" action="<?php echo base_url().'/Banco/mostrarConsulta' ?>">
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

            <script type="text/javascript"> 

                  function cancelar(){
                    window.location.href = "http://localhost/Ej4/AdminControlador";
                  }

                      var banco =<?php echo json_encode($bancos); ?>;
                      
                      let contenido="";
                      document.getElementById("banco").innerHTML = "";
                      for (var i = 0; i < banco.length;i=i+1) {
                        
                        contenido = contenido + '<option value='+ banco[i].idBanco+ '>'+banco[i].B_nombre+'</option>';
                      }
                      document.getElementById("banco").innerHTML = contenido;
                    

                </script>
            <!-- <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Dirección</th>
                    <th scope="col">Teléfono</th>
                    <th scope="col">Fecha de nacimiento</th>
                    <th scope="col">DNI</th>
                    <th scope="col">CUIT/CUIL</th>
                  </tr>
                </thead>
                <tbody id="tbody_tabla">
                  <tr>
                    <th scope="row">Lolo</th>
                    <td>Perez</td>
                    <td>Direccion ejemplo</td>
                    <td>151515131</td>
                    <td>26/09/1998</td>
                    <td>41564510</td>
                    <td>27-4151571-1</td>
                  </tr>
                </tbody>
              </table> -->
        </form>

        <div class="col-12 text-center">
          <button type="button" class="btn btn-primary" onclick="cancelar()">Cancelar</button>
        </div>

        </div>
      </main>
    </header>
    </div>