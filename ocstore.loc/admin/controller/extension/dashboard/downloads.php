<?php
class ControllerExtensionDashboardDownloads extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('extension/dashboard/downloads');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('dashboard_downloads', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=dashboard', true));
		}

		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_today'] = $this->language->get('text_today');
		$data['text_last_7_days'] = $this->language->get('text_last_7_days');
		$data['text_last_30_days'] = $this->language->get('text_last_30_days');
		$data['text_last_180_days'] = $this->language->get('text_last_180_days');
		$data['text_last_360_days'] = $this->language->get('text_last_360_days');

		$data['entry_width'] = $this->language->get('entry_width');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$data['entry_download_count'] = $this->language->get('entry_download_count');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=dashboard', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/dashboard/downloads', 'token=' . $this->session->data['token'], true)
		);

		$data['action'] = $this->url->link('extension/dashboard/downloads', 'token=' . $this->session->data['token'], true);

		$data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=dashboard', true);

		if (isset($this->request->post['dashboard_downloads_width'])) {
			$data['dashboard_downloads_width'] = $this->request->post['dashboard_downloads_width'];
		} else {
			$data['dashboard_downloads_width'] = $this->config->get('dashboard_downloads_width');
		}

		$data['columns'] = array();
		
		for ($i = 3; $i <= 12; $i++) {
			$data['columns'][] = $i;
		}
				
		if (isset($this->request->post['dashboard_downloads_status'])) {
			$data['dashboard_downloads_status'] = $this->request->post['dashboard_downloads_status'];
		} else {
			$data['dashboard_downloads_status'] = $this->config->get('dashboard_downloads_status');
		}

		if (isset($this->request->post['dashboard_downloads_sort_order'])) {
			$data['dashboard_downloads_sort_order'] = $this->request->post['dashboard_downloads_sort_order'];
		} else {
			$data['dashboard_downloads_sort_order'] = $this->config->get('dashboard_downloads_sort_order');
		}

		if (isset($this->request->post['dashboard_downloads_download_count'])) {
			$data['dashboard_downloads_download_count'] = $this->request->post['dashboard_downloads_download_count'];
		} else {
			$data['dashboard_downloads_download_count'] = $this->config->get('dashboard_downloads_download_count');
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$template = 'extension/dashboard/downloads_form';

		$this->response->setOutput($this->load->view($template, $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/dashboard/downloads')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
		
	public function dashboard() {
		if (!((int)$this->config->get('pd_status') && (int)$this->config->get('dashboard_downloads_status'))) {
			return;
		}

		$this->load->language('extension/dashboard/downloads');

		$data['heading_title'] = $this->language->get(sprintf('text_downloads_%s', $this->config->get('dashboard_downloads_download_count')));

		$data['text_view'] = $this->language->get('text_view');

		$data['token'] = $this->session->data['token'];

		$this->load->model('extension/module/product_downloads');

		$current_period = $this->model_extension_module_product_downloads->getTotalDownloads((int)$this->config->get('dashboard_downloads_download_count'));

		$previous_period = $this->model_extension_module_product_downloads->getTotalDownloads((int)$this->config->get('dashboard_downloads_download_count') - 1);

		$difference = $current_period - $previous_period;

		if ($difference && $current_period) {
			$data['percentage'] = round(($difference / $current_period) * 100);
		} else {
			$data['percentage'] = 0;
		}

		$downloads_total = $current_period;

		if ($downloads_total > 1000000000000) {
			$data['total'] = round($downloads_total / 1000000000000, 1) . 'T';
		} elseif ($downloads_total > 1000000000) {
			$data['total'] = round($downloads_total / 1000000000, 1) . 'B';
		} elseif ($downloads_total > 1000000) {
			$data['total'] = round($downloads_total / 1000000, 1) . 'M';
		} elseif ($downloads_total > 1000) {
			$data['total'] = round($downloads_total / 1000, 1) . 'K';
		} else {
			$data['total'] = $downloads_total;
		}

		$data['downloads'] = $this->url->link('extension/module/product_downloads', 'token=' . $this->session->data['token'] . "#statistics", true);

		$template = 'extension/dashboard/downloads_info';

		return $this->load->view($template, $data);
	}
}
