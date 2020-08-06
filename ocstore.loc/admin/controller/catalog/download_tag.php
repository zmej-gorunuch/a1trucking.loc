<?php

class ControllerCatalogDownloadTag extends Controller {
	protected $error = array();
	protected $alert = array(
		'error'     => array(),
		'warning'   => array(),
		'success'   => array(),
		'info'      => array()
	);

	private $columns = array(
		'selector'              => array('display' => 1, 'index' =>  0, 'align' => 'text-center', 'sort' => '',                         'class'=>          ''),
		'id'                    => array('display' => 0, 'index' =>  1, 'align' =>   'text-left', 'sort' => 'dt.download_tag_id',       'class'=>          ''),
		'name'                  => array('display' => 1, 'index' =>  5, 'align' =>   'text-left', 'sort' => 'dtd.name',                 'class'=>          ''),
		'administrative'        => array('display' => 1, 'index' => 10, 'align' => 'text-center', 'sort' => 'administrative',           'class'=>'visible-sm visible-md visible-lg'),
		'related_downloads'     => array('display' => 1, 'index' => 15, 'align' =>   'text-left', 'sort' => 'related_downloads_count',  'class'=>'visible-md visible-lg'),
		'sort_order'            => array('display' => 1, 'index' => 20, 'align' =>  'text-right', 'sort' => 'sort_order',               'class'=>'visible-sm visible-md visible-lg'),
		'action'                => array('display' => 1, 'index' => 25, 'align' =>  'text-right', 'sort' => '',                         'class'=>          ''),
	);

	private static $list_language_texts = array(
		'heading_title',
		// Texts
		'text_list', 'text_none', 'text_toggle_navigation', 'text_toggle_dropdown', 'text_confirm_delete', 'text_force_delete', 'text_are_you_sure',
		'text_yes', 'text_no', 'text_filter', 'text_search', 'text_clear_filter', 'text_clear_search', 'text_autocomplete', 'text_no_results',
		'text_no_records_found', 'text_other_actions', 'text_view_free_samples', 'text_view_downloads', 'text_copying', 'text_deleting',
		// Buttons
		'button_add', 'button_copy', 'button_cancel', 'button_delete', 'button_edit',
		// Errors
		'error_ajax_request'
	);

	private static $form_language_texts = array(
		'heading_title',
		// Texts
		'text_toggle_navigation', 'text_yes', 'text_no', 'text_remove', 'text_autocomplete', 'text_no_records_found', 'text_all_downloads',
		'text_selected_downloads', 'text_confirm_delete', 'text_force_delete', 'text_are_you_sure', 'text_saving', 'text_deleting', 'text_canceling',
		// Help texts
		'help_administrative',
		// Entries
		'entry_id', 'entry_name', 'entry_administrative', 'entry_related', 'entry_sort_order',
		// Buttons
		'button_save', 'button_apply', 'button_cancel', 'button_delete',
		// Errors
		'error_ajax_request', 'error_positive_integer', 'error_name'
	);

	public function __construct($registry) {
		parent::__construct($registry);
		$this->load->helper('pd');

		$this->load->language('catalog/download_tag');
		$this->load->model('catalog/download_tag');
	}

	public function index() {
		$this->getList();
	}

	public function delete() {
		$this->action('delete');
	}

	public function copy() {
		$this->action('copy');
	}

	public function add() {
		$this->action('add');
	}

	public function edit() {
		$this->action('edit');
	}

