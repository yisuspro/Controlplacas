<?php
/**
*
*@autor jesus andres castellanos aguilar
*
*archivo de migracion encargado de la cracion y eliminacion de la tabla users_projects en la base de datos
* 
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class Migration_create_tbl_cont extends CI_Migration {

    /**
    * funcion para crreacion de la tabla users_projects
    *
    * @return create_table()
    */
    public function up(){
         $this->dbforge->add_field(array(                    //creacion del vector que contiene los campos de la tabla
            'CNTG_PK' => array(                             //columna USPR_PK tipo int, tamaño 10, auto icremental, solo positivos
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
            ),
            'CNTG_ip_public' => array(                       //columna USPR_FK_users tipo int, tamaño 10, solo positivos
                'type' => 'VARCHAR',
                'constraint' => '45',
            ),
             'CNTG_FK_users' => array(                             //columna USPR_PK tipo int, tamaño 10, auto icremental, solo positivos
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
            ),
             'CNTG_FK_fail' => array(                             //columna USPR_PK tipo int, tamaño 10, auto icremental, solo positivos
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
            ),
             'CNTG_FK_cda' => array(                             //columna USPR_PK tipo int, tamaño 10, auto icremental, solo positivos
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
            ),
             'CNTG_delete' => array(                             //columna USPR_PK tipo int, tamaño 10, auto icremental, solo positivos
                'type' => 'INT',
                'constraint' => 10
            )
        ));
        
        $this->dbforge->add_key('CNTG_PK', TRUE);            //agregar atributo de llave primaria al campo USPR_PK
        $this->dbforge->create_table('tbl_cont');     //creacion de la tabla users con los atributos y columnas
        
        $this->dbforge->add_column('tbl_cont',[
            'CONSTRAINT CNTG_FK_users FOREIGN KEY(CNTG_FK_users) REFERENCES tbl_users(USER_PK)',
        ]);
        $this->dbforge->add_column('tbl_cont',[
            'CONSTRAINT CNTG_FK_fail FOREIGN KEY(CNTG_FK_fail) REFERENCES tbl_fail(FAIL_PK)',
        ]);  
        $this->dbforge->add_column('tbl_cont',[
            'CONSTRAINT CNTG_FK_cda FOREIGN KEY(CNTG_FK_cda) REFERENCES tbl_cda(CDA_PK)',
        ]);
    }
    
    /**
    * funcion para eliminacion de la tabla users_projects
    *
    * @return drop_table()
    */
    public function down(){
        $this->dbforge->drop_table('tbl_cont');       //eliminacion de la tabla users_projects
    }
}   