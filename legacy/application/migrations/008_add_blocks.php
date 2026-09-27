<?php
class Migration_add_blocks extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'block_title' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '255',
                        ),
						'short_code' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '255',
                        ),
                        'content' => array(
                                'type' => 'text',
                              
                        )
                       
                ));
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table('blocks');
        }
        public function down()
        {
                $this->dbforge->drop_table('blocks');
        }
		
}
?>