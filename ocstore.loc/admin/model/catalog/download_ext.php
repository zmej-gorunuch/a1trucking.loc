<?php
class ModelCatalogDownloadExt extends Model {
	protected static $filteredCount;
	protected static $updatedOrders;

	public function __construct($registry) {
		parent::__construct($registry);
		self::$updatedOrders = array('added' => array(), 'updated' => array());
	}

	public function addDownload($data) {
		$order_product_download = array();

		$this->db->query("INSERT INTO " . DB_PREFIX . "download SET filename = '" . $this->db->escape($data['filename']) . "', mask = '" . $this->db->escape($data['mask']) . "', `constraint` = '" . (int)$data['constraint'] . "', total_downloads = '" . (int)$data['total_downloads'] . "', duration = '" . (int)$data['duration_in_seconds'] . "', is_free = '" . (int)$data['download_type'] . "', file_size = '" . (int)filesize(DIR_DOWNLOAD . $data['filename']) . "', login = '" . (int)$data['login'] . "', sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', date_added = NOW(), date_modified = NOW()");

		$download_id = $this->db->getLastId();

		foreach ($data['tags'] as $tag_id) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "download_to_tag SET download_id = '" . (int)$download_id . "', download_tag_id = '" . (int)$tag_id . "'");
		}

		if (isset($data['download_customer_groups'])) {
			foreach ($data['download_customer_groups'] as $customer_group_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "download_to_customer_group SET download_id = '" . (int)$download_id . "', customer_group_id = '" . (int)$customer_group_id . "'");
			}
		} else {
			$this->db->query("INSERT INTO " . DB_PREFIX . "download_to_customer_group SET download_id = '" . (int)$download_id . "', customer_group_id = '0'");
		}

		foreach ($data['description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "download_description SET download_id = '" . (int)$download_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
		}

		if (isset($data['link_to']) && $data['link_to'] != "" && (int)$data['link_to'] == 0) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_download (product_id, download_id) SELECT product_id, '" . (int)$download_id . "' FROM " . DB_PREFIX . "product");
		} else if (isset($data['link_to']) && (int)$data['link_to'] == 1 && isset($data['category'])) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_download (product_id, download_id) SELECT p.product_id, '" . (int)$download_id . "' FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (p.product_id = p2c.product_id) WHERE p2c.category_id = '" . (int)$data['category'] . "'");
		} else if (isset($data['link_to']) && (int)$data['link_to'] == 2 && isset($data['manufacturer'])) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_download (product_id, download_id) SELECT product_id, '" . (int)$download_id . "' FROM " . DB_PREFIX . "product WHERE manufacturer_id = '" . (int)$data['manufacturer'] . "'");
		} else if (isset($data['link_to']) && (int)$data['link_to'] == 3 && isset($data['related_products'])){
			foreach ((array)$data['related_products'] as $product) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_download SET download_id = '" . (int)$download_id . "', product_id = '" . (int)$product['product_id'] . "'");
			}
		}

		if (!empty($data['add_to_previous_orders'])) {
			$order_products = $this->db->query("SELECT op.order_id, op.order_product_id, o.order_status_id, op.quantity FROM " . DB_PREFIX . "order_product op JOIN `" . DB_PREFIX . "order` o ON (op.order_id = o.order_id) JOIN " . DB_PREFIX . "product_to_download p2d ON (op.product_id = p2d.product_id AND p2d.download_id = '" . (int)$download_id . "')");
			$order_complete_statuses = $this->config->get('config_complete_status');

			foreach ($order_products->rows as $order_product) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "order_product_download SET order_product_id = '" . (int)$order_product['order_product_id'] . "', download_id = '" . (int)$download_id . "', `constraint` = '" . (int)$data['constraint'] . "', remaining = '" . (int)$data['total_downloads'] . "', duration = '" . (int)$data['duration_in_seconds'] . "', end_time = UTC_TIMESTAMP + INTERVAL " . (int)$data['duration_in_seconds'] . " SECOND");

				if (in_array($order_product['order_status_id'], (array)$order_complete_statuses) && (int)$data['status']) {
					$order_product_download_id = $this->db->getLastId();
					$order_product_download[(int)$order_product['order_id']][] = (int)$order_product_download_id;
				}
			}
		}

		if (!empty($data['notify_customers'])) {
			self::$updatedOrders['added']['order_product_download'] = $order_product_download;
		} else {
			self::$updatedOrders['added'] = array();
		}

		self::$updatedOrders['updated'] = array();

		$this->cache->delete("pd.downloads");

		return $download_id;
	}

	public function editDownload($download_id, $data) {
		$added = array();
		$updated = array();
		$order_complete_statuses = $this->config->get('config_complete_status');

		$this->db->query("UPDATE " . DB_PREFIX . "download SET filename = '" . $this->db->escape($data['filename']) . "', mask = '" . $this->db->escape($data['mask']) . "', `constraint` = '" . (int)$data['constraint'] . "', total_downloads = '" . (int)$data['total_downloads'] . "', duration = '" . (int)$data['duration_in_seconds'] . "', is_free = '" . (int)$data['download_type'] . "', file_size = '" . (int)filesize(DIR_DOWNLOAD . $data['filename']) . "', login = '" . (int)$data['login'] . "', sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', date_modified = NOW() WHERE download_id = '" . (int)$download_id . "'");

		$this->db->query("DELETE FROM " . DB_PREFIX . "download_to_tag WHERE download_id = '" . (int)$download_id . "'");
		foreach ($data['tags'] as $tag_id) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "download_to_tag SET download_id = '" . (int)$download_id . "', download_tag_id = '" . (int)$tag_id . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "download_to_customer_group WHERE download_id = '" . (int)$download_id . "'");
		if (isset($data['download_customer_groups'])) {
			foreach ($data['download_customer_groups'] as $customer_group_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "download_to_customer_group SET download_id = '" . (int)$download_id . "', customer_group_id = '" . (int)$customer_group_id . "'");
			}
		} else {
			$this->db->query("INSERT INTO " . DB_PREFIX . "download_to_customer_group SET download_id = '" . (int)$download_id . "', customer_group_id = '0'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "download_description WHERE download_id = '" . (int)$download_id . "'");
		foreach ($data['description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "download_description SET download_id = '" . (int)$download_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_download WHERE download_id = '" . (int)$download_id . "'");
		if (isset($data['link_to']) && $data['link_to'] != "" && (int)$data['link_to'] == 0) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_download (product_id, download_id) SELECT product_id, '" . (int)$download_id . "' FROM " . DB_PREFIX . "product");
		} else if (isset($data['link_to']) && (int)$data['link_to'] == 1 && isset($data['category'])) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_download (product_id, download_id) SELECT p.product_id, '" . (int)$download_id . "' FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (p.product_id = p2c.product_id) WHERE p2c.category_id = '" . (int)$data['category'] . "'");
		} else if (isset($data['link_to']) && (int)$data['link_to'] == 2 && isset($data['manufacturer'])) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_download (product_id, download_id) SELECT product_id, '" . (int)$download_id . "' FROM " . DB_PREFIX . "product WHERE manufacturer_id = '" . (int)$data['manufacturer'] . "'");
		} else if (isset($data['link_to']) && (int)$data['link_to'] == 3 && isset($data['related_products'])){
			foreach ((array)$data['related_products'] as $product) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_download SET download_id = '" . (int)$download_id . "', product_id = '" . (int)$product['product_id'] . "'");
			}
		}

		if (!empty($data['update_previous_orders'])) {
			$order_products = $this->db->query("SELECT op.order_id, opd.order_product_download_id, o.order_status_id, op.quantity FROM " . DB_PREFIX . "order_product_download opd JOIN " . DB_PREFIX . "order_product op ON (op.order_product_id = opd.order_product_id) JOIN `" . DB_PREFIX . "order` o ON (op.order_id = o.order_id) WHERE opd.download_id = '" . (int)$download_id . "'");

			foreach ($order_products->rows as $order_product) {
				$this->db->query("UPDATE " . DB_PREFIX . "order_product_download SET `constraint` = '" . (int)$data['constraint'] . "', remaining = '" . ((int)$data['total_downloads'] == -1 ? (int)$data['total_downloads'] : (int)$order_product['quantity'] * (int)$data['total_downloads']) . "', duration = '" . (int)$order_product['quantity'] * (int)$data['duration_in_seconds'] . "', end_time = UTC_TIMESTAMP + INTERVAL " . (int)$order_product['quantity'] * (int)$data['duration_in_seconds'] . " SECOND WHERE order_product_download_id = '" . (int)$order_product['order_product_download_id'] . "'");

				if (in_array($order_product['order_status_id'], (array)$order_complete_statuses) && (int)$data['status']) {
					$updated['order_product_download'][(int)$order_product['order_id']][] = (int)$order_product['order_product_download_id'];
				}
			}

			// Delete downloads that are no longer linked to the products
			$this->db->query("DELETE opd1 FROM " . DB_PREFIX . "order_product_download opd1 CROSS JOIN (SELECT opd.order_product_download_id FROM " . DB_PREFIX . "order_product_download opd LEFT JOIN " . DB_PREFIX . "order_product op ON (op.order_product_id = opd.order_product_id) LEFT JOIN " . DB_PREFIX . "product_to_download p2d ON (p2d.product_id = op.product_id AND opd.download_id = p2d.download_id) WHERE opd.download_id = '" . (int)$download_id . "' AND p2d.download_id IS NULL) AS opd2 USING (order_product_download_id)");

			$order_options = $this->db->query("SELECT oo.order_id, ood.order_option_download_id, o.order_status_id, op.quantity FROM " . DB_PREFIX . "order_option_download ood JOIN " . DB_PREFIX . "order_option oo ON (oo.order_option_id = ood.order_option_id) JOIN `" . DB_PREFIX . "order` o ON (oo.order_id = o.order_id) JOIN " . DB_PREFIX . "order_product op ON (oo.order_product_id = op.order_product_id) WHERE ood.download_id = '" . (int)$download_id . "'");

			foreach ($order_options->rows as $order_option) {
				$this->db->query("UPDATE " . DB_PREFIX . "order_option_download SET `constraint` = '" . (int)$data['constraint'] . "', remaining = '" . ((int)$data['total_downloads'] == -1 ? (int)$data['total_downloads'] : (int)$order_option['quantity'] * (int)$data['total_downloads']) . "', duration = '" . (int)$order_option['quantity'] * (int)$data['duration_in_seconds'] . "', end_time = UTC_TIMESTAMP + INTERVAL " . (int)$order_option['quantity'] * (int)$data['duration_in_seconds'] . " SECOND WHERE order_option_download_id = '" . (int)$order_option['order_option_download_id'] . "'");

				if (in_array($order_option['order_status_id'], (array)$order_complete_statuses) && (int)$data['status']) {
					$updated['order_option_download'][(int)$order_option['order_id']][] = (int)$order_option['order_option_download_id'];
				}
			}

			// Delete downloads that are no longer linked to the products
			$this->db->query("DELETE ood1 FROM " . DB_PREFIX . "order_option_download ood1 CROSS JOIN (SELECT ood.order_option_download_id FROM " . DB_PREFIX . "order_option_download ood LEFT JOIN " . DB_PREFIX . "order_option oo ON (oo.order_option_id = ood.order_option_id) LEFT JOIN " . DB_PREFIX . "order_product op ON (oo.order_product_id = op.order_product_id) LEFT JOIN " . DB_PREFIX . "product_option_value pov ON (oo.product_option_value_id = pov.product_option_value_id) LEFT JOIN " . DB_PREFIX . "option_value ov ON (pov.option_value_id = ov.option_value_id AND ov.download_id = ood.download_id) WHERE ood.download_id = '" . (int)$download_id . "' AND ov.download_id IS NULL) AS ood2 USING (order_option_download_id)");
		}

		if (!empty($data['add_to_previous_orders'])) {
			$order_products = $this->db->query("SELECT op.order_id, op.order_product_id, o.order_status_id, op.quantity FROM " . DB_PREFIX . "order_product op JOIN `" . DB_PREFIX . "order` o ON (op.order_id = o.order_id) JOIN " . DB_PREFIX . "product_to_download p2d ON (op.product_id = p2d.product_id AND p2d.download_id = '" . (int)$download_id . "') WHERE NOT EXISTS (SELECT * FROM " . DB_PREFIX . "order_product_download opd WHERE opd.download_id = '" . (int)$download_id . "' AND op.order_product_id = opd.order_product_id)");
			//$order_products = $this->db->query("SELECT op.order_product_id, o.order_status_id, op.quantity FROM " . DB_PREFIX . "order_product op JOIN `" . DB_PREFIX . "order` o ON (op.order_id = o.order_id) JOIN " . DB_PREFIX . "product_to_download p2d ON (op.product_id = p2d.product_id AND p2d.download_id = '" . (int)$download_id . "') LEFT JOIN " . DB_PREFIX . "order_product_download opd ON (opd.order_product_id = op.order_product_id AND opd.download_id = p2d.download_id) WHERE opd.order_product_id IS NULL");

			foreach ($order_products->rows as $order_product) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "order_product_download SET order_product_id = '" . (int)$order_product['order_product_id'] . "', download_id = '" . (int)$download_id . "', `constraint` = '" . (int)$data['constraint'] . "', remaining = '" . ((int)$data['total_downloads'] == -1 ? (int)$data['total_downloads'] : (int)$order_product['quantity'] * (int)$data['total_downloads']) . "', duration = '" . (int)$order_product['quantity'] * (int)$data['duration_in_seconds'] . "', end_time = UTC_TIMESTAMP + INTERVAL " . (int)$order_product['quantity'] * (int)$data['duration_in_seconds'] . " SECOND");

				if (in_array($order_product['order_status_id'], (array)$order_complete_statuses) && (int)$data['status']) {
					$order_product_download_id = $this->db->getLastId();
					$added['order_product_download'][(int)$order_product['order_id']][] = (int)$order_product_download_id;
				}
			}

			$order_options = $this->db->query("SELECT oo.order_id, oo.order_option_id, o.order_status_id, op.quantity FROM " . DB_PREFIX . "order_option oo JOIN `" . DB_PREFIX . "order` o ON (oo.order_id = o.order_id) JOIN " . DB_PREFIX . "order_product op ON (oo.order_product_id = op.order_product_id) JOIN " . DB_PREFIX . "product_option_value pov ON (oo.product_option_value_id = pov.product_option_value_id) JOIN " . DB_PREFIX . "option_value ov ON (pov.option_value_id = ov.option_value_id AND ov.download_id = '" . (int)$download_id . "') WHERE NOT EXISTS (SELECT * FROM " . DB_PREFIX . "order_option_download ood WHERE ood.download_id = '" . (int)$download_id . "' AND oo.order_option_id = ood.order_option_id)");

			foreach ($order_options->rows as $order_option) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "order_option_download SET order_option_id = '" . (int)$order_option['order_product_id'] . "', download_id = '" . (int)$download_id . "', `constraint` = '" . (int)$data['constraint'] . "', remaining = '" . ((int)$data['total_downloads'] == -1 ? (int)$data['total_downloads'] : (int)$order_option['quantity'] * (int)$data['total_downloads']) . "', duration = '" . (int)$order_option['quantity'] * (int)$data['duration_in_seconds'] . "', end_time = UTC_TIMESTAMP + INTERVAL " . (int)$order_option['quantity'] * (int)$data['duration_in_seconds'] . " SECOND");

				if (in_array($order_option['order_status_id'], (array)$order_complete_statuses) && (int)$data['status']) {
					$order_option_download_id = $this->db->getLastId();
					$added['order_option_download'][(int)$order_option['order_id']][] = (int)$order_option_download_id;
				}
			}
		}

		if (!empty($data['notify_customers'])) {
			self::$updatedOrders['updated'] = $updated;
			self::$updatedOrders['added'] = $added;
		} else {
			self::$updatedOrders['updated'] = array();
			self::$updatedOrders['added'] = array();
		}

		$this->cache->delete("pd.downloads");
	}

	public function copyDownload($download_id) {
		$data = $this->getDownload($download_id);
		$data['duration_in_seconds'] = $data['duration'];

		if (isset($data['download_id'])) {
			$data = array_merge($data, array('description' => $this->getDownloadDescriptions($download_id)));
			$data = array_merge($data, array('download_customer_groups' => $this->getDownloadCustomerGroups($download_id)));
			$data = array_merge($data, array('related_products' => $this->getDownloadRelatedProducts($download_id)));
			$data = array_merge($data, array('tags' => $this->getDownloadTags($download_id)));

			$data['status'] = '0';
			$data['link_to'] = '3';

			return $this->addDownload($data);
		}

		return null;
	}

	public function deleteDownload($download_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "download WHERE download_id = '" . (int)$download_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "download_description WHERE download_id = '" . (int)$download_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_download WHERE download_id = '" . (int)$download_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "download_to_customer_group WHERE download_id = '" . (int)$download_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "download_to_tag WHERE download_id = '" . (int)$download_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "download_sample WHERE download_id = '" . (int)$download_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "order_product_download WHERE download_id = '" . (int)$download_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "order_option_download WHERE download_id = '" . (int)$download_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "option_value WHERE download_id = '" . (int)$download_id . "'");

		$this->cache->delete("pd.downloads");
	}

	public function resetDownloaded($download_id) {
		$this->db->query("UPDATE " . DB_PREFIX . "download SET downloaded = '0' WHERE download_id = '" . (int)$download_id . "'");

		$this->cache->delete("pd.downloads");
	}

	public function changeDownloadType($download_id, $type) {
		if ($type == "free") {
			$this->db->query("UPDATE " . DB_PREFIX . "download SET is_free = '1' WHERE download_id = '" . (int)$download_id . "'");
		} else {
			$this->db->query("UPDATE " . DB_PREFIX . "download SET is_free = '0' WHERE download_id = '" . (int)$download_id . "'");
		}

		$this->cache->delete("pd.downloads");
	}

	public function getDownload($download_id) {
		$query = $this->db->query("SELECT DISTINCT d.*, d.is_free AS download_type, dd.*, GROUP_CONCAT(DISTINCT dtd.name ORDER BY dtd.name SEPARATOR ',') AS tags FROM " . DB_PREFIX . "download d LEFT JOIN " . DB_PREFIX . "download_description dd ON (d.download_id = dd.download_id AND dd.language_id = '" . (int)$this->config->get('config_language_id') . "') LEFT JOIN " . DB_PREFIX . "download_to_tag d2t ON (d.download_id = d2t.download_id) LEFT JOIN " . DB_PREFIX . "download_tag_description dtd ON (d2t.download_tag_id = dtd.download_tag_id AND dtd.language_id = '" . (int)$this->config->get('config_language_id') . "') WHERE d.download_id = '" . (int)$download_id . "' GROUP BY d.download_id");

		return $query->row;
	}

	public function getDownloads($data = array()) {
		$columns = isset($data['columns']) ? $data['columns'] : array();

		$sql = "SELECT SQL_CALC_FOUND_ROWS DISTINCT d.*, dd.name, d.download_id AS id, d.is_free AS type, d.file_size AS size";

		$sql .= ", IF(d.total_downloads = '-1', '" . $this->db->escape($this->language->get('text_unlimited')) . "', d.total_downloads) AS total_downloads_text";

		if (in_array("status", $columns)) {
			$sql .= ", IF(d.status, '" . $this->db->escape($this->language->get('text_enabled')) . "','" .$this->db->escape($this->language->get('text_disabled')) . "') AS status_text";
		}

		if (in_array("login", $columns)) {
			$sql .= ", IF(d.login, '" . $this->db->escape($this->language->get('text_yes')) . "','" .$this->db->escape($this->language->get('text_no')) . "') AS login_text";
		}

		if (in_array("type", $columns)) {
			$sql .= ", IF(d.is_free, '" . $this->db->escape($this->language->get('text_free')) . "','" .$this->db->escape($this->language->get('text_regular')) . "') AS type_text";
		}

		if (in_array("tag", $columns)) {
			$sql .= ", GROUP_CONCAT(DISTINCT dtd.name ORDER BY dtd.name SEPARATOR ', ') AS tag_text, GROUP_CONCAT(DISTINCT dtd.download_tag_id ORDER BY dtd.name SEPARATOR '_') AS tag, COUNT(DISTINCT d2t.download_tag_id) AS tag_count";
		}

		if (in_array("customer_group", $columns)) {
			$sql .= ", GROUP_CONCAT(DISTINCT cgd.name ORDER BY cgd.name SEPARATOR '<br/>') AS customer_group_text, GROUP_CONCAT(DISTINCT cgd.customer_group_id ORDER BY cgd.name SEPARATOR '_') AS customer_group, COUNT(DISTINCT d2cg.customer_group_id) AS customer_group_count";
		}

		if (in_array("related_products", $columns)) {
			$sql .= ", GROUP_CONCAT(DISTINCT pd.name ORDER BY pd.name SEPARATOR '<br/>') AS related_products_text, GROUP_CONCAT(DISTINCT pd.product_id ORDER BY pd.name SEPARATOR '_') AS related_products, COUNT(DISTINCT pd.product_id) AS related_products_count";
		}

		$sql .= " FROM " . DB_PREFIX . "download d LEFT JOIN " . DB_PREFIX . "download_description dd ON (d.download_id = dd.download_id AND dd.language_id = '" . (int)$this->config->get('config_language_id') . "')";

		if (in_array("tag", $columns)) {
			$sql .= " LEFT JOIN " . DB_PREFIX . "download_to_tag d2t ON (d.download_id = d2t.download_id) LEFT JOIN " . DB_PREFIX . "download_tag_description dtd ON (d2t.download_tag_id = dtd.download_tag_id AND dtd.language_id = '" . (int)$this->config->get('config_language_id') . "')";
			$sql .= " LEFT JOIN " . DB_PREFIX . "download_to_tag d2t2 ON (d.download_id = d2t2.download_id)";
		}

		if (in_array("customer_group", $columns)) {
			$sql .= " LEFT JOIN " . DB_PREFIX . "download_to_customer_group d2cg ON (d.download_id = d2cg.download_id) LEFT JOIN " . DB_PREFIX . "customer_group_description cgd ON (d2cg.customer_group_id = cgd.customer_group_id AND cgd.language_id = '" . (int)$this->config->get('config_language_id') . "')";
			$sql .= " LEFT JOIN " . DB_PREFIX . "download_to_customer_group d2cg2 ON (d.download_id = d2cg2.download_id)";
		}

		if (in_array("related_products", $columns)) {
			$sql .= " LEFT JOIN " . DB_PREFIX . "product_to_download p2d ON (d.download_id = p2d.download_id) LEFT JOIN " . DB_PREFIX . "product_description pd ON (p2d.product_id = pd.product_id AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "')";
			$sql .= " LEFT JOIN " . DB_PREFIX . "product_to_download p2d2 ON (d.download_id = p2d2.download_id)";
		}

		$filters = array('AND' => array(), 'OR' => array());

		// Global search
		if (!empty($data['search']) && !in_array("tag", $columns) && !in_array("customer_group", $column) && !in_array("related_products", $column)) {
			$_filters = array(
				'id'                    => 'd.download_id',
				'name'                  => 'dd.name',
				'size'                  => 'd.file_size',
				'total_downloads'       => 'd.total_downloads',
				'constraint'            => 'd.constraint',
				'downloaded'            => 'd.downloaded',
				'sort_order'            => 'd.sort_order',
				'date_added'            => 'd.date_added',
				'date_modified'         => 'd.date_modified',
				'type'                  => "IF(d.is_free, '" . $this->db->escape($this->language->get('text_free')) . "','" .$this->db->escape($this->language->get('text_regular')) . "')",
				'login'                 => "IF(d.login, '" . $this->db->escape($this->language->get('text_yes')) . "','" .$this->db->escape($this->language->get('text_no')) . "')",
				'status'                => "IF(d.status, '" . $this->db->escape($this->language->get('text_enabled')) . "','" .$this->db->escape($this->language->get('text_disabled')) . "')",
			);

			foreach ($_filters as $key => $value) {
				$filters['OR'][] = $value . " LIKE '%" . $this->db->escape($data["search"]) . "%'";
			}
		}

		$int_filters = array(
			'id'                => 'd.download_id',
			'size'              => 'd.file_size',
			'total_downloads'   => 'd.total_downloads',
			'constraint'         => 'd.constraint',
			'downloaded'        => 'd.downloaded',
			'sort_order'        => 'd.sort_order',
			'type'              => 'd.is_free',
			'login'             => 'd.login',
			'status'            => 'd.status',
			);

		foreach ($int_filters as $key => $value) {
			if (isset($data["filter"][$key]) && !is_null($data["filter"][$key])) {
				$filters['AND'][] = "$value = '" . (int)$data["filter"][$key] . "'";
			}
		}

		$date_filters = array(
			'date_added'        => 'd.date_added',
			'date_modified'     => 'd.date_modified',
			);

		foreach ($date_filters as $key => $value) {
			if (isset($data["filter"][$key]) && !is_null($data["filter"][$key])) {
				$filters['AND'][] = $this->db->escape($data["filter"][$key]);
			}
		}

		$anywhere_filters = array(
			'name'                  => 'dd.name',
			);

		foreach ($anywhere_filters as $key => $value) {
			if (!empty($data["filter"][$key])) {
				$filters['AND'][] = "$value LIKE '%" . $this->db->escape($data["filter"][$key]) . "%'";
			}
		}

		if (isset($data['filter']['tag'])) {
			if ($data['filter']['tag'] == '*') {
				$filters['AND'][] = "d2t2.download_tag_id IS NULL";
			} else {
				$filters['AND'][] = "d2t2.download_tag_id = '" . (int)$data['filter']['tag'] . "'";
			}
		}

		if (isset($data['filter']['related_products'])) {
			if ($data['filter']['related_products'] == '*') {
				$filters['AND'][] = "p2d2.product_id IS NULL";
			} else {
				$filters['AND'][] = "p2d2.product_id = '" . (int)$data['filter']['related_products'] . "'";
			}
		}

		if (isset($data['filter']['customer_group'])) {
			if ($data['filter']['customer_group'] == '*') {
				$filters['AND'][] = "(d2cg2.customer_group_id IS NULL OR d2cg2.customer_group_id = '0')";
			} else {
				$filters['AND'][] = "d2cg2.customer_group_id = '" . (int)$data['filter']['customer_group'] . "'";
			}
		}

		if ($filters['AND'] || $filters['OR']) {
			$sql .= " WHERE";

			if ($filters['OR']) {
				$sql .= " (" . implode(" OR ", $filters['OR']) . ")";
			}

			if ($filters['AND']) {
				$sql .= " " . implode(" AND ", $filters['AND']);
			}
		}

		$sql .= " GROUP BY d.download_id";

		$filters = array('AND' => array(), 'OR' => array());

		// Global search
		if (!empty($data['search']) && (in_array("tag", $columns) || in_array("customer_group", $columns) || in_array("related_products", $columns))) {
			$_filters = array(
				'id'                    => 'd.download_id',
				'name'                  => 'dd.name',
				'size'                  => 'd.file_size',
				'total_downloads'       => 'd.total_downloads',
				'constraint'            => 'd.constraint',
				'downloaded'            => 'd.downloaded',
				'sort_order'            => 'd.sort_order',
				'date_added'            => 'd.date_added',
				'date_modified'         => 'd.date_modified',
				'type'                  => 'type_text',
				'login'                 => 'login_text',
				'status'                => 'status_text',
				'tag'                   => "GROUP_CONCAT(DISTINCT dtd.name SEPARATOR ' ')",
				'customer_group'        => "GROUP_CONCAT(DISTINCT cgd.name SEPARATOR ' ')",
				'related_products'      => "GROUP_CONCAT(DISTINCT pd.name SEPARATOR ' ')",
			);

			foreach ($_filters as $key => $value) {
				if (in_array($key, $columns)) {
					$filters['OR'][] = $value . " LIKE '%" . $this->db->escape($data["search"]) . "%'";
				}
			}
		}

		if ($filters['AND'] || $filters['OR']) {
			$sql .= " HAVING";

			if ($filters['OR']) {
				$sql .= " (" . implode(" OR ", $filters['OR']) . ")";
			}

			if ($filters['AND']) {
				$sql .= " " . implode(" AND ", $filters['AND']);
			}
		}

		$sort_data = array(
			'd.download_id',
			'dd.name',
			'd.file_size',
			'd.total_downloads',
			'd.constraint',
			'd.downloaded',
			'd.sort_order',
			'd.is_free',
			'd.login',
			'd.date_added',
			'd.date_modified',
			'd.status',
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY dd.name";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

		if (isset($data['start']) && $data['start'] != '' || isset($data['limit']) && $data['limit'] != '') {
			if (!isset($data['start']) || $data['start'] < 0) {
				$data['start'] = 0;
			}

			if (!isset($data['limit']) || $data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$sql_hash = md5($sql);

		$downloads_data = $this->cache->get('pd.downloads.data.' . $sql_hash);

		if (!$downloads_data) {
			$query = $this->db->query($sql);

			$count = $this->db->query("SELECT FOUND_ROWS() AS count");
			self::$filteredCount = ($count->num_rows) ? (int)$count->row['count'] : 0;

			$downloads_data = array(
				"downloads" => $query->rows,
				"count"     => self::$filteredCount
			);

			$this->cache->set('pd.downloads.data.' . $sql_hash, $downloads_data);
		} else {
			self::$filteredCount = $downloads_data['count'];
		}

		return $downloads_data["downloads"];
	}

	public function getFilteredTotalDownloads() {
		return self::$filteredCount;
	}

	public function getUpdatedOrders() {
		return self::$updatedOrders;
	}

	public function getDownloadDescriptions($download_id) {
		$data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "download_description WHERE download_id = '" . (int)$download_id . "'");

		foreach ($query->rows as $result) {
			$data[$result['language_id']] = array('name' => html_entity_decode($result['name']));
		}

		return $data;
	}

	public function getTotalDownloads() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "download");

		return (int)$query->row['total'];
	}

	public function getTotalProductsByDownloadId($download_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product_to_download WHERE download_id = '" . (int)$download_id . "'");

		return (int)$query->row['total'];
	}

	public function getTotalOrdersByDownloadId($download_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM (SELECT op.order_id FROM " . DB_PREFIX . "order_product_download opd JOIN " . DB_PREFIX . "order_product op ON (op.order_product_id = opd.order_product_id) WHERE opd.download_id = '" . (int)$download_id . "' UNION SELECT oo.order_id FROM " . DB_PREFIX . "order_option_download ood JOIN " . DB_PREFIX . "order_option oo ON (oo.order_option_id = ood.order_option_id) WHERE ood.download_id = '" . (int)$download_id . "') AS tbl");

		return (int)$query->row['total'];
	}

	public function getDownloadRelatedProducts($download_id) {
		$data = array();

		$query = $this->db->query("SELECT p.model, pd.* FROM " . DB_PREFIX . "product_to_download p2d LEFT JOIN " . DB_PREFIX . "product_description pd ON (p2d.product_id = pd.product_id AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "') LEFT JOIN " . DB_PREFIX . "product p ON (p2d.product_id = p.product_id) WHERE p2d.download_id = '" . (int)$download_id . "'");

		foreach ($query->rows as $result) {
			$data[] = array(
				"product_id"   => $result['product_id'],
				"name"         => html_entity_decode($result['name']),
				"model"        => $result['model']
			);
		}

		return $data;
	}

	public function getDownloadCustomerGroups($download_id) {
		$data = array();

		$query = $this->db->query("SELECT customer_group_id FROM " . DB_PREFIX . "download_to_customer_group WHERE download_id = '" . (int)$download_id . "'");

		foreach ($query->rows as $result) {
			$data[] = $result['customer_group_id'];
		}

		return $data;
	}

	public function getDownloadTags($download_id) {
		$data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "download_to_tag WHERE download_id = '" . (int)$download_id . "'");

		foreach ($query->rows as $result) {
			$data[] = $result['download_tag_id'];
		}

		return $data;
	}

	public function getProducts($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		$filters = array();

		if (!empty($data['filter_name'])) {
			$filters[] = "pd.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}

		if (!empty($data['filter_model'])) {
			$filters[] = "p.model LIKE '" . $this->db->escape($data['filter_model']) . "%'";
		}

        if ($filters) {
            $sql .= " AND (" . implode(" OR ", $filters) . ")";
        }

		$sql .= " GROUP BY p.product_id";

		$sort_data = array(
			'pd.name',
			'p.model',
			'p.sort_order'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY pd.name";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ((int)$data['start'] < 0) {
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

	public function getDirectoryListing($dir='.', $exclude=array('cgi-bin', '.', '..')) {
		$exclude = array_flip($exclude);

		if (!is_dir($dir)) {
			return array();
		}

		$dh = @opendir($dir);

		if (!$dh) {
			return array();
		}

		$stack = array($dh);
		$dirs = array();
		$base = (stripos(strrev($dir), "/") === 0 || stripos(strrev($dir), "\\") === 0) ? $dir : $dir . "/";
		$path = array();
		array_push($path, ".");
		$dirs[$base] = implode("/", $path);

		while (count($stack)) {
			if (false !== ($file = readdir($stack[0]))) {
				if (!isset($exclude[$file])) {
					$d =  $base . implode("/", array_merge((array)$path, (array)$file));
					if (is_dir($d)) {
						array_push($path, $file);
						$dh = @opendir($d);
						if($dh) {
							$dirs[$d] = implode("/", $path);
							array_unshift($stack, $dh);
						}
					}
				}
			} else {
				closedir(array_shift($stack));
				array_pop($path);
			}
		}

		return $dirs;
	}

	public function getFileListing($dir='.', $extensions, $recursive, $discard_hashed_files=true, $exclude=array('cgi-bin', '.', '..', 'index.html', '.htaccess'), $format=2) {
		$exclude = array_flip($exclude);

		if (!is_dir($dir)) {
			return array();
		}

		$dh = @opendir($dir);

		if (!$dh) {
			return array();
		}

		$stack = array($dh);
		$files = array();
		$base = (stripos(strrev($dir), "/") === 0 || stripos(strrev($dir), "\\") === 0) ? $dir : $dir . "/";
		$path = array();

		while (count($stack)) {
			if (false !== ($file = readdir($stack[0]))) {
				if (!isset($exclude[utf8_strtolower($file)])) {
					$d =  $base . implode("/", array_merge((array)$path, (array)$file));
					if (is_dir($d) && $recursive) {
						array_push($path, $file);
						$dh = @opendir($d);
						if($dh) {
							array_unshift($stack, $dh);
						}
					} else if (!is_dir($d)){
						$ext = utf8_strtolower(pathinfo($file, PATHINFO_EXTENSION));
						// Among other checks try to discard already added downloads that have a 32-character md5 hash appended to their name if 'discard_hashed_files' is set
						if (is_readable($d) && (is_array($extensions) && in_array($ext, $extensions) || $extensions === false && (!$discard_hashed_files || $discard_hashed_files && strlen($ext) != 32))) {
							if ($format == 2) {
								$files[] = realpath($d);
							} elseif ($format == 1) {
								$files[] = str_replace("\\", "/", (strpos(realpath($d), realpath($dir)) === 0) ? substr(realpath($d), strlen(realpath($dir)) + 1) : $d);
							} else {
								$files[] = $file;
							}
						}
					}
				}
			} else {
				closedir(array_shift($stack));
				array_pop($path);
			}
		}

		return $files;
	}
}
