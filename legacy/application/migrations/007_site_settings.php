<?php
class Migration_site_settings extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'meta_key' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                        ),
                        'meta_value' => array(
                                'type' => 'text',
                        )
                       
                ));
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table('site_settings');
        }
        public function down()
        {
                $this->dbforge->drop_table('site_settings');
        }
		
}
?>