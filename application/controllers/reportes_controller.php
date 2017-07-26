<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes_controller extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->library('session');

        if($this->session->userdata('logged')==0){ //No aceptar a usuarios sin loguearse
            redirect(base_url().'index.php/login','refresh');
        }
    }
    
    public function ajaxEstadoFacturas($IdCliente,$f1,$f2)
    {
    	$this->hana_model->ajaxEstadoFacturas($IdCliente,$f1,$f2);
    }
    public function ajaxDisponibilidadPuntos($IdCliente,$f1,$f2)
    {
    	$this->hana_model->ajaxDisponibilidadPuntos($IdCliente,$f1,$f2);
    }
    public function ajaxDireccionTelefono($IdCliente)
    {
        $this->hana_model->ajaxDireccionTelefono($IdCliente);
    }
}