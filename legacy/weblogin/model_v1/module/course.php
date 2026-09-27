<?php
class ModelModuleCourse extends Model {
	public $columns = array('id','course_name','no_of_classes','priority', 'course_status', 'created_at');

	public function add($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "course SET course_status = '" . (int)$data['course_status'] . "', course_name = '" . $this->db->escape($data['course_name']) . "', course_description = '" . $this->db->escape($data['course_description']) . "', no_of_classes = '" . $this->db->escape($data['no_of_classes']) . "', priority = '" . $this->db->escape($data['priority']) . "', course_image = '" . $this->db->escape($data['course_image']) . "', per_session_point = '" . $this->db->escape($data['per_session_point']) . "', require_validation = '" . $this->db->escape($data['require_validation']) . "', course_delete_status = '0', created_at = '".date('Y-m-d H:i:s')."', updated_at = '".date('Y-m-d H:i:s')."', created_by='".$this->user->getId()."', updated_by='".$this->user->getId()."'");
		
		$course_id = $this->db->getLastId();
		return $course_id;
	}

	public function edit($course_id,$data) {
		$this->db->query("UPDATE " . DB_PREFIX . "course SET course_status = '" . (int)$data['course_status'] . "', course_name = '" . $this->db->escape($data['course_name']) . "', course_description = '" . $this->db->escape($data['course_description']) . "', no_of_classes = '" . $this->db->escape($data['no_of_classes']) . "', priority = '" . $this->db->escape($data['priority']) . "', per_session_point = '" . $this->db->escape($data['per_session_point']) . "', require_validation = '" . $this->db->escape($data['require_validation']) . "', course_image = '" . $this->db->escape($data['course_image']) . "', updated_at = '".date('Y-m-d H:i:s')."', updated_by='".$this->user->getId()."' WHERE course_id = '" . (int)$course_id . "'");
	}
	
	public function copy($course_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "course WHERE course_id = '" . (int)$course_id . "'");

		if ($query->num_rows) {
			$data = $query->row;
			$data['course_status'] = '0';
			$this->add($data);
		}
	}

	public function delete($course_id) {
		$this->db->query("UPDATE " . DB_PREFIX . "course SET course_delete_status = '1' WHERE course_id = '" . (int)$course_id . "'");
	}
	
	public function get($course_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "course WHERE course_id = '" . (int)$course_id . "'");

		return $query->row;
	}
	
	public function getItems($data = array()) {
		//print_r($data);
		$query = $this->db->query("SELECT course_id FROM " . DB_PREFIX . "course WHERE course_delete_status=0");
		$recordsTotal = (int)$query->num_rows;
		$sql = "SELECT * FROM " . DB_PREFIX . "course";
		
		$sql .= " WHERE course_delete_status=0";
		
		if (!empty($data['filter_name'])) {
			$sql .= " AND course_name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
		}
		
		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND course_status = '" . $data['filter_status'] . "'";
		}
		
		if (!empty($data['filter_start_date'])) {
			$sql .= " AND DATE(created_at) >= '" . $this->db->escape($data['filter_start_date']) . "'";
		}

		if (!empty($data['filter_end_date'])) {
			$sql .= " AND DATE(created_at) <= '" . $this->db->escape($data['filter_end_date']) . "'";
		}
		
		if (isset($data['order']) && is_array($data['order']) && !is_null($data['order'])) {
			$sql .= " ORDER BY " . $this->columns[$data['order'][0]['column']] . " " . strtoupper($data['order'][0]['dir']) . "";
		} else {
			$sql .= " ORDER BY course_id DESC";
		}
		//echo $sql;
		$query = $this->db->query($sql);
		$recordsFiltered = (int)$query->num_rows;
		if (isset($data['start']) || isset($data['length'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}
			if ($data['length'] < 1) {
				$data['length'] = 20;
			}
			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['length'];
		}
		//echo $sql;
		$query = $this->db->query($sql);
		$result = $query->rows;
		return array('recordsTotal' => $recordsTotal, 'recordsFiltered' => $recordsFiltered, 'result' => $result);
	}
}