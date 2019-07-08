<?php
/**
*
*@autor jesus andres castellanos aguilar
*
* modelor encargado de todos los procesos referente a los usuarios
* 
* contiene todas las consultas sql a la base de datos
* 
*/
class Users extends CI_Model {
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
    * funcion para la verificacion y envio de los datos del usuario solicitado.
    * @param int $doc
    * @return row() | false
    */
    public function verificarUsuario($doc){
        $this->db->where('USER_PK',$doc);
        $query=$this->db->get('users');
        
        if( $query->num_rows()==1) return $query->row();
        else   return false;
    }
    
}