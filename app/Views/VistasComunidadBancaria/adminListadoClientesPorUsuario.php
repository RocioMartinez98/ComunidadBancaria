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
            '<th scope="col">Número de cuenta</th>'+
            '<th scope="col">Tipo de cuenta</th>'+
            '<th scope="col">Fecha de creación</th>'+
            '<th scope="col">Moneda</th>'+
            '<th scope="col">Monto actual</th>'+
            '<th scope="col">Titular</th>'+
            '<th scope="col">Banco</th>'+
            '</tr>' +
            '</thead>';
            
            for (var i = 0; i < cuenta.length;i=i+1) {

                contenido = contenido + '<tr><td>' + cuenta[i].Cu_Numero  + 
                '</td><td>'+cuenta[i].Cu_Tipo+'</td><td>'+cuenta[i].Cu_Fecha_Creacion+ '</td><td>'+cuenta[i].Cu_Moneda+
                '</td><td>'+cuenta[i].Cu_Monto_Actual + '</td><td>'+cuenta[i].C_Nombre +
                '</td><td>'+cuenta[i].B_nombre +
                '</td></tr>';   
            
            
            }
            document.getElementById("tabla1").innerHTML = contenido;
        </script>
    </table>

    <div class="col-12 text-center">
        <button type="button" class="btn btn-primary" onclick="volver();">Volver</button>
    </div>

</main>