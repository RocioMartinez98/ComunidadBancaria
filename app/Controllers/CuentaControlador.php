<?php

namespace App\Controllers;
use App\Models\CuentaModel;
use App\Models\ClienteModel;
use App\Models\BancoModel;
use CodeIgniter\Controller;

class CuentaControlador extends BaseController
{
    protected $helpers = ['form'];
    public function indexAlta()
    {
        $bancoModel = new BancoModel($db);

        $bancos = array('bancos' =>$bancoModel -> BuscarBancos());

        $estructura = view ('VistasComunidadBancaria/header').view('VistasComunidadBancaria/adminAltaCuenta', $bancos).view(((('VistasComunidadBancaria/footer'))));
        return $estructura;
    }

    ///Alta Cuenta
    public function cargaCuenta()
    {
        $cuentaModel = new CuentaModel($db);
        $clienteModel = new ClienteModel($db);
        $bancoModel = new BancoModel($db);
        $request = \Config\Services::request();
        $Cliente_idCliente = $request -> getPostGet('dni');
        $nombreBanco = $request -> getPostGet('banco');
        if($nombreBanco === '1'){
            $nombreBanco= 'Banco Nacion';
        }else{
            if($nombreBanco === '2'){
                $nombreBanco= 'Banco Superville';
            }
            else{
                if($nombreBanco === '3'){
                    $nombreBanco= 'Banco Galicia';
                } 
            }
        }
        $tipoMoneda = $request -> getPostGet('tipocuenta');
        if($tipoMoneda === '1'){
            $tipoMoneda= 'Caja de Ahorros';
        }else{
            if($tipoMoneda === '2'){
                $tipoMoneda= 'Cuenta Sueldo/ Cuenta de Seguridad Social';
            }
            else{
                if($tipoMoneda === '3'){
                    $tipoMoneda= 'Cuenta Corriente';
                }
                else{
                    if($tipoMoneda === '4'){
                        $tipoMoneda= 'Cuenta Universal Gratuita';
                    } 
                }
            }
        }
        $idBanco = $bancoModel -> BuscarRepetidos($nombreBanco);

        $dniCom = $clienteModel -> ConsultaIDCliente($Cliente_idCliente);
        if($dniCom !=0){
            $data = array(
                'Cu_Numero' => $request -> getPostGet('numerocuenta'),
                'Cu_Tipo' => $tipoMoneda,
                'Cu_Fecha_Creacion' => $request -> getPostGet('fechacreacion'),
                'Cu_Moneda' => $request -> getPostGet('tipomoneda'),
                'Cu_Monto_Actual' => $request -> getPostGet('monto'),
                'Cliente_idCliente' => $dniCom,
                'Banco_idBanco' => $idBanco,
                'flag_Eliminar ' => 0,
            );
            if($cuentaModel -> insert($data)=== false){
                var_dump($cuentaModel-> errors());
            }else{
                
                $mensajeExito = "Cuenta ingresada correctamente";
                $controlador = "adminAltaCuenta";
                $mensajeExitoArray = array('mensajeExito' => $mensajeExito, 'controlador' => $controlador);
                $estructura = view ('VistasComunidadBancaria/header').view('VistasComunidadBancaria/exito',$mensajeExitoArray).view('VistasComunidadBancaria/footer');
                return $estructura;
            }

        }else{
            $mensajeError = "No se encontro el DNI del usuario";
            $mensajeErrorArray = array('mensajeError' => $mensajeError);

            $estructura = view ('VistasComunidadBancaria/header').view('VistasComunidadBancaria/error',$mensajeErrorArray).view('VistasComunidadBancaria/footer');
            return $estructura;
        }
        
    }

    ///BAJA
    public function indexBaja()
    {
        $cuentaModel = new CuentaModel($db);
        $cuentas1 = $cuentaModel->where('flag_Eliminar',0)->findAll();
        $cuentas = array('cuentas'=>$cuentas1);
        $estructura = view ('VistasComunidadBancaria/header').view('VistasComunidadBancaria/adminBajaCuenta',$cuentas).view(((('VistasComunidadBancaria/footer'))));
        return $estructura;
    }

    ///Baja Cuenta
    public function bajaCuenta()
    {
        $cuentaModel = new CuentaModel($db);
        $request = \Config\Services::request();
        $idCuenta = $request -> getPostGet('idCuenta');

        if($cuentaModel -> eliminarCuentaAux($idCuenta) === 0){
            $mensajeError = "No existe la cuenta";
            $mensajeErrorArray = array('mensajeError' => $mensajeError);

            $estructura = view ('VistasComunidadBancaria/header').view('VistasComunidadBancaria/error',$mensajeErrorArray).view('VistasComunidadBancaria/footer');
            return $estructura;
        }else{
            if($cuentaModel -> eliminarCuenta($idCuenta) === false){
                var_dump($cuentaModel-> errors());
            }else{
                $mensajeExito = "Eliminacion exitosa";
                $controlador = "adminBajaCuenta";
                $mensajeExitoArray = array('mensajeExito' => $mensajeExito, 'controlador' => $controlador);

                $estructura = view ('VistasComunidadBancaria/header').view('VistasComunidadBancaria/exito',$mensajeExitoArray).view('VistasComunidadBancaria/footer');
                return $estructura;
            }
        }
    
    }

