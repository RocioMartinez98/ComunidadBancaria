<?php

namespace App\Controllers;

use App\Models\ClienteModel;
use App\Models\UsuarioModel;
use App\Models\BancoModel;
use App\Models\CuentaModel;
use CodeIgniter\CLI\Console;

class ControladorCliente extends BaseController
{
    protected $helpers = ['form'];

    public function indexAlta()
    {
        $flag = array('confirmacionCliente' => 0);
        $estructura = view ('VistasComunidadBancaria/header').view('VistasComunidadBancaria/adminAltaCliente',$flag).view(((('VistasComunidadBancaria/footer'))));
        return $estructura;
    }

     ///Alta Banco
     public function cargaCliente()
     {
         $clienteModel = new ClienteModel($db);
         $clientModelUsuario = new UsuarioModel($db);

         $request = \Config\Services::request();
         $data = array(
             'C_Nombre' => $request -> getPostGet('nombrecliente'),
             'C_Apellido' => $request -> getPostGet('apellidocliente'),
             'C_Fecha_Nacimiento' => $request -> getPostGet('fnacimiento'),
             'C_DNI' => $request -> getPostGet('dnicliente'),
             'C_CUIL__C_CUIT' => $request -> getPostGet('cuitcuilcliente'),
             'C_Direccion' => $request -> getPostGet('direccioncliente'),
             'C_Telefono' => $request -> getPostGet('telefonocliente'),
             'flag_Eliminar ' => 0,
         );

        $U_usuario = $request -> getPostGet('usuariocliente');
        $U_contraseña= $request -> getPostGet('clavecliente');

         if($clienteModel-> ConsultaIDCliente($data['C_DNI']) != 0){ // Si es distinto de cero es porque lo encontro. 

            $mensajeError = "DNI duplicado, el cliente ya se encuentra cargado";
            $mensajeErrorArray = array('mensajeError' => $mensajeError);

            $estructura = view ('VistasComunidadBancaria/header').view('VistasComunidadBancaria/error',$mensajeErrorArray).view('VistasComunidadBancaria/footer');
            return $estructura;

         }else{
            // Todo lo demas.

            if($clienteModel -> insert($data)=== false){
                var_dump($clienteModel-> errors());
            }else{
                // Obtener el id, del qlia que recien le di de alta 
                $idCliente = $clienteModel-> ConsultaIDCliente($data['C_DNI']);

                // Se encripta la contraseña. 
                $contraseña = password_hash($U_contraseña, PASSWORD_DEFAULT);

                $data1 = array(
                    'U_usuario' => $U_usuario,
                    'U_contraseña' => $contraseña,
                    'U_rol' => 0,
                    'Cliente_idCliente' => $idCliente,
                    'flag_Eliminar ' => 0,
                );

                if($clientModelUsuario -> insert($data1) === false){
                    var_dump($clienteModel-> errors());
                }else{
                   /*  $flag = array('confirmacionCliente' => 1);
                    $estructura = view ('VistasComunidadBancaria/header').view('VistasComunidadBancaria/adminAltaCliente',$flag).view(((('VistasComunidadBancaria/footer'))));
                    return $estructura; */

                    $mensajeExito = "El cliente se ha ingresado con exito";
                    $controlador = "adminAltaCliente";
                    $mensajeExitoArray = array('mensajeExito' => $mensajeExito, 'controlador' => $controlador);

                    $estructura = view ('VistasComunidadBancaria/header').view('VistasComunidadBancaria/exito',$mensajeExitoArray).view('VistasComunidadBancaria/footer');
                    return $estructura;
                

                }
            
            } 
        
        } 
        
     }

     
     public function indexBaja(){
        $clienteModel = new ClienteModel($db);
        //$flag = array('confirmacionCliente' => 0);
        // $bancos1 = $bancoModel->findColumn('B_Numero_Sucursal');
        // foreach($bancos1 as $bancos1){
        //     echo "bancos 1 tiene".$bancos1;
        // }
        $cliente1 = $clienteModel->findAll();
        $cliente = array('cliente'=>$cliente1);

        $estructura = view ('VistasComunidadBancaria/header').view('VistasComunidadBancaria/adminBajaCliente',$cliente).view(((('VistasComunidadBancaria/footer'))));
        return $estructura;
    }


