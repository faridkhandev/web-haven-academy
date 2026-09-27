<?php
class Migration_add_banner extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE,
                        ),
                        'title' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                        ),

                        'caption' => array(
                                'type' => 'VARCHAR',
                                'constraint'=>'255'
                        ),
                        
                        'banner_img' => array(
                                'type' => 'VARCHAR',
                                'constraint'=>'255'
                        ),
                        'target_url' => array(
                                'type' => 'VARCHAR',
                                'constraint'=>'255',
                               
                        ),
                        'status' => array(
                                 'type' => 'INT',
                                 'constraint' =>3,
                        ),
					    'display_order' => array(
                                 'type' => 'INT',
                                 'constraint' => 11,
                        ),
                ));
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table('banners');
        }

        public function down()
        {
                $this->dbforge->drop_table('banners');
        }
}
?>