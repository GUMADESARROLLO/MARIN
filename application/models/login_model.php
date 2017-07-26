<?php 
class Login_model extends CI_Model
{
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    
    public function index(){
        $this->load->view('header/header_login');
        $this->load->view('paginas/login');
        $this->load->view('footer/footer_login');
    }

    public function login($name, $pass ){
        if($name != FALSE && $pass != FALSE){
            $this->db->where('Usuario', $name);
            $this->db->where('Clave',md5($pass));
            $this->db->where('Estado',1);

            $query = $this->db->get('TblUsuario');
            if($query->num_rows() == 1){
                return $query->result_array();
            }
            return 0;
        }
    }

}