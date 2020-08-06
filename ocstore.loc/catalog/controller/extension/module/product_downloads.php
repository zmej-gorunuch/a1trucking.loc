<?php
class ControllerExtensionModuleProductDownloads extends Controller {
	protected static $total_downloads; 

	public function __construct($registry) {
		parent::__construct($registry);

		$this->load->helper('pd');

		$this->load->language('download/download');

		$this->load->model('catalog/download');
	}

	public function index($settings) {
		if (!$settings) {
			$this->log->write("Product Downloads module called without parameters. Route:" . $this->request->get['route']);
			return;
		} else if (!$this->validateRequest()) {
			return;
		}

		$ssl = (
				!empty($_SERVER['HTTPS']) && (strtolower($_SERVER['HTTPS']) == 'on' || $_SERVER['HTTPS'] == '1') ||
				!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' ||
				!empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on'
			) ? true : false;

		$data['heading_title'] = isset($settings['names'][$this->config->get('config_language_id')]) ? $settings['names'][$this->config->get('config_language_id')] : $this->language->get('heading_title_downloads');

		$data['error_ajax_request'] = $this->language->get('error_ajax_request');

		$data['lazy_load'] = (int)$settings['lazy_load'];
		$data['show_in_tab'] = (int)$settings['show_in_tab'];
		$data['position'] = $data['show_in_tab'] ? "content_tab" : ((isset($settings['position'])) ? $settings['position'] : "content_bottom");
		$data['mid'] = $settings['module_id'];
		$data['downloads_search_data'] = '';
		$data['product_id'] = 0;
		$settings['search_page'] = (isset($this->request->get['_route_']) && $this->request->get['_route_'] == "product/search" || isset($this->request->get['route']) && $this->request->get['route'] == "product/search" || !empty($this->request->get['sp'])) ? true : false;

		$status = (int)$this->config->get('pd_status') && (int)$settings['status'];
		$logged = $this->customer->isLogged();
		$login_text = $this->config->get('pd_show_login_required_text');
		$login = $this->config->get('pd_require_login');
		$no_link = $this->config->get('pd_show_download_without_link');
		$login_free = $this->config->get('pd_require_login_free');
		$login_regular = $this->config->get('pd_require_login_regular');
		$purchasable = $this->config->get('pd_show_purchasable_downloads');

		if (isset($this->request->get['dsearch'])) {
			$search = html_entity_decode($this->request->get['dsearch'], ENT_QUOTES, 'UTF-8');
		} else if (isset($this->request->get['search']) && $settings['search_page']) {
			$search = html_entity_decode($this->request->get['search'], ENT_QUOTES, 'UTF-8');
		} else {
			$search = '';
		}

		if (isset($this->request->get['dtags'])) {
			$tags = $this->request->get['dtags'];
		} else {
			$tags = array();
		}

		if (isset($this->request->get['dsort'])) {
			$sort = $this->request->get['dsort'];
		} else {
			$sort = 'name';
		}

		if (isset($this->request->get['dorder'])) {
			$order = $this->request->get['dorder'];
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

		$url_params = array();

		$url_params['mid'] = $data['mid'];

		if ($search) {
			$url_params['dsearch'] = $search;
		}

		if ($sort) {
			$url_params['dsort'] = $sort;
		}

		if ($order) {
			$url_params['dorder'] = $order;
		}

		if ((int)$page != 1) {
			$url_params['dpage'] = $page;
		}

		if ($tags) {
			$url_params['dtags'] = $tags;
		}

		if ($settings['search_page']) {
			$url_params['sp'] = "1";
		}

		if ($settings['type'] == 'custom') {
			if (!empty($settings['downloads'])) {
				$download_ids = explode(",", $settings['downloads']);
			} else {
				$download_ids = array();
			}

			$show_downloads = $status && ($logged || $no_link || $login_text || !$login && !$login_free);

			$data['show_module'] = $show_downloads && count($download_ids) || $status && (int)$settings['show_empty_module'];

			$url_params['ll'] = 1; // lazy load
			$url_params['pos'] = $data['position'];
			$data['lazy_load_url'] = html_entity_decode($this->url->link('extension/module/product_downloads/load', http_build_query($url_params), $ssl));

			if (!$data['lazy_load'] && $show_downloads && count($download_ids)) {
				$data['downloads_search_data'] = $this->load($settings);
			}
		} else if ($settings['type'] == 'free') {
			$show_downloads = $status && ($logged || $no_link || !$login && !$login_free);

			$data['show_module'] = $show_downloads || $status && (int)$settings['show_empty_module'];

			$url_params['ll'] = 1; // lazy load
			$url_params['pos'] = $data['position'];
			$data['lazy_load_url'] = html_entity_decode($this->url->link('extension/module/product_downloads/load', http_build_query($url_params), $ssl));

			if (!$data['lazy_load'] && $show_downloads) {
				$data['downloads_search_data'] = $this->load($settings);
				$data['show_module'] = $show_downloads && self::$total_downloads || $status && (int)$settings['show_empty_module'];
			}
		} else if ($settings['type'] == 'product' && isset($this->request->get['product_id'])) {
			$data['product_id'] = $this->request->get['product_id'];

			$show_downloads = $status && ($logged || $login_text || $no_link || (!$login && !$login_free) || ($purchasable && !$login && !$login_regular));

			$data['show_module'] = $show_downloads || $status && (int)$settings['show_empty_module'];

			$url_params['pid'] = $data['product_id'];
			$url_params['ll'] = 1; // lazy load
			$url_params['pos'] = $data['position'];
			$data['lazy_load_url'] = html_entity_decode($this->url->link('extension/module/product_downloads/load', http_build_query($url_params), $ssl));

			if (!$data['lazy_load']) {
				$download_count = $this->model_catalog_download->getProductDownloadsCount($data['product_id']);

				$data['show_module'] = $show_downloads && $download_count || $status && (int)$settings['show_empty_module'];

				// if ($download_count) {
					$settings['product_id'] = $data['product_id'];
					$data['downloads_search_data'] = $this->load($settings);
					$this->session->data["download_count"][$data['product_id']] = $download_count;
				// }
			} else if ($data['position'] == 'content_tab') {
				$download_count = $this->model_catalog_download->getProductDownloadsCount($data['product_id']);
				$data['show_module'] = $show_downloads && $download_count || $status && (int)$settings['show_empty_module'];
				$this->session->data["download_count"][$data['product_id']] = $download_count;
			}
		} else {
			$data['lazy_load'] = 0;
			$data['show_module'] = 0;
		}

		if ($data['show_module']) {
			$this->document->addScript('catalog/view/javascript/pd/downloads.min.js');

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template'). '/stylesheet/pd/css/downloads.min.css')) {
				$this->document->addStyle('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/pd/css/downloads.min.css');
			} else {
				$this->document->addStyle('catalog/view/theme/default/stylesheet/pd/css/downloads.min.css');
			}
		}

		$template = 'download/downloads_module';

		return $this->load->view($template, $data);
	}

