<?php
/**
*
*@autor jesus andres castellanos aguilar
*
*archivo de migracion encargado de la cracion y eliminacion de la tabla users_projects en la base de datos
* 
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class Migration_create_tbl_role extends CI_Migration {

    /**
    * funcion para crreacion de la tabla users_projects
    *
    * @return create_table()
    */
    public function up(){
         $this->dbforge->add_field(array(                    //creacion del vector que contiene los campos de la tabla
            'ROLE_PK' => array(                             //columna USPR_PK tipo int, tamaño 10, auto icremental, solo positivos
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
            ),
            'ROLE_role' => array(                       //columna USPR_FK_users tipo int, tamaño 10, solo positivos
                'type' => 'VARCHAR',
                'constraint' => '45',
            ),
             
        ));
        
        $this->dbforge->add_key('ROLE_PK', TRUE);            //agregar atributo de llave primaria al campo USPR_PK
        $this->dbforge->create_table('tbl_role');     //creacion de la tabla users con los atributos y columnas
      }
    
    /**
    * funcion para eliminacion de la tabla users_projects
    *
    * @return drop_table()
    */
    public function down(){
        $this->dbforge->drop_table('tbl_role');       //eliminacion de la tabla users_projects
    }
}   