<?php

namespace App\Controllers;
use App\Models\BancoModel;
use App\Models\UsuarioModel;

class ControladorInicio extends BaseController
{


    protected $helpers = ['form'];
    public function index()
    {
        $bancoModel = new BancoModel($db);
        $bancos1 = $bancoModel->TraerTodosLosBancosSinSurcusalYSinDireccion();
        $bancos2 = $bancoModel->TraerTodosLosBancos();
        // var_dump($bancos1);
        $bancos = array('bancos'=>$bancos1, 'allBancos' => $bancos2);

        // Cuando ejecuta esto, es como si fuera mi login 
        $estructura = view ('VistasComunidadBancaria/headerInicio').view('VistasComunidadBancaria/inicioBanco',$bancos ).view('VistasComunidadBancaria/footer');
        return $estructura;
    }

    public function login(){
        $users = new UsuarioModel($db);

        $request = \Config\Services::request();
        
        $usuario = $request -> getPostGet('user');
        $password = $request -> getPostGet('pass');
        // $rol = $_POST["tipoUser"];
        $rol = $request -> getPostGet('tipoUser');

        if($rol == "Administrador"){
            $rol = 1;
        }
        else{
            $rol = 0;
        }
        $datosUsuario = $users-> obtenerUsuarioxNombre($usuario,$rol);

        $usuario = "";
        $contraseña ="";
        $idCliente = "";
        $rol = -1;

        if($datosUsuario == 1){
            echo "los datos traen nada";
        }
        else{
            // var_dump($datosUsuario);
            //echo "trajo algo es ".$datosUsuario;
            //echo json_encode($datosUsuario);
            foreach($datosUsuario as $User ){
                
                echo "<script>console.log('Console Row Usuario: " ."El usuario es".$User['U_usuario']."' );</script>";
                echo "<script>console.log('Console Row Usuario: " ."El usuario contrasena es".$User['U_contraseña']."' );</script>";
                echo "<script>console.log('Console Row Usuario: " ."El usuario rol es".$User['U_rol']."' );</script>";
                $usuario = $User['U_usuario'];
                $contraseña = $User['U_contraseña'];
                $idCliente = $User['Cliente_idCliente'];
                $rol = $User['U_rol'];
                
            }

            echo "<script>console.log('Console Row Usuario: " ."El usuario es".$usuario."' );</script>";
            echo "<script>console.log('Console Row Usuario: " ."El usuario contrasena es".$contraseña."' );</script>";
            echo "<script>console.log('Console Row Usuario: " ."El usuario rol es". $rol."' );</script>";

            if(count($datosUsuario) > 0 && password_verify($password,$contraseña)){ // Si se cumple esto el usuario existe. 
                
                $flagUser = "";
                if($rol === '0'){
                    $flagUser = "Cliente";
                }else{
                    $flagUser = "Admin";
                }
        
                $data = [
                    "U_usuario" => $usuario,
                    "U_rol" =>  $flagUser
                ];
        
                $session = session();
                $session -> set($data);

                if($rol === "1"){
                    ///Admin
                    return redirect()->to(base_url('AdminControlador')) ->with('mensaje','1');
                }else{
                    ///Cliente
                    ///Para Clientes inciso 3b
                    // public function TraerCuentaConIdCliente(){
                    //     $data = $this->db->query("SELECT   Cliente_idCliente, Banco_idBanco   FROM cuenta WHERE flag_Eliminar= 0;");
                    //     return $data->getResultArray();
                    // }

                    $datos = $users->consultAux($idCliente);
                    
                    if($datos == 0){
                        $mensajeError = "Hubo un error";
                        $mensajeErrorArray = array('mensajeError' => $mensajeError);
                        $estructura = view ('VistasComunidadBancaria/header').view('VistasComunidadBancaria/error',$mensajeErrorArray).view('VistasComunidadBancaria/footer');
                        return $estructura;
                        //return redirect()->to(base_url('ControladorInicio'));
                    }else{
                        $cuentas = array('cuentas'=>$datos);
                        $estructura = view ('VistasComunidadBancaria/header').view('VistasComunidadBancaria/clienteListadoCuentas',$cuentas).view('VistasComunidadBancaria/footer');
                        return $estructura;
                    }
                }
    
            }else{
                return redirect()->to(base_url('ControladorInicio')) ->with('mensaje','1');
            }

        }

    }


    public function Salir(){
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('ControladorInicio')) ->with('mensaje','1');
    }


    // Vistas a retornar 

    /* public function AdminIngreso(){
        $estructura = view ('VistasComunidadBancaria/header').view(('VistasComunidadBancaria/adminMenuPrincipal')).view(((('VistasComunidadBancaria/footer'))));
        return $estructura;
    }

    public function UserIngreso(){
        $estructura = view ('VistasComunidadBancaria/headerInicio').view('VistasComunidadBancaria/clienteListadoCuentas').view('VistasComunidadBancaria/footer');
        return $estructura;
    } */



}