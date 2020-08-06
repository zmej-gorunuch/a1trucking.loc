<?php
class ModelExtensionFaq extends Model {

    public function getTotalQuestions($data = array()) {
        $sql = "SELECT COUNT(DISTINCT f.id) AS total FROM " . DB_PREFIX . "faq f LEFT JOIN " . DB_PREFIX . "faq_description fd ON (f.id = fd.question_id)";

        $sql .= " WHERE fd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

        if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
            $sql .= " AND f.status = '" . (int)$data['filter_status'] . "'";
        }

        $query = $this->db->query($sql);

        return $query->row['total'];
    }

    public function getQuestions($data = array()) {
        $sql = "SELECT f.id, fd.title, f.status, fc.id AS cat_id, fcd.name AS category
                FROM " . DB_PREFIX . "faq f
                INNER JOIN " . DB_PREFIX . "faq_description fd
                  ON f.id = fd.question_id
                LEFT JOIN " . DB_PREFIX . "faq_to_categories ftc
                  ON f.id = ftc.question_id
                LEFT JOIN " . DB_PREFIX . "faq_categories fc
                  ON ftc.category_id = fc.id
                LEFT JOIN " . DB_PREFIX . "faq_cat_descriptions fcd
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

    public function getQuestion($question_id) {
        $sql = "SELECT f.id, fd.title, f.status, f.sort_order, fc.id AS cat_id, fcd.name AS category
                    FROM " . DB_PREFIX . "faq f
                    LEFT JOIN " . DB_PREFIX ."faq_description fd
                        ON f.id = fd.question_id
                    LEFT JOIN " . DB_PREFIX . "faq_to_categories ftc
                      ON f.id = ftc.question_id
                    LEFT JOIN " . DB_PREFIX . "faq_categories fc
                      ON ftc.category_id = fc.id
                    LEFT JOIN " . DB_PREFIX . "faq_cat_descriptions fcd
                      ON fc.id = fcd.category_id AND fd.language_id = fcd.language_id
                    WHERE f.id = '" . (int)$question_id . "' AND
                    fd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

        $query = $this->db->query($sql);

        return $query->row;
    }

    public function getFaqDescriptions($question_id) {
        $faq_description_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "faq_description WHERE question_id = '" . (int)$question_id . "'");

        foreach ($query->rows as $result) {
            $faq_description_data[$result['language_id']] = array(
                'title'            => $result['title'],
                'description'      => $result['description']
            );
        }

        return $faq_description_data;
    }

    public function addFaq($data) {

        $this->db->query("INSERT INTO " . DB_PREFIX . "faq SET `sort_order` = '" . (int)$data['sort_order'] . "', `status` = '" . (int)$data['status'] . "', `create` = NOW()");

        $question_id = $this->db->getLastId();

        foreach ($data['faq_question'] as $language_id => $value) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "faq_description SET question_id = '" . (int)$question_id . "', language_id = '" . (int)$language_id . "', title = '" . $this->db->escape($value['title']) . "', description = '" . $this->db->escape($value['description']) . "'");
        }

        if ($data['category']) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "faq_to_categories
                SET question_id = " . (int)$question_id . ", category_id = " . (int)$data['category']);
        }

       return $question_id;
    }

    public function editFaq($question_id, $data) {

        $this->db->query("UPDATE " . DB_PREFIX . "faq SET sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "' WHERE id = '" . (int)$question_id . "'");

        $this->db->query("DELETE FROM " . DB_PREFIX . "faq_description WHERE question_id = '" . (int)$question_id . "'");

        foreach ($data['faq_question'] as $language_id => $value) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "faq_description SET question_id = '" . (int)$question_id . "', language_id = '" . (int)$language_id . "', title = '" . $this->db->escape($value['title']) . "', description = '" . $this->db->escape($value['description']) . "'");
        }

        if ($data['category']) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "faq_to_categories (question_id, category_id) VALUES(" . (int)$question_id . ", " . (int)$data['category'] . ") ON DUPLICATE KEY UPDATE question_id=". (int)$question_id . ", category_id=" . (int)$data['category']);
        } else {
            $this->db->query("DELETE FROM " . DB_PREFIX . "faq_to_categories WHERE question_id = " . (int)$question_id );
        }

    }

    public function getCategories($data = array()) {
        $sql = "SELECT c.id, c.sort_order, c.status, cd.name FROM " . DB_PREFIX . "faq_categories c LEFT JOIN " . DB_PREFIX . "faq_cat_descriptions cd ON (c.id = cd.category_id) WHERE cd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

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
        $sql = "SELECT COUNT(DISTINCT c.id) AS total FROM " . DB_PREFIX . "faq_categories c LEFT JOIN " . DB_PREFIX . "faq_cat_descriptions cd ON (c.id = cd.category_id)";

        $sql .= " WHERE cd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

        $query = $this->db->query($sql);

        return $query->row['total'];
    }

    public function getCategory($category_id) {
        $sql = "SELECT * FROM " . DB_PREFIX . "faq_categories fc
                    LEFT JOIN " . DB_PREFIX ."faq_cat_descriptions fd
                        ON fc.id = fd.category_id
                    WHERE fc.id = '" . (int)$category_id . "' AND
                    fd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

        $query = $this->db->query($sql);

        return $query->row;
    }

    public function getCatDescriptions($category_id) {
        $faq_cat_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "faq_cat_descriptions WHERE category_id = '" . (int)$category_id . "'");

        foreach ($query->rows as $result) {
            $faq_cat_data[$result['language_id']] = array(
                'name'            => $result['name']
            );
        }

        return $faq_cat_data;
    }

    public function addCategory($data) {
        $this->db->query("INSERT INTO " . DB_PREFIX . "faq_categories SET `sort_order` = '" . (int)$data['sort_order'] . "', `status` = '" . (int)$data['status'] . "'");

        $category_id = $this->db->getLastId();

        foreach ($data['faq_category'] as $language_id => $value) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "faq_cat_descriptions SET category_id = '" . (int)$category_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
        }

        return $category_id;
    }

    public function editCategory($category_id, $data) {

        $this->db->query("UPDATE " . DB_PREFIX . "faq_categories SET sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "' WHERE id = '" . (int)$category_id . "'");

        foreach ($data['faq_category'] as $language_id => $value) {
            $this->db->query("UPDATE " . DB_PREFIX . "faq_cat_descriptions SET name = '" . $this->db->escape($value['name']) . "' WHERE category_id = '" . (int)$category_id . "' AND language_id = '" . (int)$language_id . "'");
        }
    }

    public function deleteFaq($question_id) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "faq WHERE id = '" . (int)$question_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "faq_description WHERE question_id = '" . (int)$question_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "faq_to_categories WHERE question_id = '" . (int)$question_id . "'");
    }

    public function deleteCategory($category_id) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "faq_categories WHERE id = '" . (int)$category_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "faq_cat_descriptions WHERE category_id = '" . (int)$category_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "faq_to_categories WHERE category_id = '" . (int)$category_id . "'");
    }

    public function addRoute() {
        $this->db->query("INSERT INTO `" . DB_PREFIX . "url_alias` (`url_alias_id`, `query`, `keyword`) VALUES (NULL, 'extension/module/faq', 'faq')");
    }

    public function removeRoute() {
        $this->db->query("DELETE FROM `" . DB_PREFIX . "url_alias` WHERE `query` = 'extension/module/faq'");
    }

    public function createTable() {
        $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "faq` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `create` datetime NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");

        $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "faq_description` (
  `question_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  UNIQUE KEY `answer` (`question_id`,`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8");

        $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "faq_categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sort_order` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");

        $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "faq_cat_descriptions` (
  `category_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8");

        $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "faq_to_categories` (
  `question_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  UNIQUE KEY `faq_cat` (`question_id`,`category_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8");
    }

    public function removeTable() {
        $this->db->query("DROP TABLE `" . DB_PREFIX . "faq`");
        $this->db->query("DROP TABLE `" . DB_PREFIX . "faq_description`");
        $this->db->query("DROP TABLE `" . DB_PREFIX . "faq_categories`");
        $this->db->query("DROP TABLE `" . DB_PREFIX . "faq_cat_descriptions`");
        $this->db->query("DROP TABLE `" . DB_PREFIX . "faq_to_categories`");
    }

    public function removeLayout() {
        $query = $this->db->query("SELECT `layout_id` FROM `" . DB_PREFIX . "layout` WHERE name = 'FAQ'");
        $layout_id = $query->row['layout_id'];

        $this->db->query("DELETE FROM " . DB_PREFIX . "layout WHERE layout_id = '" . (int)$layout_id . "'");

        $this->db->query("DELETE FROM " . DB_PREFIX . "layout_route WHERE layout_id = '" . (int)$layout_id . "'");
    }
}
