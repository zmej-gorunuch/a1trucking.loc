<?php
class ModelCatalogDownloadSample extends Model {
	protected static $filteredCount;
	protected static $hash;

	public function addDownloadSample($data) {
		// Create a proper unique download hash
		$hash = "";
		$hash_exists = false;
		$hash_chars = $this->config->get('pd_hash_chars');

		do {
			$hash = hash("sha256", $data['download'] . microtime());
			$hash = dec2base(base2dec($hash, 16), 62, $hash_chars ? $hash_chars : false);

			$query = $this->db->query("SELECT download_sample_id FROM " . DB_PREFIX . "download_sample WHERE hash = '" . $this->db->escape($hash) . "'");
			$hash_exists = $query->num_rows;
		} while ($hash_exists);

		$this->db->query("INSERT INTO " . DB_PREFIX . "download_sample SET hash = '" . $this->db->escape($hash) . "', download_id = '" . (int)$data['download_id'] . "', `constraint` = '" . (int)$data['constraint'] . "', remaining = '" . (int)$data['remaining'] . "', end_time = '" . $this->db->escape($data['end_time']) . "', store_id = '" . (int)$data['store_id'] . "', customer_id = " . ($data['customer_id'] ? "'" . (int)$data['customer_id'] . "'" : "NULL") . ", language_id = '" . (int)$data['language_id'] . "', name = '" . $this->db->escape($data['name']) . "', email = '" . $this->db->escape($data['email']) . "', date_added = UTC_TIMESTAMP(), date_modified = UTC_TIMESTAMP()");

		$download_sample_id = $this->db->getLastId();

		$this->cache->delete("pd.downloads.samples");

		$this->hash = $hash;

		return $download_sample_id;
	}

	public function editDownloadSample($download_sample_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "download_sample SET download_id = '" . (int)$data['download_id'] . "', `constraint` = '" . (int)$data['constraint'] . "', remaining = '" . (int)$data['remaining'] . "', end_time = '" . $this->db->escape($data['end_time']) . "', store_id = '" . (int)$data['store_id'] . "', customer_id = " . ($data['customer_id'] ? "'" . (int)$data['customer_id'] . "'" : "NULL") . ", language_id = '" . (int)$data['language_id'] . "', name = '" . $this->db->escape($data['name']) . "', email = '" . $this->db->escape($data['email']) . "', date_modified = UTC_TIMESTAMP() WHERE download_sample_id = '" . (int)$download_sample_id . "'");

