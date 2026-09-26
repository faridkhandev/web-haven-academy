<?php
class ModelWelcomeWeeklybest extends Model {
	
	public function save($data) {
		$this->db->query("TRUNCATE TABLE " . DB_PREFIX . "bestperformer");
		foreach($data['weeklybest'] as $item){
			$this->db->query("INSERT INTO " . DB_PREFIX . "bestperformer SET type = '" . $item['type'] . "', entity_name = '" . $this->db->escape($item['entity_name']) . "', entity_image = '" . $this->db->escape($item['entity_image']) . "', entity_no = '" . $this->db->escape($item['entity_no']) . "', entity_description = '" . $this->db->escape($item['entity_description']) . "'");
		}
	}
	
	public function get() {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "bestperformer");
		return $query->rows;
	}
}