<?php
class ControllerDownloadSample extends Controller {
	public function __construct($registry) {
		parent::__construct($registry);

		$this->load->helper('pd');

		$this->load->language('download/download');

		$this->load->model('catalog/download');
	}

	public function index() {
		$ssl = (
				!empty($_SERVER['HTTPS']) && (strtolower($_SERVER['HTTPS']) == 'on' || $_SERVER['HTTPS'] == '1') ||
				!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' ||
				!empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on'
			) ? true : false;

		if (isset($this->request->get['dsid']) && $this->validateRequest()) {
			$download_sample_id = $this->request->get['dsid'];
		} else {
			if ($this->config->get("pd_dp_status")) {
				$this->response->redirect($this->url->link('download/download', '', $ssl));
			} else {
				$this->response->redirect($this->url->link('common/home', '', $ssl));
			}
			return;
		}

		if ($this->config->get("pd_require_login_sample") && !$this->customer->isLogged()) {
			$this->session->data['redirect'] = $this->url->link('download/sample', 'dsid=' . $download_sample_id, $ssl);
			$this->response->redirect($this->url->link('account/login', '', $ssl));
			return;
		}

		$download_info = $this->model_catalog_download->getDownloadSampleByHash($download_sample_id);

		if ((int)$download_info['expired']) {
			$this->unavailable($download_info, "expired");
			return;
		}

		if ($download_info) {
			if ((int)$download_info['login'] && !$this->customer->isLogged()) {
				$this->response->redirect($this->url->link('account/login', 'redirect=' . urlencode('download/sample&dsid='. $download_sample_id), $ssl));
				return;
			}

			$file = DIR_DOWNLOAD . $download_info['filename'];
			$mask = basename($download_info['mask']);

			if (!file_exists($file)) {
				if ($this->config->get('config_error_log')) {
					$this->log->write('Error: Could not find file ' . $file . '!');
				}
				$this->unavailable($download_info, "not_found");
				return;
			}

			if (!is_readable($file)) {
				if ($this->config->get('config_error_log')) {
					$this->log->write('Error: Could not read file ' . $file . '!');
				}
				$this->unavailable($download_info, "not_found");
				return;
			}

			if ((int)$this->config->get('pd_delay_download_sample') && !$this->downloadTokenValid()) {
				$this->download($download_info);
				return;
			}

			$download_finished = function() use ($download_info) {
				$this->model_catalog_download->updateDownloaded($download_info['download_id']);
				$this->model_catalog_download->updateDownloadSampleDownloaded($download_info['download_sample_id']);
			};

			$dh = new DownloadHandler($this->registry);
			$dl = $dh->download($file, $mask, $download_finished->bindTo($this));
		} else {
			if ($this->config->get("pd_dp_status")) {
				$this->response->redirect($this->url->link('download/download', '', $ssl));
			} else {
				$this->response->redirect($this->url->link('common/home', '', $ssl));
			}
		}
	}

	protected function unavailable($download_info, $error="expired") {
		$ssl = (
				!empty($_SERVER['HTTPS']) && (strtolower($_SERVER['HTTPS']) == 'on' || $_SERVER['HTTPS'] == '1') ||
				!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' ||
				!empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on'
			) ? true : false;

		$this->load->language('download/download');

		$download_name = isset($download_info['mask']) ? $download_info['mask'] : '';

		$this->document->setTitle($this->language->get('heading_title_' . $error));

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text'  => $this->language->get('text_home'),
			'href'  => $this->url->link('common/home', '', $ssl),
		);

		if ($this->config->get("pd_dp_status")) {
			$data['breadcrumbs'][] = array(
				'text'  => $this->language->get('text_downloads'),
				'href'  => $this->url->link('download/download', '', $ssl),
			);
		}

		$data['breadcrumbs'][] = array(
			'text'  => $this->language->get('text_samples'),
			'href'  => $this->url->link('download/sample', '', $ssl),
		);

		if (isset($this->request->get['route'])) {
			$url_data = $this->request->get;

			unset($url_data['_route_']);

			$route = $url_data['route'];

			unset($url_data['route']);

			$url = '';

			if ($url_data) {
				$url = '&' . urldecode(http_build_query($url_data, '', '&'));
			}

			if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
				$ssl = true;
			} else {
				$ssl = false;
			}

