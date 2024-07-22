<main>
		</br>
        <div class="container">
        <h3 class=" text-center">Cuentas</h3>
		<hr>
        <form class="row g-3">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Número de cuenta</th>
                    <th scope="col">Tipo de cuenta</th>
                    <th scope="col">Fecha de creación</th>
                    <th scope="col">Moneda</th>
                    <th scope="col">Monto actual</th>
                    <th scope="col">DNI</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Banco</th>
                  </tr>
                </thead>
                <tbody id="tbody1">
                  <!-- <tr>
                    <th scope="row">1554123</th>
                    <td>Caja de ahorros</td>
                    <td>25/01/1999</td>
                    <td>Peso</td>
                    <td>$1000</td>
                    <td>Lolo Perez</td> 
                    <td>Nación</td>
                    SELECT DISTINCT Cu_Numero, Cu_Tipo, Cu_Fecha_Creacion, Cu_Moneda, Cu_Monto_Actual, C_DNI, C_Nombre, C_Apellido, B_nombre FROM cliente, banco, cuenta WHERE cliente.flag_Eliminar= 0 AND banco.flag_Eliminar= 0 AND cuenta.flag_Eliminar= 0 AND cliente.idCliente = '$idCliente' AND banco.idBanco = cuenta.Banco_idBanco AND cliente.idCliente = cuenta.Cliente_idCliente
                  </tr> -->
                </tbody>
                <script> 
                  var cuentas = <?php echo json_encode($cuentas); ?>;
                  ///Cuando busque por usuario
                  let contenido="";
                  document.getElementById("tbody1").innerHTML = "";
            
                  for (var i = 0; i < cuentas.length;i=i+1) {

                      contenido = contenido + '<tr><td>' + cuentas[i].Cu_Numero  + 
                      '</td><td>'+cuentas[i].Cu_Tipo+'</td><td>'+cuentas[i].Cu_Fecha_Creacion+ '</td><td>'+cuentas[i].Cu_Moneda+
                      '</td><td>'+cuentas[i].Cu_Monto_Actual+'</td><td>'+cuentas[i].C_DNI+'</td><td>'+cuentas[i].C_Nombre+
                      '</td><td>'+cuentas[i].C_Apellido+ '</td><td>'+cuentas[i].B_nombre+
                      '</td></tr>';   
                  }
                  document.getElementById("tbody1").innerHTML = contenido;
              </script>
              </table>
        </form>
        </div>
      </main>
    </header>
    </div>