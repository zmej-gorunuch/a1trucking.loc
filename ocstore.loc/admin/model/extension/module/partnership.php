<?php

class ModelExtensionModulePartnership extends Model {
	
	public function getTotalPartnership( $data = [] ) {
		
		$sql = "SELECT COUNT(DISTINCT f.id) AS total FROM " . DB_PREFIX . "partnership p LEFT JOIN " . DB_PREFIX . "partnership_description pd ON (p.id = pd.partnership_id)";
		
		$sql .= " WHERE pd.language_id = '" . (int) $this->config->get( 'config_language_id' ) . "'";
		
		if ( isset( $data['filter_status'] ) && ! is_null( $data['filter_status'] ) ) {
			$sql .= " AND p.status = '" . (int) $data['filter_status'] . "'";
		}
		
		$query = $this->db->query( $sql );
		
		return $query->row['total'];
	}
	
	public function getPartnerships( $data = [] ) {
		$sql = "SELECT p.id, pd.title, p.status, fc.id AS cat_id, fcd.name AS category
                FROM " . DB_PREFIX . "partnership p
                INNER JOIN " . DB_PREFIX . "partnership_description pd
                  ON p.id = pd.partnership_id
                WHERE
                  pd.language_id = '" . (int) $this->config->get( 'config_language_id' ) . "'";
		
		if ( isset( $data['filter_status'] ) && ! is_null( $data['filter_status'] ) ) {
			$sql .= " AND f.status = '" . (int) $data['filter_status'] . "'";
		}
		
		$sql .= " GROUP BY p.id";
		
		$sql .= " ORDER BY p.sort_order ASC, p.create DESC";
		
		if ( isset( $data['start'] ) || isset( $data['limit'] ) ) {
			if ( $data['start'] < 0 ) {
				$data['start'] = 0;
			}
			
			if ( $data['limit'] < 1 ) {
				$data['limit'] = 20;
			}
			
			$sql .= " LIMIT " . (int) $data['start'] . "," . (int) $data['limit'];
		}
		
		$query = $this->db->query( $sql );
		
		return $query->rows;
	}
	
	public function getPartnershipDescriptions( $partnership_id ) {
		
		$query = $this->db->query( "SELECT * FROM " . DB_PREFIX . "partnership_description WHERE partnership_id = '" . (int) $partnership_id . "'" );
		
		return $query->rows;
	}
	
	public function addPartnership( $data ) {
		
		$this->db->query( "INSERT INTO " . DB_PREFIX . "partnership SET `sort_order` = '" . (int) $data['sort_order'] . "', `status` = '" . (int) $data['status'] . "', `create` = NOW()" );
		
		$partnership_id = $this->db->getLastId();
		
		foreach ( $data['partnership_data'] as $language_id => $value ) {
			$this->db->query( "INSERT INTO " . DB_PREFIX . "partnership_description SET partnership_id = '" . (int) $partnership_id . "', language_id = '" . (int) $language_id . "', title = '" . $this->db->escape( $value['title'] ) . "', description = '" . $this->db->escape( $value['description'] ) . "'" );
		}
		
		return $partnership_id;
	}
	
	public function editPartnership( $partnership_id, $data ) {
		
		$this->db->query( "UPDATE " . DB_PREFIX . "partnership SET sort_order = '" . (int) $data['sort_order'] . "', status = '" . (int) $data['status'] . "' WHERE id = '" . (int) $partnership_id . "'" );
		
		$this->db->query( "DELETE FROM " . DB_PREFIX . "partnership_description WHERE partnership_id = '" . (int) $partnership_id . "'" );
		
		foreach ( $data['partnership_descriptions'] as $language_id => $value ) {
			$this->db->query( "INSERT INTO " . DB_PREFIX . "partnership_description SET partnership_id = '" . (int) $partnership_id . "', language_id = '" . (int) $language_id . "', title = '" . $this->db->escape( $value['title'] ) . "', description = '" . $this->db->escape( $value['description'] ) . "'" );
		}
	}
	
	public function deletePartnership( $partnership_id ) {
		$this->db->query( "DELETE FROM " . DB_PREFIX . "partnership WHERE id = '" . (int) $partnership_id . "'" );
		$this->db->query( "DELETE FROM " . DB_PREFIX . "partnership_description WHERE partnership_id = '" . (int) $partnership_id . "'" );
	}
	
	/** ===== Installation Functions ===== **/
	
	/**
	 * Add module route
	 */
	public function addRoute() {
		$this->db->query( "INSERT INTO `" . DB_PREFIX . "url_alias` (`url_alias_id`, `query`, `keyword`) VALUES (NULL, 'extension/module/partnership', 'partnership')" );
	}
	
	/**
	 * Remove module route
	 */
	public function removeRoute() {
		$this->db->query( "DELETE FROM `" . DB_PREFIX . "url_alias` WHERE `query` = 'extension/module/partnership'" );
	}
	
	/**
	 * Create module table DB
	 */
	public function createTable() {
		$this->db->query( "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "partnership` (
		  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
		  `image` varchar(255) NOT NULL,
		  `create` datetime NOT NULL,
		  `sort_order` int(11) NOT NULL DEFAULT '0',
		  `status` tinyint(4) NOT NULL DEFAULT '0',
		  PRIMARY KEY (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1" );
		
		$this->db->query( "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "partnership_description` (
		  `partnership_id` int(11) NOT NULL,
		  `language_id` int(11) NOT NULL,
		  `title` varchar(255) NOT NULL,
		  `name` varchar(255) NOT NULL,
		  `announce` varchar(500) NOT NULL,
		  `description` text NOT NULL,
		  UNIQUE KEY `answer` (`question_id`,`language_id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8" );
	}
	
	/**
	 * Remove module table DB
	 */
	public function removeTable() {
		$this->db->query( "DROP TABLE `" . DB_PREFIX . "partnership`" );
		$this->db->query( "DROP TABLE `" . DB_PREFIX . "partnership_description`" );
	}
	
	/**
	 * Remove module layout
	 */
	public function removeLayout() {
	
	}
}
