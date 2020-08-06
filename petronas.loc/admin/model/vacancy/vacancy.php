<?php
class ModelSalonsSalons extends Model {
	
	public function addSalon($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "salons SET status = '" . (int)$data['status'] . "',
		latitude ='".$this->db->escape($data['latitude']) ."', longitude='" . $this->db->escape($data['longitude'])."', 
		city_id='".(int)$data['city_id']."', sort_order = '".(int)$data['sort_order']."', country_id = '".(int)$data['country_id']."'");
		
		$salon_id = $this->db->getLastId();
		
		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "salons SET image = '" . $this->db->escape($data['image']) . "' WHERE salon_id = '" . (int)$salon_id . "'");
		}
		
		if ($data['sort_order'] < 1) {
			$this->db->query("UPDATE " . DB_PREFIX . "salons SET sort_order = '1' WHERE salon_id = '" . (int)$salon_id . "'");
		}
		
		if (isset($data['trend'])) {
			foreach ($data['trend'] as $trend_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "salons_to_trend SET salon_id = '" . (int)$salon_id . "', trend_id = '" . (int)$trend_id . "'");
			}
		}
		
		foreach ($data['salon_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "salons_description SET salon_id = '" . (int)$salon_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "', address = '" . $this->db->escape($value['address'])."'");
		}
	}

	public function editSalon($salon_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "salons SET status = '" . (int)$data['status'] . "',
		latitude ='".$this->db->escape($data['latitude']) ."', longitude='" . $this->db->escape($data['longitude'])."', 
		city_id='".(int)$data['city_id']."', sort_order = '".(int)$data['sort_order']."', country_id = '".(int)$data['country_id']."' WHERE salon_id = '" . (int)$salon_id . "'");
		
		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "salons SET image = '" . $this->db->escape($data['image']) . "' WHERE salon_id = '" . (int)$salon_id . "'");
		}
		
		if ($data['sort_order'] < 1) {
			$this->db->query("UPDATE " . DB_PREFIX . "salons SET sort_order = '1' WHERE salon_id = '" . (int)$salon_id . "'");
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "salons_to_trend WHERE salon_id = '" . (int)$salon_id . "'");

		if (isset($data['trend'])) {
			foreach ($data['trend'] as $trend_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "salons_to_trend SET salon_id = '" . (int)$salon_id . "', trend_id = '" . (int)$trend_id . "'");
			}
		}
		
		if ($salon_id == 54) {
			$this->db->query("UPDATE " . DB_PREFIX . "salons SET sort_order = '0' WHERE salon_id = '" . (int)$salon_id . "'");
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "salons_description WHERE salon_id = '" . (int)$salon_id . "'");

		foreach ($data['salon_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "salons_description SET salon_id = '" . (int)$salon_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "', address = '" . $this->db->escape($value['address'])."'");
		}
	}
	
	public function getSalon($salon_id) {
		$query = $this->db->query("SELECT DISTINCT *  FROM " . DB_PREFIX . "salons s LEFT JOIN " . DB_PREFIX . "salons_description sd ON (s.salon_id = sd.salon_id) WHERE s.salon_id = '" . (int)$salon_id . "'");
		return $query->row;
	}
	
	public function getSalonDescriptions($salon_id) {
		$salon_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "salons_description WHERE salon_id = '" . (int)$salon_id . "'");

		foreach ($query->rows as $result) {
			$salon_description_data[$result['language_id']] = array(
				'name'             => $result['name'],
				'description'      => $result['description'],
				'address'          => $result['address']
			);
		}

		return $salon_description_data;
	}

	public function getSalons($data = array()) {
		
			$sql = "SELECT DISTINCT *, sd.name as salon, td.name as town, cd.name as country FROM " . DB_PREFIX . "salons s LEFT JOIN " . DB_PREFIX . "salons_description sd ON (s.salon_id = sd.salon_id) LEFT JOIN " . DB_PREFIX . "salons_city_description td ON (s.city_id = td.city_id) LEFT JOIN " . DB_PREFIX . "salons_country_description cd ON (s.country_id = cd.country_id)";
			
			if (!empty($data['filter_trend'])) {
				$sql .= " LEFT JOIN " . DB_PREFIX . "salons_to_trend s2t ON (s.salon_id = s2t.salon_id)";
			}
					
			$sql .= " WHERE sd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND td.language_id = '" . (int)$this->config->get('config_language_id') . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "'";
            

		if (!empty($data['filter_name'])) {
			$sql .= " AND sd.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}

		if (!empty($data['filter_town'])) {
			$sql .= " AND s.city_id ='" . (int)$data['filter_town'] . "'";
		}
		
		if (!empty($data['filter_country'])) {
			$sql .= " AND s.country_id ='" . (int)$data['filter_country'] . "'";
		}

		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND s.status = '" . (int)$data['filter_status'] . "'";
		}


		if (!empty($data['filter_trend'])) {
			$sql .= " AND s2t.trend_id = '" . (int)$data['filter_trend'] . "'";
			
		}
            
		$sql .= " GROUP BY s.salon_id";

		$sort_data = array(
			'sd.name',
			'td.name',
			'cd.name',
			's.status'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY sd.name";
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
	
	public function getTotalSalons($data = array()) {
		
			$sql = "SELECT COUNT(DISTINCT s.salon_id) AS total FROM " . DB_PREFIX . "salons s LEFT JOIN " . DB_PREFIX . "salons_description sd ON (s.salon_id = sd.salon_id)";
			
			if (!empty($data['filter_trend'])) {
				$sql .= " LEFT JOIN " . DB_PREFIX . "salons_to_trend s2t ON (s.salon_id = s2t.salon_id)";
			}
					
			$sql .= " WHERE sd.language_id = '" . (int)$this->config->get('config_language_id') . "'";
            

		if (!empty($data['filter_name'])) {
			$sql .= " AND sd.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}

		if (!empty($data['filter_town'])) {
			$sql .= " AND s.city_id ='" . (int)$data['filter_town'] . "'";
		}
		
		if (!empty($data['filter_country'])) {
			$sql .= " AND s.country_id ='" . (int)$data['filter_country'] . "'";
		}

		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND s.status = '" . (int)$data['filter_status'] . "'";
		}


		if (!empty($data['filter_trend'])) {
			$sql .= " AND s2t.trend_id = '" . (int)$data['filter_trend'] . "'";
			
		}
            
		$query = $this->db->query($sql);

		return $query->row['total'];
	}
	
	

	public function deleteSalon($salon_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "salons WHERE salon_id = '" . (int)$salon_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "salons_description WHERE salon_id = '" . (int)$salon_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "salons_to_trend WHERE salon_id = '" . (int)$salon_id . "'");
	}
	
	public function addTrend($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "salons_trend SET status = '" . (int)$data['status'] . "'");
		
		$trend_id = $this->db->getLastId();
		
		foreach ($data['trend_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "salons_trend_description SET trend_id = '" . (int)$trend_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
		}
	}

	public function editTrend($trend_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "salons_trend SET status = '" . (int)$data['status'] . "' WHERE trend_id = '" . (int)$trend_id . "'");
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "salons_trend_description WHERE trend_id = '" . (int)$trend_id . "'");
		
		foreach ($data['trend_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "salons_trend_description SET trend_id = '" . (int)$trend_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
		}
	}

	public function deleteTrend($trend_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "salons_trend WHERE trend_id = '" . (int)$trend_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "salons_trend_description WHERE trend_id = '" . (int)$trend_id . "'");
	}

	public function getTrend($trend_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "salons_trend st LEFT JOIN " . DB_PREFIX . "salons_trend_description td ON (st.trend_id = td.trend_id) WHERE st.trend_id = '" . (int)$trend_id . "'");
		return $query->row;
	}
	
	public function getTrendDescriptions($trend_id) {
		$trend_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "salons_trend_description WHERE trend_id = '" . (int)$trend_id . "'");

		foreach ($query->rows as $result) {
			$trend_description_data[$result['language_id']] = array(
				'name'             => $result['name']
			);
		}

		return $trend_description_data;
	}
	
	public function getTrends($data = array()) {
		if ($data) {
			$sql = "SELECT * FROM " . DB_PREFIX . "salons_trend t LEFT JOIN " . DB_PREFIX . "salons_trend_description td ON (t.trend_id = td.trend_id)";
			$sql .= " WHERE td.language_id = '" . (int)$this->config->get('config_language_id') . "'";
			$sql .= " ORDER BY td.name";
			

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
		} else {
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "salons_trend t LEFT JOIN " . DB_PREFIX . "salons_trend_description td ON (t.trend_id = td.trend_id) WHERE td.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY td.name ASC");

			$trend_data = $query->rows;

			return $trend_data;
		}
	}

	public function getTotalTrends() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "salons_trend");

		return $query->row['total'];
	}
	
	public function getSalonTrends($salon_id){
				
		$salon_trend_data = array();

		$query = $this->db->query("SELECT trend_id FROM " . DB_PREFIX . "salons_to_trend WHERE salon_id=".(int)$salon_id);
		
		foreach ($query->rows as $result) {
			$salon_trend_data[] = $result['trend_id'];
		}

		return $salon_trend_data;
		
	}
	
	
	public function addCountry($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "salons_country SET status = '" . (int)$data['status'] . "'");
		
		$country_id = $this->db->getLastId();
		
		foreach ($data['country_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "salons_country_description SET country_id = '" . (int)$country_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
		}
	}

	public function editCountry($country_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "salons_country SET status = '" . (int)$data['status'] . "' WHERE country_id = '" . (int)$country_id . "'");
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "salons_country_description WHERE country_id = '" . (int)$country_id . "'");
		
		foreach ($data['country_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "salons_country_description SET country_id = '" . (int)$country_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
		}
	}

	public function deleteCountry($country_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "salons_country WHERE country_id = '" . (int)$country_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "salons_country_description WHERE country_id = '" . (int)$country_id . "'");
	}

	public function getCountry($country_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "salons_country c LEFT JOIN " . DB_PREFIX . "salons_country_description cd ON (c.country_id = cd.country_id) WHERE c.country_id = '" . (int)$country_id . "'");
		return $query->row;
	}

	public function getCountries($data = array()) {
		if ($data) {
			$sql = "SELECT DISTINCT * FROM " . DB_PREFIX . "salons_country c LEFT JOIN " . DB_PREFIX . "salons_country_description cd ON (c.country_id = cd.country_id)";
			
			$sql .= " WHERE cd.language_id = '" . (int)$this->config->get('config_language_id') . "'";
			if (isset($data['sort'])) {
				$sql .= " ORDER BY " . $data['sort'];
			} else {
				$sql .= " ORDER BY cd.name";
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
		} else {
			$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "salons_country c LEFT JOIN " . DB_PREFIX . "salons_country_description cd ON (c.country_id = cd.country_id) WHERE cd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY c.country_id ASC");

			$country_data = $query->rows;

			return $country_data;
		}
	}

	public function getCountryDescriptions($country_id) {
		$country_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "salons_country_description WHERE country_id = '" . (int)$country_id . "'");

		foreach ($query->rows as $result) {
			$country_description_data[$result['language_id']] = array(
				'name'             => $result['name']
			);
		}

		return $country_description_data;
	}
	
	
	public function getTotalCountries() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "salons_country");

		return $query->row['total'];
	}
	
	public function addCity($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "salons_city SET status = '" . (int)$data['status'] . "', country_id = '" . (int)$data['country_id'] . "'");
		$city_id = $this->db->getLastId();
		
		foreach ($data['city_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "salons_city_description SET city_id = '" . (int)$city_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
		}
		$this->cache->delete('salons_city.' . (int)$data['country_id']);
	}

	public function editCity($city_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "salons_city SET status = '" . (int)$data['status'] . "', country_id = '" . (int)$data['country_id'] . "' WHERE city_id = '" . (int)$city_id . "'");
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "salons_city_description WHERE city_id = '" . (int)$city_id . "'");
		foreach ($data['city_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "salons_city_description SET city_id = '" . (int)$city_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
		}
		
		$this->cache->delete('salons_city.' . (int)$data['country_id']);
	}
	
	public function getCityDescriptions($city_id) {
		$city_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "salons_city_description WHERE city_id = '" . (int)$city_id . "'");

		foreach ($query->rows as $result) {
			$city_description_data[$result['language_id']] = array(
				'name'             => $result['name']
			);
		}

		return $city_description_data;
	}

	public function deleteCity($city_id,$country_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "salons_city WHERE city_id = '" . (int)$city_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "salons_city_description WHERE city_id = '" . (int)$city_id . "'");
		$this->cache->delete('salons_city.' . (int)$country_id);
	}

	public function getCity($city_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "salons_city c LEFT JOIN " . DB_PREFIX . "salons_city_description cd ON (c.city_id = cd.city_id) WHERE c.city_id = '" . (int)$city_id . "'");
		return $query->row;
	}

	public function getCities($data = array()) {
		$sql = "SELECT *, td.name, cd.name AS country FROM " . DB_PREFIX . "salons_city t LEFT JOIN " . DB_PREFIX . "salons_country_description cd ON (t.country_id = cd.country_id) LEFT JOIN " . DB_PREFIX . "salons_city_description td ON (t.city_id = td.city_id)";
		
		$sql .= " WHERE td.language_id = '" . (int)$this->config->get('config_language_id') . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "'";
		
		$sort_data = array(
			'cd.name',
			'td.name'
		);
		
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY cd.name";
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

	public function getCitiesByCountryId($country_id) {
		$city_data = $this->cache->get('salons_city.' . (int)$country_id);

		if (!$city_data) {
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "salons_city c LEFT JOIN " . DB_PREFIX . "salons_city_description cd ON (c.city_id = cd.city_id) WHERE c.country_id = '" . (int)$country_id . "' AND c.status = '1' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY cd.name");

			$city_data = $query->rows;

			$this->cache->set('salons_city.' . (int)$country_id, $city_data);
		}

		return $city_data;
	}

	public function getTotalCities() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "salons_city");

		return $query->row['total'];
	}

	public function getTotalCitiesByCountryId($country_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "salons_city WHERE country_id = '" . (int)$country_id . "'");

		return $query->row['total'];
	}
	
	public function getTotalCitiesByCityId($city_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "salons_city WHERE city_id = '" . (int)$city_id . "'");

		return $query->row['total'];
	}
	
	public function getTotalSalonsByTrendId($trend_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "salons_to_trend WHERE trend_id_id = '" . (int)$trend_id . "'");

		return $query->row['total'];
	}
}