			$data['breadcrumbs'][] = array(
				'text'  => $download_name,
				'href'  => $this->url->link($route, $url, $ssl),
			);
		}

		$data['heading_title'] = $this->language->get('heading_title_' . $error);

		$data['text_error'] = sprintf($this->language->get('error_sample_' . $error), $download_name);

		$data['button_continue'] = $this->language->get('button_continue');

		$this->response->addHeader($this->request->server['SERVER_PROTOCOL'] . ' 404 Not Found');

		$data['continue'] = $this->url->link($this->config->get("pd_dp_status") ? 'download/download' : 'common/home', '', $ssl);

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		if (version_compare(VERSION, '2.2.0', '>=')) {
			$template = 'download/unavailable';
		} else {
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/download/unavailable.tpl')) {
				$template = $this->config->get('config_template') . '/template/download/unavailable.tpl';
			} else {
				$template = 'default/template/download/unavailable.tpl';
			}
		}

		$this->response->setOutput($this->load->view($template, $data));
	}

	protected function download($download_info) {
		$ssl = (
				!empty($_SERVER['HTTPS']) && (strtolower($_SERVER['HTTPS']) == 'on' || $_SERVER['HTTPS'] == '1') ||
				!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' ||
				!empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on'
			) ? true : false;

		$this->load->language('download/download');

		$download_name = isset($download_info['mask']) ? $download_info['mask'] : '';

		$heading_title = sprintf($this->language->get('heading_title_sample'), $download_name);

		$this->document->setTitle($heading_title);

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text'  => $this->language->get('text_home'),
			'href'  => $this->url->link('common/home', '', $ssl),
		);

		if ($this->config->get("pd_dp_status")) {
			$data['breadcrumbs'][] = array(
				'text'  => $this->language->get('text_downloads'),
				'href'  => $this->url->link('download/download', '', $ssl),
			);
		}

		$data['breadcrumbs'][] = array(
			'text'  => $this->language->get('text_samples'),
			'href'  => $this->url->link('download/sample', '', $ssl),
		);

		if (isset($this->request->get['route'])) {
			$url_data = $this->request->get;

			unset($url_data['_route_']);

			$route = $url_data['route'];

			unset($url_data['route']);

			$url = '';

			if ($url_data) {
				$url = '&' . urldecode(http_build_query($url_data, '', '&'));
			}

			if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
				$ssl = true;
			} else {
				$ssl = false;
			}

			$data['breadcrumbs'][] = array(
				'text'  => $download_name,
				'href'  => $this->url->link($route, $url, $ssl),
			);
		}

		$token = hash("crc32b", $download_info['filename'] . microtime());
		$this->session->data['download_sample_token'] = $token;

		$download_link = $this->url->link('download/sample', 'dsid=' . $download_info['hash'] . '&dt=' . $token, $ssl);

		$data['heading_title'] = $heading_title;

		$data['text_download'] = sprintf($this->language->get('text_download_auto_start'), $download_link);
		$data['download_link'] = html_entity_decode($download_link);

		$data['button_continue'] = $this->language->get('button_continue');

		$data['continue'] = $this->url->link('common/home', '', $ssl);

		$data['download_delay'] = $this->config->get('pd_delay_download_sample');

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		if (version_compare(VERSION, '2.2.0', '>=')) {
			$template = 'download/sample';
		} else {
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/download/sample.tpl')) {
				$template = $this->config->get('config_template') . '/template/download/sample.tpl';
			} else {
				$template = 'default/template/download/sample.tpl';
			}
		}

		$this->response->setOutput($this->load->view($template, $data));
	}

	private function downloadTokenValid() {
		if (!isset($this->request->get['dt']) || !isset($this->session->data['download_sample_token']) || $this->session->data['download_sample_token'] != $this->request->get['dt']) {
			return false;
		}

		return true;
	}

	protected function validateRequest() {
		return in_array($this->config->get('config_store_id'), bdecode($this->config->get('pd_as')));
	}
}
