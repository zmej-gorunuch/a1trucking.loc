<?php
class ControllerMarketingCform extends Controller
{

	private $error = array();

	public function index()
	{
		$this->load->language('marketing/cform');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('marketing/cform');

		$this->model_marketing_cform->createcform();

		$this->getList();
	}

	public function add()
	{
		$this->load->language('marketing/cform');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('marketing/cform');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {

			$this->model_marketing_cform->addcform($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

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

			$this->response->redirect($this->url->link('marketing/cform', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getForm();
	}

	public function edit()
	{
		$this->load->language('marketing/cform');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('marketing/cform');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_marketing_cform->editcform($this->request->get['cform_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

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

			$this->response->redirect($this->url->link('marketing/cform', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getForm();
	}

	public function delete()
	{
		$this->load->language('marketing/cform');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('marketing/cform');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $cform_id) {
				$this->model_marketing_cform->deletecform($cform_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

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

			$this->response->redirect($this->url->link('marketing/cform', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getList();
	}

	protected function getList()
	{
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'subscribe_date';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'DESC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
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

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('marketing/cform', 'token=' . $this->session->data['token'] . $url, true)
		);

		$data['add'] = $this->url->link('marketing/cform/add', 'token=' . $this->session->data['token'] . $url, true);
		$data['delete'] = $this->url->link('marketing/cform/delete', 'token=' . $this->session->data['token'] . $url, true);

		$data['cform'] = array();

		$filter_data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit' => $this->config->get('config_limit_admin')
		);

		$cform_total = $this->model_marketing_cform->getTotalcforms();

		$results = $this->model_marketing_cform->getcform($filter_data);

		foreach ($results as $result) {

			$data['cform'][] = array(
				'cform_id'  => $result['cform_id'],
				'cform_email'       => $result['cform_email'],
				'cform_name'       => $result['cform_name'],
				'cform_phone'       => $result['cform_phone'],
				'subscribe_date' => date($this->language->get('date_format_short'), strtotime($result['subscribe_date'])),
				'edit'       => $this->url->link('marketing/cform/edit', 'token=' . $this->session->data['token'] . '&cform_id=' . $result['cform_id'] . $url, true)
			);
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_list'] = $this->language->get('text_list');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['column_cform_id'] = $this->language->get('column_cform_id');
		$data['column_cform_email'] = $this->language->get('column_cform_email');
		$data['column_subscribe_date'] = $this->language->get('column_subscribe_date');
		$data['column_action'] = $this->language->get('column_action');

		$data['button_add'] = $this->language->get('button_add');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_delete'] = $this->language->get('button_delete');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
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

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['sort_cform_id'] = $this->url->link('marketing/cform', 'token=' . $this->session->data['token'] . '&sort=cform_id' . $url, true);
		$data['sort_cform_email'] = $this->url->link('marketing/cform', 'token=' . $this->session->data['token'] . '&sort=cform_email' . $url, true);
		$data['sort_subscribe_date'] = $this->url->link('marketing/cform', 'token=' . $this->session->data['token'] . '&sort=subscribe_date' . $url, true);

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}


		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $cform_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('marketing/cform', 'token=' . $this->session->data['token'] . $url . '&page={page}', true);

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($cform_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($cform_total - $this->config->get('config_limit_admin'))) ? $cform_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $cform_total, ceil($cform_total / $this->config->get('config_limit_admin')));

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('marketing/cform_list', $data));
	}

	protected function getForm()
	{
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_form'] = !isset($this->request->get['cform_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');

		$data['entry_cform_email'] = $this->language->get('entry_cform_email');
		$data['entry_cform_name'] = $this->language->get('entry_cform_name');
		$data['entry_cform_phone'] = $this->language->get('entry_cform_phone');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		$data['token'] = $this->session->data['token'];

		if (isset($this->request->get['cform_id'])) {
			$data['cform_id'] = $this->request->get['cform_id'];
		} else {
			$data['cform_id'] = 0;
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['cform_email'])) {
			$data['error_cform_email'] = $this->error['cform_email'];
		} else {
			$data['error_cform_email'] = '';
		}

		$url = '';

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('marketing/cform', 'token=' . $this->session->data['token'] . $url, true)
		);

		if (!isset($this->request->get['cform_id'])) {
			$data['action'] = $this->url->link('marketing/cform/add', 'token=' . $this->session->data['token'] . $url, true);
		} else {
			$data['action'] = $this->url->link('marketing/cform/edit', 'token=' . $this->session->data['token'] . '&cform_id=' . $this->request->get['cform_id'] . $url, true);
		}

		$data['cancel'] = $this->url->link('marketing/cform', 'token=' . $this->session->data['token'] . $url, true);

		if (isset($this->request->get['cform_id']) && (!$this->request->server['REQUEST_METHOD'] != 'POST')) {
			$cform_info = $this->model_marketing_cform->getcform($this->request->get['cform_id']);
		}

		if (isset($this->request->post['cform_email'])) {
			$data['cform_email'] = $this->request->post['cform_email'];
		} elseif (!empty($cform_info)) {
			$data['cform_email'] = $cform_info['cform_email'];
		} else {
			$data['cform_email'] = '';
		}

		if (isset($this->request->post['cform_name'])) {
			$data['cform_name'] = $this->request->post['cform_name'];
		} elseif (!empty($cform_info)) {
			$data['cform_name'] = $cform_info['cform_name'];
		} else {
			$data['cform_name'] = '';
		}

		if (isset($this->request->post['cform_phone'])) {
			$data['cform_phone'] = $this->request->post['cform_phone'];
		} elseif (!empty($cform_info)) {
			$data['cform_phone'] = $cform_info['cformphonel'];
		} else {
			$data['cform_phone'] = '';
		}

		if (isset($this->request->post['subscribe_date'])) {
			$data['subscribe_date'] = $this->request->post['subscribe_date'];
		} elseif (!empty($cform_info)) {
			$data['subscribe_date'] = ($cform_info['subscribe_date'] != '0000-00-00' ? $cform_info['subscribe_date'] : '');
		} else {
			$data['subscribe_date'] = date('Y-m-d', time());
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('marketing/cform_form', $data));
	}

	protected function validateForm()
	{

		if (!$this->user->hasPermission('modify', 'marketing/cform')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ((utf8_strlen($this->request->post['cform_email']) > 96) || (!filter_var($this->request->post['cform_email'], FILTER_VALIDATE_EMAIL))) {
			$this->error['cform_email'] = $this->language->get('error_cform_email');
		}

		$email = $this->model_marketing_cform->getcformEmail($this->request->post['cform_email']);

		if ($this->request->post['cform_email'] == isset($email['cform_email'])) {
			$this->error['cform_email'] = $this->language->get('error_cform_email_duplicate');
		}

		return !$this->error;
	}

	protected function validateDelete()
	{
		if (!$this->user->hasPermission('modify', 'marketing/cform')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
}
