<?php

namespace App\Controllers;
use App\Models\BancoModel;
use App\Models\CuentaModel;
use App\Models\ClienteModel;

class Banco extends BaseController
{
    protected $helpers = ['form'];
    public function index()
    {
        $flag = array('confirmacionBanco' => 0);
        $estructura = view ('VistasComunidadBancaria/header').view('VistasComunidadBancaria/adminAltaBanco',$flag).view(((('VistasComunidadBancaria/footer'))));
        return $estructura;
    }

    ///Alta Banco
    public function cargaBanco()
    {
        $bancoModel = new BancoModel($db);
        $request = \Config\Services::request();
        $B_nombre = $request -> getPostGet('nombrebanco');
        $bancoAux = $bancoModel -> BuscarRepetidos($B_nombre);
    
        $data = array(
            'B_nombre' => $request -> getPostGet('nombrebanco'),
            'B_Direccion' => $request -> getPostGet('direccionbanco'),
            'B_Numero_Sucursal' => $request -> getPostGet('numerosucursal'),
            'flag_Eliminar ' => 0,
        );

        if($bancoAux != 0){ // Si es distinto de cero quiere decir que encontro un id, pero ahora hay que ver que no haya el mismo numero de sucursal.
            $data = array(
                'idBanco' =>$bancoAux,
                'B_nombre' => $request -> getPostGet('nombrebanco'),
                'B_Direccion' => $request -> getPostGet('direccionbanco'),
                'B_Numero_Sucursal' => $request -> getPostGet('numerosucursal'),
                'flag_Eliminar ' => 0,
            );

            // Acá como que deberíamos hacer una consulta de ese $bancoAux por todos sus campos 

            $bancoAux1 = $bancoModel -> BuscarRepetidosAux($bancoAux,$data['B_Numero_Sucursal']);
            
            if($bancoAux1 === 1){ // No se puede dar de alta porque significa que hay al menos un banco con ese numero de sucursal. 
               $mensajeError = "El numero de sucursal para este banco ya existe";
               $mensajeErrorArray = array('mensajeError' => $mensajeError);
   
               $estructura = view ('VistasComunidadBancaria/header').view('VistasComunidadBancaria/error',$mensajeErrorArray).view('VistasComunidadBancaria/footer');
               return $estructura;

            }else{

                if($bancoModel -> insert($data)=== false){
                    var_dump($bancoModel-> errors());
                }else{
                    $mensajeExito = "Banco ingresado correctamente";
                    $controlador = "adminAltaBanco";
                    $mensajeExitoArray = array('mensajeExito' => $mensajeExito, 'controlador' => $controlador);
                    $estructura = view ('VistasComunidadBancaria/header').view('VistasComunidadBancaria/exito',$mensajeExitoArray).view('VistasComunidadBancaria/footer');
                    return $estructura;
                }
            }

        }else{ // Si es igual a cero quiere decir que no se encontro banco con este nombre por lo cual solo se hace el insert. 

            if($bancoModel -> insert($data)=== false){
                var_dump($bancoModel-> errors());
            }else{
                $mensajeExito = "Banco ingresado correctamente";
                $controlador = "adminAltaBanco";
                $mensajeExitoArray = array('mensajeExito' => $mensajeExito, 'controlador' => $controlador);
                $estructura = view ('VistasComunidadBancaria/header').view('VistasComunidadBancaria/exito',$mensajeExitoArray).view('VistasComunidadBancaria/footer');
                return $estructura;
            }

        }
    }

    ///Modificar Banco
    public function modificarBanco()
    {
        $bancoModel = new BancoModel($db);
        $request = \Config\Services::request();
        $data = array(
            'B_nombre' => $request -> getPostGet('nombrebanco'),
            'B_Direccion' => $request -> getPostGet('direccionbanco'),
            'B_Numero_Sucursal' => $request -> getPostGet('numerosucursal'),
            'flag_Eliminar ' => 0,
        );

        if($bancoModel -> insert($data)=== false){
            var_dump($bancoModel-> errors());
        }else{
            $flag = array('confirmacionBanco' => 1);
            $estructura = view ('VistasComunidadBancaria/header').view('VistasComunidadBancaria/adminAltaBanco',$flag).view('VistasComunidadBancaria/footer');
            return $estructura;
        }
    }

    public function indexConsulta()
    {
        $bancoModel = new BancoModel($db);
        $cuentaModel = new CuentaModel($db);
        $clienteModel = new ClienteModel($db);
        $bancos = array('bancos' =>$bancoModel -> TraerTodosLosBancosSinSurcusalYSinDireccion(),
        'cuentas' =>$cuentaModel -> BuscarClientesidYBancoid(),
        'clientes' =>$clienteModel -> BuscarClientesID(),
    
        );
        $estructura = view ('VistasComunidadBancaria/header').view('VistasComunidadBancaria/adminListadoBancos',$bancos).view(((('VistasComunidadBancaria/footer'))));
        return $estructura;
    }

