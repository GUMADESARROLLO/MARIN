<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_controller extends CI_Controller
{
    public function __construct(){
        parent::__construct();
    }

    public function Usuarios() {// CARGAR USUARIOS
        $query['Luser'] = $this->usuario_model->LoadUser();
        $query['Lrol'] = $this->usuario_model->LoadRol();
        $query['Lven'] = $this->hana_model->vendedores();
        
        $this->load->view('header/header');
        $this->load->view('pages/menu');
        $this->load->view('pages/Users',$query);
        $this->load->view('footer/footer');
    }
    
    // AGREGAR USUARIO
    public function addUser($user, $nombre, $clave, $rol, $vendedor, $idVendedor){
        if ($rol == 'Vendedor') {
            echo "entro a usuario";
            $this->usuario_model->addUser($user, $nombre, md5($clave), $rol,  $vendedor, $idVendedor);
        } else {
            echo "entro al vendedor";
            $this->usuario_model->guardarVdor($user, $nombre, md5($clave), $rol, $vendedor, $idVendedor);
        }
    }

    public function ActUser($IdUser, $Estado){/*CAMBIAR ESTADO DE USUARIO*/
        $this->usuario_model->ActUser($IdUser, $Estado);
    }

    public function LoadClient(){//Cargar los clientes
        $this->usuario_model->LoadClient();
    }

    public function LoadVendedor(){//cargar los vendedores
        $this->usuario_model->LoadVendedores();
    }
}