     public function bajaCliente()
     {
         $clienteModel = new ClienteModel($db);
         $request = \Config\Services::request();
         $idCliente = $request -> getPostGet('idCliente');

         

         //update($idBanco, $data)

        if($clienteModel-> ConsultaIDClienteAux($idCliente) === 0){
            $mensajeError = "El cliente no se encuentra cargado";
            $mensajeErrorArray = array('mensajeError' => $mensajeError);

            $estructura = view ('VistasComunidadBancaria/header').view('VistasComunidadBancaria/error',$mensajeErrorArray).view('VistasComunidadBancaria/footer');
            return $estructura;

        }else{

            if($clienteModel -> eliminarCliente($idCliente) === false){
                var_dump($clienteModel-> errors());
            }else{
                //echo '<script language="javascript">alert("Eliminacion exitosa");</script>';
                // Solucion temporal.
               

                $mensajeExito = "Eliminacion exitosa";
                $controlador = "adminBajaCliente";
                $mensajeExitoArray = array('mensajeExito' => $mensajeExito, 'controlador' => $controlador);

                $estructura = view ('VistasComunidadBancaria/header').view('VistasComunidadBancaria/exito',$mensajeExitoArray).view('VistasComunidadBancaria/footer');
                return $estructura;
                
                
                //return redirect()->to(base_url('adminBajaCliente')) ->with('mensaje','1');
            }
            
        }
         
     }


     public function indexConsulta(){
        $clienteModel = new ClienteModel($db);
        $bancoModel = new BancoModel($db);
        $cliente1 = $clienteModel->where('flag_Eliminar',0)->findAll();
        $banco1 = $bancoModel->BuscarBancos();
        
        
        $cliente = array('cliente'=>$cliente1, 'banco'=> $banco1);

        $estructura = view ('VistasComunidadBancaria/header').view('VistasComunidadBancaria/adminListadoClientes',$cliente).view('VistasComunidadBancaria/footer');
        return $estructura;
    }

    public function consultaUsuario(){
        // Esto hace que se envie a si mismo.
        $usuario = $_POST['id'];

        //echo "Lo que tiene usuario es:".$usuario;
        $clienteModel = new ClienteModel($db);
        $datos = $clienteModel->consultaUser($usuario);

        if($datos == 0){
            $mensajeError = "El usuario no se encuentra cargado";
            $mensajeErrorArray = array('mensajeError' => $mensajeError);

            $estructura = view ('VistasComunidadBancaria/header').view('VistasComunidadBancaria/error',$mensajeErrorArray).view('VistasComunidadBancaria/footer');
            return $estructura;
        }else{
            $cuenta = array('cuenta'=>$datos);
            
            $estructura = view ('VistasComunidadBancaria/header').view('VistasComunidadBancaria/adminListadoClientesPorUsuario',$cuenta).view('VistasComunidadBancaria/footer');
            return $estructura;
        }  
    }


    public function consultaBanco(){
        $usuario = $_POST['banco'];
        $bancoModel = new BancoModel($db);
        $clienteModel = new ClienteModel($db);
        $banco1 = $bancoModel->BuscarBancosPorID($usuario);

        foreach($banco1 as $banco){
            $dato= $banco['B_nombre'];
        }
        
        $datos = $clienteModel->consultaBanc($dato);

        if($datos == 0){   
            $mensajeError = "No hay clientes pertenecientes a este banco";
            $mensajeErrorArray = array('mensajeError' => $mensajeError);

            $estructura = view ('VistasComunidadBancaria/header').view('VistasComunidadBancaria/error',$mensajeErrorArray).view('VistasComunidadBancaria/footer');
            return $estructura;
        }else{
            $cuenta = array('banco'=>$datos);
            $estructura = view ('VistasComunidadBancaria/header').view('VistasComunidadBancaria/adminListadoClientesBanco',$cuenta).view('VistasComunidadBancaria/footer');
            return $estructura;
        }

    }

