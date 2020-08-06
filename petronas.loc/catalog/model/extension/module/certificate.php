<?php
class ModelExtensionModuleCertificate extends Model {

    public function getNoCatCertificate()
    {
        $query = $this->db->query("SELECT f.id, fd.title, f.filename, f.create
            FROM " . DB_PREFIX . "certificate f
            LEFT JOIN " . DB_PREFIX . "certificate_description fd
                ON f.id = fd.certificate_id
            WHERE f.status = 1 AND
                fd.language_id = " . (int)$this->config->get('config_language_id') . " AND
                    f.id NOT IN (SELECT certificate_id FROM " . DB_PREFIX . "certificate_to_categories)
            ORDER BY f.sort_order ASC");
        
        return $query->rows;
    }

    public function getCatCertificates()
    {
        $query = $this->db->query("SELECT f.id, fd.title, f.filename, fcd.name AS category, fc.id AS category_id
                FROM " . DB_PREFIX . "certificate f
                INNER JOIN " . DB_PREFIX . "certificate_description fd
                  ON f.id = fd.certificate_id
                INNER JOIN " . DB_PREFIX . "certificate_to_categories ftc
                  ON f.id = ftc.certificate_id
                LEFT JOIN " . DB_PREFIX . "certificate_categories fc
                  ON ftc.category_id = fc.id
                LEFT JOIN " . DB_PREFIX . "certificate_cat_descriptions fcd
                  ON fc.id = fcd.category_id AND fd.language_id = fcd.language_id
                WHERE
                  fd.language_id = '" . (int)$this->config->get('config_language_id') . "'
                  AND fc.status = 1
                ORDER BY fc.sort_order, f.sort_order");

        return $query->rows;
    }
	
	public function getDownload($download_id)
	{
		$query = $this->db->query("SELECT f.id, fd.title, f.filename, f.create
            FROM " . DB_PREFIX . "certificate f
            LEFT JOIN " . DB_PREFIX . "certificate_description fd
                ON f.id = fd.certificate_id
            WHERE f.status = 1 AND f.id = $download_id AND
                fd.language_id = " . (int)$this->config->get('config_language_id') . " AND
                    f.id NOT IN (SELECT certificate_id FROM " . DB_PREFIX . "certificate_to_categories)
            ORDER BY f.sort_order ASC");
		
		return $query->rows;
	}
}