    public function mostrarConsulta()
    {
        $bancos = $_POST['banco'];
        $bancoModel = new BancoModel($db);
        $banco1 = $bancoModel->BuscarBancosPorID($bancos);
        foreach($banco1 as $banco){
            $dato= $banco['B_nombre'];
        }

        $datos = $bancoModel->mostrarConsu($dato);
        
        if($datos == 0){
            $mensajeError = "No hay clientes pertenecientes a este banco";
            $mensajeErrorArray = array('mensajeError' => $mensajeError);
            $estructura = view ('VistasComunidadBancaria/header').view('VistasComunidadBancaria/error',$mensajeErrorArray).view('VistasComunidadBancaria/footer');
            return $estructura;
        }else{
            $cuenta = array('banco'=>$datos);
            $estructura = view ('VistasComunidadBancaria/header').view('VistasComunidadBancaria/adminListadoBancosConsulta',$cuenta).view('VistasComunidadBancaria/footer');
            return $estructura;
        }
    }



    public function indexModifica(){
        $bancoModel = new BancoModel($db);
        $bancos = array('bancos' =>$bancoModel -> BuscarBancos(), 'allBancos' => $bancoModel->where('flag_Eliminar',0)->findAll(), 'datoBanco' => 0
        );
        $estructura = view ('VistasComunidadBancaria/header').view('VistasComunidadBancaria/adminModificarBanco',$bancos).view('VistasComunidadBancaria/footer');
        return $estructura;
    }

    public function modificaMuestraBanco(){
        $nombreBanco = $_POST['banco'];
        $surcusalBanco = $_POST['numSucursal'];

        $db = mysqli_connect("localhost", "root", "", "comunidad_bancaria");

        $data = mysqli_query($db, "SELECT idBanco, B_nombre, B_Direccion, B_Numero_Sucursal FROM banco WHERE banco.flag_Eliminar= 0 AND  banco.idBanco  = '$nombreBanco' AND banco.B_Numero_Sucursal = '$surcusalBanco';") or die("Error al cargar el banco");

        if($data->num_rows > 0){
            if(isset($data)){
                while($rowData = mysqli_fetch_array($data)){
                    $arreglo[] = $rowData ;
                }
                $bancoModel = new BancoModel($db1);
                $bancos = array('bancos' =>$bancoModel -> BuscarBancos(), 'allBancos' => $bancoModel->where('flag_Eliminar',0)->findAll(), 'datoBanco' => $arreglo
                );
                $estructura = view ('VistasComunidadBancaria/header').view('VistasComunidadBancaria/adminModificarBanco',$bancos).view('VistasComunidadBancaria/footer');
                return $estructura;
            }else{
                echo '<script language="javascript">alert("Hubo un error");</script>';
                
            }
        }else{
            echo '<script language="javascript">alert("Error no se encontro el banco");</script>';
             echo "
            <h2>Por favor Reintente</h2>
            <br>
            <input type='button' value='Atras' onClick='history.go(-1);'>";
        }
    }

    public function modificaBanco(){
        // $clienteModel = new ClienteModel($db);
        // $clientModelUsuario = new UsuarioModel($db);
        // $clientes1 = $clienteModel->TraerNombresYApellidoYID();


        $bancoModel = new BancoModel($db);
        
        
         $request = \Config\Services::request();
         $idBanco = $request -> getPostGet('idBanco');
         $B_Direccion = $request -> getPostGet('direccionbanco');
         $B_Numero_Sucursal = $request -> getPostGet('numerosucursal');
        //  $data = array(
        //      'B_Direccion' => $request -> getPostGet('direccionbanco'),
        //      'B_Numero_Sucursal' => $request -> getPostGet('numerosucursal')
        //  );


        // echo "IdCLiente".$idCliente;
        // echo "Nombre".$data['C_Nombre'];
        // echo "Apellido".$data['C_Apellido'];
        // echo "Fecha de Nacimiento".$data['C_Fecha_Nacimiento'];
        // echo "CUIL/CUIT".$data['C_CUIL__C_CUIT'];
        // echo "Direccion".$data['C_Direccion'];
        // echo "Telefono".$data['C_Telefono'];
        // echo "usuario".$U_usuario;
      
        if($B_Numero_Sucursal === ""){
            $mensajeError = "No ha seleccionado un banco";
            $mensajeErrorArray = array('mensajeError' => $mensajeError);
            $estructura = view ('VistasComunidadBancaria/header').view('VistasComunidadBancaria/error',$mensajeErrorArray).view('VistasComunidadBancaria/footer');
            return $estructura;
        }


        if($bancoModel-> modificarBanco($idBanco,$B_Numero_Sucursal,$B_Direccion) == false){
            // var_dump($bancoModel-> errors());
            echo '<script language="javascript">alert("Hubo un error");</script>';
        }
        else{
            // Preguntar esto
            // $flag = array('bancos'=>0,'allBancos' => 0, 'confirmacionBanco' => 1);
            // $estructura = view ('VistasComunidadBancaria/header').view('VistasComunidadBancaria/adminModificarBanco',$flag).view('VistasComunidadBancaria/footer');
            // return $estructura;

            $mensajeExito = "El banco ha sido modificado con exito";
            $controlador = "adminModificarBanco";
            $mensajeExitoArray = array('mensajeExito' => $mensajeExito, 'controlador' => $controlador);

            $estructura = view ('VistasComunidadBancaria/header').view('VistasComunidadBancaria/exito',$mensajeExitoArray).view('VistasComunidadBancaria/footer');
            return $estructura;
            
        }
      
    }



}