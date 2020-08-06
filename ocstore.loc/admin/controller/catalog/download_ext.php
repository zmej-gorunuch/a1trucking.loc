<?php

class ControllerCatalogDownloadExt extends Controller {
	protected $error = array();

	protected $alert = array(
		'error'     => array(),
		'warning'   => array(),
		'success'   => array(),
		'info'      => array()
	);

	private $columns = array(
		'selector'              => array('display' => 1, 'index' =>  0, 'align' => 'text-center', 'sort' => '',                     'class'=> ''),
		'id'                    => array('display' => 0, 'index' =>  1, 'align' =>   'text-left', 'sort' => 'd.download_id',        'class'=> ''),
		'name'                  => array('display' => 1, 'index' =>  5, 'align' =>   'text-left', 'sort' => 'dd.name',              'class'=> ''),
		'tag'                   => array('display' => 1, 'index' => 10, 'align' =>   'text-left', 'sort' => '',                     'class'=> 'visible-lg'),
		'size'                  => array('display' => 1, 'index' => 15, 'align' =>  'text-right', 'sort' => 'd.file_size',          'class'=> 'visible-sm visible-md visible-lg text-nowrap'),
		'constraint'            => array('display' => 1, 'index' => 20, 'align' =>   'text-left', 'sort' => 'd.constraint',         'class'=> 'visible-md visible-lg'),
		// 'total_downloads'       => array('display' => 1, 'index' => 20, 'align' =>  'text-right', 'sort' => 'd.total_downloads',    'class'=> 'visible-md visible-lg'),
		'downloaded'            => array('display' => 1, 'index' => 25, 'align' =>  'text-right', 'sort' => 'd.downloaded',         'class'=> 'visible-xl'),
		'sort_order'            => array('display' => 1, 'index' => 30, 'align' =>  'text-right', 'sort' => 'd.sort_order',         'class'=> 'visible-sm visible-md visible-lg'),
		'type'                  => array('display' => 1, 'index' => 35, 'align' => 'text-center', 'sort' => 'd.is_free',            'class'=> 'visible-md visible-lg'),
		'login'                 => array('display' => 1, 'index' => 40, 'align' => 'text-center', 'sort' => 'd.login',              'class'=> 'visible-md visible-lg'),
		'customer_group'        => array('display' => 1, 'index' => 45, 'align' =>   'text-left', 'sort' => '',                     'class'=> 'visible-xl'),
		'related_products'      => array('display' => 1, 'index' => 50, 'align' =>   'text-left', 'sort' => '',                     'class'=> 'visible-xl'),
		'date_added'            => array('display' => 0, 'index' => 55, 'align' =>   'text-left', 'sort' => 'd.date_added',         'class'=> 'visible-lg'),
		'date_modified'         => array('display' => 0, 'index' => 60, 'align' =>   'text-left', 'sort' => 'd.date_modified',      'class'=> ''),
		'status'                => array('display' => 1, 'index' => 65, 'align' => 'text-center', 'sort' => 'd.status',             'class'=> 'visible-sm visible-md visible-lg'),
		'action'                => array('display' => 1, 'index' => 70, 'align' =>  'text-right', 'sort' => '',                     'class'=> ''),
	);

	private $units = array(
		'year'  => 31556952,
		'month' => 2629746,
		'week'  => 604800,
		'day'   => 86400,
		'hour'  => 3600,
		'minute'=> 60,
	);


	private static $list_language_texts = array(
		'heading_title',
		// Texts
		'text_list', 'text_edit', 'text_none', 'text_toggle_navigation', 'text_toggle_dropdown', 'text_confirm_delete', 'text_force_delete',
		'text_are_you_sure', 'text_yes', 'text_no', 'text_enabled', 'text_disabled', 'text_filter', 'text_search', 'text_clear_filter',
		'text_clear_search', 'text_autocomplete', 'text_no_results', 'text_no_records_found', 'text_free', 'text_regular', 'text_auto_add_x',
		'text_searching', 'text_no_files_found', 'text_add_all_files', 'text_add_single_file', 'text_batch_add', 'text_copy_to_clipboard', 'text_copied',
		'text_view_free_samples', 'text_create_free_sample', 'text_view_tags', 'text_make_free', 'text_make_commercial', 'text_other_actions',
		'text_copying', 'text_deleting', 'text_no_constraints', 'text_quantitative', 'text_temporal', 'text_both',
		// Buttons
		'button_add', 'button_copy', 'button_cancel', 'button_delete', 'button_edit',
		// Errors
		'error_ajax_request'
	);

	private static $form_language_texts = array(
		'heading_title',
		// Texts
		'text_toggle_navigation', 'text_yes', 'text_no', 'text_enabled', 'text_disabled', 'text_free', 'text_regular', 'text_remove', 'text_autocomplete',
		'text_no_products', 'text_no_records_found', 'text_all_products', 'text_all_category_products', 'text_all_manufacturer_products',
		'text_selected_products', 'text_add_tag', 'text_download_stats', 'text_drop_files_here', 'text_choose_file', 'text_upload_in_progress',
		'text_confirm_delete', 'text_force_delete', 'text_are_you_sure', 'text_saving', 'text_deleting', 'text_canceling', 'text_resetting',
		'text_no_constraints', 'text_quantitative', 'text_temporal', 'text_both', 'text_minutes', 'text_hours', 'text_days', 'text_weeks', 'text_months',
		'text_years',
		// Help texts
		'help_tags', 'help_free_download', 'help_download_require_login', 'help_customer_group', 'help_update_previous_orders',
		'help_add_to_previous_orders', 'help_notify_customers', 'help_mask', 'help_upload', 'help_quantitative', 'help_temporal', 'help_limit_both',
		// Entries
		'entry_id', 'entry_name', 'entry_filename', 'entry_mask', 'entry_download_url', 'entry_tags', 'entry_related_products', 'entry_sort_order',
		'entry_constraint', 'entry_duration', 'entry_total_downloads', 'entry_download_type', 'entry_login', 'entry_status', 'entry_customer_group',
		'entry_downloaded', 'entry_update_previous_orders', 'entry_add_to_previous_orders', 'entry_notify_customers', 'entry_type', 'entry_size',
		// Buttons
		'button_save', 'button_apply', 'button_cancel', 'button_reset', 'button_add_files', 'button_choose_file', 'button_upload', 'button_start_upload',
		'button_cancel_upload', 'button_delete',
		// Errors
		'error_ajax_request', 'error_positive_integer', 'error_integer', 'error_name', 'error_mask', 'error_filename', 'error_missing_file'
	);

	private static $ba_form_language_texts = array(
		'heading_title',
		// Texts
		'text_form', 'text_toggle_navigation', 'text_yes', 'text_no', 'text_enabled', 'text_disabled', 'text_free', 'text_regular', 'text_remove',
		'text_autocomplete', 'text_all_types', 'text_no_products', 'text_no_records_found', 'text_all_products', 'text_all_category_products',
		'text_all_manufacturer_products', 'text_selected_products', 'text_loading_dir_list', 'text_refresh_dir_list', 'text_select_directory',
		'text_no_directories_found', 'text_no_files_found', 'text_searching', 'text_saving', 'text_canceling', 'text_add_tag', 'text_no_constraints',
		'text_quantitative', 'text_temporal', 'text_both', 'text_minutes', 'text_hours', 'text_days', 'text_weeks', 'text_months', 'text_years',
		// Help texts
		'help_file_types', 'help_excludes', 'help_recursive', 'help_tags', 'help_path_to_tags', 'help_free_download', 'help_download_require_login',
		'help_customer_group', 'help_quantitative', 'help_temporal', 'help_limit_both', 'help_add_to_previous_orders', 'help_notify_customers',
		// Entries
		'entry_directory', 'entry_files', 'entry_file_types', 'entry_excludes', 'entry_recursive', 'entry_tags', 'entry_path_to_tags',
		'entry_related_products', 'entry_sort_order', 'entry_constraint', 'entry_duration', 'entry_total_downloads', 'entry_download_type',
		'entry_login', 'entry_status', 'entry_customer_group', 'entry_add_to_previous_orders', 'entry_notify_customers',
		// Buttons
		'button_save', 'button_apply', 'button_cancel',
		// Errors
		'error_ajax_request', 'error_positive_integer', 'error_integer', 'error_filetype'
	);

