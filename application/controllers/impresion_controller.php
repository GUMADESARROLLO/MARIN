<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Impresion_controller extends CI_Controller
{
    public function __construct(){
        parent::__construct();
    }

    public function DetalleFRP() {
        $this->load->view('header/header');
        $this->load->view('pages/ImprimirDatos/FRP_Impresion');
        $this->load->view('footer/footer');
    }

    public function DetalleFRE() {
        $this->load->view('header/header');
        $this->load->view('pages/ImprimirDatos/FRE_Impresion');
        $this->load->view('footer/footer');
    }
}