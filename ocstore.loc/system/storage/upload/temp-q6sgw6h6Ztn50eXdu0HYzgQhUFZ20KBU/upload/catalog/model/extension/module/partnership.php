<?php
class ModelExtensionModulePartnership extends Model {
    
    public function getPartnerships()
    {
        $data = [];

        $query = $this->db->query("SELECT p.id, p.image, pd.name, pd.announce, p.status, p.sort_order
                FROM " . DB_PREFIX . "partnership p
                INNER JOIN " . DB_PREFIX . "partnership_description pd
                  ON p.id = pd.partnership_id
                WHERE
                  pd.language_id = '" . (int)$this->config->get('config_language_id') . "'
                  AND p.status = 1
                ORDER BY p.sort_order");

        foreach ($query->rows as $row) {
            $data[$row['category']][] = [
                'id' => $row['id'],
                'name' => $row['name'],
                'announce' => $row['announce'],
                'image' => $row['image'],
            ];
        }

        var_dump($data);
        exit();
        
        return $data;
    }
}