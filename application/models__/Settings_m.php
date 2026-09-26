<?php
class Settings_m extends MY_Model
{
	protected $_table_name = 'bh_setting';
	
	public function getSetting($code) {
		$setting_data = [];
		$query = $this->db->query("SELECT * FROM bh_setting WHERE code = '" . $code . "'");
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row){
				if (!$row['serialized']) {
					$setting_data[$row['key']] = $row['value'];
				} else {
					$setting_data[$row['key']] = unserialize($row['value']);
				}
			}
		}
		return $setting_data;
	}
	
	public function getSettingValue($key) {
		$query = $this->db->query("SELECT * FROM bh_setting WHERE `key` = '" . $key . "'");
		if ($query->num_rows() > 0) {
			$row = $query->row_array();
			if (!$row['serialized']) {
				return $row['value'];
			} else {
				return unserialize($row['value']);
			}
		}
	}
}