<?php

class ControllerExtensionModuleFaqCategory extends Controller {

    private $error = array();

    public function index() {
        $this->load->language('extension/module/faq');
        $this->document->setTitle($this->language->get('faq_category_title'));

        $this->load->model('extension/faq');

        $this->getList();
    }

    protected function getList() {

        $data = $this->load->language('extension/module/faq');

        if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 'c.status';
        }

        if (isset($this->request->get['order'])) {
            $order = $this->request->get['order'];
        } else {
            $order = 'ASC';
        }

        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        $url = '';

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        if (isset($this->session->data['success'])) {
            $data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $data['success'] = '';
        }

        if (isset($this->request->post['selected'])) {
            $data['selected'] = (array)$this->request->post['selected'];
        } else {
            $data['selected'] = array();
        }

        $url = '';

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('extension/module/faq', 'token=' . $this->session->data['token'] . $url, true)
        );

        $data['add'] = $this->url->link('extension/module/faq_category/add', 'token=' . $this->session->data['token'] . $url, true);
        $data['delete'] = $this->url->link('extension/module/faq_category/delete', 'token=' . $this->session->data['token'] . $url, true);

        $data['categories'] = array();

        $filter_data = array(
            'sort'            => $sort,
            'order'           => $order,
            'start'           => ($page - 1) * $this->config->get('config_limit_admin'),
            'limit'           => $this->config->get('config_limit_admin')
        );

        $categories_total = $this->model_extension_faq->getTotalCategories($filter_data);

        $results = $this->model_extension_faq->getCategories($filter_data);

        foreach ($results as $result) {
            $data['categories'][] = array(
                'id'     => $result['id'],
                'name'   => $result['name'],
                'status' => ($result['status']) ? $this->language->get('text_enabled') : $this->language->get('text_disabled'),
                'edit'   => $this->url->link('extension/module/faq_category/edit', 'token=' . $this->session->data['token'] . '&category_id=' . $result['id'] . $url, true)
            );
        }

        $data['token'] = $this->session->data['token'];

        if (isset($this->request->post['selected'])) {
            $data['selected'] = (array)$this->request->post['selected'];
        } else {
            $data['selected'] = array();
        }

        $url = '';

        if ($order == 'ASC') {
            $url .= '&order=DESC';
        } else {
            $url .= '&order=ASC';
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        $data['sort_status'] = $this->url->link('extension/module/faq_category', 'token=' . $this->session->data['token'] . '&sort=c.status' . $url, true);

        $url = '';

        if (isset($this->request->get['filter_status'])) {
            $url .= '&filter_status=' . $this->request->get['filter_status'];
        }

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        // Pagination
        $pagination = new Pagination();
        $pagination->total = $categories_total;
        $pagination->page = $page;
        $pagination->limit = $this->config->get('config_limit_admin');
        $pagination->url = $this->url->link('extension/module/faq', 'token=' . $this->session->data['token'] . $url . '&page={page}', true);

        $data['pagination'] = $pagination->render();

        $data['results'] = sprintf($this->language->get('text_pagination'), ($categories_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($categories_total - $this->config->get('config_limit_admin'))) ? $categories_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $categories_total, ceil($categories_total / $this->config->get('config_limit_admin')));

        $data['sort'] = $sort;
        $data['order'] = $order;

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/module/faq_category_list', $data));
    }

    public function add() {

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('extension/faq');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_extension_faq->addCategory($this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('extension/module/faq_category', 'token=' . $this->session->data['token'], true));
        }

        $this->getForm();
    }

    public function edit() {

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('extension/faq');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {

            $this->model_extension_faq->editCategory($this->request->get['category_id'], $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('extension/module/faq_category', 'token=' . $this->session->data['token'], true));
        }

        $this->getForm();
    }

    public function delete() {

        $this->load->language('extension/module/faq');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('extension/faq');

        if (isset($this->request->post['selected']) && $this->validateDelete()) {

            foreach ($this->request->post['selected'] as $category_id) {
                $this->model_extension_faq->deleteCategory($category_id);
            }

            $this->response->redirect($this->url->link('extension/module/faq_category', 'token=' . $this->session->data['token'], true));
        }
    }

    protected function validateDelete() {
        if (!$this->user->hasPermission('modify', 'extension/module/faq_category')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        return !$this->error;
    }

    protected function getForm() {

        $data = $this->load->language('extension/module/faq');

        $data['text_form'] = !isset($this->request->get['category_id']) ? $this->language->get('faq_cat_add') : $this->language->get('faq_cat_edit');

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->error['name'])) {
            $data['error_name'] = $this->error['name'];
        } else {
            $data['error_name'] = array();
        }

        $url = '';

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('extension/module/faq', 'token=' . $this->session->data['token'] . $url, true)
        );

        if (!isset($this->request->get['category_id'])) {
            $data['action'] = $this->url->link('extension/module/faq_category/add', 'token=' . $this->session->data['token'] . $url, true);
        } else {
            $data['action'] = $this->url->link('extension/module/faq_category/edit', 'token=' . $this->session->data['token'] . '&category_id=' . $this->request->get['category_id'] . $url, true);
        }

        $data['cancel'] = $this->url->link('extension/module/faq_category', 'token=' . $this->session->data['token'] . $url, true);

        if (isset($this->request->get['category_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            $category_info = $this->model_extension_faq->getCategory($this->request->get['category_id']);
        }

        $data['token'] = $this->session->data['token'];

        $this->load->model('localisation/language');

        $data['languages'] = $this->model_localisation_language->getLanguages();

        if (isset($this->request->post['faq_category'])) {
            $data['faq_category'] = $this->request->post['faq_category'];
        } elseif (isset($this->request->get['category_id'])) {
            $data['faq_category'] = $this->model_extension_faq->getCatDescriptions($this->request->get['category_id']);
        } else {
            $data['faq_category'] = array();
        }

        if (isset($this->request->post['sort_order'])) {
            $data['sort_order'] = $this->request->post['sort_order'];
        } elseif (!empty($category_info)) {
            $data['sort_order'] = $category_info['sort_order'];
        } else {
            $data['sort_order'] = 1;
        }

        if (isset($this->request->post['status'])) {
            $data['status'] = $this->request->post['status'];
        } elseif (!empty($category_info)) {
            $data['status'] = $category_info['status'];
        } else {
            $data['status'] = true;
        }

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/module/faq_category_form', $data));

    }

    protected function validateForm() {

        if (!$this->user->hasPermission('modify', 'extension/module/faq_category')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        foreach ($this->request->post['faq_category'] as $language_id => $value) {
            if ((utf8_strlen($value['name']) < 3) || (utf8_strlen($value['name']) > 255)) {
                $this->error['name'][$language_id] = $this->language->get('error_name');
            }
        }

        if ($this->error && !isset($this->error['warning'])) {
            $this->error['warning'] = $this->language->get('error_warning');
        }

        return !$this->error;
    }
}