<?php

namespace App\Models;

use CodeIgniter\Model;

class CuentaModel extends Model
{
    protected $table      = 'cuenta';
    protected $primaryKey = 'idCuenta';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['Cu_Numero', 'Cu_Tipo','Cu_Fecha_Creacion','Cu_Moneda','Cu_Monto_Actual','Cliente_idCliente','Banco_idBanco','flag_Eliminar'];

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

    
    public function eliminarCuentaAux($idCuenta){
        $data = $this->db->query("SELECT idCuenta FROM cuenta WHERE idCuenta ='$idCuenta'");
        if (isset($data)) {
            $id= 0;
            foreach($data->getResultArray() as $dat){
                $id= $dat['idCuenta'];
            }
            return $id;
        } else {
            return 0;
        }
        
        //return $data;
    }

    public function eliminarCuenta($idCuenta){
        $data = $this->db->query("UPDATE cuenta SET  flag_Eliminar = 1 WHERE idCuenta='$idCuenta'");
        return $data;
    }


    public function BuscarClientesidYBancoid(){
        $data = $this->db->query("SELECT   Cliente_idCliente, Banco_idBanco   FROM cuenta WHERE flag_Eliminar= 0;");
        return $data->getResultArray();
    }

    public function BuscarClientesidYBancoidConTipoCuenta(){
        $data = $this->db->query("SELECT   Cliente_idCliente, Banco_idBanco, Cu_Tipo   FROM cuenta WHERE flag_Eliminar= 0;");
        return $data->getResultArray();
    }

    public function modificarCuenta($Cu_Numero,$Cu_Tipo, $Cu_Fecha_Creacion, $Cu_Moneda, $Cu_Monto_Actual){
        $data = $this->db->query("UPDATE cuenta SET Cu_Tipo= '$Cu_Tipo', Cu_Fecha_Creacion= '$Cu_Fecha_Creacion',
        Cu_Moneda= '$Cu_Moneda', Cu_Monto_Actual= '$Cu_Monto_Actual' WHERE Cu_Numero ='$Cu_Numero'");
        if(isset($data) ){
            return 1;
        }else{return 0;}
    }

    public function mostrarConsul($tipoCuenta){
        $db = mysqli_connect("localhost", "root", "", "comunidad_bancaria");

        $data = mysqli_query($db, "SELECT  DISTINCT C_Nombre, C_Apellido, C_DNI, B_nombre FROM cliente, banco, cuenta WHERE cliente.flag_Eliminar= 0 AND banco.flag_Eliminar= 0 AND cuenta.flag_Eliminar= 0 AND cuenta.Cu_Tipo = '$tipoCuenta' AND cliente.idCliente = cuenta.Cliente_idCliente AND banco.idBanco  = cuenta.Banco_idBanco") or die("Error al cargar el usuario");

        if($data->num_rows > 0){
            while($rowData = mysqli_fetch_array($data)){
                $arreglo[] = $rowData ;
            }
            return $arreglo;
        }else{
            return 0; 
        }
        
    }

    public function modificarMuestraCue($numeroCuenta){
        $db = mysqli_connect("localhost", "root", "", "comunidad_bancaria");

        $data = mysqli_query($db, "SELECT DISTINCT Cu_Numero, Cu_Tipo, Cu_Fecha_Creacion, Cu_Moneda, Cu_Monto_Actual, C_DNI, C_Nombre, C_Apellido, B_nombre FROM cliente, banco, cuenta WHERE cliente.flag_Eliminar= 0 AND banco.flag_Eliminar= 0 AND cuenta.flag_Eliminar= 0 AND cuenta.Cu_Numero = '$numeroCuenta' AND banco.idBanco = cuenta.Banco_idBanco AND cliente.idCliente = cuenta.Cliente_idCliente;") or die("Error al cargar el usuario");

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