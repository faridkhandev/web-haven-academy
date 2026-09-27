<?php
class Cart {
	private $config;
	private $db;
	private $data = array();

	public function __construct($registry) {
		$this->config = $registry->get('config');
		$this->customer = $registry->get('customer');
		$this->session = $registry->get('session');
		$this->db = $registry->get('db');

		if (!isset($this->session->data['cart']) || !is_array($this->session->data['cart'])) {
			$this->session->data['cart'] = array();
		}
	}
	
	public function getProducts() {
		if (!$this->data) {
			foreach ($this->session->data['cart'] as $key => $quantity) {
				$product = unserialize(base64_decode($key));

				$package_id = $product['package_id'];

				$package_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "packages p WHERE p.package_id = '" . (int)$package_id . "' AND p.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p.package_status = '1'");

				if ($package_query->num_rows) {

					$price = $package_query->row['package_price'];
					// Product Specials
					$product_special_query = $this->db->query("SELECT special_price FROM " . DB_PREFIX . "package_special WHERE package_id = '" . (int)$package_id . "' AND ((special_date_start = '0000-00-00' OR special_date_start < NOW()) AND (special_date_end = '0000-00-00' OR special_date_end > NOW())) ORDER BY special_price ASC LIMIT 1");

					if ($product_special_query->num_rows) {
						$price = $product_special_query->row['special_price'];
					}

					$this->data[$key] = array(
						'key'             => $key,
						'package_id'      => $package_query->row['package_id'],
						'package_name'    => $package_query->row['package_name'],
						'package_duration'=> $package_query->row['package_duration'],
						'package_code'    => $package_query->row['package_code'],
						'package_image'   => $package_query->row['package_image'],
						'package_price'   => $price,
						'quantity'        => $quantity,
						'total'           => $price * $quantity,
					);
				} else {
					$this->remove($key);
				}
			}
		}

		return $this->data;
	}
	
	public function add($package_id, $qty = 1) {
		$this->data = array();

		$product['package_id'] = (int)$package_id;

		$key = base64_encode(serialize($product));

		if ((int)$qty && ((int)$qty > 0)) {
			if (!isset($this->session->data['cart'][$key])) {
				$this->session->data['cart'][$key] = (int)$qty;
			} else {
				$this->session->data['cart'][$key] += (int)$qty;
			}
		}
	}
	
	public function update($key, $qty) {
		$this->data = array();

		if ((int)$qty && ((int)$qty > 0) && isset($this->session->data['cart'][$key])) {
			$this->session->data['cart'][$key] = (int)$qty;
		} else {
			$this->remove($key);
		}
	}

	public function remove($key) {
		$this->data = array();

		unset($this->session->data['cart'][$key]);
	}

	public function clear() {
		$this->data = array();

		$this->session->data['cart'] = array();
	}
	
	public function getSubTotal() {
		$total = 0;

		foreach ($this->getProducts() as $product) {
			$total += $product['total'];
		}

		return $total;
	}
	
	public function getTotal() {
		$total = 0;

		foreach ($this->getProducts() as $product) {
			$total += $product['price'] * $product['quantity'];
		}

		return $total;
	}

	public function countProducts() {
		$product_total = 0;

		$products = $this->getProducts();

		foreach ($products as $product) {
			$product_total += $product['quantity'];
		}

		return $product_total;
	}

	public function hasProducts() {
		return count($this->session->data['cart']);
	}
}	