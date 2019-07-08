<?php
/**
*
*@autor jesus andres castellanos aguilar
*
*archivo de migracion encargado de la cracion y eliminacion de la tabla users_projects en la base de datos
* 
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class Migration_create_tbl_blocking extends CI_Migration {

    /**
    * funcion para crreacion de la tabla users_projects
    *
    * @return create_table()
    */
    public function up(){
         $this->dbforge->add_field(array(                    //creacion del vector que contiene los campos de la tabla
            'BLCK_PK' => array(                             //columna USPR_PK tipo int, tamaño 10, auto icremental, solo positivos
               'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'BLCK_placa' => array(                       //columna USPR_FK_users tipo int, tamaño 10, solo positivos
                'type' => 'VARCHAR',
                'constraint' => '45',
            ),
             'BLCK_FK_type_block' => array(                       //columna USPR_FK_users tipo int, tamaño 10, solo positivos
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
            ),
             'BLCK_FK_users' => array(                       //columna USPR_FK_users tipo int, tamaño 10, solo positivos
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
            ),
             'BLCK_time' => array(                       //columna USPR_FK_users tipo int, tamaño 10, solo positivos
                'type' => 'date',
            ),
             'BLCK_delete' => array(                             //columna USPR_PK tipo int, tamaño 10, auto icremental, solo positivos
                'type' => 'INT',
                'constraint' => 10
            )
        ));
        
        $this->dbforge->add_key('BLCK_PK', TRUE);      //agregar atributo de llave primaria al campo USPR_PK
        $this->dbforge->create_table('tbl_blocking');     //creacion de la tabla users con los atributos y columnas
        
        $this->dbforge->add_column('tbl_blocking',[
            'CONSTRAINT BLCK_FK_type_block FOREIGN KEY(BLCK_FK_type_block) REFERENCES tbl_type_block(TPBL_PK)',
        ]);  
        
        $this->dbforge->add_column('tbl_blocking',[
            'CONSTRAINT BLCK_FK_users FOREIGN KEY(BLCK_FK_users) REFERENCES tbl_users(USER_PK)',
        ]); 
        

    }
    
    /**
    * funcion para eliminacion de la tabla users_projects
    *
    * @return drop_table()
    */
    public function down(){
        $this->dbforge->drop_table('tbl_blocking');       //eliminacion de la tabla users_projects
    }
}