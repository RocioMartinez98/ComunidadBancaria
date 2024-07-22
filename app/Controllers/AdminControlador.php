<?php

namespace App\Controllers;

class AdminControlador extends BaseController
{
    public function index()
    {
        // session_start();
        // echo $_SESSION["usuario"];
        // if(!isset($_SESSION['navegar'])) $_SESSION['navegar']=1;
        // else $_SESSION['navegar']++;

        // Este es como la vista de inicio del login en caso de que sea un administrador. 

        $estructura = view ('VistasComunidadBancaria/header').view(('VistasComunidadBancaria/adminMenuPrincipal')).view(((('VistasComunidadBancaria/footer'))));
        return $estructura;
    }


}