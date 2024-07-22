<main>

    <table class="table" id="tabla1">
        <script> 
            function volver(){
                history.go(-1);
            }

            var banco = <?php echo json_encode($banco); ?>;
            ///Cuando busque por usuario
            let contenido="";
            document.getElementById("tabla1").innerHTML = "";
            contenido = contenido + '<thead> '+
            '<tr>'+
            '<th scope="col">Nombre</th>'+
            '<th scope="col">Apellido</th>'+
            '<th scope="col">Fecha de Nacimiento</th>'+
            '<th scope="col">DNI</th>'+
            '<th scope="col">CUIL/CUIT </th>'+
            '<th scope="col">Direccion</th>'+
            '<th scope="col">Telefono</th>'+
            '</tr>' +
            '</thead>';
            
            for (var i = 0; i < banco.length;i=i+1) {

                contenido = contenido + '<tr><td>' + banco[i].C_Nombre  + 
                '</td><td>'+banco[i].C_Apellido+'</td><td>'+banco[i].C_Fecha_Nacimiento+ '</td><td>'+banco[i].C_DNI+
                '</td><td>'+banco[i].C_CUIL__C_CUIT+'</td><td>'+banco[i].C_Direccion+'</td><td>'+banco[i].C_Telefono+
                '</td></tr>';   
            }
            document.getElementById("tabla1").innerHTML = contenido;
        </script>
    </table>

    <div class="col-12 text-center">
        <button type="button" class="btn btn-primary" onclick="volver();">Volver</button>
    </div>

</main>