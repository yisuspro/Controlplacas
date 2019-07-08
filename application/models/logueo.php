<?php
/**
*
*@autor jesus andres castellanos aguilar
*
* modelor encargado de todos los procesos referente a el inicio de sesion de usuarios
* 
* contiene todas las consultas sql a la base de datos
* 
*/
class logueo extends CI_Model {
    /**
    * metodo constructor donde se cargan todos los helpers, librerias necesarios en el modelo
    *@library 
    *
    *@helper 
    * 
    */
    public function __construct(){
        
    }
    
    /**
    * funcion para la verificacion y envio de los datos dell usuario logueado.
    *
    * @return row() | false
    */
    public function login($email,$password){
        $rep=$this->db->select('*')
            ->join('tbl_stats','tbl_users.USER_FK_stats = tbl_stats.STTS_PK')
            ->get_where('tbl_users',array('USER_users' => $email,'USER_password'=> $password), 1);
        if (!$rep->result()){
            return FALSE;
        }
        $consulta =$rep;
        return $consulta->row();
    }
}