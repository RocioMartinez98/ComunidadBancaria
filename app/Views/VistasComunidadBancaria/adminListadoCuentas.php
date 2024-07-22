      <main>
		</br>
        <div class="container">
        <h3 class=" text-center">Cuentas</h3>
		<hr>
		</br>
        <form class="row g-3" method="post" action="<?php echo base_url().'/CuentaControlador/mostrarConsulta' ?>">
			<div class="container text-center">
			<div class="row">
				<div class="form-floating col-sm-4">
					<select id="banco" name="banco" class="form-select">
						<option value="Tipo1" selected>Caja de Ahorros</option>
						<option value="Tipo2">Cuenta Sueldo/ Cuenta de Seguridad Social</option>
						<option value="Tipo3">Cuenta Corriente</option>
						<option value="Tipo4">Cuenta Universal Gratuita</option>
					</select>
					<label for="tipoCuenta" class="form-label">Filtrado por tipo de cuenta</label>
				</div>
				<div class="col-sm-1 text-center">
					<button type="submit" id= "filtrarPorTipoCuenta" class="btn btn-primary py-3" onclick="buscar();">Buscar</button>
				</div>
			</div>
			</div>
            <!-- <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Banco</th>
                    <th scope="col">Numero Surcusal</th>
                  </tr>
                </thead>
                <tbody id= "tbody_tabla">
                  <tr>
                    <th scope="row">Titi titosa</th>
                    <td>Banco Nacion</td>
                  </tr>
                  
                </tbody>
              </table> -->
              <script> 

                    function cancelar(){
                        window.location.href = "http://localhost/Ej4/AdminControlador";
                    }

                    function tiposCuentas( tipos){
                      if(tipos === "Tipo1"){
                        return "Caja de Ahorros";
                      }else{
                        if(tipos === "Tipo2"){
                          return "Cuenta Sueldo/ Cuenta de Seguridad Social";
                        }
                        else{
                          if(tipos === "Tipo3"){
                            return "Cuenta Corriente";
                          }
                          else{
                            if(tipos === "Tipo4"){
                              return "Cuenta Universal Gratuita";
                            }
                          }
                        }
                        
                      }
                    }
                    
                  </script>
        </form>
        </div>

        <div class="col-12 text-center">
          <button type="button" class="btn btn-primary" onclick="cancelar()">Cancelar</button>
        </div>

      </main>
    </header>
    </div>