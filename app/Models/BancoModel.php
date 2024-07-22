<?php

namespace App\Models;

use CodeIgniter\Model;

class BancoModel extends Model
{
    protected $table      = 'banco';
    protected $primaryKey = 'idBanco';

     protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['idBanco','B_nombre', 'B_Direccion','B_Numero_Sucursal','flag_Eliminar'];

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

    public function BuscarBancos(){
        $data = $this->db->query("SELECT DISTINCT idBanco, B_nombre  FROM banco WHERE flag_Eliminar= 0;");
        return $data->getResultArray();
    }
    public function BuscarBancosPorID($idBanco){
        $data = $this->db->query("SELECT B_nombre  FROM banco WHERE idBanco= '$idBanco';");
        return $data->getResultArray();
    }

    public function BuscarRepetidos($B_nombre){
        $data = $this->db->query("SELECT DISTINCT `idBanco` FROM `banco` WHERE `B_nombre`= '$B_nombre'");
        //verificamos el retorno
        
        if (isset($data)) {
            $id= 0;
            foreach($data->getResultArray() as $dat){
                $id= $dat['idBanco'];
            }
            return $id;
        } else {
            return 0;
        }
        //return $data;
    }

    public function BuscarRepetidosAux($idBanco,$numSucursal){
        $data = $this->db->query("SELECT DISTINCT `B_Numero_Sucursal` FROM `banco` WHERE `idBanco`= '$idBanco'");
        //verificamos el retorno
        
        if (isset($data)) {
            $flag= 0;
            foreach($data->getResultArray() as $dat){
                if( $dat['B_Numero_Sucursal'] === $numSucursal){
                    $flag = 1;
                }
            }
            return $flag;
            
        } else {
            return 0;
        }
        //return $data;
    }

    public function TraerTodosLosBancosSinSurcusal(){
        $data = $this->db->query("SELECT DISTINCT idBanco, B_nombre, B_Direccion  FROM banco WHERE flag_Eliminar= 0;");
        return $data->getResultArray();
    }
    public function TraerTodosLosBancos(){
        $data = $this->db->query("SELECT  idBanco, B_nombre, B_Direccion  FROM banco WHERE flag_Eliminar= 0;");
        return $data->getResultArray();
    }

    public function eliminarBanco($idBanco){
        $data = $this->db->query("UPDATE banco SET  flag_Eliminar = 1 WHERE idBanco='$idBanco'");
        return $data;
    }

    public function TraerTodosLosBancosConSurcusal(){
        $data = $this->db->query("SELECT DISTINCT idBanco, B_nombre, B_Numero_Sucursal  FROM banco WHERE flag_Eliminar= 0;");
        return $data->getResultArray();
    }

    public function modificarBanco($idBanco, $B_Numero_Sucursal , $B_Direccion){
        $data = $this->db->query("UPDATE banco SET B_Direccion= '$B_Direccion' WHERE idBanco='$idBanco' AND B_Numero_Sucursal = '$B_Numero_Sucursal '");
        return $data;
    }


    public function mostrarConsu($dato){

        $db = mysqli_connect("localhost", "root", "", "comunidad_bancaria");

        $data = mysqli_query($db, "SELECT DISTINCT C_Nombre, C_Apellido, C_Fecha_Nacimiento, C_DNI, C_CUIL__C_CUIT, C_Direccion, C_Telefono FROM cliente, banco, cuenta WHERE cliente.flag_Eliminar= 0 AND banco.flag_Eliminar= 0 AND cuenta.flag_Eliminar= 0 AND banco.B_nombre = '$dato' AND cliente.idCliente = cuenta.Cliente_idCliente AND banco.idBanco = cuenta.Banco_idBanco") or die("Error al cargar el usuario");

        if($data->num_rows > 0){
            while($rowData = mysqli_fetch_array($data)){
                $arreglo[] = $rowData ;
            }
            return $arreglo;
        }else{
            return 0;
        }
    }

    public function TraerTodosLosBancosSinSurcusalYSinDireccion(){
        $data = $this->db->query("SELECT DISTINCT idBanco, B_nombre  FROM banco WHERE flag_Eliminar= 0;");
        return $data->getResultArray();
    }

    

}