	public function load($settings=null) {
		$ssl = (
				!empty($_SERVER['HTTPS']) && (strtolower($_SERVER['HTTPS']) == 'on' || $_SERVER['HTTPS'] == '1') ||
				!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' ||
				!empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on'
			) ? true : false;

		$direct_call = !empty($settings);
		$ajax_request = isset($this->request->server['HTTP_X_REQUESTED_WITH']) && !empty($this->request->server['HTTP_X_REQUESTED_WITH']) && strtolower($this->request->server['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';

		$this->load->model('extension/module');

		if (!$settings && isset($this->request->get['mid'])) {
			$settings = $this->model_extension_module->getModule($this->request->get['mid']);
		}

		if (!$settings || !$this->validateRequest()) {
			return;
		}

		$settings['search_page'] = isset($settings['search_page']) ? $settings['search_page'] : ((isset($this->request->get['_route_']) && $this->request->get['_route_'] == "product/search" || isset($this->request->get['route']) && $this->request->get['route'] == "product/search" || !empty($this->request->get['sp'])) ? true : false);

		if (isset($settings['product_id'])) {
			$product_id = $settings['product_id'];
		} else if (isset($this->request->get['pid'])) {
			$product_id = $this->request->get['pid'];
		} else {
			$product_id = null;
		}

		if (isset($this->request->get['dsearch'])) {
			$search = html_entity_decode($this->request->get['dsearch'], ENT_QUOTES, 'UTF-8');
		} else if (isset($this->request->post['dsearch'])) {
			$search = html_entity_decode($this->request->post['dsearch'], ENT_QUOTES, 'UTF-8');
		} else if (isset($this->request->get['search']) && $settings['search_page']) {
			$search = html_entity_decode($this->request->get['search'], ENT_QUOTES, 'UTF-8');
		} else {
			$search = '';
		}

		if ($search && !$settings['search_page'] && !(int)$settings['show_search_bar']) {
			$search = '';
		}

		if (isset($this->request->get['dtags'])) {
			$tags = $this->request->get['dtags'];
		} else {
			$tags = array();
		}

		if ($tags && !(int)$settings['show_filter_tags']) {
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

		if (isset($this->request->get['ll'])) {
			$lazy_loading = true;
		} else {
			$lazy_loading = false;
		}

		if (isset($this->request->get['referer'])) {
			$referer = html_entity_decode(urldecode($this->request->get['referer']), ENT_QUOTES, 'UTF-8');
		} else if (!$direct_call && isset($this->request->server['HTTP_REFERER'])) {
			$referer = urldecode($this->request->server['HTTP_REFERER']);
		} else if ($direct_call) {
			$referer = 'http' . (empty($this->request->server['HTTPS']) ? '' : 's') . '://' . $this->request->server['HTTP_HOST'] . $this->request->server['REQUEST_URI'];
		} else {
			$referer = false;
		}

		if ($referer) {
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

			$display_url = html_entity_decode(build_url($referer, array("query" => http_build_query($url_params)), array('dsearch', 'dsort', 'dorder', 'dpage', 'dtags')), ENT_QUOTES, 'UTF-8');
		} else {
			$display_url = false;
		}

		$data['text_no_downloads'] = ($filtering && $tags) ? $this->language->get('text_filter_zero') : (($search || $settings['search_page']) ? $this->language->get('text_search_zero') : $this->language->get('text_no_downloads'));
		$data['text_search'] = $this->language->get('text_search');
		$data['text_clear_search'] = $this->language->get('text_clear_search');
		$data['text_search_downloads'] = $this->language->get('text_search_downloads');
		$data['text_filter_by'] = $this->language->get('text_filter_by');
		$data['text_downloaded'] = $this->language->get('text_downloaded');
		$data['text_remaining'] = $this->language->get('text_remaining');
		$data['text_loading'] = $this->language->get('text_loading');

		$data['column_file_name'] = $this->language->get('column_file_name');
		$data['column_size'] = $this->language->get('column_size');
		$data['column_date_added'] = $this->language->get('column_date_added');
		$data['column_date_modified'] = $this->language->get('column_date_modified');
		$data['column_link'] = $this->language->get('column_link');

		$status = (int)$this->config->get('pd_status') && (int)$settings['status'];
		$logged = $this->customer->isLogged();
		$login_text = $this->config->get('pd_show_login_required_text');
		$login = $this->config->get('pd_require_login');
		$no_link = $this->config->get('pd_show_download_without_link');
		$login_free = $this->config->get('pd_require_login_free');
		$login_regular = $this->config->get('pd_require_login_regular');
		$purchasable = $this->config->get('pd_show_purchasable_downloads');

		$data['position'] = (int)$settings['show_in_tab'] ? "content_tab" : ((isset($settings['position'])) ? $settings['position'] : (isset($this->request->get['pos']) ? $this->request->get['pos'] : "content_bottom"));
		$data['mid'] = $settings['module_id'];
		$data['downloads'] = array();
		$data['download_tags'] = array();
		$data['show_search_bar'] = (int)$settings['show_search_bar'];
		$data['show_filter_tags'] = (int)$settings['show_filter_tags'];
		$data['show_file_size'] = (int)$settings['show_file_size'];
		$data['show_date_added'] = (int)$settings['show_date_added'];
		$data['show_date_modified'] = (int)$settings['show_date_modified'];
		$data['show_icons'] = (int)$settings['show_icon'];
		$data['use_fa_icons'] = (int)$this->config->get('pd_use_fa_icons');
		$data['make_file_name_link'] = (int)$settings['name_as_link'];
		$data['search_page'] = (int)$settings['search_page'];

		$data['show_free_download_count'] = (int)$this->config->get('pd_show_free_download_count');
		$data['show_downloads_remaining'] = (int)$this->config->get('pd_show_downloads_remaining');

		$url_params = array();

		$url_params['mid'] = $data['mid'];

		if ($product_id) {
			$url_params['pid'] = $product_id;
		}

		if ($settings['search_page']) {
			$url_params['sp'] = "1";
		}

		$data['request_url'] = html_entity_decode($this->url->link('extension/module/product_downloads/load', http_build_query($url_params), $ssl));

		$data['show_login_required'] = 0;
		$data['text_login_required'] = $this->language->get('text_no_downloads');

		$per_page = (int)$settings['downloads_per_page'];

		$filter_data = array(
			'sort'          => $sort,
			'order'         => $order,
			'start'         => ($page - 1) * $per_page,
			'per_page'      => $per_page,
			'limit'         => $settings['limit'],
			'search'        => explode(" ", $search),
			'filter_tag'    => $tags
		);

		$results = array();
		$filtered_total_downloads = 0;
		$total_downloads = 0;
		$fa_icons = get_fa_icons();

		if ($settings['type'] == 'custom') {
			if ($settings['downloads']) {
				$download_ids = explode(",", $settings['downloads']);
			} else {
				$download_ids = array();
			}

			$show_downloads = $status && ($logged || $no_link || $login_text || !$login && !$login_free);
			$filtered_total_downloads = 0;

			if (!$logged && $login_text) {
				if (!$no_link && ($login || $login_free)) {
					$data['show_login_required'] = count($download_ids);
					$data['text_login_required'] = sprintf($this->language->get('text_login_required'), $this->url->link('account/login', $referer ? 'redirect=' . urlencode($referer) : '', $ssl));
				}
			}

			if ($settings['search_page'] && !$search) {
			} else if ($show_downloads && count($download_ids)) {
				$filter_data['downloads'] = $settings['downloads'];

				if ($data['show_filter_tags'] && ($lazy_loading || $searching || $direct_call)) {
					$download_tags = $this->model_catalog_download->getDownloadTags($filter_data);

					foreach ($download_tags as $tag) {
						$data['download_tags'][$tag["download_tag_id"]] = $tag["name"];
					}
				}

				$results = $this->model_catalog_download->getDownloads($filter_data);

				$filtered_total_downloads = $this->model_catalog_download->getFilteredDownloadCount();
				$this->download_count = $filtered_total_downloads;
				if ($settings['search_page']) {
					$total_downloads = $filtered_total_downloads;
				} else {
					$total_downloads = count($download_ids);
				}
			}

			$data['show_downloads'] = $show_downloads && ($total_downloads || $filtering || $searching) || $status && (int)$settings['show_empty_module'];
		} else if ($settings['type'] == 'free') {
			$show_downloads = $status && ($logged || $no_link || !$login && !$login_free);
			$filtered_total_downloads = 0;

			if (!$logged && $login_text) {
				if (!$no_link && ($login || $login_free)) {
					$data['show_login_required'] = $this->model_catalog_download->getFreeDownloadsCount();
					$data['text_login_required'] = sprintf($this->language->get('text_login_required'), $this->url->link('account/login', 'redirect=' . urlencode('download/download'), $ssl));
				}
			}

			if ($settings['search_page'] && !$search) {
			} else if ($show_downloads) {
				if ($data['show_filter_tags'] && ($lazy_loading || $searching || $direct_call)) {
					$download_tags = $this->model_catalog_download->getDownloadTags($filter_data);

					foreach ($download_tags as $tag) {
						$data['download_tags'][$tag["download_tag_id"]] = $tag["name"];
					}
				}

				$results = $this->model_catalog_download->getDownloads($filter_data);
				$filtered_total_downloads = $this->model_catalog_download->getFilteredDownloadCount();
				if ($settings['search_page']) {
					$total_downloads = $filtered_total_downloads;
				} else {
					$total_downloads = $this->model_catalog_download->getTotalDownloads();
				}
			}

			$data['show_downloads'] = $show_downloads && ($total_downloads || $filtering || $searching) || $status && (int)$settings['show_empty_module'];
		} else if ($settings['type'] == 'product' && $product_id) {
			$data['product_id'] = $product_id;

			$show_downloads = $status && ($logged || $login_text || $no_link || (!$login && !$login_free) || ($purchasable && !$login && !$login_regular));
			$filtered_total_downloads = 0;

			if (!$logged && $login_text) {
				if (!$no_link && ($login || $login_free && $login_regular)) {
					$data['show_login_required'] = $this->model_catalog_download->getTotalProductDownloadsCount($product_id);
					$data['text_login_required'] = sprintf($this->language->get('text_login_required'), $this->url->link('account/login', $referer ? 'redirect=' . urlencode($referer) : '', $ssl));
				} else if (!$no_link && $login_free) {
					$data['show_login_required'] = $this->model_catalog_download->getFreeDownloadsCount($product_id);
					$data['text_login_required'] = sprintf($this->language->get('text_login_required_free'), $this->url->link('account/login', $referer ? 'redirect=' . urlencode($referer) : '', $ssl));
				} else if (($login_regular || $login) && $purchasable) {
					$data['show_login_required'] = $this->model_catalog_download->getProductCommercialDownloadsCount($product_id);
					$data['text_login_required'] = sprintf($this->language->get('text_login_required_commercial'), $this->url->link('account/login', $referer ? 'redirect=' . urlencode($referer) : '', $ssl));
				}
			}

			if ($show_downloads) {
				if ($data['show_filter_tags'] && ($lazy_loading || $searching || $direct_call)) {
					$download_tags = $this->model_catalog_download->getProductDownloadsTags($product_id, $filter_data);

					foreach ($download_tags as $tag) {
						$data['download_tags'][$tag["download_tag_id"]] = $tag["name"];
					}
				}

				$results = $this->model_catalog_download->getProductDownloads($product_id, $filter_data);
				$filtered_total_downloads = $this->model_catalog_download->getFilteredDownloadCount();
				$this->download_count = $filtered_total_downloads;
				$total_downloads = $this->model_catalog_download->getProductDownloadsCount($product_id);
			}

			$data['show_downloads'] = $show_downloads && ($total_downloads || $filtering || $searching);// || $status && (int)$settings['show_empty_module'];
		} else {
			return;
		}

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

				if ($data['show_icons']) {
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

				if ($result['is_free']) {
					if ($this->customer->isLogged() || !(int)$result['login'] && !$login && !$login_free) {
						$href = $this->url->link('extension/module/product_downloads/get', 'did=' . $result['download_id'], $ssl);
						$link_text = $this->language->get('button_download');
					} else {
						$href = $this->url->link('account/login', $referer ? 'redirect=' . urlencode($referer) : '', $ssl);
						$link_text = $this->language->get('button_login');
					}
				} else {
					if ($this->customer->isLogged() && $this->config->get('pd_show_purchased_downloads') && (!empty($result['order_product_download_id']) || !empty($result['order_option_download_id']))) {
						$href = $this->url->link('account/download/download', !empty($result['order_product_download_id']) ? 'pdi=' . $result['order_product_download_id'] : 'odi=' . $result['order_option_download_id'], $ssl);
						$link_text = $this->language->get('button_download');
					} else {
						$href = '';
						$link_text = $this->language->get('button_cart');
					}
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
					'remaining'     => (!empty($result['order_product_download_id']) || !empty($result['order_option_download_id'])) ? $this->formatRemaining($result) : '',
					'icon'          => $icon,
				);
			// }
		}

		$data['total'] = $total_downloads;
		self::$total_downloads = $total_downloads;
		$data['total_downloads'] = $filtered_total_downloads;

		$url_params = array();

		$url_params['mid'] = $data['mid'];

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

		if ($product_id) {
			$url_params['pid'] = $product_id;
		}

		if ($settings['search_page']) {
			$url_params['sp'] = "1";
		}

		foreach (array('name', 'size', 'added', 'modified') as $value) {
			$url_params['dsort'] = $value;
			$data["sort_$value"] = $this->url->link('extension/module/product_downloads/load', http_build_query($url_params), $ssl);
		}

		if ($sort) {
			$url_params['dsort'] = $sort;
		} else {
			unset($url_params['dsort']);
		}

		if ($order) {
			$url_params['dorder'] = $order;
		}

		if ($page) {
			$url_params['dpage'] = "{page}";
		}

		$data['search'] = $search;
		$data['tags'] = $tags;
		$data['sort'] = $sort;
		$data['order'] = $order;

		$pagination = new Pagination();
		$pagination->total = $data['total_downloads'];
		$pagination->page = $page;
		$pagination->limit = $per_page;
		$pagination->url = str_replace('%7Bpage%7D', '{page}', $this->url->link('extension/module/product_downloads/load', http_build_query($url_params), $ssl));

		$data['pagination'] = $pagination->render();

		$results_find = array(
			'{start}',
			'{end}',
			'{total}',
			'{pages}'
		);

		$results_replace = array(
			($filtered_total_downloads) ? (($page - 1) * $per_page) + 1 : 0,
			((($page - 1) * $per_page) > ($filtered_total_downloads - $per_page)) ? $filtered_total_downloads : ((($page - 1) * $per_page) + $per_page),
			$filtered_total_downloads,
			$per_page ? ceil($filtered_total_downloads / $per_page) : 1
		);

		// $data['results'] = str_replace($results_find, $results_replace, $this->language->get('text_pagination_custom'));
		$data['results'] = str_replace($results_find, $results_replace, ($search && !$settings['search_page'] && $data['show_search_bar']) ? $this->language->get('text_pagination_custom') . ' ' . sprintf($this->language->get('text_filtered_from'), $total_downloads) : $this->language->get('text_pagination_custom'));

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

		if ($settings['search_page']) {
			$url_params['sp'] = "1";
		}

		$data['search_url'] = $this->url->link('extension/module/product_downloads/load', http_build_query($url_params), $ssl);

		$template = 'download/downloads_files';

		$data['downloads_data'] = $this->load->view($template, $data);

		$template = 'download/downloads_filter';

		$data['downloads_filter_data'] = $this->load->view($template, $data);

		$template = 'download/downloads_search';

		$data['downloads_search_data'] = $this->load->view($template, $data);

		if ($direct_call) {
			return $data['downloads_search_data'];
		} else if ($ajax_request) {
			if ($lazy_loading) {
				$content = $data['downloads_search_data'];
			} else if ($searching) {
				$content = $data['downloads_filter_data'];
			} else {
				$content = $data['downloads_data'];
			}
			$this->response->addHeader('Content-Type: application/json');
			$this->response->setOutput(json_enc(array("content" => $content, "url" => $display_url, "r" => $request), JSON_UNESCAPED_SLASHES));
		} else {
			if ($lazy_loading) {
				$content = $data['downloads_search_data'];
			} else if ($searching) {
				$content = $data['downloads_filter_data'];
			} else {
				$content = $data['downloads_data'];
			}
			$this->response->setOutput($content);
			// if ($referer) {
			//     $this->response->redirect($referer);
			// } else {
			//     $this->response->redirect($this->url->link('common/home', '', $ssl));
			// }
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
			if (isset($this->request->server['HTTP_REFERER'])) {
				$this->response->redirect(urldecode($this->request->server['HTTP_REFERER']));
			} else {
				$this->response->redirect($this->url->link('common/home', '', $ssl));
			}
			return;
		}

		if ($this->config->get("pd_require_login") && !$this->customer->isLogged()) {
			if (isset($this->request->server['HTTP_REFERER'])) {
				$this->session->data['redirect'] = urldecode($this->request->server['HTTP_REFERER']);
				$this->response->redirect($this->url->link('account/login', '', $ssl));
			} else {
				$this->response->redirect($this->url->link('account/login', '', $ssl));
			}
			return;
		}

		if ($this->config->get("pd_differentiate_customers")) {
			$this->load->model('catalog/download');

			$download_customer_groups = $this->model_catalog_download->getDownloadCustomerGroups($download_id);

			if (!in_array($this->customer->getGroupId(), $download_customer_groups) && !in_array('0', $download_customer_groups)) {
				if (isset($this->request->server['HTTP_REFERER'])) {
					$this->response->redirect(urldecode($this->request->server['HTTP_REFERER']));
				} else {
					$this->response->redirect($this->url->link('common/home', '', $ssl));
				}
				return;
			}
		}

		$download_info = $this->model_catalog_download->getFreeDownload($download_id);

		if ($download_info && (int)$download_info['login'] && !$this->customer->isLogged()) {
			if (isset($this->request->server['HTTP_REFERER'])) {
				$this->session->data['redirect'] = urldecode($this->request->server['HTTP_REFERER']);
				$this->response->redirect($this->url->link('account/login', '', $ssl));
			} else {
				$this->response->redirect($this->url->link('account/login', '', $ssl));
			}
			return;
		}

		if ($download_info) {
			$file = DIR_DOWNLOAD . $download_info['filename'];
			$mask = basename($download_info['mask']);

			if (!file_exists($file)) {
				if ($this->config->get('config_error_log')) {
					$this->log->write('Error: Could not find file ' . $file . '!');
				}

				if (isset($this->request->server['HTTP_REFERER'])) {
					$this->response->redirect(urldecode($this->request->server['HTTP_REFERER']));
				} else {
					$this->response->redirect($this->url->link('common/home', '', $ssl));
				}
				return;
			}

			if (!is_readable($file)) {
				if ($this->config->get('config_error_log')) {
					$this->log->write('Error: Could not read file ' . $file . '!');
				}

				if (isset($this->request->server['HTTP_REFERER'])) {
					$this->response->redirect(urldecode($this->request->server['HTTP_REFERER']));
				} else {
					$this->response->redirect($this->url->link('common/home', '', $ssl));
				}
				return;
			}

			$download_finished = function() use ($download_info) {
				$this->model_catalog_download->updateDownloaded($download_info['download_id']);
				// unset($this->session->data['download_token']);
			};

			$dh = new DownloadHandler($this->registry);
			$dl = $dh->download($file, $mask, $download_finished->bindTo($this));
		} else {
			if (isset($this->request->server['HTTP_REFERER'])) {
				$this->response->redirect(urldecode($this->request->server['HTTP_REFERER']));
			} else {
				$this->response->redirect($this->url->link('common/home', '', $ssl));
			}
		}
	}

	private function formatRemaining($data) {
		$value = '';
		if ($data['constraint'] == '0') {
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

	protected function validateRequest() {
		return in_array($this->config->get('config_store_id'), bdecode($this->config->get('pd_as')));
	}
}