    ///Consulta
    public function indexConsulta()
    {
        $cuentaModel = new CuentaModel($db);
        $bancoModel = new BancoModel($db);
        $clienteModel = new ClienteModel($db);
        $cuentas1 = $cuentaModel->BuscarClientesidYBancoidConTipoCuenta();
        $bancos1 = $bancoModel->TraerTodosLosBancosConSurcusal();
        $clientes1 = $clienteModel->TraerNombresYApellidoYID();

        $cuentas = array('cuentas'=>$cuentas1,
                        'bancos'=>$bancos1,
                        'clientes'=>$clientes1,
        );
        $estructura = view ('VistasComunidadBancaria/header').view('VistasComunidadBancaria/adminListadoCuentas',$cuentas).view(((('VistasComunidadBancaria/footer'))));
        return $estructura;
    }

    ///Modificacion
    public function indexModificar()
    {
        // $cuentaModel = new CuentaModel($db);
        // $bancoModel = new BancoModel($db);
        // $clienteModel = new ClienteModel($db);
        // $cuentas1 = $cuentaModel->BuscarClientesidYBancoidConTipoCuenta();
        // $bancos1 = $bancoModel->TraerTodosLosBancosConSurcusal();
        // $clientes1 = $clienteModel->TraerNombresYApellidoYID();
        // $cuentas = array('cuentas'=>$cuentas1,
        //                 'bancos'=>$bancos1,
        //                 'clientes'=>$clientes1,
        // );
        $cuentas = array('cuentas'=>0,
            );
        $estructura = view ('VistasComunidadBancaria/header').view('VistasComunidadBancaria/adminModificarCuenta',$cuentas).view('VistasComunidadBancaria/footer');
        return $estructura;
        return $estructura;
    }

    public function modificarMuestraCuenta() // Poner esto en un modelo, cuando modifiquemos.
    {
        $cuentaModel = new CuentaModel($db);

        $numeroCuenta = $_POST['numerocuenta'];

        $datos = $cuentaModel->modificarMuestraCue($numeroCuenta);

        if($datos == 0){
            $mensajeError = "No se encontro la cuenta";
            $mensajeErrorArray = array('mensajeError' => $mensajeError);
            $estructura = view ('VistasComunidadBancaria/header').view('VistasComunidadBancaria/error',$mensajeErrorArray).view('VistasComunidadBancaria/footer');
            return $estructura;
        }else{
            $cuentas = array('cuentas'=>$datos);
            $estructura = view ('VistasComunidadBancaria/header').view('VistasComunidadBancaria/adminModificarCuenta',$cuentas).view('VistasComunidadBancaria/footer');
            return $estructura;
        }
        
    }

    public function modificarCuenta()
    {
        
        $numeroCuenta = $_POST['numerocuenta1'];
        
        $tipoCuenta = $_POST['tipocuenta'];
        if($tipoCuenta == "Tipo1"){
            $tipoCuenta  = "Caja de Ahorros";
        }else{
            if($tipoCuenta == "Tipo2"){
                $tipoCuenta  = "Cuenta Sueldo/ Cuenta de Seguridad Social";
            }
            else{
                if($tipoCuenta == "Tipo3"){
                    $tipoCuenta  = "Cuenta Corriente";
                }
                else{
                    if($tipoCuenta == "Tipo4"){
                        $tipoCuenta  = "Cuenta Universal Gratuita";
                    }
                }
            }
        }
        $fechacreacion = $_POST['fechacreacion'];
        $tipomoneda = $_POST['tipomoneda'];
        if($tipomoneda == "Tipo1"){
            $tipomoneda  = "Peso";
        }else{
            if($tipomoneda == "Tipo2"){
                $tipomoneda  = "Euro";
            }
            else{
                if($tipomoneda == "Tipo3"){
                    $tipomoneda  = "Dolar";
                }
                else{
                    if($tipomoneda == "Tipo4"){
                        $tipomoneda  = "Real";
                    }
                }
            }
        }
        $monto = $_POST['monto'];
        
        $cuentaModel = new CuentaModel($db);
        $cuentas1 = $cuentaModel->modificarCuenta($numeroCuenta, $tipoCuenta, $fechacreacion, $tipomoneda, $monto);
        echo "lo que tiene cuentas1 es: ".$cuentas1;


        if($cuentas1 === 1){
            echo '<script language="javascript">alert("La cuenta fue modificada con exito");</script>';
            //return redirect()->to(base_url('AdminControlador'));
        }else{
            echo '<script language="javascript">alert("Hubo un error");</script>';
            //return redirect()->to(base_url('AdminControlador'));
        }
    }

    public function mostrarConsulta()
    {
        $cuentaModel = new CuentaModel($db);

        $tipoCuenta = $_POST['banco'];
        if($tipoCuenta === "Tipo1"){
            $tipoCuenta = "Caja de Ahorros";
          }else{
            if($tipoCuenta === "Tipo2"){
              $tipoCuenta = "Cuenta Sueldo/ Cuenta de Seguridad Social";
            }
            else{
              if($tipoCuenta === "Tipo3"){
                $tipoCuenta = "Cuenta Corriente";
              }
              else{
                if($tipoCuenta === "Tipo4"){
                  $tipoCuenta = "Cuenta Universal Gratuita";
                }
              }
            }
            
        }

        $data = $cuentaModel->mostrarConsul($tipoCuenta);
        
        if($data == 0 ){
            $mensajeError = "No hay usuarios con el tipo de cuenta seleccionada";
            $mensajeErrorArray = array('mensajeError' => $mensajeError);
            $estructura = view ('VistasComunidadBancaria/header').view('VistasComunidadBancaria/error',$mensajeErrorArray).view('VistasComunidadBancaria/footer');
            return $estructura;
        }else{
            $cuenta = array('cuenta'=>$data);
            $estructura = view ('VistasComunidadBancaria/header').view('VistasComunidadBancaria/adminListadoCuentasTipoCuenta',$cuenta).view('VistasComunidadBancaria/footer');
            return $estructura;
        } 
    }


}