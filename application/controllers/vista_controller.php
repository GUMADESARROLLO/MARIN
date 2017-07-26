<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vista_controller extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->library('session');

        if($this->session->userdata('logged')==0){ //No aceptar a usuarios sin loguearse
            redirect(base_url().'index.php/login','refresh');
        }
    }

    public function MYHeaders(){
        $this->load->view('header/header');
        $this->load->view('pages/menu');
    }

    public function MYFooters(){
        $this->load->view('footer/footer');
    }

    public function main(){
        $this->MYHeaders();
        $data['catalogo'] = $this->catalogo_model->traerCatalogoImg();
        $this->load->view('pages/main',$data);
        $this->MYFooters();
    }

    public function Facturas(){
        $this->MYHeaders();
        $data['Facturas'] = $this->hana_model->Factuas();
        $this->load->view('pages/Facturas',$data);
        $this->MYFooters();
    }




    public function getDetalleFactura($Factura){
        $this->hana_model->DFacturas($Factura);
    }
    

    public  function BajaClientes(){
        $this->MYHeaders();
        $this->load->view('pages/BajaClientes');
        $this->MYFooters();
    }
    
    public function DetalleFact(){
        $this->MYHeaders();
        $this->load->view('pages/DetalleFact');
        $this->MYFooters();
    }



    public function CanjeFre(){
        $this->MYHeaders();
        $this->load->view('pages/CanjeEfec');
        $this->MYFooters();
    }

    public function getPuntosArticulosCatalogo(){
        $data['PtsItem'] = $this->catalogo_model->getPtsItem($this->input->post('codigo'));
    }

    public function Catalogo(){
        $this->MYHeaders();
        $this->load->view('pages/Catalogo');
        $this->MYFooters();
    }

    public function Reportes(){
        $this->MYHeaders();
        $data['Clientes'] = $this->hana_model->LoadClients();// Cargar Clientes
        $this->load->view('pages/Reportes',$data);
        $this->MYFooters();
    }
}