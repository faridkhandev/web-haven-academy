<?php
class Migration_add_admin_members extends CI_Migration {
		private $table_name			= 'admin_members';
        public function up()
        {
                $this->dbforge->add_field(array(
                        'id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'first_name' => array(
                                'type' => 'VARCHAR',
                                'constraint' => 100,
                        ),
						'last_name' => array(
                                'type' => 'VARCHAR',
                                'constraint' => 100,
                        ),
						'email_address' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                        ),
						'user_name' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                        ),
                        'pass_word' => array(
                                'type' => 'VARCHAR',
                                'constraint'=>'100'
                        ),
						'photo' => array(
                                'type' => 'VARCHAR',
                                'constraint'=>'255'
                        ),
						'created_on' => array(
                                'type' => 'VARCHAR',
                                'constraint'=>'255'
                        ),
						'last_login' => array(
                                'type' => 'VARCHAR',
                                'constraint'=>'255'
                        ),
						
						'last_login' => array(
                                'type' => 'VARCHAR',
                                'constraint'=>'255'
                        ),
						
						'ip_address' => array(
                                'type' => 'VARCHAR',
                                'constraint'=>'255'
                        ),
						'status' => array(
                                'type' => 'INT',
                                'constraint'=>'2'
                        ),
                ));
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table($this->table_name);
        
				/*Insert data*/
				 // default data
			    $data = array(
				'first_name'	=> 'Nasiruddin',
				'last_name' 	=> 'Khan',	
				'user_name'		=>'admin@abn',
				'pass_word'		=> md5('abn@mitas'),
				'email_address'	=>'abnwebtech@gmail.com',
				'created_on'	=> date('Y-m-d H:i:s'),
				'last_login'	=>'1268889823',
				'status'		=>'1',
				'ip_address'	=> inet_pton('127.0.0.1'),
			);
			$this->db->insert($this->table_name, $data);
		}

        public function down()
        {
                $this->dbforge->drop_table($this->table_name);
        }
}
?>