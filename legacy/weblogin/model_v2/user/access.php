<?php
class ModelUserAccess extends Model {
	
	public function getControllerTaskByControllerId($controllerId) {
		$sql = "SELECT * FROM " . DB_PREFIX . "controller_to_task WHERE controller_id = $controllerId";
		$query = $this->db->query($sql);
		return $query->rows;
	}
	
	public function getAllController() {
		$sql = "SELECT * FROM " . DB_PREFIX . "controller ORDER BY id ASC";
		$query = $this->db->query($sql);
		return $query->rows;
	}
	
	public function saveData($data = array()){
		foreach($data['task'] as $controller_id => $group_task){
			$c = $controller_id;
			foreach($group_task as $group_id => $task_detail){
				foreach($task_detail as $task_id => $task_value){
					$ctid = $task_id;
					
					$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "controller_task_group WHERE customer_group_id = '" . (int)$group_id. "' AND ctid = '" . (int)$ctid. "'");
						
					if($query->num_rows==0){

						if(empty($task_value)){
							$value = 0;
						}else{
							$value = $task_value;
						}
						
						$this->db->query("INSERT INTO " . DB_PREFIX . "controller_task_group SET customer_group_id = '" . (int)$group_id. "', ctid = '" . (int)$ctid. "', value='".(int)$value."'");
					}else{

						if(empty($task_value)){
							$value = 0;
						}else{
							$value = $task_value;
						}
							
						$this->db->query("UPDATE " . DB_PREFIX . "controller_task_group SET value='".(int)$value."' WHERE customer_group_id = '" . (int)$group_id. "' AND ctid = '" . (int)$ctid. "'");
					}
				}
			}
		}
	}
}	