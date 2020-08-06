<?php
class ControllerDownloadDownload extends Controller {
	public function __construct($registry) {
		parent::__construct($registry);

		$this->load->helper('pd');

		$this->load->language('download/download');

		$this->load->model('catalog/download');
	}

	public function index() {
		$ajax_request = isset($this->request->server['HTTP_X_REQUESTED_WITH']) && !empty($this->request->server['HTTP_X_REQUESTED_WITH']) && strtolower($this->request->server['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';

		$ssl = (
				!empty($_SERVER['HTTPS']) && (strtolower($_SERVER['HTTPS']) == 'on' || $_SERVER['HTTPS'] == '1') ||
				!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' ||
				!empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on'
			) ? true : false;

		if (!(int)$this->config->get('pd_status') || !(int)$this->config->get('pd_dp_status') || !$this->validateRequest()) {
			$this->response->redirect($this->url->link('common/home', '', $ssl));
			return;
		}

		$this->document->addScript('catalog/view/javascript/pd/downloads.min.js');

		if (file_exists('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/pd/css/downloads.min.css')) {
			$this->document->addStyle('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/pd/css/downloads.min.css');
		} else {
			$this->document->addStyle('catalog/view/theme/default/stylesheet/pd/css/downloads.min.css');
		}

		$this->document->setTitle($this->language->get('heading_title_downloads'));

		if (isset($this->request->get['dsearch'])) {
			$search = html_entity_decode($this->request->get['dsearch'], ENT_QUOTES, 'UTF-8');
		} else if (isset($this->request->post['dsearch'])) {
			$search = html_entity_decode($this->request->post['dsearch'], ENT_QUOTES, 'UTF-8');
		} else {
			$search = '';
		}

		if (isset($this->request->get['s'])) {
			$searching = true;
		} else {
			$searching = false;
		}

		if (isset($this->request->get['f'])) {
			$filtering = true;
		} else {
			$filtering = false;
		}

		if (isset($this->request->get['dtags'])) {
			$tags = $this->request->get['dtags'];
		} else {
			$tags = array();
		}

		if (isset($this->request->get['dsort'])) {
			$sort = $this->request->get['dsort'];
		} else if (isset($this->request->post['dsort'])) {
			$sort = $this->request->post['dsort'];
		} else {
			$sort = 'name';
		}

		if (isset($this->request->get['dorder'])) {
			$order = $this->request->get['dorder'];
		} else if (isset($this->request->post['dorder'])) {
			$order = $this->request->post['dorder'];
		} else {
			$order = 'ASC';
		}

		if (isset($this->request->get['dpage'])) {
			$page = $this->request->get['dpage'];
		} else {
			$page = 1;
		}

		if ((int)$page < 1) {
			$page = 1;
		}

		if (isset($this->request->get['r'])) {
			$request = $this->request->get['r'];
		} else if (isset($this->request->post['r'])) {
			$request = $this->request->post['r'];
		} else {
			$request = false;
		}

		$url_params = array();

		if ($search) {
			$url_params['dsearch'] = $search;
		}

		if ($sort && $sort != 'name') {
			$url_params['dsort'] = $sort;
		}

		if ($order && $order != 'ASC') {
			$url_params['dorder'] = $order;
		}

		if ((int)$page != 1 && !isset($this->request->post['dsort']) && !isset($this->request->post['dsearch'])) {
			$url_params['dpage'] = $page;
		}

		if ($tags) {
			$url_params['dtags'] = $tags;
		}

		$display_url = $this->url->link('download/download', http_build_query($url_params), $ssl);

		if (isset($this->request->post['redirect']) && (int)$this->request->post['redirect'] && !$ajax_request) {
			$this->response->redirect($display_url, 303);
			return;
		}

		$display_url = html_entity_decode($display_url, ENT_QUOTES, 'UTF-8');

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text'  => $this->language->get('text_home'),
			'href'  => $this->url->link('common/home', '', $ssl),
		);

		$data['breadcrumbs'][] = array(
			'text'  => $this->language->get('heading_title_downloads'),
			'href'  => $this->url->link('download/download', '', $ssl),
		);

		$data['heading_title'] = $this->language->get('heading_title_downloads');

		$data['text_no_downloads'] = ($filtering && $tags) ? $this->language->get('text_filter_zero') : (($search) ? $this->language->get('text_search_zero') : $this->language->get('text_no_downloads'));
		$data['text_search'] = $this->language->get('text_search');
		$data['text_clear_search'] = $this->language->get('text_clear_search');
		$data['text_search_downloads'] = $this->language->get('text_search_downloads');
		$data['text_filter_by'] = $this->language->get('text_filter_by');
		$data['text_downloaded'] = $this->language->get('text_downloaded');

		$data['column_file_name'] = $this->language->get('column_file_name');
		$data['column_size'] = $this->language->get('column_size');
		$data['column_date_added'] = $this->language->get('column_date_added');
		$data['column_date_modified'] = $this->language->get('column_date_modified');
		$data['column_link'] = $this->language->get('column_link');

		$data['error_ajax_request'] = $this->language->get('error_ajax_request');

		$status = $this->config->get("pd_status");
		$logged = $this->customer->isLogged();
		$login_text = $this->config->get('pd_show_login_required_text');
		$login = $this->config->get('pd_require_login');
		$no_link = $this->config->get('pd_show_download_without_link');
		$login_free = $this->config->get('pd_require_login_free');

		$show_downloads = $status && ($logged || $no_link || !$login && !$login_free);

		$data['mid'] = "dp";
		$data['downloads'] = array();
		$data['download_tags'] = array();
		$data['show_search_bar'] = (int)$this->config->get('pd_dp_show_search_bar');
		$data['show_filter_tags'] = (int)$this->config->get('pd_dp_show_filter_tags');
		$data['show_file_size'] = (int)$this->config->get('pd_dp_show_file_size');
		$data['show_date_added'] = (int)$this->config->get('pd_dp_show_date_added');
		$data['show_date_modified'] = (int)$this->config->get('pd_dp_show_date_modified');
		$data['make_file_name_link'] = (int)$this->config->get('pd_dp_name_as_link');
		$data['show_free_download_count'] = (int)$this->config->get('pd_show_free_download_count');
		$data['show_downloads_remaining'] = (int)$this->config->get('pd_show_downloads_remaining');
		$data['show_icons'] = (int)$this->config->get('pd_dp_show_icon');
		$data['use_fa_icons'] = (int)$this->config->get('pd_use_fa_icons');
		$data['show_downloads'] = $show_downloads;
		$data['search_link'] = $this->url->link('download/download', '', $ssl);
		$data['request_url'] = html_entity_decode($this->url->link('download/download', '', $ssl));

		$data['show_login_required'] = 0;
		$data['text_login_required'] = $this->language->get('text_no_downloads');

		if (!$logged && $login_text) {
			if (!$no_link && ($login || $login_free)) {
				$data['show_login_required'] = $this->model_catalog_download->getFreeDownloadsCount();
				$data['text_login_required'] = sprintf($this->language->get('text_login_required'), $this->url->link('account/login', 'redirect=' . urlencode('download/download'), $ssl));
			}
		}

		$per_page = (int)$this->config->get('pd_dp_downloads_per_page');

		$filter_data = array(
			'sort'          => $sort,
			'order'         => $order,
			'start'         => ($page - 1) * $per_page,
			'per_page'      => $per_page,
			'limit'         => 0,
			'search'        => explode(" ", $search),
			'filter_tag'    => $tags
		);

		if ($show_downloads) {
			if ($this->config->get('pd_dp_show_filter_tags')) {
				$download_tags = $this->model_catalog_download->getDownloadTags($filter_data);
				foreach ($download_tags as $tag) {
					$data['download_tags'][$tag["download_tag_id"]] = $tag["name"];
				}
			}

			$results = $this->model_catalog_download->getDownloads($filter_data);
			$filtered_total = $this->model_catalog_download->getFilteredDownloadCount();
			$total = $this->model_catalog_download->getTotalDownloads();

			$fa_icons = get_fa_icons();

			foreach ($results as $result) {
				// if (file_exists(DIR_DOWNLOAD . $result['filename'])) {
					// $size = filesize(DIR_DOWNLOAD . $result['filename']);
					$size = $result['file_size'];

					$i = 0;

					$suffix = array(
						'B',
						'KiB',
						'MiB',
						'GiB',
						'TiB',
					);

					while (($size / 1024) > 1) {
						$size = $size / 1024;
						$i++;
					}

					if ($this->config->get('pd_dp_show_icon')) {
						$info = pathinfo($result['mask']);

						if (isset($info["extension"])) {
							if ($data['use_fa_icons']) {
								$icon = isset($fa_icons[utf8_strtolower($info["extension"])]) ? $fa_icons[utf8_strtolower($info["extension"])] : $fa_icons['unknown'];
							} else {
								$icon = is_readable("image/icons/" . utf8_strtolower($info["extension"]) . ".png") ? "image/icons/" . utf8_strtolower($info["extension"]) . ".png" : (is_readable("image/icons/unknown.png") ? "image/icons/unknown.png" : "");
							}
						} else {
							$icon = $data['use_fa_icons'] ? $fa_icons['unknown'] : (is_readable("image/icons/unknown.png") ? "image/icons/unknown.png" : "");
						}
					} else {
						$icon = "";
					}

					if ($this->customer->isLogged() || !(int)$result['login'] && !$this->config->get('pd_require_login') && !$this->config->get('pd_require_login_free')) {
						$href = $this->url->link('download/download/get', 'did=' . $result['download_id'], $ssl);
						$link_text = $this->language->get('button_download');
					} else {
						$href = $this->url->link('account/login', 'redirect=' . urlencode('download/download/get&did='. $result['download_id']), $ssl);
						$link_text = $this->language->get('button_login');
					}

					$data['downloads'][] = array(
						'download_id'   => $result['download_id'],
						'free'          => (int)$result['is_free'],
						'name'          => $result['name'],
						'date_added'    => (new DateTime($result['date_added'], new DateTimeZone('UTC')))->format($this->language->get('date_format_short')), //date($this->language->get('date_format_short'), strtotime($result['date_added'])),
						'date_modified' => (new DateTime($result['date_modified'], new DateTimeZone('UTC')))->format($this->language->get('date_format_short')), //date($this->language->get('date_format_short'), strtotime($result['date_modified'])),
						'size'          => round(substr($size, 0, strpos($size, '.') + 4), 2) . $suffix[$i],
						'href'          => $href,
						'link_text'     => $link_text,
						'downloaded'    => $result['downloaded'],
						'icon'          => $icon,
					);
				// }
			}
		} else {
			$filtered_total = 0;
			$total = 0;
		}

		$data['total_downloads'] = $total;

		$url_params = array();

		if ($search) {
			$url_params['dsearch'] = $search;
		}

		if ($order) {
			$url_params['dorder'] = (($order == "ASC") ? "DESC" : "ASC");
		}

		if ($page) {
			$url_params['dpage'] = $page;
		}

		if ($tags) {
			$url_params['dtags'] = $tags;
		}

		foreach (array('name', 'size', 'added', 'modified') as $value) {
			$url_params['dsort'] = $value;
			$data["sort_$value"] = $this->url->link('download/download', http_build_query($url_params), $ssl);
		}

		$url_params = array();

		if ($search) {
			$url_params['dsearch'] = $search;
		}

		if ($order) {
			$url_params['dorder'] = $order;
		}

		if ($page) {
			$url_params['dpage'] = "{page}";
		}

		if ($tags) {
			$url_params['dtags'] = $tags;
		}

		$data['search'] = $search;
		$data['tags'] = $tags;
		$data['sort'] = $sort;
		$data['order'] = $order;

		$pagination = new Pagination();
		$pagination->total = $filtered_total;
		$pagination->page = $page;
		$pagination->limit = $per_page;
		$pagination->url = str_replace('%7Bpage%7D', '{page}', $this->url->link('download/download', http_build_query($url_params), $ssl));

		$data['pagination'] = $pagination->render();

		$results_find = array(
			'{start}',
			'{end}',
			'{total}',
			'{pages}'
		);

		$results_replace = array(
			($filtered_total) ? (($page - 1) * $per_page) + 1 : 0,
			((($page - 1) * $per_page) > ($filtered_total - $per_page)) ? $filtered_total : ((($page - 1) * $per_page) + $per_page),
			$filtered_total,
			$per_page ? ceil($filtered_total / $per_page) : 1
		);

		$data['results'] = str_replace($results_find, $results_replace, ($search || $tags) ? $this->language->get('text_pagination_custom') . ' ' . sprintf($this->language->get('text_filtered_from'), $total) : $this->language->get('text_pagination_custom'));

		$url_params = array();

		if ($sort) {
			$url_params['dsort'] = $sort;
		}

		if ($order) {
			$url_params['dorder'] = $order;
		}

		if ($page) {
			$url_params['dpage'] = $page;
		}

		if ($tags) {
			$url_params['dtags'] = $tags;
		}

		$data['search_url'] = $this->url->link('download/download', http_build_query($url_params), $ssl);

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		$template = 'download/downloads_files';

		$data['downloads_data'] = $this->load->view($template, $data);

		$template = 'download/downloads_filter';

		$data['downloads_filter_data'] = $this->load->view($template, $data);

		$template = 'download/downloads_search';

		$data['downloads_search_data'] = $this->load->view($template, $data);

		$template = 'download/downloads_page';

		if ($ajax_request) {
			if (!$searching) {
				$content = $data['downloads_data'];
			} else {
				$content = $data['downloads_filter_data'];
			}
			$this->response->addHeader('Content-Type: application/json');
			$this->response->setOutput(json_enc(array("content" => $content, "url" => $display_url, "r" => $request), JSON_UNESCAPED_SLASHES));
		} else {
			$this->response->setOutput($this->load->view($template, $data));
		}
	}

	public function get() {
		$ssl = (
				!empty($_SERVER['HTTPS']) && (strtolower($_SERVER['HTTPS']) == 'on' || $_SERVER['HTTPS'] == '1') ||
				!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' ||
				!empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on'
			) ? true : false;

		if (isset($this->request->get['did']) && $this->validateRequest()) {
			$download_id = $this->request->get['did'];
		} else {
			if ($this->config->get("pd_dp_status")) {
				$this->response->redirect($this->url->link('download/download', '', $ssl));
			} else {
				$this->response->redirect($this->url->link('common/home', '', $ssl));
			}
			return;
		}

		if ($this->config->get("pd_require_login") && !$this->customer->isLogged()) {
			$this->session->data['redirect'] = $this->url->link('download/download/get', 'did=' . $download_id, $ssl);
			$this->response->redirect($this->url->link('account/login', '', $ssl));
			return;
		}

		if ($this->config->get("pd_differentiate_customers")) {
			$this->load->model('catalog/download');

			$download_customer_groups = $this->model_catalog_download->getDownloadCustomerGroups($download_id);

			if (!in_array($this->customer->getGroupId(), $download_customer_groups) && !in_array('0', $download_customer_groups)) {
				if ($this->config->get("pd_dp_status")) {
					$this->response->redirect($this->url->link('download/download', '', $ssl));
				} else {
					$this->response->redirect($this->url->link('common/home', '', $ssl));
				}
				return;
			}
		}

		$download_info = $this->model_catalog_download->getFreeDownload($download_id);

		if ($download_info) {
			if ((int)$download_info['login'] && !$this->customer->isLogged()) {
				$this->session->data['redirect'] = $this->url->link('download/download/get', 'did=' . $download_id, $ssl);
				$this->response->redirect($this->url->link('account/login', '', $ssl));
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

			if ((int)$this->config->get('pd_dp_delay_download') && !$this->downloadTokenValid()) {
				$this->download($download_info);
				return;
			}

			$download_finished = function() use ($download_info) {
				$this->model_catalog_download->updateDownloaded($download_info['download_id']);
				// unset($this->session->data['download_token']);
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

	public function account_downloads() {
		$ssl = (
				!empty($_SERVER['HTTPS']) && (strtolower($_SERVER['HTTPS']) == 'on' || $_SERVER['HTTPS'] == '1') ||
				!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' ||
				!empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on'
			) ? true : false;

		if (!$this->customer->isLogged()) {
			$this->session->data['redirect'] = $this->url->link('account/download', '', $ssl);
			$this->response->redirect($this->url->link('account/login', '', $ssl));
			return;
		}

		if (!$this->validateRequest()) {
			$this->response->redirect($this->url->link('account/download', '', $ssl));
			return;
		}

		$this->document->addScript('catalog/view/javascript/pd/moment-with-locales.min.js');

		if (file_exists('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/pd/css/account.downloads.min.css')) {
			$this->document->addStyle('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/pd/css/account.downloads.min.css');
		} else {
			$this->document->addStyle('catalog/view/theme/default/stylesheet/pd/css/account.downloads.min.css');
		}

		$this->load->helper('pd');

		if (isset($this->request->get['download_search'])) {
			$search = html_entity_decode($this->request->get['download_search'], ENT_QUOTES, 'UTF-8');
		} else if (isset($this->request->post['download_search'])) {
			$search = html_entity_decode($this->request->post['download_search'], ENT_QUOTES, 'UTF-8');
		} else {
			$search = '';
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else if (isset($this->request->post['sort'])) {
			$sort = $this->request->post['sort'];
		} else {
			$sort = 'date_added';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else if (isset($this->request->post['order'])) {
			$order = $this->request->post['order'];
		} else {
			$order = 'DESC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		if ((int)$page < 1) {
			$page = 1;
		}

		$url_params = array();

		if ($sort && $sort != 'date_added') {
			$url_params['sort'] = $sort;
		}

		if ($order && $order != 'DESC') {
			$url_params['order'] = $order;
		}

		if ($search) {
			$url_params['download_search'] = $search;
		}

		$display_url = $this->url->link('account/download', http_build_query($url_params), $ssl);

		if (isset($this->request->post['redirect']) && (int)$this->request->post['redirect']) {
			$this->response->redirect($display_url, 303);
			return;
		}

		$this->load->language('download/download');

		$this->document->setTitle($this->language->get('heading_title_account_downloads'));

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home', '', $ssl)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_account'),
			'href' => $this->url->link('account/account', '', $ssl)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_downloads'),
			'href' => $this->url->link('account/download', '', $ssl)
		);

		$this->load->model('catalog/download');

		$data['heading_title'] = $this->language->get('heading_title_account_downloads');

		$data['locale'] = $this->language->get('code');
		$data['text_no_downloads'] = $search ? $this->language->get('text_search_zero') : $this->language->get('text_no_order_downloads');
		$data['text_search_downloads'] = $this->language->get('text_search_downloads');

		$data['column_order_id'] = $this->language->get('column_order_id');
		$data['column_name'] = $this->language->get('column_name');
		$data['column_active'] = $this->language->get('column_active');
		$data['column_size'] = $this->language->get('column_size');
		$data['column_date_added'] = $this->language->get('column_date_added');
		$data['column_date_modified'] = $this->language->get('column_date_modified');

		$data['button_search'] = $this->language->get('button_search');
		$data['button_clear'] = $this->language->get('button_clear');
		$data['button_download'] = $this->language->get('button_download');
		$data['button_continue'] = $this->language->get('button_continue');

		$data['show_icons'] = (int)$this->config->get('pd_cadp_show_icon');
		$data['use_fa_icons'] = (int)$this->config->get('pd_use_fa_icons');

		$per_page = (int)$this->config->get('pd_cadp_downloads_per_page');

		$filter_data = array(
			'sort'          => $sort,
			'order'         => $order,
			'start'         => ($page - 1) * $per_page,
			'per_page'      => $per_page,
			'limit'         => 0,
			'search'        => explode(" ", $search),
		);

		$fa_icons = get_fa_icons();

		$data['downloads'] = array();

		$results = $this->model_catalog_download->getAccountDownloads($filter_data);

		$filtered_total = $this->model_catalog_download->getFilteredDownloadCount();
		$total = $this->model_catalog_download->getAccountTotalDownloads();

		foreach ($results as $result) {
			// if (file_exists(DIR_DOWNLOAD . $result['filename'])) {
				// $size = filesize(DIR_DOWNLOAD . $result['filename']);
				$size = $result['file_size'];

				$i = 0;

				$suffix = array(
					'B',
					'KiB',
					'MiB',
					'GiB',
					'TiB',
				);

				while (($size / 1024) > 1) {
					$size = $size / 1024;
					$i++;
				}

				if ($this->config->get('pd_dp_show_icon')) {
					$info = pathinfo($result['mask']);

					if (isset($info["extension"])) {
						if ($data['use_fa_icons']) {
							$icon = isset($fa_icons[utf8_strtolower($info["extension"])]) ? $fa_icons[utf8_strtolower($info["extension"])] : $fa_icons['unknown'];
						} else {
							$icon = is_readable("image/icons/" . utf8_strtolower($info["extension"]) . ".png") ? "image/icons/" . utf8_strtolower($info["extension"]) . ".png" : (is_readable("image/icons/unknown.png") ? "image/icons/unknown.png" : "");
						}
					} else {
						$icon = $data['use_fa_icons'] ? $fa_icons['unknown'] : (is_readable("image/icons/unknown.png") ? "image/icons/unknown.png" : "");
					}
				} else {
					$icon = "";
				}

				$data['downloads'][] = array(
					'download_id'   => $result['download_id'],
					'order_id'      => $result['order_id'],
					'date_added'    => (new DateTime($result['date_added'], new DateTimeZone('UTC')))->format($this->language->get('date_format_short')),//date($this->language->get('date_format_short'), strtotime($result['date_added'])),
					'date_modified' => (new DateTime($result['date_modified'], new DateTimeZone('UTC')))->format($this->language->get('date_format_short')),//date($this->language->get('date_format_short'), strtotime($result['date_modified'])),
					'name'          => $result['name'],
					'size'          => round(substr($size, 0, strpos($size, '.') + 4), 2) . $suffix[$i],
					'href'          => $this->url->link('account/download/download', !empty($result['order_product_download_id']) ? 'pdi=' . $result['order_product_download_id'] : 'odi=' . $result['order_option_download_id'], $ssl),
					'remaining'     => $this->formatRemaining($result),
					'expired'       => $result['expired'],
					'icon'          => $icon
				);
			// }
		}

		$url_params = array();

		if ($search) {
			$url_params['download_search'] = $search;
		}

		if ($order) {
			$url_params['order'] = (($order == "ASC") ? "DESC" : "ASC");
		}

		if ($page) {
			$url_params['page'] = $page;
		}

		foreach (array('order_id', 'name', 'file_size', 'date_added', 'date_modified') as $value) {
			$url_params['sort'] = $value;
			$data["sort_$value"] = $this->url->link('account/download', http_build_query($url_params), $ssl);
		}

		$url_params = array();

		if ($search) {
			$url_params['download_search'] = $search;
		}

		if ($order) {
			$url_params['order'] = $order;
		}

		if ($page) {
			$url_params['page'] = "{page}";
		}

		$data['search'] = $search;
		$data['sort'] = $sort;
		$data['order'] = $order;

		$pagination = new Pagination();
		$pagination->total = $filtered_total;
		$pagination->page = $page;
		$pagination->limit = $per_page;
		$pagination->url = str_replace('%7Bpage%7D', '{page}', $this->url->link('account/download', http_build_query($url_params), $ssl));

		$data['pagination'] = $pagination->render();

		$results_find = array(
			'{start}',
			'{end}',
			'{total}',
			'{pages}'
		);

		$results_replace = array(
			($filtered_total) ? (($page - 1) * $per_page) + 1 : 0,
			((($page - 1) * $per_page) > ($filtered_total - $per_page)) ? $filtered_total : ((($page - 1) * $per_page) + $per_page),
			$filtered_total,
			$per_page ? ceil($filtered_total / $per_page) : 1
		);

		$data['results'] = str_replace($results_find, $results_replace, ($search) ? $this->language->get('text_pagination_custom') . ' ' . sprintf($this->language->get('text_filtered_from'), $total) : $this->language->get('text_pagination_custom'));

		$data['continue'] = $this->url->link('account/account', '', $ssl);

		$url_params = array();

		if ($sort) {
			$url_params['sort'] = $sort;
		}

		if ($order) {
			$url_params['order'] = $order;
		}

		if ($page) {
			$url_params['page'] = $page;
		}

		$data['search_url'] = $this->url->link('account/download', http_build_query($url_params), $ssl);

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		$template = 'download/account_download';

		$this->response->setOutput($this->load->view($template, $data));
	}

	public function account_download() {
		$ssl = (
				!empty($_SERVER['HTTPS']) && (strtolower($_SERVER['HTTPS']) == 'on' || $_SERVER['HTTPS'] == '1') ||
				!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' ||
				!empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on'
			) ? true : false;

		if (!$this->customer->isLogged()) {
			$this->session->data['redirect'] = $this->url->link('account/download', '', $ssl);
			$this->response->redirect($this->url->link('account/login', '', $ssl));
			return;
		}

		if (!$this->validateRequest()) {
			$this->response->redirect($this->url->link('account/download', '', $ssl));
			return;
		}

		if (isset($this->request->get['pdi'])) {
			$order_product_download_id = $this->request->get['pdi'];
			$order_option_download_id = null;
		} elseif (isset($this->request->get['odi'])) {
			$order_product_download_id = null;
			$order_option_download_id = $this->request->get['odi'];
		} else {
			$this->response->redirect($this->url->link('account/download', '', $ssl));
			return;
		}

		$this->load->model('catalog/download');

		if ($order_product_download_id) {
			$download_info = $this->model_catalog_download->getOrderProductDownload($order_product_download_id);
		} else {
			$download_info = $this->model_catalog_download->getOrderOptionDownload($order_option_download_id);
		}

		if ($download_info) {
			$this->load->helper('pd');

			$file = DIR_DOWNLOAD . $download_info['filename'];
			$mask = basename($download_info['mask']);

			if (!file_exists($file)) {
				if ($this->config->get('config_error_log')) {
					$this->log->write('Error: Could not find file ' . $file . '!');
				}
				$this->unavailable($download_info, "not_found", $ssl);
				return;
			}

			if (!is_readable($file)) {
				if ($this->config->get('config_error_log')) {
					$this->log->write('Error: Could not read file ' . $file . '!');
				}
				$this->unavailable($download_info, "not_found", $ssl);
				return;
			}

			$download_finished = function() use ($download_info, $order_product_download_id, $order_option_download_id) {
				$this->model_catalog_download->updateDownloaded($download_info['download_id']);
				if ($order_product_download_id) {
					$this->model_catalog_download->updateOrderProductDownload($order_product_download_id);
				} else {
					$this->model_catalog_download->updateOrderOptionDownload($order_option_download_id);
				}
			};

			$dh = new DownloadHandler($this->registry);
			$dl = $dh->download($file, $mask, $download_finished->bindTo($this));
		} else {
			$this->response->redirect($this->url->link('account/download', '', $ssl));
		}
	}

	protected function unavailable($download_info, $error="not_found", $account=false) {
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
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home', '', $ssl)
		);

		if ($account) {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_account'),
				'href' => $this->url->link('account/account', '', $ssl)
			);

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_downloads'),
				'href' => $this->url->link('account/download', '', $ssl)
			);
		} else if ($this->config->get("pd_dp_status")) {
			$data['breadcrumbs'][] = array(
				'text'	=> $this->language->get('text_downloads'),
				'href'  => $this->url->link('download/download', '', $ssl),
			);
		}

		if (isset($this->request->get['route'])) {
			$url_data = $this->request->get;

			unset($url_data['_route_']);

			$route = $url_data['route'];

			unset($url_data['route']);

			$url = '';

			if ($url_data) {
				$url = '&' . urldecode(http_build_query($url_data, '', '&'));
			}

			$data['breadcrumbs'][] = array(
				'text'  => $download_name,
				'href'  => $this->url->link($route, $url, $ssl),
			);
		}

		$data['heading_title'] = $this->language->get('heading_title_' . $error);

		if ($account) {
			$data['text_error'] = sprintf($this->language->get('error_download_' . $error), $download_name);
		} else {
			$data['text_error'] = sprintf($this->language->get('error_sample_' . $error), $download_name);
		}

		$data['button_continue'] = $this->language->get('button_continue');

		$this->response->addHeader($this->request->server['SERVER_PROTOCOL'] . ' 404 Not Found');

		if ($account) {
			$data['continue'] = $this->url->link('account/download', '', $ssl);
		} else {
			$data['continue'] = $this->url->link($this->config->get("pd_dp_status") ? 'download/download' : 'common/home', '', $ssl);
		}

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		$template = 'download/unavailable';

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

		$heading_title = sprintf($this->language->get('heading_title_download'), $download_name);

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

			$url_data['breadcrumbs'][] = array(
				'text'  => $download_name,
				'href'  => $this->url->link($route, $url, $ssl),
			);
		}

		$token = hash("crc32b", $download_info['filename'] . microtime());
		$this->session->data['download_token'] = $token;

		$download_link = $this->url->link('download/download/get', 'did=' . $download_info['download_id'] . '&dt=' . $token, $ssl);

		$data['heading_title'] = $heading_title;

		$data['text_download'] = sprintf($this->language->get('text_download_auto_start'), $download_link);
		$data['download_link'] = html_entity_decode($download_link);

		$data['button_continue'] = $this->language->get('button_continue');

		$data['continue'] = $this->url->link($this->config->get("pd_dp_status") ? 'download/download' : 'common/home', '', $ssl);

		$data['download_delay'] = $this->config->get('pd_dp_delay_download');

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		$template = 'download/download';

		$this->response->setOutput($this->load->view($template, $data));
	}

	private function downloadTokenValid() {
		if (!isset($this->request->get['dt']) || !isset($this->session->data['download_token']) || $this->session->data['download_token'] != $this->request->get['dt']) {
			return false;
		}

		return true;
	}

	protected function validateRequest() {
		return in_array($this->config->get('config_store_id'), bdecode($this->config->get('pd_as')));
	}

	private function formatRemaining($data) {
		$value = '';
		if ($data['expired'] == '1') {
			$value = $this->language->get('text_expired');
		} else if ($data['constraint'] == '0') {
			$value = $this->language->get('text_unlimited_downloads');
		} else if ($data['constraint'] == '1') {
			$value = sprintf($this->language->get('text_quantitative_constraint'), $data['remaining']);
		} else if ($data['constraint'] == '2') {
			$end_time = new DateTime($data['end_time'], new DateTimeZone("UTC"));
			$value = sprintf($this->language->get('text_temporal_constraint'), $end_time->format(DateTime::ISO8601));
		} else if ($data['constraint'] == '3') {
			$end_time = new DateTime($data['end_time'], new DateTimeZone("UTC"));
			$value = sprintf($this->language->get('text_both_constraints'), $data['remaining'], $end_time->format(DateTime::ISO8601));
		}
		return $value;
	}
}
