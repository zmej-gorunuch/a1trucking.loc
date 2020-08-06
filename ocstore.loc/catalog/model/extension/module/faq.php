<?php
class ModelExtensionModuleFaq extends Model {

    public function getNoCatAnswer()
    {
        $query = $this->db->query("SELECT f.id, fd.title, fd.description
            FROM " . DB_PREFIX . "faq f
            LEFT JOIN " . DB_PREFIX . "faq_description fd
                ON f.id = fd.question_id
            WHERE f.status = 1 AND
                fd.language_id = " . (int)$this->config->get('config_language_id') . " AND
                    f.id NOT IN (SELECT question_id FROM " . DB_PREFIX . "faq_to_categories)
            ORDER BY f.sort_order ASC");

        return $query->rows;
    }

    public function getCatAnswers()
    {
        $data = [];

        $query = $this->db->query("SELECT f.id, fd.title, fd.description, fcd.name AS category
                FROM " . DB_PREFIX . "faq f
                INNER JOIN " . DB_PREFIX . "faq_description fd
                  ON f.id = fd.question_id
                INNER JOIN " . DB_PREFIX . "faq_to_categories ftc
                  ON f.id = ftc.question_id
                LEFT JOIN " . DB_PREFIX . "faq_categories fc
                  ON ftc.category_id = fc.id
                LEFT JOIN " . DB_PREFIX . "faq_cat_descriptions fcd
                  ON fc.id = fcd.category_id AND fd.language_id = fcd.language_id
                WHERE
                  fd.language_id = '" . (int)$this->config->get('config_language_id') . "'
                  AND fc.status = 1
                ORDER BY fc.sort_order, f.sort_order");

        foreach ($query->rows as $row) {
            $data[$row['category']][] = [
                'id' => $row['id'],
                'title' => $row['title'],
                'description' => $row['description']
            ];
        }

        return $data;
    }
}