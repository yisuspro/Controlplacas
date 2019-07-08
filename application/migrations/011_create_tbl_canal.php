<?php
/**
*
*@autor jesus andres castellanos aguilar
*
*archivo de migracion encargado de la cracion y eliminacion de la tabla users_projects en la base de datos
* 
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class Migration_create_tbl_canal extends CI_Migration {

    /**
    * funcion para crreacion de la tabla users_projects
    *
    * @return create_table()
    */
    public function up(){
         $this->dbforge->add_field(array(                    //creacion del vector que contiene los campos de la tabla
            'CANL_PK' => array(                             //columna USPR_PK tipo int, tamaño 10, auto icremental, solo positivos
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
            ),
            'CANL_canal' => array(                       //columna USPR_FK_users tipo int, tamaño 10, solo positivos
                'type' => 'VARCHAR',
                'constraint' => '45',
            ),
             'CANL_FK_cda' => array(                             //columna USPR_PK tipo int, tamaño 10, auto icremental, solo positivos
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
            ),
             'CANL_FK_state_canal' => array(                             //columna USPR_PK tipo int, tamaño 10, auto icremental, solo positivos
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
            ),
             
             'CANL_delete' => array(                             //columna USPR_PK tipo int, tamaño 10, auto icremental, solo positivos
                'type' => 'INT',
                'constraint' => 10
            )
        ));
        
        $this->dbforge->add_key('CANL_PK', TRUE);      //agregar atributo de llave primaria al campo USPR_PK
        $this->dbforge->create_table('tbl_canal');     //creacion de la tabla users con los atributos y columnas
        
        $this->dbforge->add_column('tbl_canal',[
            'CONSTRAINT CANL_FK_state_canal FOREIGN KEY(CANL_FK_state_canal) REFERENCES tbl_state_canal(STCN_PK)',
        ]);
        $this->dbforge->add_column('tbl_canal',[
            'CONSTRAINT CANL_FK_cda FOREIGN KEY(CANL_FK_cda) REFERENCES tbl_cda(CDA_PK)',
        ]);                               
    }
    
    /**
    * funcion para eliminacion de la tabla users_projects
    *
    * @return drop_table()
    */
    public function down(){
        $this->dbforge->drop_table('tbl_canal');       //eliminacion de la tabla users_projects
    }
}