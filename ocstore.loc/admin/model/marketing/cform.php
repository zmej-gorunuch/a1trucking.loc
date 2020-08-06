<?php
class ModelMarketingCform extends Model {
	
	public function createcform()
	{
		$res0 = $this->db->query("SHOW TABLES LIKE '".DB_PREFIX."cform'");
		if($res0->num_rows == 0){
			$this->db->query("
				CREATE TABLE IF NOT EXISTS `". DB_PREFIX. "cform` (
				`cform_id` int(11) NOT NULL AUTO_INCREMENT,
				`cform_email` varchar(255) NOT NULL,
				`cform_phone` text(255) NOT NULL,
				`cform_name` text(255) NOT NULL,
				`subscribe_date` datetime NOT NULL,
				PRIMARY KEY (`cform_id`)
				) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
				");
		}
	}

	public function addcform($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "cform 
		SET cform_email = '" . $this->db->escape($data['cform_email']) . "',
		cform_name = '" . $this->db->escape($data['cform_name']) . "',
		cform_phone = '" . $this->db->escape($data['cform_phone']) . "',
		subscribe_date = NOW()");

		$cform_id = $this->db->getLastId();

		return $cform_id;
	}

	public function editcform($cform_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "cform 
		SET cform_email = '" . $this->db->escape($data['cform_email']) . "', 
		cform_name = '" . $this->db->escape($data['cform_name']) . "',
		cform_phone = '" . $this->db->escape($data['cform_phone']) . "',
		subscribe_date = '" . $this->db->escape($data['subscribe_date']) . "' 
		WHERE cform_id = '" . (int)$cform_id . "'");
	}

	public function deletecform($cform_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "cform WHERE cform_id = '" . (int)$cform_id . "'");
	}

	public function getcform($cform_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "cform WHERE cform_id = '" . (int)$cform_id . "'");

		return $query->row;
	}

	public function getcformEmail($cform_email) {
		$query = $this->db->query("SELECT cform_email FROM " . DB_PREFIX . "cform WHERE cform_email = '" . $cform_email . "'");

		return $query->row;
	}

	public function getcforms($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "cform";

		$sort_data = array(
			'cform_id',
			'cform_email',
			'subscribe_date'
			);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY subscribe_date";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

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

		return $query->rows;
	}

	public function getTotalcforms() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "cform");

		return $query->row['total'];
	}
	
}