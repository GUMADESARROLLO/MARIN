<?php
/**
 * Created by PhpStorm.
 * User: marangelo.php
 * Date: 18/10/2016
 * Time: 10:18
 */
class Frp_model extends CI_Model{
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function getAllFRP(){
        $query = $this->db->get('frp');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return 0;
    }

    public function getFRP($id,$tabla){
        $this->db->where('IdFRP', $id);
        $query = $this->db->get($tabla);
        
        if($query->num_rows() > 0){
            return $query->result_array();
        }
        return 0;
    }

    public function inactivar($id){
        //Retornamos los Puntos a la Factura
        $this->FRPInac($id);

        $this->db->where('IdFRP',$id);
        return $this->db->update('frp',array('Anulado' => 'S'));
    }
    
    public function FRPInac($FRP){
        $this->db->where('IdFRP',$FRP);
        $query = $this->db->get('detalleFRP');
        
        foreach ($query->result_array() as $row){
            $this->db->query("call pc_MFactura ('".$row['Factura']."','".$row['Puntos']."','".date('Y-m-d h:i:s')."')");
        }     
    }


    public function save($top,$art,$fact,$log){
        $top = array(
            'IdFRP'     => $top[0],
            'Fecha'     => date_format(date_create($top[1]), 'Y-m-d H:i:s'),
            'IdCliente' => $top[2],
            'Nombre'    => $top[3],
            'IdUsuario' => $_SESSION['id'],
            'Anulado'   => "N"
        );

        $q = $this->db->insert('frp', $top);

        for ($f=0; $f < count($fact); $f++) {
            $Facturas = explode(",",$fact[$f]);
            $InsertArticulos = array(
                'IdFRP'         => $Facturas[0],
                'Factura'       => $Facturas[1],
                'Faplicado'     => $Facturas[2],
                'IdArticulo'    => $Facturas[3],
                'Descripcion'   => $Facturas[4],
                'Puntos'        => $Facturas[5],
                'Cantidad'      => $Facturas[6],
                'Fecha'         => $Facturas[7]
            );
            $q = $this->db->insert('detallefrp', $InsertArticulos);
        }

        for ($l=0; $l < count($log); $l++) {
            $Faclog = explode(",",trim($log[$l]));
            $this->db->query("call pc_RFactura ('".$Faclog[1]."','".$Faclog[2]."','".$Faclog[0]."','".date('Y-m-d h:i:s')."','".$Faclog[3]."')");
        }

        if ($q) { return 1;
        } else { return 0;
        }
    }
}