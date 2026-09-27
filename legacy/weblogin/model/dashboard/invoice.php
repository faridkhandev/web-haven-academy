<?php
class ModelDashboardInvoice extends Model {
	public function getInvoices($data = array()) {
		$sql = "SELECT i.invoice_no,i.no_of_nights,i.total_hours_added,i.date_added,b.boarding_id,b.checkin_date,b.checkin_time,b.checkout_date,b.checkout_time,b.day_rate as boarding_day_rate,b.overnight_rate as boarding_overnight_rate,b.food_charges,b.pickup_drop_charges,b.discount,b.additional_charges,b.hourly_charge,b.vat,b.payment_mode,d.name,d.microchip_number,d.day_rate,d.overnight_rate,c.firstname,c.lastname,c.email FROM " . DB_PREFIX . "invoice i INNER JOIN " . DB_PREFIX . "boarding b ON (i.boarding_id = b.boarding_id) INNER JOIN " . DB_PREFIX . "dog d ON (b.dog_id = d.dog_id) INNER JOIN " . DB_PREFIX . "customer c ON (b.customer_id = c.customer_id) WHERE b.language_id = '" . (int)$this->config->get('config_language_id') . "'";
		
		$implode = array();
		
		if (!empty($data['filter_dog_name'])) {
			$sql .= " AND d.name LIKE '" . $this->db->escape($data['filter_dog_name']) . "%'";
		}
		
		if (!empty($data['filter_microchip_number'])) {
			$sql .= " AND d.microchip_number LIKE '" . $this->db->escape($data['filter_microchip_number']) . "%'";
		}
		
		if (!empty($data['filter_customer_id'])) {
			$sql .= " AND c.customer_id = '" . $this->db->escape($data['filter_customer_id']) . "'";
		}
		
		if (!empty($data['filter_payment_mode'])) {
			$sql .= " AND b.payment_mode = '" . $this->db->escape($data['filter_payment_mode']) . "'";
		}
		
		if (!empty($data['filter_checkout_status'])) {
			$sql .= " AND b.checkout_status = '" . $this->db->escape($data['filter_checkout_status']) . "'";
		}
		
		if (!empty($data['filter_selected_boarding']) && count($data['filter_selected_boarding'])>0) {
			$implode[] = "b.boarding_id IN (" . $data['filter_selected_boarding'] . ")";
		}
		
		if (!empty($data['filter_checkin_start_date']) && !empty($data['filter_checkin_end_date'])) {
			$implode[] = "(DATE(b.checkin_date) BETWEEN DATE('" . $this->db->escape($data['filter_checkin_start_date']) . "') AND DATE('" . $this->db->escape($data['filter_checkin_end_date']) . "'))";
		}elseif (!empty($data['filter_checkin_start_date'])) {
			$implode[] = "DATE(b.checkin_date) >= DATE('" . $this->db->escape($data['filter_checkin_start_date']) . "')";
		}elseif (!empty($data['filter_checkin_end_date'])) {
			$implode[] = "DATE(b.checkin_date) <= DATE('" . $this->db->escape($data['filter_checkin_end_date']) . "')";
		}
		
		if (!empty($data['filter_checkout_start_date']) && !empty($data['filter_checkout_end_date'])) {
			$implode[] = "(DATE(b.checkout_date) BETWEEN DATE('" . $this->db->escape($data['filter_checkout_start_date']) . "') AND DATE('" . $this->db->escape($data['filter_checkout_end_date']) . "'))";
		}elseif (!empty($data['filter_checkout_start_date'])) {
			$implode[] = "DATE(b.checkout_date) >= DATE('" . $this->db->escape($data['filter_checkout_start_date']) . "')";
		}elseif (!empty($data['filter_checkout_end_date'])) {
			$implode[] = "DATE(b.checkout_date) <= DATE('" . $this->db->escape($data['filter_checkout_end_date']) . "')";
		}
		
		if (!empty($data['filter_date_added']) && !empty($data['filter_date_ended'])) {
			$implode[] = "(DATE(b.date_added) BETWEEN DATE('" . $this->db->escape($data['filter_date_added']) . "') AND DATE('" . $this->db->escape($data['filter_date_ended']) . "'))";
		}elseif (!empty($data['filter_date_added'])) {
			$implode[] = "DATE(b.date_added) >= DATE('" . $this->db->escape($data['filter_date_added']) . "')";
		}elseif (!empty($data['filter_date_ended'])) {
			$implode[] = "DATE(b.date_added) <= DATE('" . $this->db->escape($data['filter_date_ended']) . "')";
		}
		
		if ($implode) {
			$sql .= " AND " . implode(" AND ", $implode);
		}

		/* $sort_data = array(
			'e.amount',
			'c.email',
			'expense_head',
			'e.expense_date',
			'e.date_added'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY e.date_added";
		} */
		
		$sql .= " ORDER BY i.date_added DESC";

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);
		/* echo $sql; */
		return $query->rows;
	}
}	