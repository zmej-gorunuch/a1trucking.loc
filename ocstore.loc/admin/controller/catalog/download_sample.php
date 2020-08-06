<?php

class ControllerCatalogDownloadSample extends Controller {
	protected $error = array();

	protected $alert = array(
		'error'     => array(),
		'warning'   => array(),
		'success'   => array(),
		'info'      => array()
	);

	private $columns = array(
		'selector'              => array('display' => 1, 'index' =>  0, 'align' => 'text-center', 'sort' => '',                     'class'=> ''),
		'id'                    => array('display' => 0, 'index' =>  5, 'align' =>   'text-left', 'sort' => 'ds.download_sample_id','class'=> ''),
		'download'              => array('display' => 1, 'index' => 10, 'align' =>   'text-left', 'sort' => 'dd.name',              'class'=> ''),
		'tag'                   => array('display' => 1, 'index' => 15, 'align' =>   'text-left', 'sort' => '',                     'class'=> 'visible-xl'),
		'constraint'            => array('display' => 1, 'index' => 25, 'align' =>   'text-left', 'sort' => 'ds.constraint',        'class'=> 'visible-lg'),
		'active'                => array('display' => 1, 'index' => 30, 'align' =>  'text-right', 'sort' => '',                     'class'=> 'visible-sm visible-md hidden-lg'),
		'remaining'             => array('display' => 1, 'index' => 35, 'align' =>  'text-right', 'sort' => 'ds.remaining',         'class'=> 'visible-lg'),
		'end_time'              => array('display' => 1, 'index' => 40, 'align' =>  'text-right', 'sort' => 'ds.end_time',          'class'=> 'visible-lg'),
		'name'                  => array('display' => 1, 'index' => 45, 'align' =>   'text-left', 'sort' => 'ds.name',              'class'=> 'visible-lg'),
		'email'                 => array('display' => 1, 'index' => 50, 'align' =>   'text-left', 'sort' => 'ds.email',             'class'=> 'visible-md visible-lg'),
		'last_accessed'         => array('display' => 0, 'index' => 55, 'align' =>   'text-left', 'sort' => 'ds.last_accessed',     'class'=> 'visible-lg'),
		'date_added'            => array('display' => 0, 'index' => 60, 'align' =>   'text-left', 'sort' => 'ds.date_added',        'class'=> 'visible-lg'),
		'date_modified'         => array('display' => 0, 'index' => 65, 'align' =>   'text-left', 'sort' => 'ds.date_modified',     'class'=> 'visible-lg'),
		'status'                => array('display' => 1, 'index' => 70, 'align' => 'text-center', 'sort' => 'sample_status',        'class'=> 'visible-sm visible-md visible-lg'),
		'store'                 => array('display' => 1, 'index' => 75, 'align' =>   'text-left', 'sort' => 's.name',               'class'=> 'visible-xl'),
		'action'                => array('display' => 1, 'index' => 80, 'align' =>  'text-right', 'sort' => '',                     'class'=> ''),
	);

	private static $list_language_texts = array(
		'heading_title',
		// Texts
		'text_list', 'text_none', 'text_toggle_navigation', 'text_toggle_dropdown', 'text_confirm_delete', 'text_force_delete', 'text_are_you_sure',
		'text_active', 'text_expired', 'text_quantitative', 'text_temporal', 'text_both', 'text_filter', 'text_search', 'text_clear_filter',
		'text_clear_search', 'text_autocomplete', 'text_no_results', 'text_no_records_found', 'text_searching', 'text_no_files_found',
		'text_copy_to_clipboard', 'text_copied', 'text_view_downloads', 'text_view_download_tags', 'text_other_actions', 'text_copying', 'text_deleting',
		'text_sending',
		// Buttons
		'button_add', 'button_copy', 'button_cancel', 'button_delete', 'button_edit',
		// Errors
		'error_ajax_request'
	);

	private static $form_language_texts = array(
		'heading_title',
		// Texts
		'text_toggle_navigation', 'text_yes', 'text_no', 'text_autocomplete', 'text_confirm_delete', 'text_force_delete', 'text_are_you_sure',
		'text_duration', 'text_date_and_time', 'text_quantitative', 'text_temporal', 'text_both', 'text_minutes', 'text_hours', 'text_days',
		'text_weeks', 'text_saving', 'text_deleting', 'text_canceling',
		// Help texts
		'help_send_sample_link', 'help_quantitative', 'help_temporal', 'help_limit_both', 'help_end_time', 'help_language',
		// Entries
		'entry_id', 'entry_hash', 'entry_date_added', 'entry_date_modified', 'entry_last_accessed', 'entry_download', 'entry_store', 'entry_customer',
		'entry_name', 'entry_email', 'entry_constraint', 'entry_expiration', 'entry_remaining', 'entry_language', 'entry_send_sample_email',
		// Buttons
		'button_save', 'button_apply', 'button_cancel', 'button_delete',
		// Errors
		'error_ajax_request', 'error_positive_integer', 'error_name', 'error_email', 'error_date_time', 'error_required'
	);

