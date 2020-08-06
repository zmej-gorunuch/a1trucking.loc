<?php
class ModelSalonsSalons extends Model {
	

	public function getSalons($data = array()) {
		
			$sql = "SELECT DISTINCT *, rand() as r  FROM " . DB_PREFIX . "salons s LEFT JOIN " . DB_PREFIX . "salons_description sd ON (s.salon_id = sd.salon_id)";
			
			if (!empty($data['filter_trend'])) {
				$sql .= " LEFT JOIN " . DB_PREFIX . "salons_to_trend s2t ON (s.salon_id = s2t.salon_id)";
			}
					
			$sql .= " WHERE s.status='1' AND sd.language_id = '" . (int)$this->config->get('config_language_id') . "'";
            


		if (!empty($data['filter_town'])) {
			$sql .= " AND s.city_id ='" . (int)$data['filter_town'] . "'";
		}
		
		if (!empty($data['filter_country'])) {
			$sql .= " AND s.country_id ='" . (int)$data['filter_country'] . "'";
		}

		

		if (!empty($data['filter_trend'])) {
			$sql .= " AND s2t.trend_id = '" . (int)$data['filter_trend'] . "'";
			
		}
            
		$sql .= " GROUP BY s.sort_order ASC,r";

		

		$query = $this->db->query($sql);

		return $query->rows;
	}
	
	
	public function getTrends() {
		
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "salons_trend t LEFT JOIN " . DB_PREFIX . "salons_trend_description td ON (t.trend_id = td.trend_id) WHERE td.language_id = '" . (int)$this->config->get('config_language_id') . "' AND t.status='1' ORDER BY td.name ASC");

			$trend_data = $query->rows;

			return $trend_data;
		
	}


	public function getCountries($data = array()) {
		
			$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "salons_country c LEFT JOIN " . DB_PREFIX . "salons_country_description cd ON (c.country_id = cd.country_id) WHERE cd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c.status='1' ORDER BY cd.name ASC");

			$country_data = $query->rows;

			return $country_data;
		
	}

	public function getCountry($country_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "salons_country c LEFT JOIN " . DB_PREFIX . "salons_country_description cd ON (c.country_id = cd.country_id) WHERE c.status='1' AND c.country_id = '" . (int)$country_id . "'");
		return $query->row;
	}
	
	public function getCitiesByCountryId($country_id) {
		$city_data = $this->cache->get('salons_city.' . (int)$country_id.'.'.(int)$this->config->get('config_language_id'));

		if (!$city_data) {
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "salons_city c LEFT JOIN " . DB_PREFIX . "salons_city_description cd ON (c.city_id = cd.city_id) WHERE c.country_id = '" . (int)$country_id . "' AND c.status = '1' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY cd.name COLLATE  utf8_unicode_ci");

			$city_data = $query->rows;

			$this->cache->set('salons_city.' . (int)$country_id.'.'.(int)$this->config->get('config_language_id'), $city_data);
		}

		return $city_data;
	}
	public function getCities($data = array()) {

			$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "salons_city c LEFT JOIN " . DB_PREFIX . "salons_city_description cd ON (c.city_id = cd.city_id) WHERE c.status = '1' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

			$cities_data = $query->rows;

			// $this->cache->set('salons_city.' . (int)$country_id.'.'.(int)$this->config->get('config_language_id'), $city_data);

		return $cities_data;
	}

	
}