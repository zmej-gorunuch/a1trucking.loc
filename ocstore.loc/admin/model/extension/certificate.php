<?php
class ModelExtensionCertificate extends Model {

    public function getTotalCertificates($data = array()) {
        $sql = "SELECT COUNT(DISTINCT f.id) AS total FROM " . DB_PREFIX . "certificate f LEFT JOIN " . DB_PREFIX . "certificate_description fd ON (f.id = fd.certificate_id)";

        $sql .= " WHERE fd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

        if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
            $sql .= " AND f.status = '" . (int)$data['filter_status'] . "'";
        }

        $query = $this->db->query($sql);

        return $query->row['total'];
    }

    public function getCertificates($data = array()) {
        $sql = "SELECT f.id, fd.title, f.status, f.filename, fc.id AS cat_id, fcd.name AS category
                FROM " . DB_PREFIX . "certificate f
                INNER JOIN " . DB_PREFIX . "certificate_description fd
                  ON f.id = fd.certificate_id
                LEFT JOIN " . DB_PREFIX . "certificate_to_categories ftc
                  ON f.id = ftc.certificate_id
                LEFT JOIN " . DB_PREFIX . "certificate_categories fc
                  ON ftc.category_id = fc.id
                LEFT JOIN " . DB_PREFIX . "certificate_cat_descriptions fcd
                  ON fc.id = fcd.category_id AND fd.language_id = fcd.language_id
                WHERE
                  fd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

        if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
            $sql .= " AND f.status = '" . (int)$data['filter_status'] . "'";
        }

        $sql .= " GROUP BY f.id";

        $sql .= " ORDER BY f.sort_order ASC, f.create DESC";

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

    public function getCertificate($certificate_id) {
        $sql = "SELECT f.id, fd.title, f.status, f.sort_order, f.filename, fc.id AS cat_id, fcd.name AS category
                    FROM " . DB_PREFIX . "certificate f
                    LEFT JOIN " . DB_PREFIX ."certificate_description fd
                        ON f.id = fd.certificate_id
                    LEFT JOIN " . DB_PREFIX . "certificate_to_categories ftc
                      ON f.id = ftc.certificate_id
                    LEFT JOIN " . DB_PREFIX . "certificate_categories fc
                      ON ftc.category_id = fc.id
                    LEFT JOIN " . DB_PREFIX . "certificate_cat_descriptions fcd
                      ON fc.id = fcd.category_id AND fd.language_id = fcd.language_id
                    WHERE f.id = '" . (int)$certificate_id . "' AND
                    fd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

        $query = $this->db->query($sql);

        return $query->row;
    }

    public function getCertificateDescriptions($certificate_id) {
        $certificate_description_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "certificate_description WHERE certificate_id = '" . (int)$certificate_id . "'");

        foreach ($query->rows as $result) {
            $certificate_description_data[$result['language_id']] = array(
                'title'            => $result['title']
            );
        }

        return $certificate_description_data;
    }

    public function addCertificate($data) {

        $this->db->query("INSERT INTO " . DB_PREFIX . "certificate SET `sort_order` = '" . (int)$data['sort_order'] . "', `status` = '" . (int)$data['status'] . "', `filename` = '" . (int)$data['filename'] . "', `create` = NOW()");

        $certificate_id = $this->db->getLastId();

        foreach ($data['certificate_data'] as $language_id => $value) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "certificate_description SET certificate_id = '" . (int)$certificate_id . "', language_id = '" . (int)$language_id . "', title = '" . $this->db->escape($value['title']) . "'");
        }

        if ($data['category']) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "certificate_to_categories
                SET certificate_id = " . (int)$certificate_id . ", category_id = " . (int)$data['category']);
        }

       return $certificate_id;
    }

    public function editCertificate($certificate_id, $data) {

        $this->db->query("UPDATE " . DB_PREFIX . "certificate SET sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', filename = '" . $data['filename'] . "' WHERE id = '" . (int)$certificate_id . "'");

        $this->db->query("DELETE FROM " . DB_PREFIX . "certificate_description WHERE certificate_id = '" . (int)$certificate_id . "'");

        foreach ($data['certificate_data'] as $language_id => $value) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "certificate_description SET certificate_id = '" . (int)$certificate_id . "', language_id = '" . (int)$language_id . "', title = '" . $this->db->escape($value['title']) . "'");
        }

        if ($data['category']) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "certificate_to_categories (certificate_id, category_id) VALUES(" . (int)$certificate_id . ", " . (int)$data['category'] . ") ON DUPLICATE KEY UPDATE certificate_id=". (int)$certificate_id . ", category_id=" . (int)$data['category']);
        } else {
            $this->db->query("DELETE FROM " . DB_PREFIX . "certificate_to_categories WHERE certificate_id = " . (int)$certificate_id );
        }

    }

    public function getCategories($data = array()) {
        $sql = "SELECT c.id, c.sort_order, c.status, cd.name FROM " . DB_PREFIX . "certificate_categories c LEFT JOIN " . DB_PREFIX . "certificate_cat_descriptions cd ON (c.id = cd.category_id) WHERE cd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

        $sql .= " GROUP BY c.id";

        $sort_data = array(
            'c.status',
        );

        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .= " ORDER BY " . $data['sort'];
        } else {
            $sql .= " ORDER BY c.sort_order";
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

    public function getTotalCategories() {
        $sql = "SELECT COUNT(DISTINCT c.id) AS total FROM " . DB_PREFIX . "certificate_categories c LEFT JOIN " . DB_PREFIX . "certificate_cat_descriptions cd ON (c.id = cd.category_id)";

        $sql .= " WHERE cd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

        $query = $this->db->query($sql);

        return $query->row['total'];
    }

    public function getCategory($category_id) {
        $sql = "SELECT * FROM " . DB_PREFIX . "certificate_categories fc
                    LEFT JOIN " . DB_PREFIX ."certificate_cat_descriptions fd
                        ON fc.id = fd.category_id
                    WHERE fc.id = '" . (int)$category_id . "' AND
                    fd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

        $query = $this->db->query($sql);

        return $query->row;
    }

    public function getCatDescriptions($category_id) {
        $certificate_cat_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "certificate_cat_descriptions WHERE category_id = '" . (int)$category_id . "'");

        foreach ($query->rows as $result) {
            $certificate_cat_data[$result['language_id']] = array(
                'name'            => $result['name']
            );
        }

        return $certificate_cat_data;
    }

    public function addCategory($data) {
        $this->db->query("INSERT INTO " . DB_PREFIX . "certificate_categories SET `sort_order` = '" . (int)$data['sort_order'] . "', `status` = '" . (int)$data['status'] . "'");

        $category_id = $this->db->getLastId();

        foreach ($data['certificate_category'] as $language_id => $value) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "certificate_cat_descriptions SET category_id = '" . (int)$category_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
        }

        return $category_id;
    }

    public function editCategory($category_id, $data) {

        $this->db->query("UPDATE " . DB_PREFIX . "certificate_categories SET sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "' WHERE id = '" . (int)$category_id . "'");

        foreach ($data['certificate_category'] as $language_id => $value) {
            $this->db->query("UPDATE " . DB_PREFIX . "certificate_cat_descriptions SET name = '" . $this->db->escape($value['name']) . "' WHERE category_id = '" . (int)$category_id . "' AND language_id = '" . (int)$language_id . "'");
        }
    }

    public function deleteCertificate($certificate_id) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "certificate WHERE id = '" . (int)$certificate_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "certificate_description WHERE certificate_id = '" . (int)$certificate_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "certificate_to_categories WHERE certificate_id = '" . (int)$certificate_id . "'");
    }

    public function deleteCategory($category_id) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "certificate_categories WHERE id = '" . (int)$category_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "certificate_cat_descriptions WHERE category_id = '" . (int)$category_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "certificate_to_categories WHERE category_id = '" . (int)$category_id . "'");
    }

    public function addRoute() {
        $this->db->query("INSERT INTO `" . DB_PREFIX . "url_alias` (`url_alias_id`, `query`, `keyword`) VALUES (NULL, 'extension/module/certificate', 'certificate')");
    }

    public function removeRoute() {
        $this->db->query("DELETE FROM `" . DB_PREFIX . "url_alias` WHERE `query` = 'extension/module/certificate'");
    }

    public function createTable() {
        $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "certificate` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `create` datetime NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `filename` varchar(160) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");

        $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "certificate_description` (
  `certificate_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  UNIQUE KEY `answer` (`certificate_id`,`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8");

        $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "certificate_categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sort_order` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");

        $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "certificate_cat_descriptions` (
  `category_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8");

        $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "certificate_to_categories` (
  `certificate_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  UNIQUE KEY `certificate_cat` (`certificate_id`,`category_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8");
    }

    public function removeTable() {
        $this->db->query("DROP TABLE `" . DB_PREFIX . "certificate`");
        $this->db->query("DROP TABLE `" . DB_PREFIX . "certificate_description`");
        $this->db->query("DROP TABLE `" . DB_PREFIX . "certificate_categories`");
        $this->db->query("DROP TABLE `" . DB_PREFIX . "certificate_cat_descriptions`");
        $this->db->query("DROP TABLE `" . DB_PREFIX . "certificate_to_categories`");
    }

    public function removeLayout() {
        $query = $this->db->query("SELECT `layout_id` FROM `" . DB_PREFIX . "layout` WHERE name = 'certificate'");
        $layout_id = $query->row['layout_id'];

        $this->db->query("DELETE FROM " . DB_PREFIX . "layout WHERE layout_id = '" . (int)$layout_id . "'");

        $this->db->query("DELETE FROM " . DB_PREFIX . "layout_route WHERE layout_id = '" . (int)$layout_id . "'");
    }
}
