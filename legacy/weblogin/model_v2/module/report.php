<?php
class ModelModuleReport extends Model {
	public function getTotalStudentsActivated($data = array()) {
		$sql = "SELECT id FROM " . DB_PREFIX . "student_active_history WHERE 1=1";
		
		if (isset($data['filter_counsellor_id']) && !is_null($data['filter_counsellor_id'])) {
			$sql .= " AND counsellor_id = '".$data['filter_counsellor_id']."'";
		}
		
		if (isset($data['filter_user_id']) && !is_null($data['filter_user_id'])) {
			$sql .= " AND user_id IN( ".$data['filter_user_id'].")";
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
}
