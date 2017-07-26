<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Exportacion_controller extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->library('MPDF/mpdf');
    }

    public function ExpoClients(){
        $data['Clientes'] = $this->hana_model->LoadClients();// Cargar Clientes
        $this->load->view('Exportar/Excel_Cliente',$data);
    }

    public function ExpoPdf(){
        $query['Clientes'] = $this->hana_model->LoadClients();// Cargar Clientes
        $PdfCliente = new mPDF('utf-8','A4');
        $PdfCliente->SetFooter("Página {PAGENO} de {nb}");//PARA PONER EL NUMERO DE PAGINA EKISDE
        $PdfCliente -> writeHTML($this->load->view('Exportar/Pdf_Cliente',$query,true));
        $PdfCliente->Output();
    }

    public function ExpoPdfPuntosClientes(){
        $data['Clientes'] = $this->hana_model->ClientesPuntos();
        $data['Detalles'] = $this->hana_model->PdfFacturasXcliente();//print_r($data['Detalles']);
        $PdfCliente = new mPDF('utf-8','A4');
        $PdfCliente->SetFooter("Página {PAGENO} de {nb}");//PARA PONER EL NUMERO DE PAGINA EKISDE
        $PdfCliente -> writeHTML($this->load->view('Exportar/Pdf_PuntosClientes',$data,true));
        $PdfCliente->Output();
    }

    public function ExpoExcelPuntosClientes(){
        $data['Clientes'] = $this->hana_model->ClientesPuntos();
        $data['Detalles'] = $this->hana_model->PdfFacturasXcliente();//print_r($data['Detalles']);
        $this->load->view('Exportar/Excel_PuntosClientes',$data);
    }

    public function ExpoFrp($id){
        $data['top'] = $this->frp_model->getFRP($id,'frp');
        $data['DFactura'] = $this->frp_model->getFRP($id,"view_frp_factura");
        $data['DArticulo'] = $this->frp_model->getFRP($id,"view_frp_articulo");

        $this->load->view('Exportar/Pdf_FRP',$data);
    }
    public function ExpEstadoFactura()
    {
        if($_POST['reporte']==0){
            $data = $this->hana_model->ajaxEstadoFacturas($_POST['Codigo'],$_POST['txtFecha1'],$_POST['txtFecha2'],1);
            if ($_POST['tipoReporte']==0) {                
                $this->load->view('Exportar/Excel_EstadoFactura',$data);
            }if ($_POST['tipoReporte']==1){
                $PdfCliente = new mPDF('utf-8','A4');
                $PdfCliente->SetFooter("Página {PAGENO} de {nb}");//PARA PONER EL NUMERO DE PAGINA EKISDE
                $PdfCliente -> writeHTML($this->load->view('Exportar/Pdf_EstadoFactura',$data,true));
                $PdfCliente->Output();
            }else{
                $this->load->view('pages/ImprimirDatos/EstadoFactura_Impresion',$data);
            }
        }if($_POST['reporte']==1){
            $data = $this->hana_model->ajaxDisponibilidadPuntos($_POST['Codigo'],$_POST['txtFecha1'],$_POST['txtFecha2'],1);
            if ($_POST['tipoReporte']==0) {
                $this->load->view('Exportar/Excel_DisponibilidadPuntos',$data);
            }if ($_POST['tipoReporte']==1){
                $PdfCliente = new mPDF('utf-8','A4');
                $PdfCliente->SetFooter("Página {PAGENO} de {nb}");//PARA PONER EL NUMERO DE PAGINA EKISDE
                $PdfCliente -> writeHTML($this->load->view('Exportar/Pdf_DisponibilidadPuntos',$data,true));
                $PdfCliente->Output();
            }else{
                $this->load->view('pages/ImprimirDatos/DisponibilidadPuntos_Impresion',$data);
            }
        }
    }
    public function PdfVoucher($codigo)
    {
        $data["cliente"] = $this->hana_model->puntosCliente($codigo,1);
        $data["aplicado"] = $this->vista_model->getAplicadoP($codigo);

        $PdfCliente = new mPDF('utf-8',array(80,70),0,0,5,4,0);
        $PdfCliente -> writeHTML($this->load->view('Exportar/Pdf_VoucherCliente',$data,true));
        $PdfCliente->Output();
    }
}