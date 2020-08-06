<?php
class ModelCheckoutDownload extends Model {
	public function addOrderDownloads($order_id) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "order_product_download (order_product_id, download_id, `constraint`, remaining, duration, end_time) SELECT op.order_product_id, d.download_id, d.constraint, IF(d.total_downloads = '-1', d.total_downloads, d.total_downloads * op.quantity), d.duration * op.quantity, UTC_TIMESTAMP + INTERVAL d.duration * op.quantity SECOND FROM " . DB_PREFIX . "order_product op INNER JOIN " . DB_PREFIX . "product_to_download p2d ON (op.product_id = p2d.product_id) INNER JOIN " . DB_PREFIX . "download d ON (p2d.download_id = d.download_id) WHERE op.order_id = '" . (int)$order_id . "'");

		$this->db->query("INSERT INTO " . DB_PREFIX . "order_option_download (order_option_id, download_id, `constraint`, remaining, duration, end_time) SELECT oo.order_option_id, d.download_id, d.constraint, IF(d.total_downloads = '-1', d.total_downloads, d.total_downloads * op.quantity), d.duration * op.quantity, UTC_TIMESTAMP + INTERVAL d.duration * op.quantity SECOND FROM " . DB_PREFIX . "order_option oo INNER JOIN " . DB_PREFIX . "order_product op ON (oo.order_product_id = op.order_product_id) INNER JOIN " . DB_PREFIX . "product_option_value pov ON (oo.product_option_value_id = pov.product_option_value_id) INNER JOIN " . DB_PREFIX . "option_value ov ON (pov.option_value_id = ov.option_value_id) INNER JOIN " . DB_PREFIX . "download d ON (ov.download_id = d.download_id) WHERE oo.order_id = '" . (int)$order_id . "' AND ov.download_id IS NOT NULL");
	}

	public function editOrderDownloads($order_id) {
		$this->db->query("DELETE opd FROM " . DB_PREFIX . "order_product_download opd LEFT JOIN " . DB_PREFIX . "order_product op ON (opd.order_product_id = op.order_product_id) WHERE op.order_product_id IS NULL");

		$this->db->query("INSERT INTO " . DB_PREFIX . "order_product_download (order_product_id, download_id, `constraint`, remaining, duration, end_time) SELECT op.order_product_id, d.download_id, d.constraint, IF(d.total_downloads = '-1', d.total_downloads, d.total_downloads * op.quantity), d.duration * op.quantity, UTC_TIMESTAMP + INTERVAL d.duration * op.quantity SECOND FROM " . DB_PREFIX . "order_product op INNER JOIN " . DB_PREFIX . "product_to_download p2d ON (op.product_id = p2d.product_id) INNER JOIN " . DB_PREFIX . "download d ON (p2d.download_id = d.download_id) WHERE op.order_id = '" . (int)$order_id . "'");

		$this->db->query("DELETE ood FROM " . DB_PREFIX . "order_option_download ood LEFT JOIN " . DB_PREFIX . "order_option oo ON (ood.order_option_id = oo.order_option_id) WHERE oo.order_option_id IS NULL");

		$this->db->query("INSERT INTO " . DB_PREFIX . "order_option_download (order_option_id, download_id, `constraint`, remaining, duration, end_time) SELECT oo.order_option_id, d.download_id, d.constraint, IF(d.total_downloads = '-1', d.total_downloads, d.total_downloads * op.quantity), d.duration * op.quantity, UTC_TIMESTAMP + INTERVAL d.duration * op.quantity SECOND FROM " . DB_PREFIX . "order_option oo INNER JOIN " . DB_PREFIX . "order_product op ON (oo.order_product_id = op.order_product_id) INNER JOIN " . DB_PREFIX . "product_option_value pov ON (oo.product_option_value_id = pov.product_option_value_id) INNER JOIN " . DB_PREFIX . "option_value ov ON (pov.option_value_id = ov.option_value_id) INNER JOIN " . DB_PREFIX . "download d ON (ov.download_id = d.download_id) WHERE oo.order_id = '" . (int)$order_id . "' AND ov.download_id IS NOT NULL");
	}

	public function deleteOrderDownloads($order_id) {
		$this->db->query("DELETE opd FROM " . DB_PREFIX . "order_product_download opd INNER JOIN " . DB_PREFIX . "order_product op ON (opd.order_product_id = op.order_product_id) WHERE op.order_id = '" . (int)$order_id . "'");

		$this->db->query("DELETE ood FROM " . DB_PREFIX . "order_option_download ood INNER JOIN " . DB_PREFIX . "order_option oo ON (ood.order_option_id = oo.order_option_id) WHERE oo.order_id = '" . (int)$order_id . "'");
	}
}
