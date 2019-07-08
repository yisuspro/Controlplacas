<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Canales extends CI_Controller {
    
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
    
    /**
    * metodo cnstructor donde se cargan todos los helpers, librerias y modelos necesarios en el controlador
    *@library 
    *@model  users()|logueo()
    *@helper login_rules() |url() |form ()
    * 
    */
    function __construct() {
        parent::__construct ();
        
        $this->load->helper(['url','form','login_rules']);
        $this->load->model(['canal','cdas','activity_canal']);
        $this->twig->addGlobal('session', $this->session); 
    }
    
	public function Index()
	{
        $data = $this->cdas->seeAllCda();
        
        $this->twig->display('canal',array('data' => $data));
	}
    
    
    /**
    * funcion para listar los planes de estudio en la data teble.
    *
    * @return json_encode ()
    */
    public function listarCanales(){
        $draw   = intval($this->input->get("draw"));             //trae las varibles draw, start, length para la creacion de la tabla
        $start  = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $data =$this->canal->seeAllCanal();                       //utiliza el metodo listar() del modelo plan() para traer los datos de todos los planes 
        $output = array(                                    //creacion del vector de salida
            "draw" => $draw,                                //envio la variable de dibujo de la tabla                    
            "recordsTotal" =>$data->num_rows(),             //envia el numero de filas  para saber cuantos usuarios son en total
            "recordsFiltered" => $data->num_rows(),         //envio el numero de filas para el calculo de la paginacion de la tabla
            "data" => $data->result_array()                                 //envia todos los datos de la tabla
        );
        echo json_encode($output);                          //envio del vector de salida con los parametros correspondientes
        exit;    
    }
    
    
    /**
    * funcion para listar los planes de estudio en la data teble.
    *
    * @return json_encode ()
    */
    public function agregarCaida(){
        $data= array(
            'CDA_PK'         => $this->input->post('CDA_PK'),
            'ATCN_date_down' => $this->input->post('ATCN_date_down')            
        ); 
        $query = $this->canal->verificarCanal($data['CDA_PK']);
        echo json_encode( $query);
        if($query < 1 ){
            $this->canal->addActivityDownCanal($data['CDA_PK']);
            $this->activity_canal->addActivityCanalDown($data['CDA_PK'],$data['ATCN_date_down']);
            echo json_encode ('win');
        }else{
            echo json_encode ('error');
        }
    }
    /**
    * funcion para listar los planes de estudio en la data teble.
    *
    * @return json_encode ()
    */
    public function editarCanal($id){
        $query = $this->activity_canal->bringActivityCanal($id);
        $this->twig->display('views_ajax/editCanal',array('inf' => $query));
    }
    /**
    * funcion para listar los planes de estudio en la data teble.
    *
    * @return json_encode ()
    */
    public function modificarCanal(){
        $id = $this->input->post('ATCN_FK_canal');
       $data= array(
            'ATCN_FK_canal'     => $this->input->post('ATCN_FK_canal'),
            'ATCN_date_down'    => $this->input->post('ATCN_date_down'),            
            'ATCN_date_up'      => $this->input->post('ATCN_date_up'),            
            'ATCN_PK'           => $this->input->post('ATCN_PK'),  
            'ATCN_descripcion'  => $this->input->post('ATCN_descripcion'),  
            'ATCN_id_problem'   => $this->input->post('ATCN_id_problem'),  
        );
        $accion1 = $this->canal->addActivityUpCanal($id);
        $accion2 = $this->activity_canal->addActivityCanalUp($data);
        
    }
    /**
    * funcion para listar los planes de estudio en la data teble.
    *
    * @return json_encode ()
    */
    public function verActividadCanal($id){
        $data=array('id' => $id );
        $this->twig->display('views_ajax/canalHistorialAjax',array ('id' => $id));
        
    }
    /**
    * funcion para listar los planes de estudio en la data teble.
    *
    * @return json_encode ()
    */
    public function listarActividadCanal($id){
        $draw   = intval($this->input->get("draw"));             //trae las varibles draw, start, length para la creacion de la tabla
        $start  = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));               
        $data   = $this->activity_canal->bringActivityCanalFull($id);
        $output = array(                                    //creacion del vector de salida
            "draw" => $draw,                                //envio la variable de dibujo de la tabla                    
            "recordsTotal" =>$data->num_rows(),             //envia el numero de filas  para saber cuantos usuarios son en total
            "recordsFiltered" => $data->num_rows(),         //envio el numero de filas para el calculo de la paginacion de la tabla
            "data" => $data->result_array()                                 //envia todos los datos de la tabla
        );
        echo json_encode($output);                          //envio del vector de salida con los parametros correspondientes
        exit; 
    }
    /**
    * funcion para listar los planes de estudio en la data teble.
    *
    * @return json_encode ()
    */
    public function reporteFechas($date1,$date2){
        
        $data = $this->activity_canal->reportDate($date1,$date2);
        $data = $data->result();
        foreach($data as $datos){
            $output[] = array(
                "ATCN_FK_canal"         => $datos->ATCN_FK_canal,
                "minutosNoTrabajados"   => $datos->minutosNoTrabajados,
                "minutosIdeales"        => $datos->minutosIdeales,
                "porcentaje"            => $datos->minutosNoTrabajados / $datos->minutosIdeales * 100 ,
                  
           );
        }
        //echo json_encode($output);
        $this->twig->display('reporteCanal',array ('data' => $output, 'date1' => $date1, 'date2' => $date2));
    }
    /**
    * funcion para listar los planes de estudio en la data teble.
    *
    * @return json_encode ()
    */
    public function reporteTablaFechas($date1,$date2){
        
        $draw   = intval($this->input->get("draw"));             //trae las varibles draw, start, length para la creacion de la tabla
        $start  = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));               
        $data   = $this->activity_canal->reportDate($date1,$date2);
        foreach($data->result() as $datos){
            $output1[] = array(
                "ATCN_FK_canal"         => $datos->ATCN_FK_canal,
                "minutosNoTrabajados"   => $datos->minutosNoTrabajados,
                "minutosIdeales"        => $datos->minutosIdeales,
                "porcentaje"            => $datos->minutosNoTrabajados / $datos->minutosIdeales * 100 ,
                  
           );
        }
        $output = array(                                    //creacion del vector de salida
            "draw" => $draw,                                //envio la variable de dibujo de la tabla                    
            "recordsTotal" =>$data->num_rows(),             //envia el numero de filas  para saber cuantos usuarios son en total
            "recordsFiltered" => $data->num_rows(),         //envio el numero de filas para el calculo de la paginacion de la tabla
            "data" =>  $output1                                //envia todos los datos de la tabla
        );
        echo json_encode($output);                          //envio del vector de salida con los parametros correspondientes
        exit; 
    }
  
    
}
