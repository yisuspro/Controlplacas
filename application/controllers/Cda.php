<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cda extends CI_Controller {
    
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
        $this->load->model('canal');
        $this->twig->addGlobal('session', $this->session); 
    }
    
	public function Index()
	{
       		$this->twig->display('cda');
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
    
    
    
    
    
}
