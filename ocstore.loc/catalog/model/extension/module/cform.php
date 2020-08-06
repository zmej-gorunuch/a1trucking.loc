<?php
class ModelExtensionModulecform extends Model
{
	public function createсform()
	{
		$res0 = $this->db->query("SHOW TABLES LIKE '" . DB_PREFIX . "cform'");
		if ($res0->num_rows == 0) {
			$this->db->query("
				CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "cform` (
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

	public function addcform($data)
	{
		$this->load->language('extension/module/cform');
		$data['error_cform_email_duplicate'] = $this->language->get('error_cform_email_duplicate');
		$data['error_cform_sent'] = $this->language->get('error_cform_sent');
		$data['error_cform_fail'] = $this->language->get('error_cform_fail');

		// $res = $this->db->query("select * from " . DB_PREFIX . "cform where cform_email='" . $data['email'] . "'");
		// if ($res->num_rows == 1) {
			// return $this->language->get('error_cform_email_duplicate');
		// } else {
			if ($this->db->query("INSERT INTO " . DB_PREFIX . "cform (cform_email, cform_name, cform_phone, subscribe_date) values ('" . $this->db->escape($data['email']) . "', '" . $this->db->escape($data['name']) . "', '" . $this->db->escape($data['phone']) . "', NOW())")) {
				return true;
			} else {
				return $this->language->get('error_cform_fail');
			}
		// }
	}
}