		$this->cache->delete("pd.downloads.samples");
	}

	public function copyDownloadSample($download_sample_id) {
		$data = $this->getDownloadSample($download_sample_id);

		if (isset($data['download_sample_id'])) {
			return $this->addDownloadSample($data);
		}

		return null;
	}

	public function deleteDownloadSample($download_sample_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "download_sample WHERE download_sample_id = '" . (int)$download_sample_id . "'");

		$this->cache->delete("pd.downloads.samples");
	}

	public function getDownloadSample($download_sample_id) {
		$query = $this->db->query("SELECT DISTINCT ds.*, dd.name AS download, c.email AS customer_email, CONCAT(c.firstname, ' ', c.lastname) AS customer FROM " . DB_PREFIX . "download_sample ds LEFT JOIN " . DB_PREFIX . "download_description dd ON (ds.download_id = dd.download_id AND dd.language_id = '" . (int)$this->config->get('config_language_id') . "') LEFT JOIN " . DB_PREFIX . "customer c ON (ds.customer_id = c.customer_id) WHERE ds.download_sample_id = '" . (int)$download_sample_id . "'");

		return $query->row;
	}

	public function getDownloadSamples($data = array()) {
		$columns = isset($data['columns']) ? $data['columns'] : array();

		$sql = "SELECT SQL_CALC_FOUND_ROWS DISTINCT ds.*, dd.name AS download, ds.download_sample_id AS id, UTC_TIMESTAMP() AS now, d.filename, d.mask, d.date_added AS download_date_added, d.date_modified AS download_date_modified";

		if (in_array("constraint", $columns)) {
			$sql .= ", (CASE ds.constraint WHEN '0' THEN '" . $this->db->escape($this->language->get('text_quantitative')) . "' WHEN '1' THEN '" . $this->db->escape($this->language->get('text_temporal')) . "' ELSE '" . $this->db->escape($this->language->get('text_both')) . "' END) AS constraint_text";
		}

		if (in_array("status", $columns)) {
			$sql .= ", (CASE ds.constraint WHEN '0' THEN IF(ds.remaining > '0', '1', '0') WHEN '1' THEN IF(ds.end_time > UTC_TIMESTAMP(), '1', '0') ELSE IF(ds.remaining > 0 AND ds.end_time > UTC_TIMESTAMP(), '1', '0') END) AS status";
			$sql .= ", (CASE ds.constraint WHEN '0' THEN IF(ds.remaining > '0', '" . $this->db->escape($this->language->get('text_active')) . "', '" . $this->db->escape($this->language->get('text_expired')) . "') WHEN '1' THEN IF(ds.end_time > UTC_TIMESTAMP(), '" . $this->db->escape($this->language->get('text_active')) . "', '" . $this->db->escape($this->language->get('text_expired')) . "') ELSE IF(ds.remaining > 0 AND ds.end_time > UTC_TIMESTAMP(), '" . $this->db->escape($this->language->get('text_active')) . "', '" . $this->db->escape($this->language->get('text_expired')) . "') END) AS status_text";
		}

		if (in_array("tag", $columns)) {
			$sql .= ", GROUP_CONCAT(DISTINCT dtd.name ORDER BY dtd.name SEPARATOR ', ') AS tag_text, GROUP_CONCAT(DISTINCT dtd.download_tag_id ORDER BY dtd.name SEPARATOR '_') AS tag, COUNT(DISTINCT d2t.download_tag_id) AS tag_count";
		}

		if (in_array("store", $columns)) {
			$sql .= ", IF(ds.store_id != '0', s.name, '" . $this->config->get('config_name') . "') AS store";
		}

		$sql .= " FROM " . DB_PREFIX . "download_sample ds LEFT JOIN " . DB_PREFIX . "download d ON (ds.download_id = d.download_id) LEFT JOIN " . DB_PREFIX . "download_description dd ON (ds.download_id = dd.download_id AND dd.language_id = '" . (int)$this->config->get('config_language_id') . "')";

		if (in_array("tag", $columns)) {
			$sql .= " LEFT JOIN " . DB_PREFIX . "download_to_tag d2t ON (ds.download_id = d2t.download_id) LEFT JOIN " . DB_PREFIX . "download_tag_description dtd ON (d2t.download_tag_id = dtd.download_tag_id AND dtd.language_id = '" . (int)$this->config->get('config_language_id') . "')";
			$sql .= " LEFT JOIN " . DB_PREFIX . "download_to_tag d2t2 ON (ds.download_id = d2t2.download_id)";
		}

		if (in_array("store", $columns)) {
			$sql .= " LEFT JOIN " . DB_PREFIX . "store s ON (ds.store_id = s.store_id)";
		}

		$filters = array('AND' => array(), 'OR' => array());

		// Global search
		if (!empty($data['search']) && !in_array("tag", $columns)) {
			$_filters = array(
				'id'                    => 'ds.download_sample_id',
				'download'              => 'dd.name',
				'remaining'             => 'ds.remaining',
				'end_time'              => 'ds.end_time',
				'name'                  => 'ds.name',
				'email'                 => 'ds.email',
				'store'                 => 's.name',
				'last_accessed'         => 'ds.last_accessed',
				'date_added'            => 'ds.date_added',
				'date_modified'         => 'ds.date_modified',
				'constraint'            => "CASE ds.constraint WHEN '0' THEN '" . $this->db->escape($this->language->get('text_quantitative')) . "' WHEN '1' THEN '" . $this->db->escape($this->language->get('text_temporal')) . "' ELSE '" . $this->db->escape($this->language->get('text_both')) . "' END",
				'status'                => "CASE ds.constraint WHEN '0' THEN IF(ds.remaining > '0', '" . $this->db->escape($this->language->get('text_active')) . "', '" . $this->db->escape($this->language->get('text_expired')) . "') WHEN '1' THEN IF(ds.end_time > UTC_TIMESTAMP(), '" . $this->db->escape($this->language->get('text_active')) . "', '" . $this->db->escape($this->language->get('text_expired')) . "') ELSE IF(ds.remaining > 0 AND ds.end_time > UTC_TIMESTAMP(), '" . $this->db->escape($this->language->get('text_active')) . "', '" . $this->db->escape($this->language->get('text_expired')) . "') END",
			);

			foreach ($_filters as $key => $value) {
				$filters['OR'][] = $value . " LIKE '%" . $this->db->escape($data["search"]) . "%'";
			}
		}

		$int_filters = array(
			'id'                => 'ds.download_sample_id',
			'store'             => 'ds.store_id',
			'constraint'        => 'ds.constraint',
			'remaining'         => 'ds.remaining',
			);

		foreach ($int_filters as $key => $value) {
			if (isset($data["filter"][$key]) && !is_null($data["filter"][$key])) {
				$filters['AND'][] = "$value = '" . (int)$data["filter"][$key] . "'";
			}
		}

		$date_filters = array(
			'end_time'          => 'ds.end_time',
			'last_accessed'     => 'ds.last_accessed',
			'date_added'        => 'ds.date_added',
			'date_modified'     => 'ds.date_modified',
			);

		foreach ($date_filters as $key => $value) {
			if (isset($data["filter"][$key]) && !is_null($data["filter"][$key])) {
				$filters['AND'][] = $this->db->escape($data["filter"][$key]);
			}
		}

		$anywhere_filters = array(
			'download'              => 'dd.name',
			'name'                  => 'ds.name',
			'email'                 => 'ds.email',
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

		if ($filters['AND'] || $filters['OR']) {
			$sql .= " WHERE";

			if ($filters['OR']) {
				$sql .= " (" . implode(" OR ", $filters['OR']) . ")";
			}

			if ($filters['AND']) {
				$sql .= " " . implode(" AND ", $filters['AND']);
			}
		}

		$sql .= " GROUP BY ds.download_sample_id";

		$filters = array('AND' => array(), 'OR' => array());

		// Global search
		if (!empty($data['search']) && (in_array("tag", $columns))) {
			$_filters = array(
				'id'                    => 'ds.download_sample_id',
				'download'              => 'dd.name',
				'remaining'             => 'ds.remaining',
				'end_time'              => 'ds.end_time',
				'name'                  => 'ds.name',
				'email'                 => 'ds.email',
				'store'                 => 'store',
				'last_accessed'         => 'ds.last_accessed',
				'date_added'            => 'ds.date_added',
				'date_modified'         => 'ds.date_modified',
				'constraint'            => 'constraint_text',
				'status'                => 'status_text',
				'tag'                   => "GROUP_CONCAT(DISTINCT dtd.name SEPARATOR ' ')",
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
			'ds.download_sample_id',
			'dd.name',
			'ds.remaining',
			'ds.end_time',
			'ds.name',
			's.name',
			'ds.email',
			'ds.last_accessed',
			'ds.date_added',
			'ds.date_modified',
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

		$downloads_data = $this->cache->get('pd.downloads.samples.data.' . $sql_hash);

		if (!$downloads_data) {
			$query = $this->db->query($sql);

			$count = $this->db->query("SELECT FOUND_ROWS() AS count");
			$this->filteredCount = ($count->num_rows) ? (int)$count->row['count'] : 0;

			$downloads_data = array(
				"downloads" => $query->rows,
				"count"     => $this->filteredCount
			);

			$this->cache->set('pd.downloads.samples.data.' . $sql_hash, $downloads_data);
		} else {
			$this->filteredCount = $downloads_data['count'];
		}

		return $downloads_data["downloads"];
	}

	public function getFilteredTotalDownloadSamples() {
		return $this->filteredCount;
	}

	public function getDownloadHash() {
		return $this->hash;
	}

	public function getTotalDownloadSamples() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "download_sample");

		return (int)$query->row['total'];
	}
}
