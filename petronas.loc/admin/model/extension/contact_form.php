<?php
class ModelExtensionContactForm extends Model {	
	public function addContactForm($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "contact_form 
		SET contact_form_email = '" . $this->db->escape($data['contact_form_email']) . "',
		contact_form_name = '" . $this->db->escape($data['contact_form_name']) . "',
		contact_form_phone = '" . $this->db->escape($data['contact_form_phone']) . "',
		contact_form_message = '" . $this->db->escape($data['contact_form_message']) . "',
		contact_form_date = NOW()");

		$contact_form_id = $this->db->getLastId();

		return $contact_form_id;
	}

	public function editContactForm($contact_form_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "contact_form 
		SET contact_form_email = '" . $this->db->escape($data['contact_form_email']) . "', 
		contact_form_name = '" . $this->db->escape($data['contact_form_name']) . "',
		contact_form_phone = '" . $this->db->escape($data['contact_form_phone']) . "',
		contact_form_message = '" . $this->db->escape($data['contact_form_message']) . "',
		contact_form_date = '" . $this->db->escape($data['contact_form_date']) . "'
		WHERE contact_form_id = '" . (int)$contact_form_id . "'");
	}

	public function deleteContactForm($contact_form_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "contact_form WHERE contact_form_id = '" . (int)$contact_form_id . "'");
	}

	public function getContactForm($contact_form_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "contact_form WHERE contact_form_id = '" . (int)$contact_form_id . "'");

		return $query->row;
	}

	public function getContactFormEmail($contact_form_email) {
		$query = $this->db->query("SELECT contact_form_email FROM " . DB_PREFIX . "contact_form WHERE contact_form_email = '" . $contact_form_email . "'");

		return $query->row;
	}

	public function getContactForms($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "contact_form";

		$sort_data = array(
			'contact_form_id',
			'contact_form_email',
			'contact_form_message',
			'contact_form_date'
			);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY contact_form_date";
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

	public function getTotalContactForms() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "contact_form");

		return $query->row['total'];
	}
	
	public function createTable()
	{
		$res0 = $this->db->query("SHOW TABLES LIKE '".DB_PREFIX."contact_form'");
		if($res0->num_rows == 0){
			$this->db->query("
				CREATE TABLE IF NOT EXISTS `". DB_PREFIX. "contact_form` (
				`contact_form_id` int(11) NOT NULL AUTO_INCREMENT,
				`contact_form_email` varchar(255) NOT NULL,
				`contact_form_phone` text(255) NOT NULL,
				`contact_form_name` text(255) NOT NULL,
				`contact_form_message` text() NOT NULL,
				`contact_form_date` datetime NOT NULL,
				PRIMARY KEY (`contact_form_id`)
				) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
				");
		}
	}
	
	public function removeTable() {
		$this->db->query("DROP TABLE `" . DB_PREFIX . "contact_form`");
	}
}