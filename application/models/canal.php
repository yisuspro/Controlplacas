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
class canal extends CI_Model {
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
    public function seeAllCanal(){
        $query=$this->db->select('*')->from('tbl_canal')->join('tbl_state_canal','tbl_canal.CANL_FK_state_canal = tbl_state_canal.STCN_PK')->join('tbl_cda','tbl_canal.CANL_FK_cda = tbl_cda.CDA_PK')->order_by('CANL_FK_state_canal', 'ASC')->get();
        return $query;
    }
    /**
    * funcion para la verificacion y envio de los datos del usuario solicitado.
    * @param 
    * @return row() | false
    */
    public function verificarCanal($id){
        $query=$this->db->select('*')->from('tbl_canal')->where('CANL_FK_state_canal = 1')->where('CANL_PK',$id)->count_all_results();
        return $query;
    }
    
    /**
    * funcion para la verificacion y envio de los datos del usuario solicitado.
    * @param 
    * @return row() | false
    */
    public function addActivityDownCanal($id){
        $data= array(
            'CANL_FK_state_canal' => 1
        );
        $query=$this->db->where('CANL_FK_cda',$id);
        if($query=$this->db->update( 'tbl_canal', $data )){
            return true;
            exit;
        }else{
            return false;
            exit;
        }
    }
    
    /**
    * funcion para la verificacion y envio de los datos del usuario solicitado.
    * @param 
    * @return row() | false
    */
    public function addActivityUpCanal($id){
        $data= array(
            'CANL_FK_state_canal' =>2
        );
        
        if($query=$this->db->where('CANL_FK_cda',$id)){
            $query=$this->db->update( 'tbl_canal', $data);
            return "cambio exitoso";
        }else{
            return false;
           
        }
    }
    
}