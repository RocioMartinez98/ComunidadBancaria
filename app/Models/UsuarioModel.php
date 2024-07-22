<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table      = 'usuario';
    protected $primaryKey = 'idUsuario';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['U_usuario', 'U_contraseña','U_rol','Cliente_idCliente','flag_Eliminar'];
    
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

    public function TraerClientesYID(){
        $data = $this->db->query("SELECT   Cliente_idCliente, idUsuario, U_usuario   FROM usuario WHERE flag_Eliminar= 0;");
        return $data->getResultArray();
    }

    public function VerificaNombreYTraeID($usuarioNombre){
        $data = $this->db->query("SELECT  DISTINCT  Cu_Numero, Cu_Fecha_Creacion, Cu_Moneda, Cu_Moneda, Cu_Monto_Actual, C_Nombre,B_nombre, C_Nombre, B_nombre FROM usuario, cliente, banco, cuenta WHERE cliente.flag_Eliminar= 0 AND usuario.flag_Eliminar= 0 AND U_usuario = '$usuarioNombre' AND usuario.Cliente_idCliente = cliente.idCliente AND cliente.idCliente = cuenta.Cliente_idCliente AND banco.idBanco  = cuenta.Banco_idBanco");
        return $data->getResultArray();
    }

    

    /* public function obtenerUsuarioxNombre1($data){
        // Si no funca esto, manejarlo normal y que se cague 
        $usuario = $this->db->table('usuario');
        $usuario->where($data);
        return $usuario->get()->getResultArray();
    } */

        

    public function obtenerUsuarioxNombre($usuario,$rol){
        $data = $this->db->query("SELECT * FROM usuario WHERE U_usuario= '$usuario' AND U_rol = '$rol';");

        if (isset($data)) {
            return $data->getResultArray();
        }
        else{
            return 1;
        }

        // return $data->getResultArray();
    }

    /* public function obtenerUsuarioxNombre($usuario,$rol){
        $data = $this->db->query("SELECT *FROM usuario WHERE U_usuario= '$usuario' AND U_rol = '$rol'");
        //verificamos el retorno
        $data1 = array(
            'U_usuario' => "",
            'U_contraseña' => "",
            'U_rol' => -1
        );

        if (isset($data)) {

            foreach($data->getResultArray() as $dat){
                $data1['U_usuario'] = $dat['U_usuario'];
                $data1['U_contraseña'] = $dat['U_contraseña'];
                $data1['U_rol'] = $dat['U_rol'];
            }

            return $data1;
        } else {

            return [];
        }

        return $data;
    } */

    public function modificarUsuario($idCliente, $U_usuario){
         
        $data = $this->db->query("UPDATE usuario SET U_usuario= '$U_usuario' WHERE Cliente_idCliente ='$idCliente'");

        if(isset($data) ){
            return 1;
        }else{return 0;}
    }


    public function consultAux($idCliente){
        $db = mysqli_connect("localhost", "root", "", "comunidad_bancaria");

        $data = mysqli_query($db, "SELECT DISTINCT Cu_Numero, Cu_Tipo, Cu_Fecha_Creacion, Cu_Moneda, Cu_Monto_Actual, C_DNI, C_Nombre, C_Apellido, B_nombre FROM cliente, banco, cuenta WHERE cliente.flag_Eliminar= 0 AND banco.flag_Eliminar= 0 AND cuenta.flag_Eliminar= 0 AND cliente.idCliente = '$idCliente' AND banco.idBanco = cuenta.Banco_idBanco AND cliente.idCliente = cuenta.Cliente_idCliente") or die("Error al cargar el usuario");

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