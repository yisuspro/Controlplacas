<?php
/**
*
*@autor jesus andres castellanos aguilar
*
*archivo de migracion encargado de la cracion y eliminacion de la tabla users_projects en la base de datos
* 
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class Migration_create_tbl_activity_canal extends CI_Migration {

    /**
    * funcion para crreacion de la tabla users_projects
    *
    * @return create_table()
    */
    public function up(){
         $this->dbforge->add_field(array(                    //creacion del vector que contiene los campos de la tabla
            'ATCN_PK' => array(                             //columna USPR_PK tipo int, tamaño 10, auto icremental, solo positivos
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ),
             'ATCN_date_down' => array(                       //columna USPR_FK_users tipo int, tamaño 10, solo positivos
                'type' => 'DATETIME',
            ),
             'ATCN_date_up' => array(                       //columna USPR_FK_users tipo int, tamaño 10, solo positivos
                'type' => 'DATETIME',
            ),
             'ATCN_FK_canal' => array(                             //columna USPR_PK tipo int, tamaño 10, auto icremental, solo positivos
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
            )
             'ATCN_descripcion' => array(                             //columna USPR_PK tipo int, tamaño 10, auto icremental, solo positivos
                'type' => 'VARCHAR',
                'constraint' => 50,
            )
             '	ATCN_id_problem' => array(                             //columna USPR_PK tipo int, tamaño 10, auto icremental, solo positivos
                'type' => 'INT',
                'constraint' => 10,
            )
             
        ));
        
        $this->dbforge->add_key('ATCN_PK', TRUE);                //agregar atributo de llave primaria al campo USPR_PK
        $this->dbforge->create_table('tbl_activity_canal');     //creacion de la tabla users con los atributos y columnas
        
        $this->dbforge->add_column('tbl_activity_canal',[
            'CONSTRAINT ATCN_FK_canal FOREIGN KEY(ATCN_FK_canal) REFERENCES tbl_canal(CANL_PK)',
        ]);
                                      
    }
    
    /**
    * funcion para eliminacion de la tabla users_projects
    *
    * @return drop_table()
    */
    public function down(){
        $this->dbforge->drop_table('tbl_activity_canal');       //eliminacion de la tabla users_projects
    }
}