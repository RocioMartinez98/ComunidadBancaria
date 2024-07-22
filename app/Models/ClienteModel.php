<?php

namespace App\Models;

use CodeIgniter\Model;
use Tests\Support\Models\UserModel;
use App\Models\UsuarioModel;

class ClienteModel extends Model
{
    protected $table      = 'cliente';
    protected $primaryKey = 'idCliente';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['C_Nombre', 'C_Apellido','C_Fecha_Nacimiento','C_DNI','C_CUIL__C_CUIT','C_Direccion','C_Telefono','flag_Eliminar'];

    protected $useTimestamps = false;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    protected $validationRules    = [
        // 'nombre' => 'required|alpha',
        // 'apellido' => 'required|alpha',
        // 'dni' => 'required|decimal|exact_length[8]',
        // 'categoria' => 'required',
        // 'direccion' => 'required|max_length[50]',
        // 'telefono' => 'required|decimal|max_length[8]',
        
    ];
    protected $validationMessages = [
    ];
    protected $skipValidation     = false;


    ////Consulta Personalizada

    public function ConsultaIDCliente($DNICliente){
        $data = $this->db->query("SELECT idCliente FROM cliente WHERE C_DNI='$DNICliente'");
        
        if (isset($data)) {
            $id= 0;
            foreach($data->getResultArray() as $dat){
                $id= $dat['idCliente'];
            }
            return $id;
        } else {
            return 0;
        }
        //return $data;

    }


    public function ConsultaIDClienteAux($idC){
        $data = $this->db->query("SELECT idCliente FROM cliente WHERE idCliente='$idC'");
        
        if (isset($data)) {
            $id= 0;
            foreach($data->getResultArray() as $dat){
                $id= $dat['idCliente'];
            }
            return $id;
        } else {
            return 0;
        }
        //return $data;

    }

    public function BuscarClientesID(){
        $data = $this->db->query("SELECT   idCliente, C_Nombre, C_Apellido, C_Fecha_Nacimiento, C_Direccion, C_Telefono, C_Fecha_Nacimiento, C_DNI, C_CUIL__C_CUIT
           FROM cliente WHERE flag_Eliminar= 0;");
        return $data->getResultArray();
    }

    public function eliminarCliente($idCliente){
        $data = $this->db->query("UPDATE cliente SET  flag_Eliminar = 1 WHERE idCliente='$idCliente'");
        return $data;
    }

    /*
    'C_Nombre' => $request -> getPostGet('nombrecliente'),
             'C_Apellido' => $request -> getPostGet('apellidocliente'),
             'C_Fecha_Nacimiento' => $request -> getPostGet('fnacimiento'),
             'C_DNI' => $request -> getPostGet('dnicliente'),
             'C_CUIL__C_CUIT' => $request -> getPostGet('cuitcuilcliente'),
             'C_Direccion' => $request -> getPostGet('direccioncliente'),
             'C_Telefono' => $request -> getPostGet('telefonocliente'),
             'flag_Eliminar ' => 0,
    */

    public function modificarCliente($idCliente,$C_Nombre,$C_Apellido,$C_Fecha_Nacimiento, $C_DNI, $C_CUIL__C_CUIT,$C_Direccion,$C_Telefono){

        
        $data = $this->db->query("UPDATE cliente SET C_Nombre= '$C_Nombre', C_Apellido = '$C_Apellido', C_Fecha_Nacimiento = '$C_Fecha_Nacimiento', C_Direccion = '$C_Direccion', C_Telefono = '$C_Telefono', C_DNI = '$C_DNI', C_CUIL__C_CUIT = '$C_CUIL__C_CUIT' WHERE idCliente ='$idCliente'");

        if(isset($data) ){
            return 1;
        }else{return 0;}
        
    }

    public function TraerNombresYApellidoYID(){
        $data = $this->db->query("SELECT   idCliente, C_Nombre, C_Apellido
           FROM cliente WHERE flag_Eliminar= 0;");
        return $data->getResultArray();
    }

    public function consultaUser($usuario){

        $db = mysqli_connect("localhost", "root", "", "comunidad_bancaria");

        $data = mysqli_query($db, "SELECT  DISTINCT  Cu_Numero, Cu_Fecha_Creacion, Cu_Moneda, Cu_Moneda, Cu_Monto_Actual, C_Nombre,B_nombre   FROM usuario, cliente, banco, cuenta WHERE cliente.flag_Eliminar= 0 AND usuario.flag_Eliminar= 0 AND U_usuario = '$usuario' AND usuario.Cliente_idCliente = cliente.idCliente AND cliente.idCliente = cuenta.Cliente_idCliente AND banco.idBanco  = cuenta.Banco_idBanco") or die("Error al cargar el usuario");
        
        $filas = $data->num_rows;

        if($filas > 0){ // hay datos je 
            while($rowData = mysqli_fetch_array($data)){
                $arreglo[] = $rowData ;
            }
            return $arreglo;
        }else{
            return 0;
        }

    }

    public function consultaBanc($dato){
        $db = mysqli_connect("localhost", "root", "", "comunidad_bancaria");

        $data = mysqli_query($db, "SELECT DISTINCT C_Nombre, C_Apellido, C_DNI, C_Telefono FROM cliente, banco, cuenta WHERE cliente.flag_Eliminar= 0 AND banco.flag_Eliminar= 0 AND cuenta.flag_Eliminar= 0 AND banco.B_nombre = '$dato' AND cliente.idCliente = cuenta.Cliente_idCliente AND banco.idBanco = cuenta.Banco_idBanco") or die("Error al cargar el usuario");

        if($data->num_rows > 0){
            while($rowData = mysqli_fetch_array($data)){
                $arreglo[] = $rowData ;
            }
            return $arreglo;
        }else{
            return 0; 
        }
    }

    public function modificarMuestraClie($cliente){

        $db = mysqli_connect("localhost", "root", "", "comunidad_bancaria");

        $data = mysqli_query($db, "SELECT idCliente, C_Nombre, C_Apellido, C_Fecha_Nacimiento, C_DNI, C_CUIL__C_CUIT, C_Direccion, C_Telefono, U_usuario FROM cliente, usuario WHERE cliente.flag_Eliminar= 0 AND cliente.C_DNI = '$cliente' AND cliente.idCliente = usuario.Cliente_idCliente;") or die("Error al cargar el usuario");
        
        if($data->num_rows > 0){
            while($rowData = mysqli_fetch_array($data)){
                $arreglo[] = $rowData ;
            }
            return $arreglo;
        }else{
            return 0; 
        }

    }

}

