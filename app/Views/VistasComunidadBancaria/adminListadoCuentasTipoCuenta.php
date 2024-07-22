<main>

    <table class="table" id="tabla1">
        <script> 
            function volver(){
                history.go(-1);
            }

            var cuenta = <?php echo json_encode($cuenta); ?>;
            ///Cuando busque por usuario
            let contenido="";
            document.getElementById("tabla1").innerHTML = "";
            contenido = contenido + '<thead> '+
            '<tr>'+
            '<th scope="col">Nombre</th>'+
            '<th scope="col">Apellido</th>'+
            '<th scope="col">DNI</th>'+
            '<th scope="col">Banco</th>'+
            '</tr>' +
            '</thead>';
            
            for (var i = 0; i < cuenta.length;i=i+1) {

                contenido = contenido + '<tr><td>' + cuenta[i].C_Nombre  + 
                '</td><td>'+cuenta[i].C_Apellido+'</td><td>'+cuenta[i].C_DNI+ '</td><td>'+cuenta[i]. B_nombre+
                '</td></tr>';   
            }
            document.getElementById("tabla1").innerHTML = contenido;
        </script>
    </table>

    <div class="col-12 text-center">
        <button type="button" class="btn btn-primary" onclick="volver();">Volver</button>
    </div>

</main>