    ///Modificar
    public function indexModifica()
    {
        // $clienteModel = new ClienteModel($db);
        // $clientModelUsuario = new UsuarioModel($db);
        // $cliente1 = $clienteModel->where('flag_Eliminar',0)->findAll();
        // $clienteUsuario1 = $clientModelUsuario->where('flag_Eliminar',0)->findAll();
        
        // $cliente = array('cliente'=>$cliente1,'confirmacionCliente' => 0, 'clienteUsuario' => $clienteUsuario1);
        $cliente = array('cliente'=>0);
        $estructura = view ('VistasComunidadBancaria/header').view('VistasComunidadBancaria/adminModificarCliente',$cliente).view(((('VistasComunidadBancaria/footer'))));
        return $estructura;
    }

    public function modificarMuestraCliente(){

        $clienteModel = new ClienteModel($db);

        $cliente = $_POST['dnicliente'];

        $datos = $clienteModel->modificarMuestraClie($cliente);

        if($datos == 0){
           $mensajeError = "No se encontro el cliente";
           $mensajeErrorArray = array('mensajeError' => $mensajeError);
           $estructura = view ('VistasComunidadBancaria/header').view('VistasComunidadBancaria/error',$mensajeErrorArray).view('VistasComunidadBancaria/footer');
           return $estructura;
        }else{
            $cliente = array('cliente'=>$datos);
            $estructura = view ('VistasComunidadBancaria/header').view('VistasComunidadBancaria/adminModificarCliente',$cliente).view(((('VistasComunidadBancaria/footer'))));
            return $estructura;
        }
        
    }

    public function modificaCliente(){
        // $clienteModel = new ClienteModel($db);
        // $clientModelUsuario = new UsuarioModel($db);
        // $clientes1 = $clienteModel->TraerNombresYApellidoYID();

        $clienteModel = new ClienteModel($db);
        $clientModelUsuario = new UsuarioModel($db);
        
         $request = \Config\Services::request();
         $idCliente = $request -> getPostGet('idCliente');
         $data = array(
             'C_Nombre' => $request -> getPostGet('nombrecliente'),
             'C_Apellido' => $request -> getPostGet('apellidocliente'),
             'C_Fecha_Nacimiento' => $request -> getPostGet('fnacimiento'),
             'C_DNI' => $request -> getPostGet('dnicliente2'),
             'C_CUIL__C_CUIT' => $request -> getPostGet('cuitcuilcliente'),
             'C_Direccion' => $request -> getPostGet('direccioncliente'),
             'C_Telefono' => $request -> getPostGet('telefonocliente'),
             'flag_Eliminar ' => 0,
         );
        
        $U_usuario = $request -> getPostGet('usuariolcliente');

        if($clienteModel-> modificarCliente($idCliente,$data['C_Nombre'],$data['C_Apellido'],$data['C_Fecha_Nacimiento'],$data['C_DNI'],$data['C_CUIL__C_CUIT'],$data['C_Direccion'],$data['C_Telefono']) === 0){
            var_dump($clienteModel-> errors());
        }
        else{
            if($clientModelUsuario -> modificarUsuario($idCliente, $U_usuario) === 0){
                var_dump($clientModelUsuario-> errors());
            }
            else{
                $mensajeExito = "El cliente ha sido modificado con exito";
                $controlador = "adminModificarCliente";
                $mensajeExitoArray = array('mensajeExito' => $mensajeExito, 'controlador' => $controlador);

                $estructura = view ('VistasComunidadBancaria/header').view('VistasComunidadBancaria/exito',$mensajeExitoArray).view('VistasComunidadBancaria/footer');
                return $estructura;

            }
        }
      
    }

}


