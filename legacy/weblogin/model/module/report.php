<?php
class ModelModuleReport extends Model {
	public function getTotalStudentsActivated($data = array()) {
		$sql = "SELECT id FROM " . DB_PREFIX . "student_active_history WHERE 1=1";
		
		if (isset($data['filter_counsellor_id']) && !is_null($data['filter_counsellor_id'])) {
			$sql .= " AND counsellor_id = '".$data['filter_counsellor_id']."'";
		}
		
		if (isset($data['filter_user_id']) && !is_null($data['filter_user_id'])) {
			$sql .= " AND user_id IN(".$data['filter_user_id'].")";
		}
		
		if (isset($data['filter_seniorteamleader_id']) && !is_null($data['filter_seniorteamleader_id'])) {
			$sql .= " AND refer_student_seniorteamleader_id IN(".$data['filter_seniorteamleader_id'].")";
		}
		
		if (isset($data['filter_teamleader_id']) && !is_null($data['filter_teamleader_id'])) {
			$sql .= " AND refer_student_teamleader_id IN(".$data['filter_teamleader_id'].")";
		}
		
		if (isset($data['filter_trainer_id']) && !is_null($data['filter_trainer_id'])) {
			$sql .= " AND refer_student_trainer_id IN(".$data['filter_trainer_id'].")";
		}
		
		if (isset($data['filter_student_id']) && !is_null($data['filter_student_id'])) {
			$sql .= " AND refer_student_id IN( ".$data['filter_student_id'].")";
		}
		
		if (!empty($data['filter_start_date'])) {
			$sql .= " AND DATE(added_on) >= '" . $this->db->escape($data['filter_start_date']) . "'";
		}

		if (!empty($data['filter_end_date'])) {
			$sql .= " AND DATE(added_on) <= '" . $this->db->escape($data['filter_end_date']) . "'";
		}
		//echo $sql;
		$query = $this->db->query($sql);
		return (int)$query->num_rows;
	}
	
	public function getStudentsActivated($data = array()) {
		$sql = "SELECT sah.id, sah.added_on, s.student_name, s.student_no, s1.student_name as refer_student_name, s1.student_no as refer_student_no FROM " . DB_PREFIX . "student_active_history sah INNER JOIN " . DB_PREFIX . "student s ON sah.student_id = s.id INNER JOIN " . DB_PREFIX . "student s1 ON sah.refer_student_id = s1.id WHERE 1=1";
		
		if (isset($data['filter_counsellor_id']) && !is_null($data['filter_counsellor_id'])) {
			$sql .= " AND sah.counsellor_id = '".$data['filter_counsellor_id']."'";
		}
		
		if (isset($data['filter_user_id']) && !is_null($data['filter_user_id'])) {
			$sql .= " AND sah.user_id IN(".$data['filter_user_id'].")";
		}
		
		if (isset($data['filter_seniorteamleader_id']) && !is_null($data['filter_seniorteamleader_id'])) {
			$sql .= " AND sah.refer_student_seniorteamleader_id IN(".$data['filter_seniorteamleader_id'].")";
		}
		
		if (isset($data['filter_teamleader_id']) && !is_null($data['filter_teamleader_id'])) {
			$sql .= " AND sah.refer_student_teamleader_id IN(".$data['filter_teamleader_id'].")";
		}
		
		if (isset($data['filter_trainer_id']) && !is_null($data['filter_trainer_id'])) {
			$sql .= " AND sah.refer_student_trainer_id IN(".$data['filter_trainer_id'].")";
		}
		
		if (isset($data['filter_student_id']) && !is_null($data['filter_student_id'])) {
			$sql .= " AND sah.refer_student_id IN( ".$data['filter_student_id'].")";
		}
		
		if (!empty($data['filter_start_date'])) {
			$sql .= " AND DATE(sah.added_on) >= '" . $this->db->escape($data['filter_start_date']) . "'";
		}

		if (!empty($data['filter_end_date'])) {
			$sql .= " AND DATE(sah.added_on) <= '" . $this->db->escape($data['filter_end_date']) . "'";
		}
		//echo $sql;
		$query = $this->db->query($sql);
		return $query->rows;
	}
}
