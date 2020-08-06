<?php

class ModelExtensionModulePartnership extends Model {
    
    public function getPartnerships() {
        $query = $this->db->query( "SELECT p.id, p.image, pd.name, pd.announce, p.status, p.sort_order
                FROM " . DB_PREFIX . "partnership p
                INNER JOIN " . DB_PREFIX . "partnership_description pd
                  ON p.id = pd.partnership_id
                WHERE
                  pd.language_id = '" . (int) $this->config->get( 'config_language_id' ) . "'
                  AND p.status = 1
                ORDER BY p.sort_order" );
        
        return $query->rows;
    }
}