	public function __construct($registry) {
		parent::__construct($registry);
		$this->load->helper('pd');

		$this->load->language('catalog/download_ext');
		$this->load->model('catalog/download_ext');
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

	public function change_type() {
		$this->action('change_type');
	}

	public function reset_download_stats() {
		$this->action('reset_download_stats');
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
				case 'product':
					$this->load->model('catalog/download_ext');

					$results = array();

					if (isset($this->request->get['query'])) {
						$filter_data = array(
							'filter_name'   => $this->request->get['query'],
							'filter_model'  => $this->request->get['query'],
							'sort'          => 'pd.name',
							'start'         => 0,
							'limit'         => 20,
						);

						$results = $this->model_catalog_download_ext->getProducts($filter_data);
					} else {
						$results = $this->model_catalog_download_ext->getProducts(array());
					}

					foreach ($results as $result) {
						$result['name'] = html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8');
						$response[] = array(
							'value'     => $result['name'],
							'tokens'    => explode(' ', $result['name']),
							'id'        => $result['product_id'],
							'model'     => $result['model']
						);
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
							'id'        => $result['download_id'],
							'free'      => ((int)$result['is_free']) ? utf8_strtolower($this->language->get('text_free')) : ''
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
			case 'reset_download_stats':
				if ($this->validateAction($action, $this->request->get)) {
					$this->model_catalog_download_ext->resetDownloaded($this->request->get['download_id']);
					$response['values']['downloaded'] = 0;
					$this->alert['success'][$action] = $this->language->get('text_success_reset');
				}

				$response = array_merge($response, array("errors" => $this->error), array("alerts" => $this->alert));

				if (!$ajax_request) {
					$this->session->data['errors'] = $this->error;
					$this->session->data['alerts'] = $this->alert;

					$url = $this->urlParams();

					if (isset($this->request->get['download_id'])) {
						$this->response->redirect($this->url->link('catalog/download_ext/edit', 'download_id=' . $this->request->get['download_id'] . $url, true));
					} else {
						$this->response->redirect($this->url->link('catalog/download_ext', $url, true));
					}
					return;
				} else {
					$this->response->addHeader('Content-Type: application/json');
					$this->response->setOutput(json_enc($response, JSON_UNESCAPED_SLASHES));
					return;
				}
				break;
			case 'copy':
			case 'delete':
			case 'change_type':
				if ($this->request->server['REQUEST_METHOD'] == 'GET' && isset($this->request->get['download_id'])) {
					$this->request->post['selected'] = array($this->request->get['download_id']);
				}
				if (isset($this->request->post['selected'])) {
					$successful = array();
					$failed = array();
					foreach ((array)$this->request->post['selected'] as $download_id) {
						switch ($action) {
							case 'copy':
								if ($this->validateAction($action, $download_id)) {
									$result = $this->model_catalog_download_ext->copyDownload($download_id);
									if ($result) {
										$successful[] = $download_id;
									} else {
										$failed[] = $download_id;
									}
								}
								break;
							case 'delete':
								if ($this->validateAction($action, $download_id)) {
									if ($this->config->get("pd_delete_file_from_system")) {
										$results = $this->model_catalog_download_ext->getDownload($download_id);

										$filename = $results['filename'];

										if (file_exists(DIR_DOWNLOAD . $filename)) {
											@unlink(DIR_DOWNLOAD . $filename);
										}
									}
									$this->model_catalog_download_ext->deleteDownload($download_id);
									$successful[] = $download_id;
								} else {
									$failed[] = $download_id;
								}
								break;
							case 'change_type':
								if ($this->validateAction($action, $this->request->get)) {
									$type = $this->request->get['to'];
									$this->model_catalog_download_ext->changeDownloadType($download_id, $type);
									$successful[] = $download_id;
								} else {
									$failed[] = $download_id;
								}
								break;
						}
					}

					if ($ajax_request) {
						if (count($successful)) {
							if ($action == "change_type") {
								$this->alert['success'][$action] = sprintf($this->language->get('text_success_' . $action), utf8_strtolower($this->language->get('text_' . $this->request->get['to'])), count($successful));
								$this->session->data['success'] = sprintf($this->language->get('text_success_' . $action), utf8_strtolower($this->language->get('text_' . $this->request->get['to'])), count($successful));
							} else {
								$this->alert['success'][$action] = sprintf($this->language->get('text_success_' . $action), count($successful));
								$this->session->data['success'] = sprintf($this->language->get('text_success_' . $action), count($successful));
							}
							// $response['reload'] = true; // TODO: is needed?
						}
						if ($this->error && count($failed) < 5) {
							$this->alert['warning'] = array_merge($this->alert['warning'], $this->error);
						} else if (count($failed)) {
							if ($action == "change_type") {
								$this->alert['warning']['failed'] = sprintf($this->language->get('text_failed_' . $action), utf8_strtolower($this->language->get('text_' . $this->request->get['to'])), count($failed));
							} else {
								$this->alert['warning']['failed'] = sprintf($this->language->get('text_failed_' . $action), count($failed));
							}
						}
					} else {
						if (count($successful)) {
							if ($action == "change_type") {
								$this->session->data['success'] = sprintf($this->language->get('text_success_' . $action), utf8_strtolower($this->language->get('text_' . $this->request->get['to'])), count($successful));
							} else {
								$this->session->data['success'] = sprintf($this->language->get('text_success_' . $action), count($successful));
							}
						}
						if ($this->error && count($failed) < 5) {
							$this->alert['warning'] = array_merge($this->alert['warning'], $this->error);
						} else if (count($failed)) {
							if ($action == "change_type") {
								$this->alert['warning']['failed'] = sprintf($this->language->get('text_failed_' . $action), utf8_strtolower($this->language->get('text_' . $this->request->get['to'])), count($failed));
							} else {
								$this->alert['warning']['failed'] = sprintf($this->language->get('text_failed_' . $action), count($failed));
							}
						}
					}
				}

				$response = array_merge($response, array("errors" => $this->error), array("alerts" => $this->alert));

				if (!$ajax_request) {
					$this->session->data['errors'] = $this->error;
					$this->session->data['alerts'] = $this->alert;

					$url = $this->urlParams();

					$this->response->redirect($this->url->link('catalog/download_ext', $url, true));
					return;
				} else {
					$this->response->addHeader('Content-Type: application/json');
					$this->response->setOutput(json_enc($response, JSON_UNESCAPED_SLASHES));
					return;
				}
				break;
			case 'add':
			case 'edit':
				if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm($this->request->post)) {
					$download_id = isset($this->request->get['download_id']) ? $this->request->get['download_id'] : '';

					$this->request->post['tags'] = $this->processTags($this->request->post['tags']);

					$downloads = array();
					$notifications = array('successful' => array(), 'failed' => array());
					switch ($action) {
						case 'add':
							$files = (array)$this->request->post['files'];
							unset($this->request->post['files']);
							foreach ($files as $file) {
								$save_data = array_merge($this->request->post, $file);
								$download_id = $this->model_catalog_download_ext->addDownload($save_data);
								$downloads[] = $download_id;

								if (!empty($save_data['notify_customers'])) {
									$updated_orders = $this->model_catalog_download_ext->getUpdatedOrders();

									if (isset($updated_orders['added'])) {
										foreach ($updated_orders['added'] as $order_id => $order_downloads) {
											$result = $this->notifyCustomer($order_id, $order_downloads[0], $save_data, "added");
											if ($result) {
												$notifications['successful'][] = $order_id;
											} else {
												$notifications['failed'][] = $order_id;
											}
										}
									}
								}
							}
							break;
						case 'edit':
							if ($download_id) {
								$files = (array)$this->request->post['files'];
								unset($this->request->post['files']);
								if (count($files)) {
									$save_data = array_merge($this->request->post, $files[0]);
									$this->model_catalog_download_ext->editDownload($download_id, $save_data);
									$downloads[] = $download_id;

									if (!empty($save_data['notify_customers'])) {
										$updated_orders = $this->model_catalog_download_ext->getUpdatedOrders();
										foreach (array("updated", "added") as $change_type) {
											if (isset($updated_orders[$change_type])) {
												foreach ($updated_orders[$change_type] as $order_id => $order_downloads) {
													$result = $this->notifyCustomer($order_id, $order_downloads[0], $save_data, $change_type);
													if ($result) {
														$notifications['successful'][] = $order_id;
													} else {
														$notifications['failed'][] = $order_id;
													}
												}
											}
										}
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
								$response['url'] = html_entity_decode($this->url->link('catalog/download_ext/edit', 'download_id=' . $download_id . $this->urlParams(), true));
								$this->session->data['success'] = $this->language->get('text_success_' . $action);
							}
						}

						if (count($downloads) > 1) {
							$this->alert['success'][$action] = sprintf($this->language->get('text_success_' . $action . '_multiple'), count($downloads));
						} else {
							$this->alert['success'][$action] = $this->language->get('text_success_' . $action);
						}

						if (count($notifications['successful'])) {
							$this->alert['success']['notifications'] = sprintf($this->language->get('text_success_notify'), count($notifications['successful']));
						}

						if (!empty($this->error['notifications']) && count($this->error['notifications']) < 5) {
							$this->alert['warning'] = array_merge($this->alert['warning'], $this->error['notifications']);
						} else if (count($notifications['failed'])) {
							$this->alert['warning']['notifications'] = sprintf($this->language->get('text_failed_notify'), count($notifications['failed']));
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

						if (count($notifications['successful'])) {
							$this->alert['success']['notifications'] = sprintf($this->language->get('text_success_notify'), count($notifications['successful']));
						}

						if (!empty($this->error['notifications']) && count($this->error['notifications']) < 5) {
							$this->alert['warning'] = array_merge($this->alert['warning'], $this->error['notifications']);
						} else if (count($notifications['failed'])) {
							$this->alert['warning']['notifications'] = sprintf($this->language->get('text_failed_notify'), count($notifications['failed']));
						}

						$this->session->data['errors'] = $this->error;
						$this->session->data['alerts'] = $this->alert;

						$url = $this->urlParams();

						$this->response->redirect($this->url->link('catalog/download_ext', $url, true));
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

	public function get_auto_add_file_list() {
		$response = array();

		if (($this->request->server['REQUEST_METHOD'] == 'GET')) {
			$file_types = $this->config->get("pd_aa_all_types") ? false : explode(",", $this->config->get('pd_aa_file_types'));
			$files = $this->model_catalog_download_ext->getFileListing($this->config->get('pd_aa_directory'), $file_types, $this->config->get("pd_aa_recursive"), true, array_unique(array_merge(array('cgi-bin', '.', '..', 'index.html', '.htaccess'), explode(",", $this->config->get("pd_aa_excludes")))), 1);

			$response['files'] = $files;
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_enc($response));
	}

	public function auto_add() {
		if ($this->request->server['REQUEST_METHOD'] == 'GET' && $this->validateAction("auto_add", $this->request->get)) {
			$save_data = array();
			$single_file = "";
			$files = array();

			if (isset($this->request->get['file'])) {
				$single_file = html_entity_decode($this->request->get['file']);
				if (is_readable($this->config->get('pd_aa_directory') . $single_file)) {
					$files[] = $this->config->get('pd_aa_directory') . $single_file;
				}
			} else {
				$file_types = $this->config->get("pd_aa_all_types") ? false : explode(",", $this->config->get('pd_aa_file_types'));

				$files = $this->model_catalog_download_ext->getFileListing($this->config->get('pd_aa_directory'), $file_types, $this->config->get("pd_aa_recursive"), true, array_unique(array_merge(array('cgi-bin', '.', '..', 'index.html', '.htaccess'), explode(",", $this->config->get("pd_aa_excludes")))));
			}

			$this->load->model('localisation/language');
			$languages = $this->model_localisation_language->getLanguages();

			$tags = array();
			if ($files && $this->config->get('pd_aa_file_tags')) {
				$tags = $this->processTags($this->config->get('pd_aa_file_tags'));
			}

			$successful = array();
			$failed = array();
			$errors = array();

			foreach ($files as $file) {
				$filename = preg_replace('/[^a-zA-Z0-9_\-\.]+/', '', preg_replace('/\s+/', '_', str_sanitize(pathinfo($file, PATHINFO_BASENAME)))) . '.' . md5(rand());
				$ok = @rename($file, DIR_DOWNLOAD . $filename);
				if ($ok && file_exists(DIR_DOWNLOAD . $filename)) {
					$save_data['filename'] = $filename;
					$save_data['mask'] = pathinfo($file, PATHINFO_BASENAME);
					$save_data['constraint'] = $this->config->get('pd_aa_constraint');
					$save_data['duration_in_seconds'] = (int)$this->config->get('pd_aa_duration') * (int)$this->config->get('pd_aa_duration_unit');
					$save_data['total_downloads'] = $this->config->get('pd_aa_total_downloads');
					$save_data['download_type'] = $this->config->get('pd_aa_free_download');
					$save_data['status'] = $this->config->get('pd_aa_download_status');
					$save_data['login'] = $this->config->get('pd_aa_login');
					$save_data['sort_order'] = $this->config->get('pd_aa_sort_order');
					$save_data['description'] = array();

					if ($this->config->get('pd_differentiate_customers')) {
						$customer_groups = $this->config->get('pd_customer_groups');
						if (is_array($customer_groups)) {
							$save_data['download_customer_groups'] = $customer_groups;
						}
					}

					foreach ($languages as $lang_key => $value) {
						$save_data['description'][$value["language_id"]] = array("name" => pathinfo($file, PATHINFO_FILENAME));
					}

					if ($this->config->get('pd_aa_path_to_tags')) {
						$file_path = str_replace("\\", "/", realpath(pathinfo($file, PATHINFO_DIRNAME)));
						$base_path = str_replace("\\", "/", realpath($this->config->get('pd_aa_directory')));
						$base_path_parts = explode("/", $base_path);
						$file_path_parts = explode("/", $file_path);

						$additional_tags = array();
						$folder_tags = array_map("htmlspecialchars", array_map("replace_commas", array_diff($file_path_parts, $base_path_parts)));
						if ($folder_tags) {
							$additional_tags = $this->processTags($folder_tags);
						}
						$save_data['tags'] = array_unique(array_merge($tags, $additional_tags));
					} else {
						$save_data['tags'] = array_unique($tags);
					}

					$result = $this->model_catalog_download_ext->addDownload($save_data);
					if ($result) {
						$successful[] = $result;
					} else {
						$failed[] = 1;
					}
				} else {
					$failed[] = 1;
					$errors['add' . $filename] = sprintf($this->language->get('error_file_permission'), pathinfo($file, PATHINFO_BASENAME));
				}
			}

			if (count($successful)) {
				if ($single_file) {
					$this->alert['success']['add'] = sprintf($this->language->get('text_success_add_file'), $single_file);
				} else {
					$this->alert['success']['add'] = sprintf($this->language->get('text_success_add'), count($successful));
				}
			}

			if ($errors && count($failed) < 5) {
				$this->alert['warning'] = array_merge($this->alert['warning'], $errors);
			} elseif (count($failed)) {
				$this->alert['warning']['add'] = sprintf($this->language->get('error_add'), count($failed));
			}

			$this->session->data['alerts'] = $this->alert;
		}

		$url = $this->urlParams();

		$this->response->redirect($this->url->link('catalog/download_ext', $url, true));
	}

	public function batch_add() {
		$ajax_request = isset($this->request->server['HTTP_X_REQUESTED_WITH']) && !empty($this->request->server['HTTP_X_REQUESTED_WITH']) && strtolower($this->request->server['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';

		$response = array();

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateAction("batch_add", $this->request->post)) {
			$save_data = array();

			$file_types = (int)$this->request->post['all_types'] ? false : array_map('trim', explode(",", $this->request->post['file_types']));
			$recursive = (int)$this->request->post['recursive'] ? true : false;

			$files = $this->model_catalog_download_ext->getFileListing($this->request->post['directory'], $file_types, $recursive, true, array_unique(array_merge(array('cgi-bin', '.', '..', 'index.html', '.htaccess'), explode(",", $this->request->post["excludes"]))));

			$this->load->model('localisation/language');
			$languages = $this->model_localisation_language->getLanguages();

			$tags = $this->processTags($this->request->post['tags']);

			$successful = array();
			$failed = array();
			$errors = array();

			foreach ($files as $file) {
				$filename = preg_replace('/[^a-zA-Z0-9_\-\.]+/', '', preg_replace('/\s+/', '_', str_sanitize(pathinfo($file, PATHINFO_BASENAME)))) . '.' . md5(rand());
				$ok = @rename($file, DIR_DOWNLOAD . $filename);
				if ($ok && file_exists(DIR_DOWNLOAD . $filename)) {
					$save_data['filename'] = $filename;
					$save_data['mask'] = pathinfo($file, PATHINFO_BASENAME);
					$save_data['description'] = array();

					if (isset($this->request->post['download_customer_groups'])) {
						$save_data['download_customer_groups'] = $this->request->post['download_customer_groups'];
					}

					foreach ($languages as $lang_key => $value) {
						$save_data['description'][$value["language_id"]] = array("name" => pathinfo($file, PATHINFO_FILENAME));
					}

					if (isset($this->request->post['path_to_tags'])) {
						$file_path = str_replace("\\", "/", realpath(pathinfo($file, PATHINFO_DIRNAME)));
						$base_path = str_replace("\\", "/", realpath($this->config->get('pd_ba_directory')));
						$base_path_parts = explode("/", $base_path);
						$file_path_parts = explode("/", $file_path);

						$additional_tags = array();
						$folder_tags = array_map("htmlspecialchars", array_map("replace_commas", array_diff($file_path_parts, $base_path_parts)));
						if ($folder_tags) {
							$additional_tags = $this->processTags($folder_tags);
						}
						$save_data['tags'] = array_unique(array_merge($tags, $additional_tags));
					} else {
						$save_data['tags'] = array_unique($tags);
					}

					$result = $this->model_catalog_download_ext->addDownload(array_merge($this->request->post, $save_data));
					if ($result) {
						$successful[] = $result;
					} else {
						$failed[] = 1;
					}
				} else {
					$failed[] = 1;
					$errors['add' . $filename] = sprintf($this->language->get('error_file_permission'), pathinfo($file, PATHINFO_BASENAME));
				}
			}

			if (count($successful)) {
				$response['callback'] = "bull5i.resetDirectory()";
				$this->alert['success']['add'] = sprintf($this->language->get('text_success_add'), count($successful));
			}

			if ($errors && count($failed) < 5) {
				$this->alert['warning'] = array_merge($this->alert['warning'], $errors);
			} elseif (count($failed)) {
				$this->alert['warning']['add'] = sprintf($this->language->get('error_add'), count($failed));
			}

			if (count($files) == 0) {
				$this->alert['info']['no_files_added'] = $this->language->get('text_no_files_added');
			}

			if ($ajax_request) {
				$response = array_merge($response, array("errors" => $this->error), array("alerts" => $this->alert));

				$this->response->addHeader('Content-Type: application/json');
				$this->response->setOutput(json_enc($response, JSON_UNESCAPED_SLASHES));
				return;
			} else {
				$this->session->data['errors'] = $this->error;
				$this->session->data['alerts'] = $this->alert;

				$url = $this->urlParams();

				$this->response->redirect($this->url->link('catalog/download_ext', $url, true));
				return;
			}
		}

		if ($ajax_request) {
			$response = array_merge($response, array("errors" => $this->error), array("alerts" => $this->alert));

			$this->response->addHeader('Content-Type: application/json');
			$this->response->setOutput(json_enc($response, JSON_UNESCAPED_SLASHES));
			return;
		} else {
			$this->getBatchAddForm();
		}
	}

	public function get_file_list() {
		$response = array();

		if ($this->request->server['REQUEST_METHOD'] == 'GET' && $this->validateGetFileListParams($this->request->get)) {
			$files = array();
			if (is_dir($this->request->get['d']) && $this->request->get['b']) {
				$recursive = filter_var($this->request->get['r'], FILTER_VALIDATE_BOOLEAN);
				$file_types = (filter_var($this->request->get['af'], FILTER_VALIDATE_BOOLEAN) === true) ? false : array_map('trim', explode(",", $this->request->get['ft']));
				$excludes = array_map('trim', explode(",", $this->request->get['ex']));
				$dir = realpath($this->request->get['d']);

				if ($this->request->get['b'] == ".") {
					$d = str_replace("\\", "/", realpath($this->request->get['d']));
				} else {
					$d = str_replace("\\", "/", realpath((strpos($this->request->get['d'], $this->request->get['b']) !== false) ? substr($this->request->get['d'], 0, strpos($this->request->get['d'], $this->request->get['b'])) : $this->request->get['d']));
				}

				$base = (stripos(strrev($d), "/") === 0 || stripos(strrev($d), "\\") === 0) ? $d : $d . "/";

				$files = $this->model_catalog_download_ext->getFileListing($dir, $file_types, $recursive, true, array_unique(array_merge(array('cgi-bin', '.', '..', 'index.html', '.htaccess'), $excludes)));

				usort($files, "sort_file_list");

				$response['files'] = array();

				foreach ($files as $file) {
					$file = str_replace("\\", "/", $file);
					$response['files'][] = str_replace("/", " / ", str_replace($base, "", $file));
				}
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_enc($response));
	}

	public function get_directory_list() {
		$response = array();

		if ($this->request->server['REQUEST_METHOD'] == 'GET') {
			$directories = $this->model_catalog_download_ext->getDirectoryListing($this->config->get('pd_ba_directory'), array_unique(array_merge(array('cgi-bin', '.', '..'), explode(",", $this->config->get("pd_ba_excludes")))));
			$response['directories'] = $directories;
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_enc($response));
	}

	// public function download_file_autocomplete() {
	//     $files = array();

	//     if (isset($this->request->get['name'])) {
	//         $files = glob(DIR_DOWNLOAD .  "*" . $this->request->get['name'] . "*");

	//         function format($value) {
	//             return pathinfo($value, PATHINFO_BASENAME);
	//         };

	//         function filter($value) {
	//             $exclude = array_flip(array('cgi-bin', '.', '..', 'index.html', '.htaccess'));
	//             return !isset($exclude[utf8_strtolower($value)]);
	//         };

	//         $files = array_filter(array_map("format", $files), "filter");
	//     }

	//     $this->response->addHeader('Content-Type: application/json');
	//     $this->response->setOutput(json_encode($files));
	// }

	public function upload() {
		require(DIR_SYSTEM . 'library/UploadHandler.php');

		$this->language->load('catalog/download_ext');

		$options = array(
			'script_url' => html_entity_decode($this->url->link('catalog/download_ext/upload', 'token=' . $this->session->data['token'], true)),
			'upload_dir' => DIR_DOWNLOAD,
			'upload_url' => HTTPS_CATALOG . 'system/download/',
			'discard_aborted_uploads' => false,
			'detect_mime_type' => true,
		);

		$error_messages = array(
			1 => sprintf($this->language->get('error_upload_1'), ini_get("upload_max_filesize")),
			2 => $this->language->get('error_upload_2'),
			3 => $this->language->get('error_upload_3'),
			4 => $this->language->get('error_upload_4'),
			6 => $this->language->get('error_upload_6'),
			7 => $this->language->get('error_upload_7'),
			8 => $this->language->get('error_upload_8'),
			'post_max_size' => sprintf($this->language->get('error_post_max_size'), ini_get("post_max_size")),
			'max_file_size' => $this->language->get('error_max_file_size'),
			'min_file_size' => $this->language->get('error_min_file_size'),
			'accept_file_types' => $this->language->get('error_accept_file_types'),
			'max_number_of_files' => $this->language->get('error_max_number_of_files'),
			'max_width' => $this->language->get('error_max_width'),
			'min_width' => $this->language->get('error_min_width'),
			'max_height' => $this->language->get('error_max_height'),
			'min_height' => $this->language->get('error_min_height'),
			'abort' => $this->language->get('error_abort'),
			'image_resize' => $this->language->get('error_image_resize'),
			'upload_dir_not_writable' => $this->language->get('error_upload_dir_not_writable'),
			'file_name' => $this->language->get('error_file_name'),
			'missing_file' => $this->language->get('error_missing_file'),
		);

		$upload_handler = new UploadHandler($options, true, $error_messages);
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
			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('catalog/download_ext', 'token=' . $this->session->data['token'], true),
			'active'    => true
		);

		$data['add'] = $this->url->link('catalog/download_ext/add', $url, true);
		$data['copy'] = $this->url->link('catalog/download_ext/copy', $url, true);
		$data['delete'] = $this->url->link('catalog/download_ext/delete', $url, true);
		$data['view_free_samples'] = $this->url->link('catalog/download_sample', $this->urlParams(0,0,0,0,0), true);
		$data['view_download_tags'] = $this->url->link('catalog/download_tag', $this->urlParams(0,0,0,0,0), true);
		$data['make_free'] = $this->url->link('catalog/download_ext/change_type', 'to=free' . $url, true);
		$data['make_commercial'] = $this->url->link('catalog/download_ext/change_type', 'to=commercial' . $url, true);
		$data['autocomplete'] = html_entity_decode($this->url->link('catalog/download_ext/autocomplete', 'token=' . $this->session->data['token'], true), ENT_QUOTES, 'UTF-8');
		$data['auto_add'] = $this->url->link('catalog/download_ext/auto_add', 'token=' . $this->session->data['token'] . $url, true);
		$data['auto_add_file'] = html_entity_decode($this->url->link('catalog/download_ext/auto_add', 'file=%s&token=' . $this->session->data['token'] . $url, true));
		$data['batch_add'] = $this->url->link('catalog/download_ext/batch_add', 'token=' . $this->session->data['token'] . $url, true);
		$data['auto_add_files'] = htmlspecialchars_decode($this->url->link('catalog/download_ext/get_auto_add_file_list', 'token=' . $this->session->data['token'] . $url, true));

		$data['pd_aa_status'] = $this->config->get('pd_aa_status');
		$data['pd_ba_status'] = $this->config->get('pd_ba_status');

		$data['typeahead'] = array();

		$this->load->model('catalog/download_tag');
		$total_download_tags = $this->model_catalog_download_tag->getTotalDownloadTags();

		$this->load->model('catalog/product');
		$total_products = $this->model_catalog_product->getTotalProducts();

		$url = $this->urlParams(0, 0, 0, 0, 0);

		if ($total_download_tags < TA_PREFETCH) {
			$data['typeahead']['tag']['prefetch'] = html_entity_decode($this->url->link('catalog/download_ext/autocomplete', 'type=tag' . $url, true));
		}

		if ($total_products < TA_PREFETCH) {
			$data['typeahead']['related_products']['prefetch'] = html_entity_decode($this->url->link('catalog/download_ext/autocomplete', 'type=product' . $url, true));
		}

		$data['typeahead']['tag']['remote'] = html_entity_decode($this->url->link('catalog/download_ext/autocomplete', 'type=tag&query=%QUERY' . $url, true));
		$data['typeahead']['related_products']['remote'] = html_entity_decode($this->url->link('catalog/download_ext/autocomplete', 'type=product&query=%QUERY' . $url, true));

		if ($this->config->get("pd_differentiate_customers")) {
			$this->load->model('customer/customer_group');
			$data['customer_groups'] = $this->model_customer_customer_group->getCustomerGroups(array());
		} else {
			$data['customer_groups'] = array();
		}

		$columns = $this->columns;

		if (!$this->config->get("pd_differentiate_customers")) {
			unset($columns['customer_group']);
		}

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

		if (isset($this->request->get['filter_related_products'])) {
			if ($this->request->get['filter_related_products'] != "*") {
				$product = $this->model_catalog_product->getProduct($this->request->get['filter_related_products']);
				$filters["related_products_name"] = isset($product['name']) ? $product['name'] : "";
			} else {
				$filters["related_products_name"] = $this->language->get('text_none');
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

		$results = $this->model_catalog_download_ext->getDownloads($filter_data);

		$filtered_total = $this->model_catalog_download_ext->getFilteredTotalDownloads();
		$total = $this->model_catalog_download_ext->getTotalDownloads();

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
				'url'       => $this->url->link('catalog/download_ext/edit', 'download_id=' . $result['download_id'] . $this->urlParams(), true)
			);

			$sub_action[] = array(
				'name'      => 'view_samples',
				'title'     => '',
				'text'      => $this->language->get('text_view_free_samples'),
				'class'     => '',
				'icon'      => '',
				'url'       => $this->url->link('catalog/download_sample', 'filter_download=' . urlencode(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')) . $this->urlParams(0,0,0,0,0), true)
			);

			$sub_action[] = array(
				'name'      => 'create_sample',
				'title'     => '',
				'text'      => $this->language->get('text_create_free_sample'),
				'class'     => '',
				'icon'      => '',
				'url'       => $this->url->link('catalog/download_sample/add', 'download_id=' . $result['download_id'] . $this->urlParams(0,0,0,0,0), true)
			);

			$download = array(
				'download_id'   => $result['download_id'],
				'exists'        => file_exists(DIR_DOWNLOAD . $result['filename']) && is_file(DIR_DOWNLOAD . $result['filename']),
				'selected'      => isset($this->request->post['selected']) && in_array($result['download_id'], $this->request->post['selected']),
			);

			$missing |= !$download['exists'];

			foreach ($displayed_columns as $column) {
				switch ($column) {
					case 'id':
						$value = $result['download_id'];
						break;
					case 'action':
						$value = $action;
						$download['sub_action'] = $sub_action;
						break;
					case 'type':
					case 'login':
					case 'status':
						$value = $result[$column . '_text'];
						$download[$column . '_class'] = (int)$result[$column] ? 'success' : 'danger';
						break;
					case 'constraint':
						$value = $this->formatConstraint($result);
						break;
					case 'total_downloads':
					case 'tag':
						$value = $result[$column . '_text'];
						// $download[$column . '_class'] = (int)$result[$column] ? 'success' : 'danger';
						break;
					case 'customer_group':
					case 'related_products':
						if ((int)$result[$column . '_count'] > 2) {
							$items = explode("<br/>", $result[$column . '_text']);
							$value = implode("<br/>", array_slice($items, 0, 1)) . ' ...';
							$download[$column . '_full'] = implode("<br/>", array_map("htmlspecialchars", $items));
						} else {
							$value = $result[$column . '_text'];
							$download[$column . '_full'] = '';
						}
						$download[$column . '_count'] = $result[$column . '_count'];
						break;
					case 'name':
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
						$download_data['date_added'] = $result['date_added'];
						$download_data['date_modified'] = $result['date_modified'];

						if ((int)$result['type']) {
							$_url = new Url(HTTP_CATALOG, HTTPS_CATALOG);
							$download_data['url'] = $_url->link('product/download/download', 'did=' . $result['download_id']);
						} else {
							$download_data['url'] = '';
						}

						$template = 'catalog/pd/download_info';

						$download['download_details'] = htmlentities($this->load->view($template, $download_data), ENT_QUOTES, 'UTF-8');
						break;
					case 'size':
						$value = (isset($result['file_size'])) ? format_file_size($result['file_size']) : "";
						$download[$column . '_bytes'] = (isset($result['file_size'])) ? $result['file_size'] . " B" : "";
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
				$data['sorts'][$column] = $this->url->link('catalog/download_ext', $this->urlParams(1, 1, $attr['sort'], $order == 'ASC' ? 'DESC' : 'ASC', '1'), true);
			} else {
				$data['sorts'][$column] = null;
			}
		}

		$limit = (int)$this->config->get('config_limit_admin');

		$pagination = new Pagination();
		$pagination->total = $filtered_total;
		$pagination->page = $page;
		$pagination->limit = $limit;
		$pagination->url = $this->url->link('catalog/download_ext', $this->urlParams(1, 1, 1, 1, '{page}'), true);
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

		$template = 'catalog/pd/download_ext_list';

		$this->response->setOutput($this->load->view($template, $data));
	}

	protected function getForm() {
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
		$this->document->addStyle('view/stylesheet/pd/css/fileupload/jquery.fileupload.css');

		$this->document->addScript('view/javascript/pd/catalog.min.js');
		$this->document->addScript('view/javascript/pd/fileupload/vendor/jquery.ui.widget.js');
		$this->document->addScript('view/javascript/pd/fileupload/jquery.iframe-transport.js');
		$this->document->addScript('view/javascript/pd/fileupload/jquery.fileupload.js');
		$this->document->addScript('view/javascript/pd/fileupload/jquery.fileupload-process.js');
		$this->document->addScript('view/javascript/pd/upload.min.js');

		$this->document->setTitle($this->language->get('heading_title'));

		$data['text_form'] = is_null($download_id) ? $this->language->get('text_add') : $this->language->get('text_edit');

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
			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('catalog/download_ext', 'token=' . $this->session->data['token'], true),
			'active'    => false
		);

		$data['breadcrumbs'][] = array(
			'text'      => $download_id ? $this->language->get('text_edit') : $this->language->get('text_add'),
			'href'      => $this->url->link('catalog/download_ext/' . ($download_id ? 'edit' : 'add'), ($download_id ? 'download_id=' . $download_id : '') . $url, true),
			'active'    => true
		);

		$data['save'] = $this->url->link('catalog/download_ext/' . ($download_id ? 'edit' : 'add'), ($download_id ? 'download_id=' . $download_id : '') . $url, true);
		$data['delete'] = $this->url->link('catalog/download_ext/delete', ($download_id ? 'download_id=' . $download_id : '') . $url, true);
		$data['cancel'] = $this->url->link('catalog/download_ext', $url, true);
		// $data['upload'] = html_entity_decode($this->url->link('catalog/download_ext/upload', 'token=' . $this->session->data['token'], true));
		$data['upload'] = HTTPS_CATALOG . 'upload.php?token=' . $this->session->data['token'];
		$data['autocomplete'] = html_entity_decode($this->url->link('catalog/download_ext/autocomplete', 'token=' . $this->session->data['token'], true), ENT_QUOTES, 'UTF-8');

		if ($download_id) {
			$data['edit'] = true;
			$data['download_id'] = $download_id;
			$data['reset'] = $this->url->link('catalog/download_ext/reset_download_stats', 'download_id=' . $download_id . $url, true);
		} else {
			$data['edit'] = false;
			$data['download_id'] = "";
			$data['reset'] = "";
		}

		$this->load->model('localisation/language');
		$languages = $this->model_localisation_language->getLanguages();
		foreach ($languages as $key => $value) {
			unset($languages[$key]['image']);
		}
		$data['languages'] = array_remap_key_to_id('language_id', $languages);
		$data['default_language'] = $this->config->get('config_language_id');

		// Set session data for uploader
		$this->session->data['dir_language'] = $data['languages'][$data['default_language']]['code'];
		$this->session->data['dir_application'] = DIR_APPLICATION;
		$this->session->data['oc_version'] = VERSION;

		$this->load->model('customer/customer_group');
		$customer_groups = $this->model_customer_customer_group->getCustomerGroups();
		$data['customer_groups'] = array_remap_key_to_id('customer_group_id', $customer_groups);

		$this->load->model('catalog/category');
		$categories = $this->model_catalog_category->getCategories(array("sort" => "name"));
		$data['categories'] = array_remap_key_to_id('category_id', $categories);

		$this->load->model('catalog/manufacturer');
		$manufacturers = $this->model_catalog_manufacturer->getManufacturers();
		$data['manufacturers'] = array_remap_key_to_id('manufacturer_id', $manufacturers);

		$this->load->model('catalog/download_tag');
		$total_tags = $this->model_catalog_download_tag->getTotalDownloadTags();
		$data['download_tags'] = array();

		if ($total_tags < TA_PREFETCH) {
			$tags = $this->model_catalog_download_tag->getDownloadTags();
			foreach ($tags as $tag) {
				$data['download_tags'][] = array("id" => $tag["name"], "text" => $tag["name"]);
			}
			$data['download_tags'] = json_encode($data['download_tags']);
		}

		$url = $this->urlParams(0, 0, 0, 0, 0);

		$data['typeahead'] = array();

		$this->load->model('catalog/product');
		$total_products = $this->model_catalog_product->getTotalProducts();
		if ($total_products < TA_PREFETCH) {
			$data['typeahead']['products']['prefetch'] = html_entity_decode($this->url->link('catalog/download_ext/autocomplete', 'type=product' . $url, true));
		}

		$data['typeahead']['products']['remote'] = html_entity_decode($this->url->link('catalog/download_ext/autocomplete', 'type=product&query=%QUERY' . $url, true));

		$data['differentiate_customers'] = $this->config->get('pd_differentiate_customers');
		$data['max_chunk_size'] = min(to_bytes(ini_get('post_max_size')), to_bytes(ini_get('upload_max_filesize')));

		if ($download_id && $this->request->server['REQUEST_METHOD'] != 'POST') {
			$download_info = $this->model_catalog_download_ext->getDownload($download_id);

			if (!$download_info) {
				$this->response->redirect($this->url->link('catalog/download_sample', $url, true));
				return;
			}
		}

		$form = array(
			'tags'                      => '',
			'sort_order'                => 0,
			'constraint'                => 0,
			'duration' 	                => 0,
			'duration_unit'             => 60,
			'total_downloads'           => -1,
			'download_type'             => 0,
			'login'                     => 0,
			'status'                    => 1,
			'downloaded'                => 0,
			'update_previous_orders'	=> $this->config->get('pd_update_previous_orders'),
			'add_to_previous_orders'   	=> $this->config->get('pd_add_to_previous_orders'),
			'notify_customers'          => 0,
			'download_customer_groups'  => $download_id ? $this->model_catalog_download_ext->getDownloadCustomerGroups($download_id) : array(),
			'link_to'                   => "3",
			'category'                  => "",
			'manufacturer'              => "",
			'related_products'          => $download_id ? $this->model_catalog_download_ext->getDownloadRelatedProducts($download_id) : array(),
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

		if (!isset($data['duration_in_seconds'])) {
			$this->calculateDuration($data['duration'], $data);
		}

		if (isset($this->request->post['files'])) {
			$data['files'] = $this->request->post['files'];
		} else if (isset($download_info)) {
			$data['files'] = array(
				array(
					'download_id'   => $download_info['download_id'],
					'filename'      => $download_info['filename'],
					'mask'          => $download_info['mask'],
					'description'   => $this->model_catalog_download_ext->getDownloadDescriptions($download_id),
				)
			);
		} else {
			$data['files'] = array();
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

		$template = 'catalog/pd/download_ext_form';
		$this->response->setOutput($this->load->view($template, $data));
	}

	protected function getBatchAddForm() {
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

		foreach (self::$ba_form_language_texts as $text) {
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
			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('catalog/download_ext', 'token=' . $this->session->data['token'], true),
			'active'    => false
		);

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_batch_add'),
			'href'      => $this->url->link('catalog/download_ext/batch_add', 'token=' . $this->session->data['token'], true),
			'active'    => true
		);

		$data['save'] = $this->url->link('catalog/download_ext/batch_add', $url, true);
		$data['cancel'] = $this->url->link('catalog/download_ext', $url, true);
		$data['autocomplete'] = html_entity_decode($this->url->link('catalog/download_ext/autocomplete', 'token=' . $this->session->data['token'], true), ENT_QUOTES, 'UTF-8');
		$data['dir_list'] = html_entity_decode($this->url->link('catalog/download_ext/get_directory_list', 'token=' . $this->session->data['token'], true));
		$data['file_list'] = html_entity_decode($this->url->link('catalog/download_ext/get_file_list', 'token=' . $this->session->data['token'], true));

		$this->load->model('customer/customer_group');
		$customer_groups = $this->model_customer_customer_group->getCustomerGroups();
		$data['customer_groups'] = array_remap_key_to_id('customer_group_id', $customer_groups);

		$this->load->model('catalog/category');
		$categories = $this->model_catalog_category->getCategories(array("sort" => "name"));
		$data['categories'] = array_remap_key_to_id('category_id', $categories);

		$this->load->model('catalog/manufacturer');
		$manufacturers = $this->model_catalog_manufacturer->getManufacturers();
		$data['manufacturers'] = array_remap_key_to_id('manufacturer_id', $manufacturers);

		$this->load->model('catalog/download_tag');
		$total_tags = $this->model_catalog_download_tag->getTotalDownloadTags();
		$data['download_tags'] = array();

		if ($total_tags < TA_PREFETCH) {
			$tags = $this->model_catalog_download_tag->getDownloadTags();
			foreach ($tags as $tag) {
				$data['download_tags'][] = array("id" => $tag["name"], "text" => $tag["name"]);
			}
			$data['download_tags'] = json_encode($data['download_tags']);
		}

		$url = $this->urlParams(0, 0, 0, 0, 0);

		$data['typeahead'] = array();

		$this->load->model('catalog/product');
		$total_products = $this->model_catalog_product->getTotalProducts();
		if ($total_products < TA_PREFETCH) {
			$data['typeahead']['products']['prefetch'] = html_entity_decode($this->url->link('catalog/download_ext/autocomplete', 'type=product' . $url, true));
		}

		$data['typeahead']['products']['remote'] = html_entity_decode($this->url->link('catalog/download_ext/autocomplete', 'type=product&query=%QUERY' . $url, true));

		$data['differentiate_customers'] = $this->config->get('pd_differentiate_customers');

		$form = array(
			'directory'                 => '',
			'file_types'                => $this->config->get('pd_ba_file_types'),
			'all_types'                 => $this->config->get('pd_ba_all_types'),
			'excludes'                  => $this->config->get('pd_ba_excludes'),
			'recursive'                 => $this->config->get('pd_ba_recursive'),
			'tags'                      => $this->config->get('pd_ba_file_tags'),
			'path_to_tags'              => $this->config->get('pd_ba_path_to_tags'),
			'sort_order'                => $this->config->get('pd_ba_sort_order'),
			'constraint'                => $this->config->get('pd_ba_constraint'),
			'duration'                  => $this->config->get('pd_ba_duration'),
			'duration_unit'             => $this->config->get('pd_ba_duration_unit'),
			'total_downloads'           => $this->config->get('pd_ba_total_downloads'),
			'download_type'             => $this->config->get('pd_ba_free_download'),
			'login'                     => $this->config->get('pd_ba_login'),
			'status'                    => $this->config->get('pd_ba_download_status'),
			'download_customer_groups'  => $this->config->get('pd_customer_groups'),
			'add_to_previous_orders'   	=> $this->config->get('pd_add_to_previous_orders'),
			'notify_customers'          => 0,
			'link_to'                   => "",
			'category'                  => "",
			'manufacturer'              => "",
			'related_products'          => array(),
		);

		foreach ($form as $key => $v) {
			if (isset($this->request->post[$key])) {
				$data[$key] = $this->request->post[$key];
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

		$template = 'catalog/pd/download_ext_batch_add_form';
		$this->response->setOutput($this->load->view($template, $data));
	}

	protected function validateGetFileListParams($params) {
		if (empty($params['d']))
			return false;
		else if (!isset($params['b']))
			return false;
		else if (!isset($params['r']))
			return false;
		else if (!isset($params['af']))
			return false;
		else if (!isset($params['ft']))
			return false;
		else if (!isset($params['ex']))
			return false;
		return true;
	}

	protected function validate() {
		$errors = false;

		if (!$this->user->hasPermission('modify', 'catalog/download_ext')) {
			$errors = true;
			$this->alert['error']['permission'] = $this->language->get('error_permission');
		}

		return !$errors;
	}

	protected function validateForm(&$data) {
		$errors = !$this->validate();

		if (!isset($data['files']) || !count((array)$data['files'])) {
			$errors = true;
			$this->alert['error']['no_files'] = $this->language->get('error_no_files_selected');
		} else {
			foreach ((array)$data['files'] as $idx => $file) {
				foreach ($file['description'] as $language_id => $value) {
					if ((utf8_strlen(trim($value['name'])) < 3) || (utf8_strlen(trim($value['name'])) > 128)) {
						$errors = true;
						$this->error['files'][$idx]['description'][$language_id]['name'] = $this->language->get('error_name');
					}
				}

				if ((utf8_strlen($file['filename']) < 3) || (utf8_strlen($file['filename']) > 128)) {
					$errors = true;
					$this->error['files'][$idx]['filename'] = $this->language->get('error_filename');
				}

				if (!file_exists(DIR_DOWNLOAD . $file['filename']) && !is_file(DIR_DOWNLOAD . $file['filename'])) {
					$errors = true;
					$this->error['files'][$idx]['filename'] = $this->language->get('error_not_uploaded');
				}

				if ((utf8_strlen($file['mask']) < 3) || (utf8_strlen($file['mask']) > 128)) {
					$errors = true;
					$this->error['files'][$idx]['mask'] = $this->language->get('error_mask');
				}
			}
		}

		if ((int)$data['constraint'] == 1 || (int)$data['constraint'] == 3) {
			if ((int)$data['total_downloads'] < 1 || (string)((int)$data['total_downloads']) != $data['total_downloads']) {
				$errors = true;
				$this->error['total_downloads'] = $this->language->get('error_integer');
			}
		} else {
			$data['total_downloads'] = -1;
		}

		if ($errors) {
			$this->alert['warning']['warning'] = $this->language->get('error_warning');
		}

		return !$errors;
	}

	protected function validateAction($action, &$data) {
		$errors = !$this->validate();

		switch ($action) {
			case 'delete':
				if (!$errors) {
					$download_id = $data;
					$download = $this->model_catalog_download_ext->getDownload($download_id);

					if (!isset($this->request->get['force']) && file_exists(DIR_DOWNLOAD . $download['filename']) && is_file(DIR_DOWNLOAD . $download['filename'])) {
						$product_total = $this->model_catalog_download_ext->getTotalProductsByDownloadId($download_id);

						if ($product_total) {
							$errors = true;
							$this->error['delete_product' . $download_id] = sprintf($this->language->get('error_delete_product'), $download['name'], $product_total);
						}

						$order_total = $this->model_catalog_download_ext->getTotalOrdersByDownloadId($download_id);

						if ($order_total) {
							$errors = true;
							$this->error['delete_order' . $download_id] = sprintf($this->language->get('error_delete_order'), $download['name'], $order_total);
						}
					}
				}
				break;
			case 'reset_download_stats':
				if (!isset($data['download_id'])) {
					$errors = true;
					$this->alert['error']['request'] = $this->language->get('error_invalid_request');
				}
				break;
			case 'change_type':
				if (!isset($data['to']) || !in_array($data['to'], array("free", "regular"))) {
					$errors = true;
					$this->alert['error']['request'] = $this->language->get('error_invalid_request');
				}
				break;
			case 'batch_add':
				if (!$data['file_types'] && !(int)$data['all_types']) {
					$errors = true;
					$this->error['file_types'] = $this->language->get('error_filetype');
				}

				if ((int)$data['constraint'] == 1 || (int)$data['constraint'] == 3) {
					if ((int)$data['total_downloads'] < 1 || (string)((int)$data['total_downloads']) != $data['total_downloads']) {
						$errors = true;
						$this->error['total_downloads'] = $this->language->get('error_integer');
					}
				} else {
					$data['total_downloads'] = -1;
				}

				if ($data["tags"]) {
					$tags = array_map("trim", explode(",", $data["tags"]));
					foreach ($tags as $tag) {
						if (utf8_strlen($tag) < 2 || utf8_strlen($tag) > 64) {
							$errors = true;
							$this->error['tags'] = $this->language->get('error_tag_name');
							break;
						}
					}
				}

				if ($errors) {
					$this->alert['warning']['warning'] = $this->language->get('error_warning');
				}
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

	protected function processTags($tags) {
		$this->load->model('localisation/language');
		$this->load->model('catalog/download_tag');

		$languages = $this->model_localisation_language->getLanguages();

		$tags = array_map("trim", !is_array($tags) ? explode(",", $tags) : $tags);
		$processed_tags = array();

		foreach ($tags as $tag) {
			if ($tag) {
				$_tag = $this->model_catalog_download_tag->getDownloadTagByName($tag);

				if (is_null($_tag)) {
					// This tag does not exist, let's add it to the database
					$descriptions = array();
					foreach ($languages as $language) {
						$descriptions[$language["language_id"]] = array("name" => $tag);
					}

					$tag_data = array(
						"sort_order"        => 0,
						"administrative"    => 0,
						"descriptions"      => $descriptions
					);

					$tag_id = $this->model_catalog_download_tag->addDownloadTag($tag_data);

					if ($tag_id && !in_array((int)$tag_id, $processed_tags)) {
						$processed_tags[] = (int)$tag_id;
					}
				} else {
					if (!in_array((int)$_tag["download_tag_id"], $processed_tags)) {
						$processed_tags[] = (int)$_tag["download_tag_id"];
					}
				}
			}
		}

		return $processed_tags;
	}

	protected function notifyCustomer($order_id, $order_download_id, $data, $type) {
		$order_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "order` WHERE order_id = '" . (int)$order_id . "'");

		if ($order_query->num_rows) {
			$order = $order_query->row;

			if (!$order['email']) {
				$this->error['notifications']["order_{$order_id}_download_{$order_download_id}"] = sprintf($this->language->get('error_notify_email'), $order['firstname'] . " " . $order['lastname'], $order_id);
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
			$language->load('mail/download_updated');

			$store_id = $order['store_id'];

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

			$order_link = $url->link('account/order/info', 'order_id=' . $order_id);
			$download_link = $url->link('account/download/download', 'order_download_id=' . $order_download_id);

			if ($this->config->get('config_seo_url')) {
				if (class_exists('VQMod')) {
					require_once(VQMod::modCheck((DIR_APPLICATION . '../catalog/controller/startup/seo_url.php')));
				} else {
					// TODO: try loading OCMODed file
					require_once(DIR_APPLICATION . '../catalog/controller/startup/seo_url.php');
				}
				$seo_url = new ControllerStartupSeoUrl($this->registry);
				$order_link = $seo_url->rewrite($order_link);
				$download_link = $seo_url->rewrite($download_link);
			}

			$author = $order['firstname'];
			$email = $order['email'];
			$subject = sprintf($language->get('text_subject_' . $type), $config->get('config_name'), $order_id);

			// HTML Mail
			$html_data['title'] = sprintf($language->get('text_subject_' . $type), html_entity_decode($config->get('config_name'), ENT_QUOTES, 'UTF-8'), $order_id);
			$html_data['text_heading'] = $language->get('text_heading_' . $type);
			$html_data['text_greeting'] = $language->get('text_greeting');
			$html_data['text_download'] = $language->get('text_download_' . $type);
			$html_data['text_access_download'] = $language->get('text_access_download');
			$html_data['text_view_order'] = $language->get('text_view_order');
			$html_data['text_powered_by'] = $language->get('text_powered_by');
			$html_data['text_closing'] = $language->get('text_closing');

			$html_data['store_name'] = $config->get('config_name');
			$html_data['store_url'] = $config->get('config_secure') ? $config->get('config_ssl') : $config->get('config_url');
			$html_data['logo'] = ($config->get('config_secure') ? $config->get('config_ssl') : $config->get('config_url')) . 'image/' . $config->get('config_logo');
			$html_data['author'] = $author;
			$html_data['download_name'] = isset($data['description'][$language_id]['name']) ? $data['description'][$language_id]['name'] : $data['mask'];
			$html_data['order_id'] = $order_id;
			$html_data['download_link'] = $download_link;
			$html_data['order_link'] = $order_link;
			$html_data['sender'] = $config->get('config_name');

			$template = 'mail/download_updated.html';
			$html = $this->load->view($template, $html_data);

			// Text Mail
			$template = 'mail/download_updated.text';
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

	private function calculateDuration($duration, &$data) {
		foreach ($this->units as $unit => $value) {
			if ((int)$duration && (int)$duration % $value == 0) {
				$data['duration_unit'] = $value;
				$data['duration'] = (int)$duration / $value;
				return;
			}
		}
		$data['duration_unit'] = $this->units['minute'];
		$data['duration'] = 0;
	}

	private function formatConstraint($data) {
		$value = '';
		if ($data['constraint'] == '0') {
			$value = $this->language->get('text_no_constraints');
		} else if ($data['constraint'] == '1') {
			$value = sprintf($this->language->get('text_quantitative_constraint'), $data['total_downloads_text']);
		} else if ($data['constraint'] == '2') {
			foreach ($this->units as $unit => $value) {
				$duration = (int)$data['duration'];
				$duration_unit = 'minute';
				if ($duration && $duration % $value == 0) {
					$duration = round($duration / $value);
					$duration_unit = $duration == 1 ? $unit : "{$unit}s";
					break;
				}
			}
			$value = sprintf($this->language->get('text_temporal_constraint'), $duration, $duration_unit);
		} else if ($data['constraint'] == '3') {
			foreach ($this->units as $unit => $value) {
				$duration = (int)$data['duration'];
				$duration_unit = 'minute';
				if ($duration && $duration % $value == 0) {
					$duration = round($duration / $value);
					$duration_unit = $duration == 1 ? $unit : "{$unit}s";
					break;
				}
			}
			$value = sprintf($this->language->get('text_both_constraints'), $data['total_downloads_text'], $duration, $duration_unit);
		}
		return $value;
	}
}