	public function autocomplete() {
		$response = array();
		if ($this->request->server['REQUEST_METHOD'] == 'GET' && isset($this->request->get['type'])) {
			switch ($this->request->get['type']) {
				case 'downloads':
					$this->load->model('catalog/download_ext');

					$results = array();

					if (isset($this->request->get['query'])) {
						$filter_data = array(
							'filter'        => array('name' => $this->request->get['query']),
							'sort'          => 'dd.name',
							'start'         => 0,
							'limit'         => 20,
						);

						$results = $this->model_catalog_download_ext->getDownloads($filter_data);

						if (stripos($this->language->get('text_none'), $this->request->get['query']) !== false) {
							$response[] = array(
									'value'     => $this->language->get('text_none'),
									'tokens'    => explode(' ', trim(str_replace('---', '', $this->language->get('text_none')))),
									'id'        => '*',
								);
						}
					} else {
						$results = $this->model_catalog_download_ext->getDownloads(array());

						$response[] = array(
								'value'     => $this->language->get('text_none'),
								'tokens'    => array_merge(explode(' ', trim(str_replace('---', '', $this->language->get('text_none')))), (array)trim($this->language->get('text_none'))),
								'id'        => '*'
							);
					}

					foreach ($results as $result) {
						$result['name'] = html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8');
						$response[] = array(
							'value'     => $result['name'],
							'tokens'    => explode(' ', $result['name']),
							'id'        => $result['download_id']
						);
					}
					break;
				default:
					break;
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_enc($response, JSON_UNESCAPED_SLASHES));
	}

	private function action($action) {
		$ajax_request = isset($this->request->server['HTTP_X_REQUESTED_WITH']) && !empty($this->request->server['HTTP_X_REQUESTED_WITH']) && strtolower($this->request->server['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';

		$response = array();

		switch ($action) {
			case 'copy':
			case 'delete':
				if ($this->request->server['REQUEST_METHOD'] == 'GET' && isset($this->request->get['download_tag_id'])) {
					$this->request->post['selected'] = array($this->request->get['download_tag_id']);
				}
				if (isset($this->request->post['selected'])) {
					$successful = array();
					$failed = array();
					foreach ((array)$this->request->post['selected'] as $download_tag_id) {
						switch ($action) {
							case 'copy':
								if ($this->validateAction($action, $download_tag_id)) {
									$result = $this->model_catalog_download_tag->copyDownloadTag($download_tag_id);
									if ($result) {
										$successful[] = $download_tag_id;
									} else {
										$failed[] = $download_tag_id;
									}
								}
								break;
							case 'delete':
								if ($this->validateAction($action, $download_tag_id)) {
									$this->model_catalog_download_tag->deleteDownloadTag($download_tag_id);
									$successful[] = $download_tag_id;
								} else {
									$failed[] = $download_tag_id;
								}
								break;
						}
					}

					if ($ajax_request) {
						if (count($successful)) {
							$this->alert['success'][$action] = sprintf($this->language->get('text_success_' . $action), count($successful));
							$this->session->data['success'] = sprintf($this->language->get('text_success_' . $action), count($successful));
							// $response['reload'] = true; // TODO: is needed?
						}
						if ($this->error && count($failed) < 5) {
							$this->alert['warning'] = array_merge($this->alert['warning'], $this->error);
						} else if (count($failed)) {
							$this->alert['warning']['failed'] = sprintf($this->language->get('text_failed_' . $action), count($failed));
						}
					} else {
						if (count($successful)) {
							$this->session->data['success'] = sprintf($this->language->get('text_success_' . $action), count($successful));
						}
						if ($this->error && count($failed) < 5) {
							$this->alert['warning'] = array_merge($this->alert['warning'], $this->error);
						} else if (count($failed)) {
							$this->alert['warning']['failed'] = sprintf($this->language->get('text_failed_' . $action), count($failed));
						}
					}
				}

				$response = array_merge($response, array("errors" => $this->error), array("alerts" => $this->alert));

				if (!$ajax_request) {
					$this->session->data['errors'] = $this->error;
					$this->session->data['alerts'] = $this->alert;

					$url = $this->urlParams();

					$this->response->redirect($this->url->link('catalog/download_tag', $url, true));
				} else {
					$this->response->addHeader('Content-Type: application/json');
					$this->response->setOutput(json_enc($response, JSON_UNESCAPED_SLASHES));
					return;
				}
				break;
			case 'add':
			case 'edit':
				if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm($this->request->post)) {
					$download_tag_id = isset($this->request->get['download_tag_id']) ? $this->request->get['download_tag_id'] : '';
					switch ($action) {
						case 'add':
							$download_tag_id = $this->model_catalog_download_tag->addDownloadTag($this->request->post);
							break;
						case 'edit':
							if ($download_tag_id) {
								$this->model_catalog_download_tag->editDownloadTag($download_tag_id, $this->request->post);
							}
							break;
					}

					if ($ajax_request) {
						if ($action == 'add') {
							$response['url'] = html_entity_decode($this->url->link('catalog/download_tag/edit', 'download_tag_id=' . $download_tag_id . $this->urlParams(), true));
							$this->session->data['success'] = $this->language->get('text_success_' . $action);
						}

						$this->alert['success'][$action] = $this->language->get('text_success_' . $action);

						$response = array_merge($response, array("errors" => $this->error), array("alerts" => $this->alert));

						$this->response->addHeader('Content-Type: application/json');
						$this->response->setOutput(json_enc($response, JSON_UNESCAPED_SLASHES));
						return;
					} else {
						$this->alert['success'][$action] = $this->language->get('text_success_' . $action);

						$this->session->data['errors'] = $this->error;
						$this->session->data['alerts'] = $this->alert;

						$url = $this->urlParams();

						$this->response->redirect($this->url->link('catalog/download_tag', $url, true));
						return;
					}
				}

				if (!$ajax_request) {
					$this->getForm();
				} else {
					$response = array_merge($response, array("errors" => $this->error), array("alerts" => $this->alert));

					$this->response->addHeader('Content-Type: application/json');
					$this->response->setOutput(json_enc($response, JSON_UNESCAPED_SLASHES));
					return;
				}
				break;
		}
	}

	protected function getList() {
		if (isset($this->session->data['errors'])) {
			$this->error = array_merge($this->error, (array)$this->session->data['errors']);

			unset($this->session->data['errors']);
		}

		if (isset($this->session->data['alerts'])) {
			$this->alert = array_merge($this->alert, (array)$this->session->data['alerts']);

			unset($this->session->data['alerts']);
		}

		$this->document->addStyle('view/stylesheet/pd/css/catalog.min.css');

		$this->document->addScript('view/javascript/pd/catalog.min.js');

		$this->document->setTitle($this->language->get('heading_title'));

		foreach (self::$list_language_texts as $text) {
			$data[$text] = $this->language->get($text);
		}

		$data['alert_icon'] = function($type) {
			$icon = "";
			switch ($type) {
				case 'error':
					$icon = "fa-times-circle";
					break;
				case 'warning':
					$icon = "fa-exclamation-triangle";
					break;
				case 'success':
					$icon = "fa-check-circle";
					break;
				case 'info':
					$icon = "fa-info-circle";
					break;
				default:
					break;
			}
			return $icon;
		};

		$url = $this->urlParams();

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true),
			'active'    => false
		);

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_downloads'),
			'href'      => $this->url->link('catalog/download_ext', 'token=' . $this->session->data['token'], true),
			'active'    => false
		);

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('catalog/download_tag', 'token=' . $this->session->data['token'], true),
			'active'    => true
		);

		$data['add'] = $this->url->link('catalog/download_tag/add', $url, true);
		$data['copy'] = $this->url->link('catalog/download_tag/copy', $url, true);
		$data['delete'] = $this->url->link('catalog/download_tag/delete', $url, true);
		$data['view_free_samples'] = $this->url->link('catalog/download_sample', $this->urlParams(0,0,0,0,0), true);
		$data['view_downloads'] = $this->url->link('catalog/download_ext', $this->urlParams(0,0,0,0,0), true);
		$data['autocomplete'] = html_entity_decode($this->url->link('catalog/download_tag/autocomplete', $this->urlParams(0,0,0,0,0), true), ENT_QUOTES, 'UTF-8');

		$data['typeahead'] = array();

		$this->load->model('catalog/download_ext');
		$total_downloads = $this->model_catalog_download_ext->getTotalDownloads();

		$url = $this->urlParams(0, 0, 0, 0, 0);

		if ($total_downloads < TA_PREFETCH) {
			$data['typeahead']['downloads']['prefetch'] = html_entity_decode($this->url->link('catalog/download_tag/autocomplete', 'type=downloads' . $url, true));
		}

		$data['typeahead']['downloads']['remote'] = html_entity_decode($this->url->link('catalog/download_tag/autocomplete', 'type=downloads&query=%QUERY' . $url, true));

		$columns = $this->columns;
		$filters = array();

		foreach ($columns as $column => $attr) {
			$columns[$column]['name'] = $this->language->get('column_' . $column);

			if (isset($this->request->get['filter_' . $column])) {
				$filters[$column] = $this->request->get['filter_' . $column];
			}
		}

		if (isset($this->request->get['filter_related_downloads'])) {
			if ($this->request->get['filter_related_downloads'] != "*") {
				$download = $this->model_catalog_download_ext->getDownload($this->request->get['filter_related_downloads']);
				$filters["related_downloads_name"] = isset($download['name']) ? $download['name'] : "";
			} else {
				$filters["related_downloads_name"] = $this->language->get('text_none');
			}
		}

		uasort($columns, 'column_sort');

		$columns = array_filter($columns, 'column_display');

		$displayed_columns = array_keys($columns);

		$data['columns'] = $columns;

		if (isset($this->request->get['search'])) {
			$search = html_entity_decode($this->request->get['search'], ENT_QUOTES, 'UTF-8');
		} else {
			$search = '';
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'dtd.name';
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

		$data['download_tags'] = array();

		$filter_data = array(
			'columns'   => $displayed_columns,
			'search'    => $search,
			'filter'    => $filters,
			'sort'      => $sort,
			'order'     => $order,
			'start'     => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit'     => $this->config->get('config_limit_admin')
		);

		$results = $this->model_catalog_download_tag->getDownloadTags($filter_data);

		$filtered_total = $this->model_catalog_download_tag->getFilteredTotalDownloadTags();
		$total = $this->model_catalog_download_tag->getTotalDownloadTags();

		foreach ($results as $result) {
			$action = array();
			$sub_action = array();

			$action[] = array(
				'name'      => 'edit',
				'title'     => $this->language->get('text_edit'),
				'text'      => $this->language->get('text_edit_short'),
				'class'     => 'btn-primary btn-nav-link',
				'icon'      => 'pencil',
				'url'       => $this->url->link('catalog/download_tag/edit', 'download_tag_id=' . $result['download_tag_id'] . $this->urlParams(), true)
			);

			$download_tag = array(
				'download_tag_id'       => $result['download_tag_id'],
				'selected'              => isset($this->request->post['selected']) && in_array($result['download_tag_id'], $this->request->post['selected']),
			);

			foreach ($displayed_columns as $column) {
				switch ($column) {
					case 'id':
						$value = $result['download_tag_id'];
						break;
					case 'action':
						$value = $action;
						$download_tag['sub_action'] = $sub_action;
						break;
					case 'related_downloads':
						if ((int)$result[$column . '_count'] > 2) {
							$items = explode("<br/>", $result[$column . '_text']);
							$value = implode("<br/>", array_slice($items, 0, 1)) . ' ...';
							$download_tag[$column . '_full'] = implode("<br/>", array_map("htmlspecialchars", $items));
						} else {
							$value = $result[$column . '_text'];
							$download_tag[$column . '_full'] = '';
						}
						$download_tag[$column . '_count'] = $result[$column . '_count'];
						break;
					case 'name':
						$value = html_entity_decode($result[$column], ENT_QUOTES, 'UTF-8');
						break;
					case 'administrative':
						$value = $result['administrative_text'];
						$download_tag['administrative_class'] = (int)$result['administrative'] ? 'success' : 'danger';
						break;
					default:
						$value = isset($result[$column]) ? $result[$column] : '';
						break;
				}

				$download_tag[$column] = $value;
			}

			$data['download_tags'][] = $download_tag;
		}

		if (isset($this->error['warning'])) {
			$this->alert['warning']['warning'] = $this->error['warning'];
		}

		if (isset($this->error['error'])) {
			$this->alert['error']['error'] = $this->error['error'];
		}

		if (isset($this->session->data['success'])) {
			$this->alert['success']['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		}

		$data['token'] = $this->session->data['token'];

		$data['alerts'] = $this->alert;

		$data['sorts'] = array();

		foreach ($columns as $column => $attr) {
			if ($attr['sort']) {
				$data['sorts'][$column] = $this->url->link('catalog/download_tag', $this->urlParams(1, 1, $attr['sort'], $order == 'ASC' ? 'DESC' : 'ASC', '1'), true);
			} else {
				$data['sorts'][$column] = null;
			}
		}

		$limit = (int)$this->config->get('config_limit_admin');

		$pagination = new Pagination();
		$pagination->total = $filtered_total;
		$pagination->page = $page;
		$pagination->limit = $limit;
		$pagination->url = $this->url->link('catalog/download_tag', $this->urlParams(1, 1, 1, 1, '{page}'), true);
		$pagination->style = 'pd pagination';

		$data['pagination'] = $pagination->render_custom();

		$results_find = array(
			'{start}',
			'{end}',
			'{total}',
			'{pages}'
		);

		$results_replace = array(
			($filtered_total) ? (($page - 1) * $limit) + 1 : 0,
			((($page - 1) * $limit) > ($filtered_total - $limit)) ? $filtered_total : ((($page - 1) * $limit) + $limit),
			$filtered_total,
			$limit ? ceil($filtered_total / $limit) : 1
		);

		$data['results'] = str_replace($results_find, $results_replace, ($total != $filtered_total) ? $this->language->get('text_pagination_custom') . ' ' . sprintf($this->language->get('text_filtered_from'), $total) : $this->language->get('text_pagination_custom'));

		$data['search'] = $search;
		$data['filters'] = $filters;
		$data['sort'] = $sort;
		$data['order'] = $order;
		$data['page'] = $page;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$template = 'catalog/pd/download_tag_list';
		$this->response->setOutput($this->load->view($template, $data));
	}

	protected function getForm() {
		$download_tag_id = isset($this->request->get['download_tag_id']) ? $this->request->get['download_tag_id'] : null;

		if (isset($this->session->data['errors'])) {
			$this->error = array_merge($this->error, (array)$this->session->data['errors']);

			unset($this->session->data['errors']);
		}

		if (isset($this->session->data['alerts'])) {
			$this->alert = array_merge($this->alert, (array)$this->session->data['alerts']);

			unset($this->session->data['alerts']);
		}

		$this->document->addStyle('view/stylesheet/pd/css/catalog.min.css');

		$this->document->addScript('view/javascript/pd/catalog.min.js');

		$this->document->setTitle($this->language->get('heading_title'));

		$data['text_form'] = is_null($download_tag_id) ? $this->language->get('text_add') : $this->language->get('text_edit');

		foreach (self::$form_language_texts as $text) {
			$data[$text] = $this->language->get($text);
		}

		$data['alert_icon'] = function($type) {
			$icon = "";
			switch ($type) {
				case 'error':
					$icon = "fa-times-circle";
					break;
				case 'warning':
					$icon = "fa-check-circle";
					break;
				case 'success':
					$icon = "fa-exclamation-circle";
					break;
				case 'info':
					$icon = "fa-info-circle";
					break;
				default:
					break;
			}
			return $icon;
		};

		$url = $this->urlParams();

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true),
			'active'    => false
		);

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_downloads'),
			'href'      => $this->url->link('catalog/download_ext', 'token=' . $this->session->data['token'], true),
			'active'    => false
		);

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('catalog/download_tag', $url, true),
			'active'    => false
		);

		$data['breadcrumbs'][] = array(
			'text'      => $download_tag_id ? $this->language->get('text_edit') : $this->language->get('text_add'),
			'href'      => $this->url->link('catalog/download_tag/' . ($download_tag_id ? 'edit' : 'add'), ($download_tag_id ? 'download_tag_id=' . $download_tag_id : '') . $url, true),
			'active'    => true
		);

		$data['save'] = $this->url->link('catalog/download_tag/' . ($download_tag_id ? 'edit' : 'add'), ($download_tag_id ? 'download_tag_id=' . $download_tag_id : '') . $url, true);
		$data['delete'] = $this->url->link('catalog/download_tag/delete', ($download_tag_id ? 'download_tag_id=' . $download_tag_id : '') . $url, true);
		$data['cancel'] = $this->url->link('catalog/download_tag', $url, true);

		if ($download_tag_id) {
			$data['edit'] = true;
			$data['download_tag_id'] = $download_tag_id;
		} else {
			$data['edit'] = false;
			$data['download_tag_id'] = "";
		}

		$data['typeahead'] = array();

		$this->load->model('catalog/download_ext');
		$total_downloads = $this->model_catalog_download_ext->getTotalDownloads();

		$url = $this->urlParams(0, 0, 0, 0, 0);

		if ($total_downloads < TA_PREFETCH) {
			$data['typeahead']['downloads']['prefetch'] = html_entity_decode($this->url->link('catalog/download_tag/autocomplete', 'type=downloads' . $url, true));
		}

		$data['typeahead']['downloads']['remote'] = html_entity_decode($this->url->link('catalog/download_tag/autocomplete', 'type=downloads&query=%QUERY' . $url, true));

		$this->load->model('localisation/language');

		$languages = $this->model_localisation_language->getLanguages();
		foreach ($languages as $key => $value) {
			unset($languages[$key]['image']);
		}
		$data['languages'] = array_remap_key_to_id('language_id', $languages);
		$data['default_language'] = $this->config->get('config_language_id');

		if ($download_tag_id && $this->request->server['REQUEST_METHOD'] != 'POST') {
			$download_tag_info = $this->model_catalog_download_tag->getDownloadTag($download_tag_id);
			if (!$download_tag_info) {
				$this->response->redirect($this->url->link('catalog/download_tag', $url, true));
				return;
			}
		}

		$form = array(
			'download_tag_id'       => '',
			'administrative'        => '0',
			'sort_order'            => '0',
			'link_to'               => '0',
			'related_downloads'     => $download_tag_id ? $this->model_catalog_download_tag->getDownloadTagRelatedDownloads($download_tag_id) : array(),
			'descriptions'          => $download_tag_id ? $this->model_catalog_download_tag->getDownloadTagDescriptions($download_tag_id) : array(),
		);

		foreach ($form as $key => $v) {
			if (isset($this->request->post[$key])) {
				$data[$key] = $this->request->post[$key];
			} else if (isset($download_tag_info[$key])) {
				$data[$key] = $download_tag_info[$key];
			} else {
				$data[$key] = $v;
			}
		}

		if (isset($this->session->data['error'])) {
			$this->error = $this->session->data['error'];

			unset($this->session->data['error']);
		}

		if (isset($this->error['warning'])) {
			$this->alert['warning']['warning'] = $this->error['warning'];
		}

		if (isset($this->error['error'])) {
			$this->alert['error']['error'] = $this->error['error'];
		}

		if (isset($this->session->data['success'])) {
			$this->alert['success']['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		}

		$data['errors'] = $this->error;

		$data['token'] = $this->session->data['token'];

		$data['alerts'] = $this->alert;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$template = 'catalog/pd/download_tag_form';
		$this->response->setOutput($this->load->view($template, $data));
	}

	protected function validate() {
		$errors = false;

		if (!$this->user->hasPermission('modify', 'catalog/download_tag')) {
			$errors = true;
			$this->alert['error']['permission'] = $this->language->get('error_permission');
		}

		return !$errors;
	}

	private function validateForm(&$data) {
		$errors = !$this->validate();

		foreach ($this->request->post['descriptions'] as $language_id => $value) {
			if (utf8_strlen($value['name']) < 2 || utf8_strlen($value['name']) > 64) {
				$errors = true;
				$this->error['descriptions'][$language_id]['name'] = $this->language->get('error_name');
			}
		}

		if ($errors) {
			$this->alert['warning']['warning'] = $this->language->get('error_warning');
		}

		return !$errors;
	}

	protected function validateAction($action, $data) {
		$errors = !$this->validate();

		switch ($action) {
			case 'delete':
				/*if (!$errors) {
					$download_tag_id = $data;
					$download_total = $this->model_catalog_download_tag->getTotalDownloadsByDownloadTagId($download_tag_id);

					if (!isset($this->request->get['force']) && $download_total) {
						$download_tag = $this->model_catalog_download_tag->getDownloadTag($download_tag_id);
						$errors = true;
						$this->alert['error']['delete' . $download_tag_id] = sprintf($this->language->get('error_delete'), $download_tag['name'], $download_total);
					}
				}*/
				break;
			default:
				break;
		}

		return !$errors;
	}

	protected function urlParams($search = true, $filters = true, $sort = true, $order = true, $page = true) {
		$url = '';

		if ($search) {
			if (is_string($search)) {
				$url .= '&search=' . urlencode($search);
			} else if (isset($this->request->get['search'])) {
				$url .= '&search=' . urlencode(html_entity_decode($this->request->get['search'], ENT_QUOTES, 'UTF-8'));
			}
		}

		if ($filters) {
			foreach($this->columns as $column => $attr) {
				if (isset($this->request->get['filter_' . $column])) {
					$url .= '&filter_' . $column . '=' . urlencode(html_entity_decode($this->request->get['filter_' . $column], ENT_QUOTES, 'UTF-8'));
				}
			}
		}

		if ($sort) {
			if (is_string($sort)) {
				$url .= '&sort=' . $sort;
			} else if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}
		}

		if ($order) {
			if (is_string($order)) {
				$url .= '&order=' . $order;
			} else if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}
		}

		if ($page) {
			if (is_string($page)) {
				$url .= '&page=' . $page;
			} else if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
		}

		$url .= '&token=' . $this->session->data['token'];

		return $url;
	}
}
