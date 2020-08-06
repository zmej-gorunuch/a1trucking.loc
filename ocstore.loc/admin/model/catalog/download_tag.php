<?php
class ModelCatalogDownloadTag extends Model {
	protected static $filteredCount;

	public function addDownloadTag($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "download_tag SET sort_order = '" . (int)$data['sort_order'] . "', administrative = '" . (isset($data['administrative']) ? (int)$data['administrative'] : 0) . "'");

		$download_tag_id = $this->db->getLastId();

		foreach ($data['descriptions'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "download_tag_description SET download_tag_id = '" . (int)$download_tag_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
		}

		if (isset($data['link_to']) && (int)$data['link_to'] == 1) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "download_to_tag (download_tag_id, download_id) SELECT '" . (int)$download_tag_id . "', download_id FROM " . DB_PREFIX . "download");
		} else {
			if (isset($data['related_downloads'])) {
				foreach ((array)$data['related_downloads'] as $download) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "download_to_tag SET download_tag_id = '" . (int)$download_tag_id . "', download_id = '" . (int)$download['download_id'] . "'");
				}
			}
		}

		$this->cache->delete("pd.tags");

		return $download_tag_id;
	}

	public function editDownloadTag($download_tag_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "download_tag SET sort_order = '" . (int)$data['sort_order'] . "', administrative = '" . (isset($data['administrative']) ? (int)$data['administrative'] : 0) . "' WHERE download_tag_id = '" . (int)$download_tag_id . "'");

		$this->db->query("DELETE FROM " . DB_PREFIX . "download_tag_description WHERE download_tag_id = '" . (int)$download_tag_id . "'");

		foreach ($data['descriptions'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "download_tag_description SET download_tag_id = '" . (int)$download_tag_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "download_to_tag WHERE download_tag_id = '" . (int)$download_tag_id . "'");

		if (isset($data['link_to']) && (int)$data['link_to'] == 1) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "download_to_tag (download_tag_id, download_id) SELECT '" . (int)$download_tag_id . "', download_id FROM " . DB_PREFIX . "download");
		} else {
			if (isset($data['related_downloads'])) {
				foreach ((array)$data['related_downloads'] as $download) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "download_to_tag SET download_tag_id = '" . (int)$download_tag_id . "', download_id = '" . (int)$download['download_id'] . "'");
				}
			}
		}

		$this->cache->delete("pd.tags");
	}

	public function copyDownloadTag($download_tag_id) {
		$data = $this->getDownloadTag($download_tag_id);

		if (isset($data['download_tag_id'])) {
			$data = array_merge($data, array('descriptions' => $this->getDownloadTagDescriptions($download_tag_id),
											 'related_downloads' => $this->getDownloadTagRelatedDownloads($download_tag_id)));

			$this->cache->delete('pd.tags');

			return $this->addDownloadTag($data);
		}

		return null;
	}

	public function deleteDownloadTag($download_tag_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "download_tag WHERE download_tag_id = '" . (int)$download_tag_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "download_tag_description WHERE download_tag_id = '" . (int)$download_tag_id . "'");

		$this->cache->delete("pd.tags");
	}

	public function getDownloadTag($download_tag_id) {
		$query = $this->db->query("SELECT dt.*, dtd.name FROM " . DB_PREFIX . "download_tag dt JOIN " . DB_PREFIX . "download_tag_description dtd ON (dt.download_tag_id = dtd.download_tag_id AND dtd.language_id = '" . (int)$this->config->get('config_language_id') . "') WHERE dt.download_tag_id = '" . (int)$download_tag_id . "'");

		return $query->row;
	}

	public function getDownloadTagByName($download_tag_name) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "download_tag dt JOIN " . DB_PREFIX . "download_tag_description dtd ON (dt.download_tag_id = dtd.download_tag_id AND language_id = '" . (int)$this->config->get('config_language_id') . "') WHERE dtd.name = '" . $this->db->escape($download_tag_name) . "'");

		if ($query->num_rows)
			return $query->row;
		else
			return null;
	}

	public function getDownloadTags($data = array()) {
		$columns = isset($data['columns']) ? $data['columns'] : array();

		$sql = "SELECT SQL_CALC_FOUND_ROWS dt.*, dtd.name";

		if (in_array("administrative", $columns)) {
			$sql .= ", IF(dt.administrative, '" . $this->db->escape($this->language->get('text_yes')) . "','" .$this->db->escape($this->language->get('text_no')) . "') AS administrative_text";
		}

		if (in_array("related_downloads", $columns)) {
			$sql .= ", GROUP_CONCAT(DISTINCT dd.name ORDER BY dd.name SEPARATOR '<br/>') AS related_downloads_text, GROUP_CONCAT(DISTINCT dd.download_id ORDER BY dd.name SEPARATOR '_') AS related_downloads, COUNT(DISTINCT d2t.download_id) AS related_downloads_count";
		}

		$sql .= " FROM " . DB_PREFIX . "download_tag dt LEFT JOIN " . DB_PREFIX . "download_tag_description dtd ON (dt.download_tag_id = dtd.download_tag_id AND dtd.language_id = '" . (int)$this->config->get('config_language_id') . "')";

		if (in_array("related_downloads", $columns)) {
			$sql .= " LEFT JOIN " . DB_PREFIX . "download_to_tag d2t ON (dt.download_tag_id = d2t.download_tag_id) LEFT JOIN " . DB_PREFIX . "download_description dd ON (dd.download_id = d2t.download_id AND dd.language_id = '" . (int)$this->config->get('config_language_id') . "')";
			$sql .= " LEFT JOIN " . DB_PREFIX . "download_to_tag d2t2 ON (dt.download_tag_id = d2t2.download_tag_id)";
		}

		$filters = array('AND' => array(), 'OR' => array());

		// Global search
		if (!empty($data['search']) && !in_array("related_downloads", $columns)) {
			$_filters = array(
				'id'                    => 'dt.download_tag_id',
				'name'                  => 'dtd.name',
				'administrative'        => "IF(dt.administrative, '" . $this->db->escape($this->language->get('text_yes')) . "','" .$this->db->escape($this->language->get('text_no')) . "')",
				'sort_order'            => 'dt.sort_order',
			);

			foreach ($_filters as $key => $value) {
				$filters['OR'][] = $value . " LIKE '%" . $this->db->escape($data["search"]) . "%'";
			}
		}

		$int_filters = array(
			'id'                => 'dt.download_tag_id',
			'administrative'    => 'dt.administrative',
			'sort_order'        => 'dt.sort_order',
			);

		foreach ($int_filters as $key => $value) {
			if (isset($data["filter"][$key]) && !is_null($data["filter"][$key])) {
				$filters['AND'][] = "$value = '" . (int)$data["filter"][$key] . "'";
			}
		}

		$anywhere_filters = array(
			'name'                  => 'dtd.name',
			);

		foreach ($anywhere_filters as $key => $value) {
			if (!empty($data["filter"][$key])) {
				$filters['AND'][] = "$value LIKE '%" . $this->db->escape($data["filter"][$key]) . "%'";
			}
		}

		if (isset($data['filter']['related_downloads'])) {
			if ($data['filter']['related_downloads'] == '*') {
				$filters['AND'][] = "d2t2.download_id IS NULL";
			} else {
				$filters['AND'][] = "d2t2.download_id = '" . (int)$data['filter']['related_downloads'] . "'";
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

		$sql .= " GROUP BY dt.download_tag_id";

		$filters = array('AND' => array(), 'OR' => array());

		// Global search
		if (!empty($data['search']) && (in_array("related_downloads", $columns))) {
			$_filters = array(
				'id'                    => 'dt.download_tag_id',
				'name'                  => 'dtd.name',
				'administrative'        => 'administrative_text',
				'sort_order'            => 'dt.sort_order',
				'related_downloads'     => "GROUP_CONCAT(DISTINCT dd.name SEPARATOR ' ')",
			);

			foreach ($_filters as $key => $value) {
				$filters['OR'][] = $value . " LIKE '%" . $this->db->escape($data["search"]) . "%'";
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
			'dtd.name',
			'administrative',
			'sort_order',
			'related_downloads_count',
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY dtd.name";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

		if (isset($data['start']) && $data['start'] != '' || isset($data['limit']) && $data['limit'] != '') {
			if (!isset($data['start']) || (int)$data['start'] < 0) {
				$data['start'] = 0;
			}

			if (!isset($data['limit']) || $data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$sql_hash = md5($sql);

		$download_tags_data = $this->cache->get('pd.tags.data.' . $sql_hash);

		if (!$download_tags_data) {
			$query = $this->db->query($sql);

			$count = $this->db->query("SELECT FOUND_ROWS() AS count");
			$this->filteredCount = ($count->num_rows) ? (int)$count->row['count'] : 0;

			$download_tags_data = array(
				"download_tags" => $query->rows,
				"count"         => $this->filteredCount
			);

			$this->cache->set('pd.tags.data.' . $sql_hash, $download_tags_data);
		} else {
			$this->filteredCount = $download_tags_data['count'];
		}

		return $download_tags_data["download_tags"];
	}

	public function getFilteredTotalDownloadTags() {
		return $this->filteredCount;
	}

	public function getDownloadTagDescriptions($download_tag_id) {
		$download_tag_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "download_tag_description WHERE download_tag_id = '" . (int)$download_tag_id . "'");

		foreach ($query->rows as $result) {
			$download_tag_data[$result['language_id']] = array('name' => html_entity_decode($result['name']));
		}

		return $download_tag_data;
	}

	public function getDownloadTagRelatedDownloads($download_tag_id) {
		$linked_download_data = array();

		$query = $this->db->query("SELECT dd.* FROM " . DB_PREFIX . "download_to_tag d2t LEFT JOIN " . DB_PREFIX . "download_description dd ON (d2t.download_id = dd.download_id AND dd.language_id = '" . (int)$this->config->get('config_language_id') . "') WHERE d2t.download_tag_id = '" . (int)$download_tag_id . "'");

		foreach ($query->rows as $result) {
			$linked_download_data[] = array(
				"download_id"   => $result['download_id'],
				"name"          => html_entity_decode($result['name'])
			);
		}

		return $linked_download_data;
	}

	public function getTotalDownloadTags() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "download_tag");

		return (int)$query->row['total'];
	}

	public function getTotalDownloadsByDownloadTagId($download_tag_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "download_to_tag WHERE download_tag_id = '" . (int)$download_tag_id . "'");

		return (int)$query->row['total'];
	}
}
