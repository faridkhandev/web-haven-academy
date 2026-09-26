
<?php
class Migration_add_category extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'parent_id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                        ),
						'title' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                        ),
                        'image' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '255',
                        ),
                        'desc' => array(
                                'type' => 'VARCHAR',
                                'constraint'=>'255'
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
                $this->dbforge->create_table('categories');
        }

        public function down()
        {
                $this->dbforge->drop_table('categories');
        }
}
?>