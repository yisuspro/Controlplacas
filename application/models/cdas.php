<?php
/**
*
*@autor jesus andres castellanos aguilar
*
* modelor encargado de todos los procesos referente a los canales
* 
* contiene todas las consultas sql a la base de datos
* 
*/
class cdas extends CI_Model {
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
    * @param 
    * @return row() | false
    */
    public function seeAllCda(){
        
        $query=$this->db->select('*')->from('tbl_cda')->get();
        return $query->result_object();
    }
    
    
}