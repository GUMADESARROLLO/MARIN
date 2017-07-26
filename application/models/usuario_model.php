<?php
class Usuario_model extends CI_Model
{
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    /* VISTA USUARIO*/
    public function LoadUser(){ /*CARGAR USUARIOS*/
        $this->db->select('*');
        $this->db->from('TblUsuario');
        $this->db->order_by('IdUsuario','desc');
        $query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->result_array();
        } else {
            return 0;
        }
    }
    public function LoadRol() {/*CARGAR ROLES*/
        $this->db->select('*');
        $this->db->from('CatRol');
        $query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->result_array();
        } else {
            return 0;
        }
    }

    public function LoadVendedor() {/*CARGAR VENDEDOR*/
        $query= $this->OPen_database_odbcSAp();
    }
    
    public function LoadClient(){ /* CARGAR CLIENTES */
        $this->load->model('cliente_model');

        $query = $this->sqlsrv -> fetchArray("SELECT CLIENTE, NOMBRE, VENDEDOR FROM vtVS2_Clientes WHERE CLIENTE NOT IN(".$this->cliente_model->LoadAllClients().") AND(ACTIVO = 'S') AND (RUBRO1_CLI = 'S')",SQLSRV_FETCH_ASSOC);

        $json = array();
        $i=0;
        echo '<option value="" disabled selected> BUSCAR... </option>';
        foreach ($query as $key){
            echo '<option value="'.$key['NOMBRE'].'">'.$key['NOMBRE'].'</option>';
            $i++;
        }
        $this->sqlsrv->close();
    }

    public function LoadVendedores(){ /* CARGAR CLIENTES */
        $query = $this->sqlsrv -> fetchArray("SELECT VENDEDOR, NOMBRE FROM Softland.umk.VENDEDOR WHERE  (VENDEDOR LIKE 'F%')",SQLSRV_FETCH_ASSOC);
        $json= array();
        $i=0;
        echo '<option value="" disabled selected> BUSCAR... </option>';
        
        foreach ($query as $key){
            echo '<option value="'.$key['NOMBRE'].'">'.$key['NOMBRE'].'</option>';
            $i++;
        }
        $this->sqlsrv->close();
    }

    public function BuscarCl($user, $nombre, $clave, $rol, $vendedor, $idVendedor){
        $user = array(
            'Usuario'=> $user,
            'Clave' => $clave,
            'Rol' => $rol,
            'Estado'=>0,
            'FechaCreacion' => $fecha,
            'IdCL' =>$id,
            'Cliente' => $cliente,
            'Zona' => $zona,
            'Nombre' => $consulta
        );

        $query = $this->db->insert('usuario', $user);
        if ($query) {
            return 1;
        } else {
            return 0;
        }
    }

    public function addUser($user,$nombre,$clave,$rol,$vendedor,$idVendedor){
        $nombre = str_replace('%20', ' ', $nombre);
        $vendedor = str_replace('%20', ' ', $vendedor);
        $user = str_replace('%20', ' ', $user);
        $fecha = date('Y-m-d H:i:s');
        $data = array(
            'Usuario'=> $user,
            'Nombre' => $nombre,
            'Clave' => $clave,
            'IdRol' => $rol,
            'FechaCreacion' => $fecha,
            'Estado'=>1,
            'Zona' => $idVendedor,
            'NombreVendedor' =>$vendedor
        );
        $query = $this->db->insert('tblusuario', $data);
    }

    public function guardarVdor($user, $nombre, $clave, $rol, $vendedor, $idVendedor) {/*CREACIÓN DE USUARIOS*/
        $nombre = str_replace('%20', ' ', $nombre);
        $vendedor = str_replace('%20', ' ', $vendedor);
        $user = str_replace('%20', ' ', $user); $fecha = date('Y-m-d H:i:s');
        
        $data = array(
            'Usuario'=> $user,
            'Nombre' => $nombre,
            'Clave' => $clave,
            'IdRol' => $rol,
            'FechaCreacion' => $fecha,
            'Estado'=>1,
            'IdVendedor' => $idVendedor,
            'NombreVendedor' =>$vendedor
        );
        $query = $this->db->insert('tblusuario', $data);
    }

    public function ActUser($cod,$estado){ /* CAMBIAR ESTADO DEL USUARIO*/
        $data = array(
            'Estado' => !$estado,
            'FechaBaja' =>date('Y-m-d H:i:s')
        );

        $this->db->where('IdUsuario', $cod);
        $this->db->update('TblUsuario',$data);
    }
}