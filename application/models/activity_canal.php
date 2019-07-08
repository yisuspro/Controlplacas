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
class Activity_canal extends CI_Model {
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
    public function addActivityCanalDown($id,$fecha){
        $data= array(
            'ATCN_date_down' => $fecha,
            'ATCN_date_up'   => '00/00/0000 00:00',
            'ATCN_FK_canal'  => $id
        );
        if($this->db->insert('tbl_activity_canal',$data)){
            return true;
        }
        else{
            return false;
        }   
    }
    /**
    * funcion para la verificacion y envio de los datos del usuario solicitado.
    * @param int $doc
    * @return row() | false
    */
    public function addActivityCanalUp($data){
       
        if($query = $this->db->where('ATCN_PK',$data['ATCN_PK'])){
            $query = $this->db->update('tbl_activity_canal',$data);
            return true;
        }
        else{
            return false;
        }   
    }
    /**
    * funcion para la verificacion y envio de los datos del usuario solicitado.
    * @param int $doc
    * @return row() | false
    */
    public function bringActivityCanal($id){
        $cda= $id;
        $fechaUp = '00/00/0000 00:00:00';
        if( $query=$this->db->select('*')->from('tbl_activity_canal')->where('ATCN_FK_canal',$cda)->get()){
            $query=$this->db->select('*')->from('tbl_activity_canal')->where('ATCN_FK_canal', $cda)->where('ATCN_date_up',$fechaUp)->get();
            return $query->result();
        }
        else{
            return false;
        }   
    }
    
    /**
    * funcion para la verificacion y envio de los datos del usuario solicitado.
    * @param int $doc
    * @return row() | false
    */
    public function bringActivityCanalFull($id){
        $cda= $id;
        if( $query=$this->db->select('*')->from('tbl_activity_canal')->where('ATCN_FK_canal',$cda)->get()){
            return $query;
        }
        else{
            return false;
        }   
    }
    /**
    * funcion para la verificacion y envio de los datos del usuario solicitado.
    * @param int $doc
    * @return row() | false
    */
    public function reportDate($date1,$date2){
        $sql= "SELECT ATCN_FK_canal,if(ATCN_date_up = '0000-00-00',SUM(TIMESTAMPDIFF (minute,ATCN_date_down ,'".$date2."')),SUM(TIMESTAMPDIFF (minute,ATCN_date_down ,ATCN_date_up))) as minutosNoTrabajados,TIMESTAMPDIFF (minute,'".$date1."' ,'".$date2."') as minutosIdeales FROM tbl_activity_canal WHERE (ATCN_id_problem = 2) AND ((ATCN_date_down BETWEEN '".$date1."' AND '".$date2."') OR (ATCN_date_up BETWEEN '".$date1."' AND '".$date2."')) GROUP BY ATCN_FK_canal";
        if( $query=$this->db->query($sql)){
            return $query;
        }
        else{
            return false;
        }   
    }
}