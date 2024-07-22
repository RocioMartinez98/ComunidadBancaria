<br>    

        <div class="row justify-content-center">
            <div class="col-sm-6">
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="img/Imagen1.png" class="rounded mx-auto d-block" width="700" height="500" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="img/Imagen2.png" class="rounded mx-auto d-block" width="700" height="500" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="img/Imagen3.png" class="rounded mx-auto d-block" width="700" height="500" alt="...">
                </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            </div>
        </div>
		<br>
        <div class="container titulos text-center">
            <div class="row">
                <div class="col-sm-12">
                    <img class="img-circle" src="img/ubicacion.png" alt="Generic placeholder image" width="140" height="140">
                    <h2>Sucursales</h2>
                    <p>Descubrí donde se encuentra la sucursar mas cercana.</p>
                    <p><a class="btn btn-primary" role="button" href="#sucursales">Ver más »</a></p>
                </div>
            </div>
        </div>
        <div class="container" id="sucursales">
		<form class="row g-3" >
			<div class="form-floating col-md-2">
                <select id="banco" name="banco" class="form-select">
                    <!-- <option value="Banco1" selected>Banco 1</option>
                    <option value="Banco2">Banco 2</option>
                    <option value="Banco4">Banco 3</option> -->
                </select>
                <label for="nombreBanco" class="form-label">Filtrado por banco</label>
            </div>
            <div class="col-md-1 text-center">
                <button type="button" id= "filtrarPorNombre" class="btn btn-primary py-3" onclick="buscar();">Buscar</button>
            </div>
            <script> 
                var banco =<?php echo json_encode($bancos); ?>;
                
                let contenido = '<option value= "vacio"> Todos </option>';
                document.getElementById("banco").innerHTML = "";
                for (var i = 0; i < banco.length;i=i+1) {
                    
                    contenido = contenido + '<option value='+ banco[i].idBanco+ '>'+banco[i].B_nombre+'</option>';
                }
                document.getElementById("banco").innerHTML = contenido;
                
                /// Para mostrar todos los bancos 
                var todosBancos =<?php echo json_encode($allBancos); ?>;
                
                
                function buscar(){
                    let banco1 = document.getElementById('banco').value;
                    let contenido="";
                    document.getElementById("tbody_tabla").innerHTML = "";
                    if(banco1 == "vacio"){
                        for (var i = 0; i < todosBancos.length;i=i+1) {
                    
                        contenido = contenido + '<tr><td>' + todosBancos[i].B_nombre  + 
                        '</td><td>'+todosBancos[i].B_Direccion +
                        '</td></tr>';         
                        
                        }
                        document.getElementById("tbody_tabla").innerHTML = contenido;
                    }
                    else{
                        for (var i = 0; i < todosBancos.length;i=i+1) {
                    
                        if (banco1 == todosBancos[i].idBanco) {
                                contenido = contenido + '<tr><td>' + todosBancos[i].B_nombre  + 
                                '</td><td>'+todosBancos[i].B_Direccion +
                                '</td></tr>';         
                        }
                        
                        }
                        document.getElementById("tbody_tabla").innerHTML = contenido;
                    }
                    
                }
            </script>
		</form>
            <div class = "table-responsive">
				<table class="table text-center">
				<thead>
					<tr>
						<th scope="col">Nombre</th>
						<th scope="col">Dirección</th>
					</tr>
				</thead>
				<tbody id= "tbody_tabla">
					<!-- <tr>
						<th scope="row">Nombre de ejemplo</th>
						<td>Direccion de ejemplo</td>
					</tr> -->
                    <script> 
                        let contenido1="";
                        document.getElementById("tbody_tabla").innerHTML = "";
                        for (var i = 0; i < todosBancos.length;i=i+1) {
                    
                        contenido1 = contenido1 + '<tr><td>' + todosBancos[i].B_nombre  + 
                        '</td><td>'+todosBancos[i].B_Direccion +
                        '</td></tr>';         
                        
                        }
                        document.getElementById("tbody_tabla").innerHTML = contenido1;
                    </script>
				</tbody>
				</table>
			</div>
		</div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
  
                    <!-- <form action="" method="POST"> -->
                    <?php
                        echo form_open('controladorinicio/login');
                    ?>
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ingreso al Sistema</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="container">
                                <div class="mb-3">
                                    <label for="nombreUsuario" class="form-label">Nombre de usuario</label>
                                    <input type="text" class="form-control" id="nombreUsuario" required ="" name="user"/>
                                </div>
                                <div class="mb-3">
                                    <label for="contraseña" class="form-label">Contraseña</label>
                                    <input type="password" class="form-control" id="contraseña" required ="" name="pass"/>
                                </div>
                                <div class="mb-3">
                                <label for="rol" class="form-label">Rol</label>
                                    <select id="tipoUser" name="tipoUser" class="form-select">
                                        <option value="Cliente" selected>Cliente</option>
                                        <option value="Administrador">Administrador</option>
                                    </select>
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" />
                                    <label class="form-check-label" for="exampleCheck1">Recuerdame</label>
                                </div>
                                <div class="mb-3">
                                    <a href="#">Olvide mi contraseña</a>
                                </div>
                                <div class="mb-3">
                                    <a href="#">Solicitar registro al sistema</a>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <p class="text-center">
                                <button type="submit" class="btn btn-primary">Ingresar</button>
                            </p>
                        </div>
                    <!-- </form> -->
                    <?php
                        echo form_close();
                    ?>

                </div>
				</div>
			</div>
		</div>

        