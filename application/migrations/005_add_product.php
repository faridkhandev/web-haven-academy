<?php
class Migration_add_product extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'title' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                        ),
					   'cat_id' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                        ),
                        'content' => array(
                                'type' => 'text',
                                
                        ),
						'code' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                                
                        ),
						'price' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '255',
                                
                        ),
                        'status' => array(
                                 'type' => 'INT',
                                 'constraint' =>3,
                        ),
						'image' => array(
                                'type' => 'VARCHAR',
                                'constraint'=>'255'
                        ),
					    'display_order' => array(
                                 'type' => 'INT',
                                 'constraint' => 11,
                        )
                ));
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table('products');
        }
        public function down()
        {
                $this->dbforge->drop_table('products');
        }
		
}
?>