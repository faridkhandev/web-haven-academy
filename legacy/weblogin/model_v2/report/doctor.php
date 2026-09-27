<?php
class ModelReportDoctor extends Model {
	public $columns = array('dt.doctor_transaction_id','d.doctor_name','dt.doctor_investment_id','di.description', 'di.amount', 'l.location_name', 'dt.date_added');
	public function getItems($data = array()) {
		//print_r($data);
		$query = $this->db->query("SELECT doctor_transaction_id FROM " . DB_PREFIX . "doctor_transaction WHERE delete_status=0");
		$recordsTotal = (int)$query->num_rows;
		$sql = "SELECT dt.*, di.investment_amount, di.limit_amount, di.investment_status, d.doctor_name, l.location_name, c.name as city_name, z.name as zone_name FROM " . DB_PREFIX . "doctor_transaction dt INNER JOIN " . DB_PREFIX . "doctor_investment di ON dt.doctor_investment_id=di.doctor_investment_id INNER JOIN " . DB_PREFIX . "doctor d ON dt.doctor_id=d.doctor_id INNER JOIN " . DB_PREFIX . "location l ON dt.area_id=l.location_id INNER JOIN " . DB_PREFIX . "city c ON l.city_id=c.city_id INNER JOIN " . DB_PREFIX . "zone z ON c.zone_id=z.zone_id";
		
		
		$sql .= " WHERE dt.delete_status=0";
		if (!empty($data['filter_doctor_id'])) {
			$sql .= " AND dt.doctor_id = '" . $this->db->escape($data['filter_doctor_id']) . "'";
		}
		
		if (!empty($data['filter_investment_id'])) {
			$sql .= " AND dt.doctor_investment_id = '" . $this->db->escape($data['filter_investment_id']) . "'";
		}
		
		if (!empty($data['filter_city'])) {
			$sql .= " AND c.city_id IN(" . $this->db->escape($data['filter_city']) . ")";
		}
		
		if (!empty($data['filter_area'])) {
			$sql .= " AND dt.area_id IN(" . $this->db->escape($data['filter_area']) . ")";
		}
		
		if (!empty($data['filter_name'])) {
			$sql .= " AND d.doctor_name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
		}
		
		if (!empty($data['filter_minimum_investment_amount'])) {
			$sql .= " AND di.investment_amount >= '" . $this->db->escape($data['filter_minimum_investment_amount']) . "'";
		}

		if (!empty($data['filter_maximum_investment_amount'])) {
			$sql .= " AND di.investment_amount <= '" . $this->db->escape($data['filter_maximum_investment_amount']) . "'";
		}
		
		if (!empty($data['filter_minimum_limit_amount'])) {
			$sql .= " AND di.limit_amount >= '" . $this->db->escape($data['filter_minimum_limit_amount']) . "'";
		}

		if (!empty($data['filter_maximum_limit_amount'])) {
			$sql .= " AND di.limit_amount <= '" . $this->db->escape($data['filter_maximum_limit_amount']) . "'";
		}
		
		if (!empty($data['filter_start_date'])) {
			$sql .= " AND DATE(dt.date_added) >= '" . $this->db->escape($data['filter_start_date']) . "'";
		}

		if (!empty($data['filter_end_date'])) {
			$sql .= " AND DATE(dt.date_added) <= '" . $this->db->escape($data['filter_end_date']) . "'";
		}
		
		$sql .= " GROUP BY dt.doctor_transaction_id";
		
		if (isset($data['order']) && is_array($data['order']) && !is_null($data['order'])) {
			$sql .= " ORDER BY " . $this->columns[$data['order'][0]['column']] . " " . strtoupper($data['order'][0]['dir']) . "";
		} else {
			$sql .= " ORDER BY dt.doctor_transaction_id DESC";
		}
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
	
	public function calculateReturn($data = array()) {
		//print_r($data);
		
		$sql1 = "SELECT SUM(di.investment_amount) as total FROM " . DB_PREFIX . "doctor_investment di WHERE di.delete_status=0";
				
		if (!empty($data['filter_doctor_id'])) {
			$sql1 .= " AND di.doctor_id = '" . $this->db->escape($data['filter_doctor_id']) . "'";
		}
		if (!empty($data['filter_start_date'])) {
			$sql1 .= " AND DATE(di.date_added) >= '" . $this->db->escape($data['filter_start_date']) . "'";
		}

		if (!empty($data['filter_end_date'])) {
			$sql1 .= " AND DATE(di.date_added) <= '" . $this->db->escape($data['filter_end_date']) . "'";
		}
		
		$query1 = $this->db->query($sql1);
		$total_investment_amount = $query1->row['total'];
		
		$sql2 = "SELECT SUM(dt.amount) as total FROM " . DB_PREFIX . "doctor_transaction dt WHERE dt.delete_status=0";
				
		if (!empty($data['filter_doctor_id'])) {
			$sql2 .= " AND dt.doctor_id = '" . $this->db->escape($data['filter_doctor_id']) . "'";
		}
		if (!empty($data['filter_start_date'])) {
			$sql2 .= " AND DATE(dt.date_added) >= '" . $this->db->escape($data['filter_start_date']) . "'";
		}

		if (!empty($data['filter_end_date'])) {
			$sql2 .= " AND DATE(dt.date_added) <= '" . $this->db->escape($data['filter_end_date']) . "'";
		}
		
		$query2 = $this->db->query($sql2);
		$total_sales_amount = $query2->row['total'];
		
		$percentage = ((($total_sales_amount-$total_investment_amount)*100)/$total_investment_amount);
		return array('investment'=>number_format($total_investment_amount,2),'sales'=>number_format($total_sales_amount,2),'percentage'=>number_format($percentage,2));
	}
}