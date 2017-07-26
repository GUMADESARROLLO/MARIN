<?php
class Cliente_model extends CI_Model
{
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function LoadClients(){
        $i=0;
        $json = array();
        $query = $this->sqlsrv->fetchArray("SELECT NOMBRE, RUC, DIRECCION FROM vtVS2_Clientes WHERE CLIENTE NOT IN(".$this->LoadAllClients().")",SQLSRV_FETCH_ASSOC);

        foreach($query as $key){
            $json['query'][$i]['NOMBRE']='<a href="modalPtsCliente" class="modal-trigger"'.$key['NOMBRE'].'</a>';
            $json['query'][$i]['RUC']=$key['RUC'];
            $json['query'][$i]['DIRECCION']=$key['DIRECCION'];
            $i++;
        }
        return $json;
        $this->sqlsrv->close();
    }

    public function LoadAllClients(){
        $query = $this->db->get('vt_ClientesUser');
        return $query->row('CLIENTES');
    }
    
    public function FindClient($cond){
        $consulta = str_replace('%20', ' ', $cond);
        $buscar = $this->sqlsrv->fetchArray("SELECT * from vtVS2_Clientes where NOMBRE ='".$consulta."'",SQLSRV_FETCH_ASSOC);

        $id=$buscar[0]['CLIENTE'];
        $cliente=$buscar[0]['NOMBRE'];
        $this->sqlsrv->close();
    }
}