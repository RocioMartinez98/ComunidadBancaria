<?php

namespace App\Controllers;
use App\Models\BancoModel;

class BancoBaja extends BaseController
{
    protected $helpers = ['form'];
    public function index()
    {   
        $bancoModel = new BancoModel($db);
        // $bancos1 = $bancoModel->findColumn('B_Numero_Sucursal');
        // foreach($bancos1 as $bancos1){
        //     echo "bancos 1 tiene".$bancos1;
        // }
        $bancos1 = $bancoModel->findAll();
        $bancos = array('bancos'=>$bancos1);
        // $flag = array('confirmacionBanco' => 0);
        $estructura = view ('VistasComunidadBancaria/header').view('VistasComunidadBancaria/adminBajaBanco',$bancos ).view(((('VistasComunidadBancaria/footer'))));
        return $estructura;
    }

    ///Baja Banco
    public function bajaBanco()
    {
        $bancoModel = new BancoModel($db);
        $request = \Config\Services::request();
        $idBanco = $request -> getPostGet('idBanco');
        if($bancoModel -> eliminarBanco($idBanco) === false){
            var_dump($bancoModel-> errors());
        }else{
            $mensajeExito = "Eliminacion Exitosa";
            $controlador = "adminBajaBanco";
            $mensajeExitoArray = array('mensajeExito' => $mensajeExito, 'controlador' => $controlador);
            $estructura = view ('VistasComunidadBancaria/header').view('VistasComunidadBancaria/exito',$mensajeExitoArray).view('VistasComunidadBancaria/footer');
            return $estructura;
        }
    }

    

}