	public function __construct($registry) {
		parent::__construct($registry);
		$this->load->helper('pd');

		$this->load->language('catalog/download_sample');
		$this->load->model('catalog/download_sample');
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

	public function send() {
		$this->action('notify');
	}

	public function autocomplete() {
		$response = array();
		if ($this->request->server['REQUEST_METHOD'] == 'GET' && isset($this->request->get['type'])) {
			switch ($this->request->get['type']) {
				case 'tag':
					$create = isset($this->request->get['create']);
					$query = isset($this->request->get['query']) ? $this->request->get['query'] : '';
					$exact_match = false;

					$this->load->model('catalog/download_tag');

					$results = array();

					if (isset($this->request->get['query'])) {
						if (is_array($this->request->get['query']) && isset($this->request->get['multiple'])) {
							$results = array();

							foreach ((array)$this->request->get['query'] as $value) {
								$result =  $this->model_catalog_download_tag->getDownloadTag($value);

								if ($result) {
									$results[] = $result;
								}
							}
						} else {
							$filter_data = array(
								'filter'        => array('name' => $this->request->get['query']),
								'sort'          => 'dtd.name',
								'start'         => 0,
								'limit'         => 20,
							);

							$results = $this->model_catalog_download_tag->getDownloadTags($filter_data);

							if (!$create && stripos($this->language->get('text_none'), $this->request->get['query']) !== false) {
								$response[] = array(
										'value'     => $this->language->get('text_none'),
										'tokens'    => explode(' ', trim(str_replace('---', '', $this->language->get('text_none')))),
										'id'        => '*',
									);
							}
						}
					} else {
						$results = $this->model_catalog_download_tag->getDownloadTags(array());

						$response[] = array(
								'value'     => $this->language->get('text_none'),
								'tokens'    => array_merge(explode(' ', trim(str_replace('---', '', $this->language->get('text_none')))), (array)trim($this->language->get('text_none'))),
								'id'        => '*'
							);
					}

					foreach ($results as $result) {
						$result['name'] = html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8');
						if (utf8_strtoupper($query) == utf8_strtoupper($result['name'])) {
							$exact_match = true;
						}
						$response[] = array(
							'value'     => $result['name'],
							'tokens'    => explode(' ', $result['name']),
							'id'        => $result['download_tag_id'],
							'admin'     => (int)$result['administrative']
						);
					}

					if ($create && !$exact_match) {
						array_unshift($response, array(
							'value'     => $query,
							'tokens'    => explode(' ', $query),
							'id'        => 0,
							'admin'     => 0
						));
					}
					break;
				case 'download':
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
					} else {
						$results = $this->model_catalog_download_ext->getDownloads(array());
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
				case 'customer':
					$this->load->model('customer/customer');

					$results = array();

					if (isset($this->request->get['query'])) {
						$filter_data = array(
							'filter_name'   => $this->request->get['query'],
							'sort'          => 'name',
							'start'         => 0,
							'limit'         => 20,
						);

						$results = $this->model_customer_customer->getCustomers($filter_data);
					} else {
						$results = $this->model_customer_customer->getCustomers(array());
					}

					foreach ($results as $result) {
						$result['name'] = html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8');
						$response[] = array(
							'value'     => $result['name'],
							'tokens'    => array_merge(explode(' ', $result['name']), array($result['email'])),
							'id'        => $result['customer_id'],
							'email'     => $result['email']
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
				if ($this->request->server['REQUEST_METHOD'] == 'GET' && isset($this->request->get['download_sample_id'])) {
					$this->request->post['selected'] = array($this->request->get['download_sample_id']);
				}
				if (isset($this->request->post['selected'])) {
					$successful = array();
					$failed = array();
					foreach ((array)$this->request->post['selected'] as $download_sample_id) {
						switch ($action) {
							case 'copy':
								if ($this->validateAction($action, $download_sample_id)) {
									$result = $this->model_catalog_download_sample->copyDownloadSample($download_sample_id);
									if ($result) {
										$successful[] = $download_sample_id;
									} else {
										$failed[] = $download_sample_id;
									}
								}
								break;
							case 'delete':
								if ($this->validateAction($action, $download_sample_id)) {
									$this->model_catalog_download_sample->deleteDownloadSample($download_sample_id);
									$successful[] = $download_sample_id;
								} else {
									$failed[] = $download_sample_id;
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

					$this->response->redirect($this->url->link('catalog/download_sample', $url, true));
				} else {
					$this->response->addHeader('Content-Type: application/json');
					$this->response->setOutput(json_enc($response, JSON_UNESCAPED_SLASHES));
					return;
				}
				break;
			case 'add':
			case 'edit':
				if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm($this->request->post)) {
					$download_sample_id = isset($this->request->get['download_sample_id']) ? $this->request->get['download_sample_id'] : '';

					$downloads = array();
					$notifications = array('successful' => array(), 'failed' => array());
					switch ($action) {
						case 'add':
							$save_data = $this->request->post;
							$download_sample_id = $this->model_catalog_download_sample->addDownloadSample($save_data);
							$save_data['hash'] = $this->model_catalog_download_sample->getDownloadHash();
							$downloads[] = $download_sample_id;

							if (!empty($this->request->post['send_sample_email'])) {
								$result = $this->sendSampleLink($save_data);
								if ($result) {
									$notifications['successful'][] = $this->request->post['name'] . " &lt; " . $this->request->post['email'] . " &gt;";
								} else {
									$notifications['failed'][] = $this->request->post['name'] . " &lt; " . $this->request->post['email'] . " &gt;";
								}
							}
							break;
						case 'edit':
							if ($download_sample_id) {
								$save_data = $this->request->post;
								$this->model_catalog_download_sample->editDownloadSample($download_sample_id, $save_data);
								$downloads[] = $download_sample_id;

								if (!empty($this->request->post['send_sample_email'])) {
									$result = $this->sendSampleLink($save_data);
									if ($result) {
										$notifications['successful'][] = $this->request->post['name'] . " &lt; " . $this->request->post['email'] . " &gt;";
									} else {
										$notifications['failed'][] = $this->request->post['name'] . " &lt; " . $this->request->post['email'] . " &gt;";
									}
								}
							}
							break;
					}

					if ($ajax_request) {
						if ($action == 'add') {
							if (count($downloads) > 1) {
								$response['reload'] = true;
								$this->session->data['success'] = sprintf($this->language->get('text_success_' . $action . '_multiple'), count($downloads));
							} else {
								$response['url'] = html_entity_decode($this->url->link('catalog/download_sample/edit', 'download_sample_id=' . $download_sample_id . $this->urlParams(), true));
								$this->session->data['success'] = $this->language->get('text_success_' . $action);
							}
						}

						if (count($downloads) > 1) {
							$this->alert['success'][$action] = sprintf($this->language->get('text_success_' . $action . '_multiple'), count($downloads));
						} else {
							$this->alert['success'][$action] = $this->language->get('text_success_' . $action);
						}

						if (count($notifications['successful']) < 5) {
							foreach ($notifications['successful'] as $idx => $destination) {
								$this->alert['success']['notifications_' . $idx] = sprintf($this->language->get('text_success_notify'), $destination);
							}
						} else if (count($notifications['successful']) >= 5) {
							$this->alert['success']['notifications'] = sprintf($this->language->get('text_success_notify_multiple'), count($notifications['successful']));
						}

						if (count($notifications['failed']) < 5) {
							foreach ($notifications['failed'] as $idx => $destination) {
								$this->alert['warning']['notifications_' . $idx] = sprintf($this->language->get('text_success_notify'), $destination);
							}
						} else if (count($notifications['failed']) >= 5) {
							$this->alert['warning']['notifications'] = sprintf($this->language->get('text_failed_notify_multiple'), count($notifications['failed']));
						}

						$response = array_merge($response, array("errors" => $this->error), array("alerts" => $this->alert));

						$this->response->addHeader('Content-Type: application/json');
						$this->response->setOutput(json_enc($response, JSON_UNESCAPED_SLASHES));
						return;
					} else {
						if (count($downloads) > 1) {
							$this->session->data['success'] = sprintf($this->language->get('text_success_' . $action . '_multiple'), count($downloads));
						} else {
							$this->session->data['success'] = $this->language->get('text_success_' . $action);
						}

						if (count($notifications['successful']) < 5) {
							foreach ($notifications['successful'] as $idx => $destination) {
								$this->alert['success']['notifications_' . $idx] = sprintf($this->language->get('text_success_notify'), $destination);
							}
						} else if (count($notifications['successful']) >= 5) {
							$this->alert['success']['notifications'] = sprintf($this->language->get('text_success_notify_multiple'), count($notifications['successful']));
						}

						if (count($notifications['failed']) < 5) {
							foreach ($notifications['failed'] as $idx => $destination) {
								$this->alert['warning']['notifications_' . $idx] = sprintf($this->language->get('text_success_notify'), $destination);
							}
						} else if (count($notifications['failed']) >= 5) {
							$this->alert['warning']['notifications'] = sprintf($this->language->get('text_failed_notify_multiple'), count($notifications['failed']));
						}

						$this->session->data['errors'] = $this->error;
						$this->session->data['alerts'] = $this->alert;

						$url = $this->urlParams();

						$this->response->redirect($this->url->link('catalog/download_sample', $url, true));
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
			case 'notify':
				if (($this->request->server['REQUEST_METHOD'] == 'GET') && isset($this->request->get['download_sample_id'])) {
					$this->request->post['selected'] = array($this->request->get['download_sample_id']);
				}
				if (isset($this->request->post['selected'])) {
					$successful = array();
					$failed = array();
					foreach ((array)$this->request->post['selected'] as $download_sample_id) {
						if ($this->validateAction($action, $download_sample_id)) {
							$download_sample = $this->model_catalog_download_sample->getDownloadSample($download_sample_id);
							$result = $this->sendSampleLink($download_sample);
							if ($result) {
								$successful[] = $download_sample['name'] . " &lt; " . $download_sample['email'] . " &gt;";
							} else {
								$failed[] = $download_sample['name'] . " &lt; " . $download_sample['email'] . " &gt;";
							}
						}
					}

					if (count($successful)) {
						if (count($successful) < 5) {
							foreach ($successful as $idx => $destination) {
								$this->alert['success']['notifications_' . $idx] = sprintf($this->language->get('text_success_' . $action), $destination);
							}
						} else if (count($successful) >= 5) {
							$this->alert['success']['notifications'] = sprintf($this->language->get('text_success_' . $action . '_multiple'), count($successful));
						}
					}
					if (count($failed) < 5) {
						foreach ($failed as $idx => $destination) {
							$this->alert['warning']['notifications_' . $idx] = sprintf($this->language->get('text_failed_' . $action), $destination);
						}
					} else if (count($failed) >= 5) {
						$this->alert['warning']['notifications'] = sprintf($this->language->get('text_failed_' . $action . '_multiple'), count($failed));
					}
				}

				if (!$ajax_request) {
					$this->session->data['errors'] = $this->error;
					$this->session->data['alerts'] = $this->alert;

					$url = $this->urlParams();

					$this->response->redirect($this->url->link('catalog/download_sample', $url, true));
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
		$this->document->addScript('view/javascript/pd/ZeroClipboard.min.js');

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
			'href'      => $this->url->link('catalog/download_sample', 'token=' . $this->session->data['token'], true),
			'active'    => true
		);

		$data['add'] = $this->url->link('catalog/download_sample/add', $url, true);
		$data['copy'] = $this->url->link('catalog/download_sample/copy', $url, true);
		$data['delete'] = $this->url->link('catalog/download_sample/delete', $url, true);
		$data['view_downloads'] = $this->url->link('catalog/download_ext', $this->urlParams(0,0,0,0,0), true);
		$data['view_download_tags'] = $this->url->link('catalog/download_tag', $this->urlParams(0,0,0,0,0), true);
		$data['autocomplete'] = html_entity_decode($this->url->link('catalog/download_sample/autocomplete', 'token=' . $this->session->data['token'], true), ENT_QUOTES, 'UTF-8');

		$data['typeahead'] = array();

		$this->load->model('catalog/download_tag');
		$total_download_tags = $this->model_catalog_download_tag->getTotalDownloadTags();

		$this->load->model('catalog/download_ext');
		$total_downloads = $this->model_catalog_download_ext->getTotalDownloads();

		$url = $this->urlParams(0, 0, 0, 0, 0);

		if ($total_download_tags < TA_PREFETCH) {
			$data['typeahead']['tag']['prefetch'] = html_entity_decode($this->url->link('catalog/download_sample/autocomplete', 'type=tag' . $url, true));
		}

		if ($total_downloads < TA_PREFETCH) {
			$data['typeahead']['download']['prefetch'] = html_entity_decode($this->url->link('catalog/download_sample/autocomplete', 'type=download' . $url, true));
		}

		$data['typeahead']['tag']['remote'] = html_entity_decode($this->url->link('catalog/download_sample/autocomplete', 'type=tag&query=%QUERY' . $url, true));
		$data['typeahead']['download']['remote'] = html_entity_decode($this->url->link('catalog/download_sample/autocomplete', 'type=download&query=%QUERY' . $url, true));

		$columns = $this->columns;
		$filters = array();

		foreach ($columns as $column => $attr) {
			$columns[$column]['name'] = $this->language->get('column_' . $column);

			if (isset($this->request->get['filter_' . $column])) {
				$filters[$column] = $this->request->get['filter_' . $column];
			}
		}

		if (isset($this->request->get['filter_tag'])) {
			if ($this->request->get['filter_tag'] != "*") {
				$download_tag = $this->model_catalog_download_tag->getDownloadTag($this->request->get['filter_tag']);
				$filters["tag_name"] = isset($download_tag['name']) ? $download_tag['name'] : "";
			} else {
				$filters["tag_name"] = $this->language->get('text_none');
			}
		}

		$this->load->model('setting/store');
		$multistore = $this->model_setting_store->getTotalStores();

		if (!$multistore) {
			unset($columns['store']);
			$data['stores'] = array(
				'0' => array(
					'store_id'  => 0,
					'name'      => $this->config->get('config_name'),
					'url'       => HTTP_CATALOG,
					'ssl'       => HTTPS_CATALOG
				)
			);
		} else {
			$_stores = $this->model_setting_store->getStores(array());

			$stores = array(
				'0' => array(
					'store_id'  => 0,
					'name'      => $this->config->get('config_name'),
					'url'       => HTTP_CATALOG,
					'ssl'       => HTTPS_CATALOG
				)
			);

			foreach ($_stores as $store) {
				$stores[$store['store_id']] = array(
					'store_id'  => $store['store_id'],
					'name'      => $store['name'],
					'url'       => $store['url'],
					'ssl'       => $store['ssl']
				);
			}
			$data['stores'] = $stores;
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
			$sort = 'dd.name';
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

		$data['downloads'] = array();

		$filter_data = array(
			'columns'   => $displayed_columns,
			'search'    => $search,
			'filter'    => $filters,
			'sort'      => $sort,
			'order'     => $order,
			'start'     => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit'     => $this->config->get('config_limit_admin')
		);

		$results = $this->model_catalog_download_sample->getDownloadSamples($filter_data);

		$filtered_total = $this->model_catalog_download_sample->getFilteredTotalDownloadSamples();
		$total = $this->model_catalog_download_sample->getTotalDownloadSamples();

		$missing = false;

		foreach ($results as $result) {
			$action = array();
			$sub_action = array();

			$action[] = array(
				'name'      => 'edit',
				'title'     => $this->language->get('text_edit'),
				'text'      => $this->language->get('text_edit_short'),
				'class'     => 'btn-primary btn-nav-link',
				'icon'      => 'pencil',
				'url'       => $this->url->link('catalog/download_sample/edit', 'download_sample_id=' . $result['download_sample_id'] . $this->urlParams(), true)
			);

			$action[] = array(
				'name'      => 'send',
				'title'     => $this->language->get('text_send'),
				'text'      => $this->language->get('text_send'),
				'class'     => 'btn-default btn-nav-link',
				'icon'      => 'paper-plane-o',
				'url'       => $this->url->link('catalog/download_sample/send', 'download_sample_id=' . $result['download_sample_id'] . $this->urlParams(), true)
			);

			$download = array(
				'download_sample_id'=> $result['download_sample_id'],
				'exists'            => file_exists(DIR_DOWNLOAD . $result['filename']) && is_file(DIR_DOWNLOAD . $result['filename']),
				'selected'          => isset($this->request->post['selected']) && in_array($result['download_sample_id'], $this->request->post['selected']),
			);

			$missing |= !$download['exists'];

			foreach ($displayed_columns as $column) {
				switch ($column) {
					case 'id':
						$value = $result['download_sample_id'];
						break;
					case 'action':
						$value = $action;
						$download['sub_action'] = $sub_action;
						break;
					case 'status':
						$value = $result[$column . '_text'];
						$download[$column . '_class'] = (int)$result[$column] ? 'success' : 'danger';
						break;
					case 'constraint':
						$value = $result[$column . '_text'];
						break;
					case 'remaining':
						if ($result['constraint'] == '1') {
							$value = $this->language->get('text_not_applicable');
						} else {
							$value = $result[$column];
						}
						break;
					case 'end_time':
						if ($result['constraint'] == '0') {
							$value = $this->language->get('text_not_applicable');
						} else {
							$end = new DateTime($result[$column], new DateTimeZone("UTC"));
							$start = new DateTime(NULL, new DateTimeZone("UTC"));

							if ($start > $end) {
								$value = "00:00:00";
							} else {
								$value = $this->formatDateDiff($start, $end);
							}
						}
						break;
					case 'active':
						switch ($result['constraint']) {
							case '0':
								$value = sprintf($this->language->get('text_remaining_downloads'), $result['remaining']);
								break;
							case '1':
								$end = new DateTime($result['end_time'], new DateTimeZone("UTC"));
								$start = new DateTime(NULL, new DateTimeZone("UTC"));

								if ($start > $end) {
									$value = "00:00:00";
								} else {
									$value = $this->formatDateDiff($start, $end);
								}
								break;
							case '2':
								$value = $result['remaining'];

								$end = new DateTime($result['end_time'], new DateTimeZone("UTC"));
								$start = new DateTime(NULL, new DateTimeZone("UTC"));

								if ($start > $end) {
									$duration = "00:00:00";
								} else {
									$duration = $this->formatDateDiff($start, $end);
								}

								$value = sprintf($this->language->get('text_remaining_time_and_downloads'), $result['remaining'], $duration);
								break;
							default:
								$value = "";
								break;
						}
						break;
					case 'tag':
						$value = $result[$column . '_text'];
						break;
					case 'download':
						$value = html_entity_decode($result[$column]);
						$download['filename'] = $result['filename'];
						$download['mask'] = $result['mask'];

						$download_data = array();
						$download_data['entry_filename'] = $this->language->get('entry_filename');
						$download_data['entry_mask'] = $this->language->get('entry_mask');
						$download_data['entry_download_url'] = $this->language->get('entry_download_url');
						$download_data['entry_date_added'] = $this->language->get('entry_date_added');
						$download_data['entry_date_modified'] = $this->language->get('entry_date_modified');
						$download_data['error_missing_file'] = $this->language->get('error_missing_file');
						$download_data['filename'] = $result['filename'];
						$download_data['exists'] = $download['exists'];
						$download_data['mask'] = $result['mask'];
						$download_data['date_added'] = $result['download_date_added'];
						$download_data['date_modified'] = $result['download_date_modified'];

						$_url = new Url($data['stores'][$result['store_id']]['url'], $data['stores'][$result['store_id']]['ssl']);
						$download_data['url'] = $_url->link('download/sample', 'dsid=' . $result['hash']);

						if ($this->config->get('config_seo_url')) {
							if (class_exists('VQMod')) {
								require_once(VQMod::modCheck((DIR_APPLICATION . '../catalog/controller/startup/seo_url.php')));
							} else {
								// TODO: try loading OCMODed file
								require_once(DIR_APPLICATION . '../catalog/controller/startup/seo_url.php');
							}
							$seo_url = new ControllerStartupSeoUrl($this->registry);
							$download_data['url'] = $seo_url->rewrite($download_data['url']);
						}

						$template = 'catalog/pd/download_info';
						$download['download_details'] = htmlentities($this->load->view($template, $download_data), ENT_QUOTES, 'UTF-8');
						break;
					default:
						$value = isset($result[$column]) ? $result[$column] : '';
						break;
				}

				$download[$column] = $value;
			}

			$data['downloads'][] = $download;
		}

		if ($missing) {
			$this->alert['warning']['missing'] = $this->language->get('error_missing_downloads');
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
				$data['sorts'][$column] = $this->url->link('catalog/download_sample', $this->urlParams(1, 1, $attr['sort'], $order == 'ASC' ? 'DESC' : 'ASC', '1'), true);
			} else {
				$data['sorts'][$column] = null;
			}
		}

		$limit = (int)$this->config->get('config_limit_admin');

		$pagination = new Pagination();
		$pagination->total = $filtered_total;
		$pagination->page = $page;
		$pagination->limit = $limit;
		$pagination->url = $this->url->link('catalog/download_sample', $this->urlParams(1, 1, 1, 1, '{page}'), true);
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

		$template = 'catalog/pd/download_sample_list';
		$this->response->setOutput($this->load->view($template, $data));
	}

	protected function getForm() {
		$download_sample_id = isset($this->request->get['download_sample_id']) ? $this->request->get['download_sample_id'] : null;
		$download_id = isset($this->request->get['download_id']) ? $this->request->get['download_id'] : null;

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
		//$this->document->addScript('view/javascript/pd/moment.min.js');

		$this->document->setTitle($this->language->get('heading_title'));

		$data['text_form'] = is_null($download_sample_id) ? $this->language->get('text_add') : $this->language->get('text_edit');

		foreach (self::$form_language_texts as $text) {
			$data[$text] = $this->language->get($text);
		}

		$url = $this->urlParams();

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
			'href'      => $this->url->link('catalog/download_sample', 'token=' . $this->session->data['token'], true),
			'active'    => false
		);

		$data['breadcrumbs'][] = array(
			'text'      => $download_sample_id ? $this->language->get('text_edit') : $this->language->get('text_add'),
			'href'      => $this->url->link('catalog/download_sample/' . ($download_sample_id ? 'edit' : 'add'), ($download_sample_id ? 'download_sample_id=' . $download_sample_id : '') . $url, true),
			'active'    => true
		);

		$data['save'] = $this->url->link('catalog/download_sample/' . ($download_sample_id ? 'edit' : 'add'), ($download_sample_id ? 'download_sample_id=' . $download_sample_id : '') . $url, true);
		$data['delete'] = $this->url->link('catalog/download_sample/delete', ($download_sample_id ? 'download_sample_id=' . $download_sample_id : '') . $url, true);
		$data['cancel'] = $this->url->link('catalog/download_sample', $url, true);
		$data['autocomplete'] = html_entity_decode($this->url->link('catalog/download_sample/autocomplete', 'token=' . $this->session->data['token'], true), ENT_QUOTES, 'UTF-8');

		if ($download_sample_id) {
			$data['edit'] = true;
			$data['download_sample_id'] = $download_sample_id;
		} else {
			$data['edit'] = false;
			$data['download_sample_id'] = "";
		}

		$this->load->model('localisation/language');
		$languages = $this->model_localisation_language->getLanguages();
		foreach ($languages as $key => $value) {
			unset($languages[$key]['image']);
		}
		$data['languages'] = array_remap_key_to_id('language_id', $languages);
		$data['default_language'] = $this->config->get('config_language_id');

		$this->load->model('setting/store');
		$_stores = $this->model_setting_store->getStores(array());

		$stores = array(
			'0' => array(
				'store_id'  => 0,
				'name'      => $this->config->get('config_name'),
				'url'       => HTTP_CATALOG
			)
		);

		foreach ($_stores as $store) {
			$stores[$store['store_id']] = array(
				'store_id'  => $store['store_id'],
				'name'      => $store['name'],
				'url'       => $store['url']
			);
		}
		$data['stores'] = $stores;

		$url = $this->urlParams(0, 0, 0, 0, 0);

		$data['typeahead'] = array();

		$this->load->model('catalog/download_ext');
		$total_downloads = $this->model_catalog_download_ext->getTotalDownloads();
		if ($total_downloads < TA_PREFETCH) {
			$data['typeahead']['downloads']['prefetch'] = html_entity_decode($this->url->link('catalog/download_sample/autocomplete', 'type=download' . $url, true));
		}

		$data['typeahead']['downloads']['remote'] = html_entity_decode($this->url->link('catalog/download_sample/autocomplete', 'type=download&query=%QUERY' . $url, true));

		$this->load->model('customer/customer');
		$total_customers = $this->model_customer_customer->getTotalCustomers();
		if ($total_customers < TA_PREFETCH) {
			$data['typeahead']['customers']['prefetch'] = html_entity_decode($this->url->link('catalog/download_sample/autocomplete', 'type=customer' . $url, true));
		}

		$data['typeahead']['customers']['remote'] = html_entity_decode($this->url->link('catalog/download_sample/autocomplete', 'type=customer&query=%QUERY' . $url, true));

		if ($download_sample_id && $this->request->server['REQUEST_METHOD'] != 'POST') {
			$download_info = $this->model_catalog_download_sample->getDownloadSample($download_sample_id);

			if (!$download_info) {
				$this->response->redirect($this->url->link('catalog/download_sample', $url, true));
				return;
			}
		}

		if ($download_id && $this->request->server['REQUEST_METHOD'] != 'POST') {
			$download = $this->model_catalog_download_ext->getDownload($download_id);
			$download_name = $download['name'];
		} else {
			$download_name = '';
		}

		$default_end_time = new DateTime(null, new DateTimeZone('UTC'));
		$default_end_time->add(new DateInterval("PT1H"));

		$form = array(
			'download_sample_id'        => $download_sample_id,
			'download_id'               => $download_id,
			'download'                  => $download_name,
			'hash'                      => "",
			'constraint'                => 0,
			'remaining'                 => 1,
			'expiration_type'           => $download_sample_id ? 1 : 0,
			'end_time'                  => $default_end_time->format('Y-m-d H:i:s'),
			'duration'                  => 1,
			'duration_unit'             => 3600,
			'store_id'                  => '0',
			'customer_id'               => '',
			'customer'                  => '',
			'customer_email'            => '',
			'language_id'               => $this->config->get('config_language_id'),
			'name'                      => '',
			'email'                     => '',
			'last_accessed'             => '',
			'date_added'                => '',
			'date_modified'             => '',
			'send_sample_email'         => $download_sample_id ? 0 : 1,
		);

		foreach ($form as $key => $v) {
			if (isset($this->request->post[$key])) {
				$data[$key] = $this->request->post[$key];
			} else if (isset($download_info[$key])) {
				$data[$key] = $download_info[$key];
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

		$template = 'catalog/pd/download_sample_form';
		$this->response->setOutput($this->load->view($template, $data));
	}

	protected function validate() {
		$errors = false;

		if (!$this->user->hasPermission('modify', 'catalog/download_sample')) {
			$errors = true;
			$this->alert['error']['permission'] = $this->language->get('error_permission');
		}

		return !$errors;
	}

	protected function validateForm(&$data) {
		$errors = !$this->validate();

		if (empty($data['download_id'])) {
			$errors = true;
			$this->error['download'] = $this->language->get('error_download');
		}

		if ((utf8_strlen($data['name']) < 1) || (utf8_strlen($data['name']) > 64)) {
			$errors = true;
			$this->error['name'] = $this->language->get('error_name');
		}

		if (!validate_email($data['email'])) {
			$errors = true;
			$this->error['email'] = $this->language->get('error_email');
		}

		if ($data['constraint'] != '1' && ((int)$data['remaining'] != $data['remaining'] || (int)$data['remaining'] <= 0)) {
			$errors = true;
			$this->error['remaining'] = $this->language->get('error_positive_integer');
		}

		if ($data['constraint'] != '0' && $data['expiration_type'] == '1' && !validate_date($data['end_time'])) {
			$errors = true;
			$this->error['end_time'] = $this->language->get('error_date_time');
		}

		if ($data['constraint'] != '0' && $data['expiration_type'] == '0' && ((int)$data['duration'] != $data['duration'] || (int)$data['duration'] <= 0)) {
			$errors = true;
			$this->error['duration'] = $this->language->get('error_positive_integer');
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
				if (!isset($this->request->get['force'])) {
				}
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

	protected function sendSampleLink($data) {
		if ($data) {
			if (!$data['email'] || !validate_email($data['email'])) {
				$this->alert['error']['email'] = $this->language->get('error_sample_email');
				return false;
			}

			$l_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "language WHERE language_id = '" . $data['language_id'] . "'");
			if ($l_query->num_rows) {
				$language_id = $data['language_id'];
				$language = new Language($l_query->row['code']);
				$language->load($l_query->row['code']);
			} else {
				$language = $this->language;
				$language_id = $this->config->get('config_language_id');
			}
			$language->load('mail/download_sample');

			$store_id = $data['store_id'];

			$config = new Config();

			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "setting WHERE store_id = '" . (int)$store_id . "'");

			foreach ($query->rows as $setting) {
				if (!$setting['serialized']) {
					$config->set($setting['key'], $setting['value']);
				} else {
					$config->set($setting['key'], json_decode($setting['value'], true));
				}
			}

			if ((int)$store_id == 0) {
				$config->set('config_url', HTTP_CATALOG);
				$config->set('config_ssl', HTTPS_CATALOG);
			}

			$url = new Url($config->get('config_url'), $config->get('config_ssl'));

			$download_link = $url->link('download/sample', 'dsid=' . $data['hash']);

			if ($this->config->get('config_seo_url')) {
				if (class_exists('VQMod')) {
					require_once(VQMod::modCheck((DIR_APPLICATION . '../catalog/controller/startup/seo_url.php')));
				} else {
					// TODO: try loading OCMODed file
					require_once(DIR_APPLICATION . '../catalog/controller/startup/seo_url.php');
				}
				$seo_url = new ControllerStartupSeoUrl($this->registry);
				$download_link = $seo_url->rewrite($download_link);
			}

			$customer = $data['name'];
			$email = $data['email'];
			$subject = sprintf($language->get('text_subject'), $config->get('config_name'));

			// HTML Mail
			$html_data['title'] = sprintf($language->get('text_subject'), html_entity_decode($config->get('config_name'), ENT_QUOTES, 'UTF-8'));
			$html_data['text_heading'] = $language->get('text_heading');
			$html_data['text_greeting'] = $language->get('text_greeting');
			$html_data['text_download_sample'] = $language->get('text_download_sample');
			$html_data['text_access_download'] = $language->get('text_access_download');

			if ($this->config->get('pd_show_sample_constraint')) {
				if ($data['constraint'] == '0') {
					$html_data['text_download_constraint'] = sprintf($language->get('text_constraint_quantity'), $data['remaining']);
				} else if ($data['constraint'] == '1') {
					$end_time = new DateTime($data['end_time'], new DateTimeZone("UTC"));
					$html_data['text_download_constraint'] = sprintf($language->get('text_constraint_duration'), $end_time->format('Y-m-d H:i:s \U\T\C'));
				} else {
					$end_time = new DateTime($data['end_time'], new DateTimeZone("UTC"));
					$html_data['text_download_constraint'] = sprintf($language->get('text_constraint_both'), $data['remaining'], $end_time->format('Y-m-d H:i:s \U\T\C'));
				}
			} else {
				$html_data['text_download_constraint'] = '';
			}

			$html_data['text_powered_by'] = $language->get('text_powered_by');
			$html_data['text_closing'] = $language->get('text_closing');

			$html_data['store_name'] = $config->get('config_name');
			$html_data['store_url'] = $config->get('config_secure') ? $config->get('config_ssl') : $config->get('config_url');
			$html_data['logo'] = ($config->get('config_secure') ? $config->get('config_ssl') : $config->get('config_url')) . 'image/' . $config->get('config_logo');
			$html_data['customer'] = $customer;
			$html_data['download_name'] = $data['download'];
			$html_data['download_link'] = $download_link;
			$html_data['sender'] = $config->get('config_name');

			$template = 'mail/download_sample.html';
			$html = $this->load->view($template, $html_data);

			// Text Mail
			$template = 'mail/download_sample.text';
			$text = $this->load->view($template, $html_data);
			$text = html_entity_decode(strip_tags(br2nl($text)), ENT_QUOTES, 'UTF-8');

			$mail = new Mail();
			$mail->protocol = $this->config->get('config_mail_protocol');
			$mail->parameter = $this->config->get('config_mail_parameter');
			$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
			$mail->smtp_username = $this->config->get('config_mail_smtp_username');
			$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
			$mail->smtp_port = $this->config->get('config_mail_smtp_port');
			$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');
			$mail->setFrom($config->get('config_email'));
			$mail->setSender($config->get('config_name'));
			$mail->setSubject($subject);
			$mail->setHtml($html);
			$mail->setText($text);

			$mail->setTo($email);
			$mail->send();

			return true;
		}

		return false;
	}

	protected function formatDateDiff($start, $end = null) {
		if (!($start instanceof DateTime)) {
			$start = new DateTime($start, new DateTimeZone("UTC"));
		}

		if ($end === null) {
			$end = new DateTime(null, new DateTimeZone("UTC"));
		}

		if (!($end instanceof DateTime)) {
			$end = new DateTime($end, new DateTimeZone("UTC"));
		}

		$interval = $end->diff($start);

		$format = array();

		if ($interval->y !== 0) {
			$format[] = "%y " . ($interval->y > 1 ? $this->language->get('text_years') : $this->language->get('text_year')) . " ";
		}

		if ($interval->m !== 0) {
			$format[] = "%m " . ($interval->m > 1 ? $this->language->get('text_months') : $this->language->get('text_month')) . " ";
		}

		if ($interval->d !== 0) {
			$format[] = "%d " . ($interval->d > 1 ? $this->language->get('text_days') : $this->language->get('text_day')) . " ";
		}

		$format[] = " %H:%I:%S";

		return $interval->format(implode('', $format));
	}
}
