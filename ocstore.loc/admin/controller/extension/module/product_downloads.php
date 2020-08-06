<?php
define('EXTENSION_NAME',            'Product Downloads PRO');
define('EXTENSION_VERSION',         '5.1.8');
define('EXTENSION_ID',              '4968');
define('EXTENSION_COMPATIBILITY',   'OpenCart 2.3.x.x');
define('EXTENSION_STORE_URL',       'http://www.opencart.com/index.php?route=extension/extension/info&extension_id=' . EXTENSION_ID);
define('EXTENSION_PURCHASE_URL',    'http://www.opencart.com/index.php?route=extension/purchase&extension_id=' . EXTENSION_ID);
define('EXTENSION_SUPPORT_EMAIL',   'support@opencart.ee');
define('EXTENSION_SUPPORT_FORUM',   'http://forum.opencart.com/viewtopic.php?f=123&t=53705');
define('OTHER_EXTENSIONS',          'http://www.opencart.com/index.php?route=extension/extension&filter_username=bull5-i');
define('EXTENSION_MIN_PHP_VERSION', '5.4.0');

class ControllerExtensionModuleProductDownloads extends Controller {
	private $error = array();
	protected $alert = array(
		'error'     => array(),
		'warning'   => array(),
		'success'   => array(),
		'info'      => array()
	);

	private $defaults = array(
		// General
		'pd_installed'                  => 1,
		'pd_installed_version'          => EXTENSION_VERSION,
		'pd_status'                     => 0,
		'pd_force_download'             => 1,
		'pd_require_login'              => 0,
		'pd_show_login_required_text'   => 0,
		'pd_add_to_previous_orders'     => 1,
		'pd_update_previous_orders'     => 0,
		'pd_delete_file_from_system'    => 0,
		'pd_remove_sql_changes'         => 0,
		'pd_hash_chars'                 => 'lULg6SFGR0Kmp25HwrhCMJTy39x7ZuAtN1dBcQIzV8OjnqEskfvobW4XiaPDeY',
		'pd_services'                   => "W10=",
		'pd_as'                         => "WyIwIl0=",

		// Dashboard widget
		// 'pd_db_widget_status'           => 0,
		// 'pd_db_display_downloads'       => 0,

		// Downloads page
		'pd_dp_status'                  => 0,
		'pd_dp_header_link'             => 1,
		'pd_dp_footer_link'             => 1,
		'pd_dp_seo_keyword'             => 'downloads',
		'pd_dp_downloads_per_page'      => 25,
		'pd_dp_show_search_bar'         => 1,
		'pd_dp_show_filter_tags'        => 1,
		'pd_dp_show_file_size'          => 1,
		'pd_dp_show_date_added'         => 0,
		'pd_dp_show_date_modified'      => 0,
		'pd_dp_show_icon'               => 1,
		'pd_dp_name_as_link'            => 0,
		'pd_dp_delay_download'          => 3000,

		// Custom account downloads page
		'pd_cadp_status'                => 0,
		'pd_cadp_downloads_per_page'    => 25,
		'pd_cadp_show_icon'             => 1,
		'pd_cadp_show_expired_downloads'=> 0,

		// Free downloads
		'pd_show_free_download_count'   => 0,
		'pd_require_login_free'         => 0,
		'pd_show_download_without_link' => 0,
		'pd_add_free_downloads_to_order'=> 0,
		'pd_differentiate_customers'    => 0,
		'pd_customer_groups'            => array(),

		// Regular downloads
		'pd_show_purchased_downloads'   => 0,
		'pd_show_downloads_remaining'   => 1,
		'pd_show_purchasable_downloads' => 0,
		'pd_require_login_regular'      => 0,

		// Download samples
		'pd_show_sample_constraint'     => 1,
		'pd_require_login_sample'       => 0,
		'pd_delay_download_sample'      => 3000,
		'pd_ds_seo_keyword'             => 'download-samples',

		// Icons
		'pd_use_fa_icons'               => 0,

		// Auto Add
		'pd_aa_status'                  => 0,
		'pd_aa_directory'               => DIR_DOWNLOAD,
		'pd_aa_constraint'              => 0,
		'pd_aa_duration'                => 0,
		'pd_aa_duration_unit'           => 60,
		'pd_aa_total_downloads'         => -1,
		'pd_aa_all_types'               => 0,
		'pd_aa_file_types'              => "pdf,rar,zip",
		'pd_aa_excludes'                => "",
		'pd_aa_file_tags'               => "",
		'pd_aa_free_download'           => 0,
		'pd_aa_path_to_tags'            => 0,
		'pd_aa_recursive'               => 0,
		'pd_aa_login'                   => 0,
		'pd_aa_sort_order'              => 0,
		'pd_aa_download_status'         => 1,

		// Batch Add
		'pd_ba_status'                  => 0,
		'pd_ba_directory'               => DIR_DOWNLOAD,
		'pd_ba_constraint'              => 0,
		'pd_ba_duration'                => 0,
		'pd_ba_duration_unit'           => 60,
		'pd_ba_total_downloads'         => -1,
		'pd_ba_all_types'               => 0,
		'pd_ba_file_types'              => "pdf,rar,zip",
		'pd_ba_excludes'                => "",
		'pd_ba_file_tags'               => "",
		'pd_ba_free_download'           => 0,
		'pd_ba_path_to_tags'            => 0,
		'pd_ba_recursive'               => 0,
		'pd_ba_login'                   => 0,
		'pd_ba_sort_order'              => 0,
		'pd_ba_download_status'         => 1,

		// Hide 'Add to Cart'
		'pd_product_atc_action'         => 0,
		'pd_product_price_action'       => 0,
		'pd_product_replace_price_with' => array(),
		'pd_module_atc_action'          => 0,
		'pd_module_price_action'        => 0,
		'pd_module_replace_price_with'  => array(),
		'pd_list_atc_action'            => 0,
		'pd_list_price_action'          => 0,
		'pd_list_replace_price_with'    => array(),
	);

	private $module_defaults = array(
		'module_id'           => '',
		'name'                => '',
		'names'               => array(),
		'type'                => 'product',
		'show_in_tab'         => '0',
		'limit'               => '25',
		'downloads_per_page'  => '10',
		'show_file_size'      => '1',
		'show_date_added'     => '0',
		'show_date_modified'  => '0',
		'show_icon'           => '1',
		'name_as_link'        => '0',
		'show_empty_module'   => '0',
		'show_filter_tags'    => '0',
		'show_search_bar'     => '0',
		'lazy_load'           => '1',
		'status'              => '0',
	);

	private static $language_texts = array(
		// Texts
		'text_enabled', 'text_disabled', 'text_yes', 'text_no', 'text_toggle_navigation', 'text_legal_notice', 'text_license', 'text_extension_information',
		'text_terms', 'text_license_text', 'text_support_subject', 'text_faq', 'text_most_downloaded', 'text_most_viewed', 'text_date_added',
		'text_date_modified', 'text_name', 'text_sort_order', 'text_no_modules', 'text_remove', 'text_autocomplete', 'text_auto_add', 'text_batch_add',
		'text_free_downloads', 'text_regular_downloads', 'text_download_samples', 'text_hide_add_to_cart', 'text_file_type_icons', 'text_product_page',
		'text_dashboard_widget', 'text_downloads_page', 'text_downloads_page_info', 'text_account_downloads_page', 'text_account_downloads_page_info',
		'text_product_list_pages', 'text_product_modules', 'text_no_action', 'text_hide', 'text_hide_with_free', 'text_replace', 'text_all_types',
		'text_global_setting', 'text_default_setting', 'text_add_tag', 'text_add_download', 'text_default_module_name', 'text_product_downloads',
		'text_custom_downloads', 'text_noncommercial_downloads', 'text_header', 'text_footer', 'text_saving', 'text_fixing', 'text_upgrading',
		'text_resetting', 'text_loading', 'text_canceling', 'text_opening', 'text_deleting', 'text_product_layout', 'text_confirm_delete',
		'text_are_you_sure', 'text_edit_module', 'text_no_constraints', 'text_quantitative', 'text_temporal', 'text_both', 'text_minutes', 'text_hours',
		'text_days', 'text_weeks', 'text_months', 'text_years', 'text_no_records_found', 'text_loading_chart_data', 'text_download_count', 'text_downloads',
		// Tabs
		'tab_settings', 'tab_modules', 'tab_free_downloads', 'tab_regular_downloads', 'tab_samples', 'tab_hide_add_to_cart', 'tab_auto_add', 'tab_batch_add',
		'tab_icons', 'tab_statistics', 'tab_support', 'tab_about', 'tab_general', 'tab_faq', 'tab_services', 'tab_changelog', 'tab_extension',
		// Buttons
		'button_save', 'button_apply', 'button_cancel', 'button_close', 'button_upgrade', 'button_refresh', 'button_add_module', 'button_remove',
		'button_delete', 'button_general_settings', 'button_fix_db', 'button_daily', 'button_weekly', 'button_monthly', 'button_yearly', 'button_today',
		'button_yesterday', 'button_last_7_days', 'button_last_30_days', 'button_last_365_days', 'button_overall', 'button_purchase_license',
		// Help texts
		'help_dashboard_widget', 'help_cadp_status', 'help_name_as_link', 'help_force_download', 'help_require_login', 'help_show_login_required_text',
		'help_add_to_previous_orders', 'help_update_previous_orders', 'help_delete_file_from_system', 'help_remove_sql_changes',
		'help_hide_with_only_free_downloads', 'help_replace_atc_button', 'help_show_download_without_link', 'help_add_free_downloads_to_order',
		'help_differentiate_customers', 'help_show_purchased_downloads', 'help_show_purchasable_downloads', 'help_source_directory', 'help_file_types',
		'help_excludes', 'help_recursive', 'help_tags', 'help_path_to_tags', 'help_free_download', 'help_download_require_login', 'help_performance_impact',
		'help_lazy_load', 'help_show_sample_constraint', 'help_show_in_tab', 'help_total_downloads', 'help_quantitative', 'help_temporal', 'help_limit_both',
		'help_dp_seo_keyword', 'help_ds_seo_keyword', 'help_purchase_additional_licenses',
		// Entries
		'entry_installed_version', 'entry_extension_status', 'entry_force_download', 'entry_require_login', 'entry_show_login_required_text',
		'entry_add_to_previous_orders', 'entry_update_previous_orders', 'entry_delete_file_from_system', 'entry_remove_sql_changes',
		'entry_account_downloads_page', 'entry_downloads_page', 'entry_downloads_page_link',
		'entry_show_filter_tags', 'entry_show_search_bar', 'entry_delay_download', 'entry_type', 'entry_name', 'entry_show_in_tab', 'entry_limit',
		'entry_status', 'entry_sort_order', 'entry_download_sort_order', 'entry_downloads_per_page', 'entry_lazy_load', 'entry_show_file_size',
		'entry_show_date_added', 'entry_show_date_modified', 'entry_show_icon', 'entry_show_expired_downloads', 'entry_use_fa_icons', 'entry_name_as_link',
		'entry_show_empty_module', 'entry_downloads', 'entry_show_download_count', 'entry_show_download_without_link', 'entry_add_free_downloads_to_order',
		'entry_differentiate_customers', 'entry_default_customer_group', 'entry_show_purchased_downloads', 'entry_show_downloads_remaining',
		'entry_show_purchasable_downloads', 'entry_add_to_cart_button_action', 'entry_price_tag_action', 'entry_replace_price_with', 'entry_auto_add_status',
		'entry_batch_add_status', 'entry_source_directory', 'entry_file_types', 'entry_excludes', 'entry_recursive_search', 'entry_tags',
		'entry_path_to_tags', 'entry_constraint', 'entry_duration', 'entry_total_downloads', 'entry_free_download', 'entry_download_status',
		'entry_show_sample_constraint', 'entry_icon_dir', 'entry_extension_name', 'entry_extension_compatibility', 'entry_extension_store_url',
		'entry_copyright_notice', 'entry_seo_keyword', 'entry_active_on', 'entry_inactive_on',
		// Errors
		'error_module_name', 'error_positive_integer', 'error_integer', 'error_filetype', 'error_ajax_request', 'error_seo_keyword'
	);

	public function __construct($registry) {
		parent::__construct($registry);
		$this->load->helper('pd');

		$this->load->language('extension/module/product_downloads');
		$this->load->model('extension/module/product_downloads');
	}

	public function index() {
		$this->document->addStyle('view/javascript/summernote/summernote.css');
		$this->document->addStyle('view/stylesheet/pd/css/module.min.css');

		$this->document->addScript('view/javascript/summernote/summernote.js');
		$this->document->addScript('view/javascript/pd/highcharts/highcharts.js');
		$this->document->addScript('view/javascript/pd/module.min.js');

		$this->document->setTitle($this->language->get('extension_name'));

		$this->load->model('setting/setting');
		$this->load->model('extension/module');

		$ajax_request = isset($this->request->server['HTTP_X_REQUESTED_WITH']) && !empty($this->request->server['HTTP_X_REQUESTED_WITH']) && strtolower($this->request->server['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';

		if (isset($this->request->get['module_id'])) {
			$module_id = $this->request->get['module_id'];
		} else {
			$module_id = null;
		}

		if ($this->request->server['REQUEST_METHOD'] == 'POST' && !$ajax_request) {
			if (!is_null($module_id)) {
				if ($this->validateModuleForm($this->request->post)) {
					$this->model_extension_module->editModule($module_id, $this->request->post);

					$this->session->data['success'] = sprintf($this->language->get('text_success_update_module'), $this->request->post['name']);

					$this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true));
				}
			} else {
				if ($this->validateForm($this->request->post)) {
					$original_settings = $this->model_setting_setting->getSetting('pd');

					foreach ($this->defaults as $setting => $default) {
						$value = $this->config->get($setting);
						if ($value === null) {
							$original_settings[$setting] = $default;
						}
					}

					$modules = isset($this->request->post['modules']) ? $this->request->post['modules'] : array();
					unset($this->request->post['modules']);

					$settings = array_merge($original_settings, $this->request->post);
					$settings['pd_installed_version'] = $original_settings['pd_installed_version'];

					$settings['pd_aa_file_tags'] = $this->processTags($settings['pd_aa_file_tags']);
					$settings['pd_ba_file_tags'] = $this->processTags($settings['pd_ba_file_tags']);

					$this->model_setting_setting->editSetting('pd', $settings);

					$previous_modules = $this->model_extension_module->getModulesByCode('product_downloads');
					$previous_modules = array_remap_key_to_id('module_id', $previous_modules);

					foreach ($modules as $module) {
						if (!empty($module['module_id'])) {
							$module_id = $module['module_id'];
							unset($previous_modules[$module_id]);
							$this->model_extension_module->editModule($module_id, $module);
						} else {
							$this->model_extension_module->addModule('product_downloads', $module);

							$module_id = $this->db->getLastId();
							$module['module_id'] = $module_id;
							$this->model_extension_module->editModule($module_id, $module);
						}
					}

					// Delete any modules left over
					foreach ($previous_modules as $module_id => $module) {
						$this->model_extension_module->deleteModule($module_id);
					}

					$this->session->data['success'] = $this->language->get('text_success_update');

					$this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true));
				}
			}
		} else if ($this->request->server['REQUEST_METHOD'] == 'POST' && $ajax_request) {
			$response = array();

			if (!is_null($module_id)) {
				if ($this->validateModuleForm($this->request->post)) {
					$this->model_extension_module->editModule($module_id, $this->request->post);

					$this->alert['success']['updated'] = sprintf($this->language->get('text_success_update_module'), $this->request->post['name']);
				}
			} else {
				if ($this->validateForm($this->request->post)) {
					$original_settings = $this->model_setting_setting->getSetting('pd');

					foreach ($this->defaults as $setting => $default) {
						$value = $this->config->get($setting);
						if ($value === null) {
							$original_settings[$setting] = $default;
						}
					}

					$modules = isset($this->request->post['modules']) ? $this->request->post['modules'] : array();
					unset($this->request->post['modules']);

					$settings = array_merge($original_settings, $this->request->post);
					$settings['pd_installed_version'] = $original_settings['pd_installed_version'];

					$settings['pd_aa_file_tags'] = $this->processTags($settings['pd_aa_file_tags']);
					$settings['pd_ba_file_tags'] = $this->processTags($settings['pd_ba_file_tags']);

					$response['values']['aa_file_types'] = $settings['pd_aa_file_types'];
					$response['values']['ba_file_types'] = $settings['pd_ba_file_types'];

					$response['values']['aa_excludes'] = $settings['pd_aa_excludes'];
					$response['values']['ba_excludes'] = $settings['pd_ba_excludes'];

					if ($settings['pd_aa_file_tags'] != $this->request->post['pd_aa_file_tags']) {
						$response['values']['aa_file_tags'] = $settings['pd_aa_file_tags'];
					}

					if ($settings['pd_ba_file_tags'] != $this->request->post['pd_ba_file_tags']) {
						$response['values']['ba_file_tags'] = $settings['pd_ba_file_tags'];
					}

					$this->model_setting_setting->editSetting('pd', $settings);

					$previous_modules = $this->model_extension_module->getModulesByCode('product_downloads');
					$previous_modules = array_remap_key_to_id('module_id', $previous_modules);

					foreach ($modules as $idx => $module) {
						if (!empty($module['module_id'])) {
							$module_id = $module['module_id'];
							unset($previous_modules[$module_id]);
							$this->model_extension_module->editModule($module_id, $module);
						} else {
							$this->model_extension_module->addModule('product_downloads', $module);

							$module_id = $this->db->getLastId();

							$module['module_id'] = $module_id;
							$this->model_extension_module->editModule($module_id, $module);

							$response['values']['modules'][$idx]['module_id'] = $module_id;
						}
					}

					// Delete any modules left over
					foreach ($previous_modules as $module_id => $module) {
						$this->model_extension_module->deleteModule($module_id);
					}

					$this->alert['success']['updated'] = $this->language->get('text_success_update');

					if ((int)$original_settings['pd_status'] != (int)$this->request->post['pd_status']) {
						$response['reload'] = true;
						$this->session->data['success'] = $this->language->get('text_success_update');
					}
				} else {
					if (!$this->checkVersion()) {
						$response['reload'] = true;
					}
				}
			}

			$response = array_merge($response, array("errors" => $this->error), array("alerts" => $this->alert));

			$this->response->addHeader('Content-Type: application/json');
			$this->response->setOutput(json_enc($response, JSON_UNESCAPED_SLASHES));
			return;
		}

		$db_structure_ok = $this->checkVersion() && $this->model_extension_module_product_downloads->checkDatabaseStructure($this->alert);
		$db_errors = !($db_structure_ok && $this->model_extension_module_product_downloads->checkDatabaseConsistency($this->alert));

		$this->alert = array_merge($this->alert, $this->model_extension_module_product_downloads->getAlerts());

		$this->checkPrerequisites();

		$this->checkVersion();

		$data['heading_title'] = $this->language->get('extension_name');
		$data['text_other_extensions'] = sprintf($this->language->get('text_other_extensions'), OTHER_EXTENSIONS);

		foreach (self::$language_texts as $text) {
			$data[$text] = $this->language->get($text);
		}

		$data['icon_dir'] = realpath("../image/icons");
		$data['db_errors'] = $db_errors;

		$data['ext_name'] = EXTENSION_NAME;
		$data['ext_version'] = EXTENSION_VERSION;
		$data['ext_id'] = EXTENSION_ID;
		$data['ext_compatibility'] = EXTENSION_COMPATIBILITY;
		$data['ext_store_url'] = EXTENSION_STORE_URL;
		$data['ext_purchase_url'] = EXTENSION_PURCHASE_URL;
		$data['ext_support_email'] = EXTENSION_SUPPORT_EMAIL;
		$data['ext_support_forum'] = EXTENSION_SUPPORT_FORUM;
		$data['other_extensions_url'] = OTHER_EXTENSIONS;
		$data['oc_version'] = VERSION;

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

		if (!is_null($module_id) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$module_info = $this->model_extension_module->getModule($module_id);
			if (!$module_info) {
				$this->response->redirect($this->url->link('extension/module/product_downloads', 'token=' . $this->session->data['token'], true));
				return;
			}
		} else {
			$module_info = null;
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true),
			'active'    => false
		);

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_extension'),
			'href'      => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true),
			'active'    => false
		);

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('extension_name'),
			'href'      => $this->url->link('extension/module/product_downloads', 'token=' . $this->session->data['token'], true),
			'active'    => is_null($module_id)
		);

		if (!is_null($module_id)) {
			$module_name = (!empty($module_info['name'])) ? $module_info['name'] : ((!empty($this->request->post['name'])) ? $this->request->post['name'] : EXTENSION_NAME);
			$data['breadcrumbs'][] = array(
				'text'      => $module_name,
				'href'      => $this->url->link('extension/module/product_downloads', 'token=' . $this->session->data['token'] . '&module_id=' . $module_id, true),
				'active'    => true
			);
		}

		$data['save'] = $this->url->link('extension/module/product_downloads', 'token=' . $this->session->data['token'] . (!is_null($module_id) ? '&module_id=' . $module_id : ''), true);
		$data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true);
		$data['delete'] = $this->url->link('extension/module/delete', 'token=' . $this->session->data['token'] . (!is_null($module_id) ? '&module_id=' . $module_id : ''), true);
		$data['upgrade'] = $this->url->link('extension/module/product_downloads/upgrade', 'token=' . $this->session->data['token'], true);
		$data['fix_db'] = $this->url->link('extension/module/product_downloads/fix_db', 'token=' . $this->session->data['token'], true);
		$data['general_settings'] = $this->url->link('extension/module/product_downloads', 'token=' . $this->session->data['token'], true);
		$data['autocomplete'] = html_entity_decode($this->url->link('extension/module/product_downloads/autocomplete', 'type=%TYPE%&query=%QUERY&token=' . $this->session->data['token'], true));
		$data['get_tags_url'] = html_entity_decode($this->url->link('extension/module/product_downloads/get_tags', 'token=' . $this->session->data['token'], true));
		$data['set_tags_url'] = html_entity_decode($this->url->link('extension/module/product_downloads/set_tags', 'token=' . $this->session->data['token'], true));
		$data['statistics'] = html_entity_decode($this->url->link('extension/module/product_downloads/statistics', 'token=' . $this->session->data['token'], true));
		$data['filter'] = html_entity_decode($this->url->link('extension/module/product_downloads/autocomplete', '',true));
		$data['extension_installer'] = $this->url->link('extension/installer', 'token=' . $this->session->data['token'], true);
		$data['services'] = html_entity_decode($this->url->link('extension/module/product_downloads/services', 'token=' . $this->session->data['token'], true));

		$data['update_pending'] = !$this->checkVersion();

		if (!$data['update_pending']) {
			$this->updateEventHooks();
		} else if (!is_null($module_id)) {
			$this->response->redirect($this->url->link('extension/module/product_downloads', 'token=' . $this->session->data['token'], true));
			return;
		}

		$data['ssl'] = (
				(int)$this->config->get('config_secure') ||
				!empty($_SERVER['HTTPS']) && (strtolower($_SERVER['HTTPS']) == 'on' || $_SERVER['HTTPS'] == '1') ||
				!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' ||
				!empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on'
			) ? 's' : '';

		$this->load->model('localisation/language');
		$languages = $this->model_localisation_language->getLanguages();
		foreach ($languages as $key => $value) {
			unset($languages[$key]['image']);
		}
		$data['languages'] = array_remap_key_to_id('language_id', $languages);
		$data['default_language'] = $this->config->get('config_language_id');

		$data['seo_url'] = $this->config->get('config_seo_url');

		$this->load->model('customer/customer_group');
		$customer_groups = $this->model_customer_customer_group->getCustomerGroups();
		$data['customer_groups'] = array_remap_key_to_id('customer_group_id', $customer_groups);

		$this->load->model('catalog/download_tag');
		$total_tags = $this->model_catalog_download_tag->getTotalDownloadTags();
		$data['tags'] = array();

		$update_pending = !$this->validate();

		if ($total_tags < TA_PREFETCH && !$update_pending) {
			$tags = $this->model_catalog_download_tag->getDownloadTags();
			foreach ($tags as $tag) {
				$data['tags'][] = array("id" => $tag["name"], "text" => $tag["name"]);
			}
			$data['tags'] = json_encode($data['tags']);
		}

		$this->load->model('catalog/download_ext');
		$total_downloads = $this->model_catalog_download_ext->getTotalDownloads();
		$data['downloads'] = array();

		if ($total_downloads < TA_PREFETCH && !$update_pending) {
			$downloads = $this->model_catalog_download_ext->getDownloads();
			foreach ($downloads as $download) {
				$data['downloads'][] = array("id" => $download["download_id"], "text" => html_entity_decode($download["name"]), ENT_QUOTES, 'UTF-8');
			}
			$data['downloads'] = json_encode($data['downloads']);
		}

		// Get icon listing
		$icons = array();
		if ($handler = opendir("../image/icons")) {
			while (($sub = readdir($handler)) !== FALSE) {
				if ($sub != "." && $sub != ".." && is_file("../image/icons/" . $sub)) {
					$info = pathinfo($sub);
					if(mb_strtolower($info["extension"]) == "png") {
						$icons[] = array("type" => $info["filename"], "src" => "../image/icons/" . $sub);
					}
				}
			}
			closedir($handler);
		}
		$data['icons'] = $icons;
		$data['fa_icons'] = get_fa_icons();

		$data['installed_version'] = $this->installedVersion();

		if (is_null($module_id)) {
			# Loop through all settings for the post/config values
			foreach (array_keys($this->defaults) as $setting) {
				if (isset($this->request->post[$setting])) {
					$data[$setting] = $this->request->post[$setting];
				} else {
					$data[$setting] = $this->config->get($setting);
					if ($data[$setting] === null) {
						if (!isset($this->alert['warning']['unsaved']) && $this->checkVersion())  {
							$this->alert['warning']['unsaved'] = $this->language->get('error_unsaved_settings');
						}
						if (isset($this->defaults[$setting])) {
							$data[$setting] = $this->defaults[$setting];
						}
					}
				}
			}
			if (isset($this->request->post['modules'])) {
				$data['modules'] = $this->request->post['modules'];
			} else {
				$modules = $this->model_extension_module->getModulesByCode('product_downloads');

				foreach ($modules as $idx => $module) {
					$module_settings = json_decode($module['setting'], true);
					unset($module['setting']);
					$module = array_merge($module, $module_settings);

					foreach (array_keys($this->module_defaults) as $setting) {
						if (!isset($module[$setting])) {
							$module[$setting] = $this->module_defaults[$setting];

							if (!isset($this->alert['warning']['unsaved']) && $this->checkVersion())  {
								$this->alert['warning']['unsaved'] = $this->language->get('error_unsaved_settings');
							}
						}
						$modules[$idx] = $module;
					}
				}

				$data['modules'] = $modules;
			}

			foreach (array_keys($this->module_defaults) as $setting) {
				$data["pd_m_$setting"] = $this->module_defaults[$setting];
			}

			$this->load->model('setting/store');

			$stores = $this->model_setting_store->getStores();

			$data['stores'] = array();

			$data['stores'][0] = array(
				'name' => $this->config->get('config_name'),
				'url'  => HTTP_CATALOG
			);

			foreach ($stores as $store) {
				$data['stores'][$store['store_id']] = array(
					'name' => $store['name'],
					'url'  => $store['url']
				);
			}

			$this->load->model('extension/extension');
			$installed_dashboards = $this->model_extension_extension->getInstalled('dashboard');
			if (in_array('downloads', $installed_dashboards)) {
				$data['dashboard_widget'] = array(
					'class'=> 'btn-default btn-nav-link',
					'icon' => 'fa-cog',
					'name' => $this->language->get('button_configure'),
					'loading' => $this->language->get('text_opening'),
					'link' => $this->url->link('extension/dashboard/downloads', 'token=' . $this->session->data['token'], true)
				);
			} else {
				$data['dashboard_widget'] = array(
					'class'=> 'btn-success btn-install',
					'icon' => 'fa-magic',
					'name' => $this->language->get('button_install'),
					'loading' => $this->language->get('text_installing'),
					'link' => $this->url->link('extension/module/product_downloads/install_dashboard', 'token=' . $this->session->data['token'], true)
				);
			}
		} else {
			foreach (array_keys($this->module_defaults) as $setting) {
				if (isset($this->request->post[$setting])) {
					$data[$setting] = $this->request->post[$setting];
				} else if (isset($module_info[$setting])) {
					$data[$setting] = $module_info[$setting];
				} else {
					$data[$setting] = $this->module_defaults[$setting];
					if (!isset($this->alert['warning']['unsaved']) && $this->checkVersion())  {
						$this->alert['warning']['unsaved'] = $this->language->get('error_unsaved_settings');
					}
				}
			}
			$data['module_id'] = $module_id;

			if (isset($this->request->post['downloads'])) {
				$data['m_downloads'] = $this->request->post['downloads'];
			} else if (isset($module_info['downloads'])) {
				$data['m_downloads'] = $module_info['downloads'];
			} else {
				$data['m_downloads'] = "";
			}

			$modules = $this->model_extension_module->getModulesByCode('product_downloads');

			$tab_position_used = 0;

			foreach ($modules as $idx => $module) {
				$module_settings = json_decode($module['setting'], true);
				if ((int)$module_settings['show_in_tab'] && $module_id != $module['module_id']) {
					$tab_position_used = 1;
					break;
				}
			}
			$data['tab_position_used'] = $tab_position_used;
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

		if (is_null($module_id)) {
			$template = 'extension/module/product_downloads';
		} else {
			$template = 'extension/module/product_downloads_module';
		}

		$this->response->setOutput($this->load->view($template, $data));
	}

	public function install_dashboard() {
		$ajax_request = isset($this->request->server['HTTP_X_REQUESTED_WITH']) && !empty($this->request->server['HTTP_X_REQUESTED_WITH']) && strtolower($this->request->server['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';

		$response = array();

		if ($this->validateDashboardInstall()) {
			$this->load->model('extension/extension');

			$this->model_extension_extension->install('dashboard', 'downloads');

			$this->load->model('user/user_group');

			$this->model_user_user_group->addPermission($this->user->getGroupId(), 'access', 'extension/dashboard/downloads');
			$this->model_user_user_group->addPermission($this->user->getGroupId(), 'modify', 'extension/dashboard/downloads');

			// Call install method if it exsits
			$this->load->controller('extension/dashboard/downloads/install');

			$this->alert['success']['fix_db'] = $this->language->get('text_success_install_dashboard');
			//$response['success'] = true;
			$response['url'] = html_entity_decode($this->url->link('extension/module/product_downloads', 'token=' . $this->session->data['token'], true));
		}

		$response = array_merge($response, array("errors" => $this->error), array("alerts" => $this->alert));

		if (!$ajax_request) {
			$this->session->data['errors'] = $this->error;
			$this->session->data['alerts'] = $this->alert;
			$this->response->redirect($this->url->link('extension/module/product_downloads', 'token=' . $this->session->data['token'], true));
		} else {
			$this->response->addHeader('Content-Type: application/json');
			$this->response->setOutput(json_enc($response, JSON_UNESCAPED_SLASHES));
		}
	}

	public function install() {
		$this->registerEventHooks();

		$this->model_extension_module_product_downloads->applyDatabaseChanges();

		// Add Downloads layout
		$this->load->model('design/layout');
		$this->load->model('setting/store');

		$stores = $this->model_setting_store->getStores();

		$layout_data = array();
		$layout_data["name"] = $this->language->get("text_downloads_layout");
		$layout_data["layout_route"] = array(0 => array(
			"store_id"  => 0,
			"route"     => "download/download"
		));

		foreach ($stores as $store) {
			$layout_data["layout_route"][] = array(
				"store_id"  => $store["store_id"],
				"route"     => "download/download"
			);
		}

		$this->model_design_layout->addLayout($layout_data);

		$this->load->model('setting/setting');

		$this->model_setting_setting->editSetting('pd', $this->defaults);
	}

	public function uninstall() {
		$this->removeEventHooks();

		if ($this->config->get("pd_remove_sql_changes")) {
			$this->model_extension_module_product_downloads->revertDatabaseChanges();
		}

		// Remove Downloads layout
		$query = $this->db->query("SELECT layout_id FROM " . DB_PREFIX . "layout_route WHERE route = 'download/download' LIMIT 1");
		if ($query->num_rows) {
			$this->load->model('design/layout');
			$this->model_design_layout->deleteLayout($query->row['layout_id']);
		}

		$this->load->model('setting/setting');
		$this->model_setting_setting->deleteSetting('pd');

		$this->load->model('extension/module');
		$this->model_extension_module->deleteModulesByCode('product_downloads');
	}

	public function upgrade() {
		$ajax_request = isset($this->request->server['HTTP_X_REQUESTED_WITH']) && !empty($this->request->server['HTTP_X_REQUESTED_WITH']) && strtolower($this->request->server['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';

		$response = array();

		if ($this->request->server['REQUEST_METHOD'] == 'POST' && $this->validateUpgrade()) {
			$this->load->model('setting/setting');

			if ($this->model_extension_module_product_downloads->upgradeDatabaseStructure($this->installedVersion(), $this->alert)) {
				$settings = array();

				// Go over all settings, add new values and remove old ones
				foreach ($this->defaults as $setting => $default) {
					$value = $this->config->get($setting);
					if ($value === null) {
						$settings[$setting] = $default;
					} else {
						$settings[$setting] = $value;
					}
				}

				// Add Downloads layout if needed
				$query = $this->db->query("SELECT layout_id FROM " . DB_PREFIX . "layout_route WHERE route = 'download/download' LIMIT 1");
				if (!$query->num_rows) {
					$this->load->model('design/layout');
					$this->load->model('setting/store');

					$stores = $this->model_setting_store->getStores();

					$layout_data = array();
					$layout_data["name"] = $this->language->get("text_downloads_layout");
					$layout_data["layout_route"] = array(0 => array(
						"store_id"  => 0,
						"route"     => "download/download"
					));

					foreach ($stores as $store) {
						$layout_data["layout_route"][] = array(
							"store_id"  => $store["store_id"],
							"route"     => "download/download"
						);
					}

					$this->model_design_layout->addLayout($layout_data);
				}

				$settings['pd_installed_version'] = EXTENSION_VERSION;

				$this->model_setting_setting->editSetting('pd', $settings);

				$this->session->data['success'] = sprintf($this->language->get('text_success_upgrade'), EXTENSION_VERSION);
				$this->alert['success']['upgrade'] = sprintf($this->language->get('text_success_upgrade'), EXTENSION_VERSION);

				$response['success'] = true;
				$response['reload'] = true;
			} else {
				$this->alert = array_merge($this->alert, $this->model_extension_module_product_downloads->getAlerts());
				$this->alert['error']['database_upgrade'] = $this->language->get('error_upgrade_database');
			}
		}

		$response = array_merge($response, array("errors" => $this->error), array("alerts" => $this->alert));

		if (!$ajax_request) {
			$this->session->data['errors'] = $this->error;
			$this->session->data['alerts'] = $this->alert;
			$this->response->redirect($this->url->link('extension/module/product_downloads', 'token=' . $this->session->data['token'], true));
		} else {
			$this->response->addHeader('Content-Type: application/json');
			$this->response->setOutput(json_enc($response, JSON_UNESCAPED_SLASHES));
			return;
		}
	}

	public function services() {
		$services = base64_decode($this->config->get('pd_services'));
		$response = json_decode($services, true);
		$force = isset($this->request->get['force']) && (int)$this->request->get['force'];

		if ($response && isset($response['expires']) && $response['expires'] >= strtotime("now") && !$force) {
			$response['cached'] = true;
		} else {
			$url = "http://www.opencart.ee/services/?eid=" . EXTENSION_ID . "&info=true&general=true";
			$hostname = (!empty($_SERVER['HTTP_HOST'])) ? $_SERVER['HTTP_HOST'] : '' ;

			if (function_exists('curl_init')) {
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
				curl_setopt($ch, CURLOPT_HEADER, false);
				curl_setopt($ch, CURLOPT_MAXREDIRS, 3);
				curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
				curl_setopt($ch, CURLOPT_TIMEOUT, 60);
				curl_setopt($ch, CURLOPT_USERAGENT, base64_encode("curl " . EXTENSION_ID));
				curl_setopt($ch, CURLOPT_REFERER, $hostname);
				$json = curl_exec($ch);
			} else {
				$json = false;
			}

			if ($json !== false) {
				$this->load->model('setting/setting');
				$settings = $this->model_setting_setting->getSetting('pd');
				$settings['pd_services'] = base64_encode($json);
				$this->model_setting_setting->editSetting('pd', $settings);
				$response = json_decode($json, true);
			} else {
				$response = array();
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_enc($response, JSON_UNESCAPED_SLASHES));
	}

	public function order_delete_hook($route='', $data=null, $output=null) {
		if (is_array($data) && !empty($data[0])) {
			$order_id = (int)$data[0];
		} else {
			$order_id = (int)$data;
		}

		if ($order_id) {
			$this->model_extension_module_product_downloads->deleteOrderDownloads($order_id);
		} else {
			$this->response->redirect($this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true));
		}
	}

	private function registerEventHooks() {
		$this->load->model('extension/event');

		$event_hooks = array(
			'pd.order.add'          => array('trigger' => 'catalog/model/checkout/order/addOrder/after',        'action' => 'checkout/download/order_add_hook'),
			'pd.order.edit'         => array('trigger' => 'catalog/model/checkout/order/editOrder/after',       'action' => 'checkout/download/order_edit_hook'),
			'pd.admin.order.delete' => array('trigger' => 'admin/model/sale/order/deleteOrder/before',          'action' => 'extension/module/product_downloads/order_delete_hook'),
		);

		foreach ($event_hooks as $code => $hook) {
			$this->model_extension_event->addEvent($code, $hook['trigger'], $hook['action']);
		}
	}

	private function removeEventHooks() {
		$this->load->model('extension/event');
		$this->model_extension_event->deleteEvent('pd.order.add');
		$this->model_extension_event->deleteEvent('pd.order.edit');
		$this->model_extension_event->deleteEvent('pd.admin.order.delete');
	}

	private function updateEventHooks() {
		$this->load->model('extension/event');

		$event_hooks = array(
			'pd.order.add'          => array('trigger' => 'catalog/model/checkout/order/addOrder/after',        'action' => 'checkout/download/order_add_hook'),
			'pd.order.edit'         => array('trigger' => 'catalog/model/checkout/order/editOrder/after',       'action' => 'checkout/download/order_edit_hook'),
			'pd.admin.order.delete' => array('trigger' => 'admin/model/sale/order/deleteOrder/before',          'action' => 'extension/module/product_downloads/order_delete_hook'),
		);

		foreach ($event_hooks as $code => $hook) {
			$event = $this->model_extension_event->getEvent($code, $hook['trigger'], $hook['action']);

			if (!$event) {
				$this->model_extension_event->addEvent($code, $hook['trigger'], $hook['action']);

				if (empty($this->alert['success']['hooks_updated'])) {
					$this->alert['success']['hooks_updated'] = $this->language->get('text_success_hooks_update');
				}
			}
		}

		// Delete old triggers
		$query = $this->db->query("SELECT `code` FROM " . DB_PREFIX . "event WHERE `code` LIKE 'pd.%'");
		$events = array_keys($event_hooks);

		foreach ($query->rows as $row) {
			if (!in_array($row['code'], $events)) {
				$this->model_extension_event->deleteEvent($row['code']);

				if (empty($this->alert['success']['hooks_updated'])) {
					$this->alert['success']['hooks_updated'] = $this->language->get('text_success_hooks_update');
				}
			}
		}
	}

	public function autocomplete() {
		if ($this->request->server['REQUEST_METHOD'] == 'GET' && isset($this->request->get['type'])) {
			$response = array();
			switch ($this->request->get['type']) {
				case 'tag':
					$create = isset($this->request->get['create']);
					$query = $this->request->get['query'];
					$exact_match = false;

					$this->load->model('catalog/download_tag');

					$results = array();

					if (isset($this->request->get['query'])) {
						$filter_data = array(
							'filter'   			=> array('name' => $this->request->get['query']),
							'sort'          => 'dtd.name',
							'start'         => 0,
							'limit'         => 20,
						);

						$results = $this->model_catalog_download_tag->getDownloadTags($filter_data);
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
					$query = $this->request->get['query'];
					$this->load->model('catalog/download_ext');

					$results = array();

					if (isset($this->request->get['query'])) {
						if (is_array($this->request->get['query']) && isset($this->request->get['multiple'])) {
							$results = array();

							foreach ((array)$this->request->get['query'] as $value) {
								$result =  $this->model_catalog_download_ext->getDownload($value);
								if ($result) {
									$results[] = $result;
								}
							}
						} else {
							$filter_data = array(
								'filter'        => array('name' => $this->request->get['query']),
								'sort'          => 'dd.name',
								'start'         => 0,
								'limit'         => 20,
							);

							$results = $this->model_catalog_download_ext->getDownloads($filter_data);
						}
					}

					foreach ($results as $result) {
						$result['name'] = html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8');
						$response[] = array(
							'value'     => $result['name'],
							'tokens'    => explode(' ', $result['name']),
							'id'        => $result['download_id'],
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

	public function statistics() {
		$response = array();

		$ajax_request = isset($this->request->server['HTTP_X_REQUESTED_WITH']) && !empty($this->request->server['HTTP_X_REQUESTED_WITH']) && strtolower($this->request->server['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';

		if (!$ajax_request) {
			$this->response->redirect($this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true));
			return;
		}

		if ($this->request->server['REQUEST_METHOD'] == 'GET' && isset($this->request->get['type']) && in_array($this->request->get['type'], array('daily', 'weekly', 'monthly', 'yearly', 'today_top', 'yesterday_top', 'week_top', 'month_top', 'year_top', 'most_downloaded'))) {
			$this->load->model('extension/module/product_downloads');

			$type = $this->request->get['type'];

			$response['categories'] = array();
			$response['series'] = array();
			$response['temporal'] = false;
			$response['title'] = $this->language->get("text_{$type}_downloads");

			$stats = $this->model_extension_module_product_downloads->getDownloadStats($type);
			$last_date = null;

			foreach ($stats as $key => $value) {
				switch ($type) {
					case 'daily':
						$response['temporal'] = true;
						$date = new DateTime();
						$date->setDate($value['year'], $value['month'], $value['day']);
						// if ($value['month'] == 1 && $value['day'] == 1) {
						//     $response['categories'][] = $date->format("M d, Y");
						// } else if ($value['day'] == 1 || !$key) {
						//     $response['categories'][] = $date->format("M d");
						// } else {
						//     $response['categories'][] = $date->format("d");
						// }
						if ($last_date) {
							$interval = new DateInterval('P1D'); // 1 day interval
							$begin = $last_date;
							$begin->modify('+1 day');
							$end = $date;
							$daterange = new DatePeriod($begin, $interval ,$end);

							foreach($daterange as $d) {
								$response['series'][] = array("date" => $d->format("Y-m-d"), "count" => "0");
							}
						}
						$response['series'][] = array("date" => $date->format("Y-m-d"), "count" => $value['count']);
						$last_date = $date;
						break;
					case 'weekly':
						$response['temporal'] = true;
						$week = (int)$value['week'];
						$date1 = new DateTime();
						//$date2 = new DateTime();
						$date1->setISODate($value['year'], $week, 1);
						// $start = $date1->format("M d");
						// $date2->setISODate((int)$value['year'], $week, 7);
						// if ($week == 1) {
						//     $end = $date2->format("M d, Y");
						// } else {
						//     $end = $date2->format("M d");
						// }
						// $response['categories'][] = "W$week: $start - $end";
						if ($last_date) {
							$interval = new DateInterval('P1W'); // 7 days interval
							$begin = $last_date;
							$begin->modify('+1 week');
							$end = $date1;
							$daterange = new DatePeriod($begin, $interval ,$end);

							foreach($daterange as $d) {
								$response['series'][] = array("date" => $d->format("Y-m-d"), "count" => "0");
							}
						}
						$response['series'][] = array("date" => $date1->format("Y-m-d"), "count" => $value['count']);
						$last_date = $date1;
						break;
					case 'monthly':
						$response['temporal'] = true;
						$date = new DateTime();
						$date->setDate($value['year'], $value['month'], 1);
						// if ($value['month'] == 1 || !$key) {
						//     $response['categories'][] = $date->format("Y M");
						// } else {
						//     $response['categories'][] = $date->format("M");
						// }
						if ($last_date) {
							$interval = new DateInterval('P1M'); // 1 month interval
							$begin = $last_date;
							$begin->modify('+1 month');
							$end = $date;
							$daterange = new DatePeriod($begin, $interval ,$end);

							foreach($daterange as $d) {
								$response['series'][] = array("date" => $d->format("Y-m-d"), "count" => "0");
							}
						}
						$response['series'][] = array("date" => $date->format("Y-m-d"), "count" => $value['count']);
						$last_date = $date;
						break;
					case 'yearly':
						$response['temporal'] = true;
						$date = new DateTime();
						$date->setDate($value['year'], 1, 1);
						if ($last_date) {
							$interval = new DateInterval('P1Y'); // 1 year interval
							$begin = $last_date;
							$begin->modify('+1 year');
							$end = $date;
							$daterange = new DatePeriod($begin, $interval ,$end);

							foreach($daterange as $d) {
								$response['series'][] = array("date" => $d->format("Y-m-d"), "count" => "0");
							}
						}
						// $response['categories'][] = $value['year'];
						$response['series'][] = array("date" => $date->format("Y-m-d"), "count" => $value['count']);
						$last_date = $date;
						break;
					case 'today_top':
					case 'yesterday_top':
					case 'week_top':
					case 'month_top':
					case 'year_top':
					case 'most_downloaded':
						$response['categories'][] = html_entity_decode($value['name'], ENT_QUOTES, 'UTF-8');
						$response['series'][] = $value['count'];
						break;
					default:
						break;
				}
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_enc($response, JSON_UNESCAPED_SLASHES));
	}

	public function fix_db() {
		$ajax_request = isset($this->request->server['HTTP_X_REQUESTED_WITH']) && !empty($this->request->server['HTTP_X_REQUESTED_WITH']) && strtolower($this->request->server['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';

		$response = array();

		if ($this->request->server['REQUEST_METHOD'] == 'POST' && $this->validateFix()) {
			$this->model_extension_module_product_downloads->applyDatabaseChanges();
			if ($this->model_extension_module_product_downloads->fixDatabaseConsistency($this->alert)) {
				$this->alert['success']['fix_db'] = $this->language->get('text_success_fix_db');
				$response['success'] = true;
			} else {
				$this->alert = array_merge($this->alert, $this->model_extension_module_product_downloads->getAlerts());
			}
		}

		$response = array_merge($response, array("errors" => $this->error), array("alerts" => $this->alert));

		if (!$ajax_request) {
			$this->session->data['errors'] = $this->error;
			$this->session->data['alerts'] = $this->alert;
			$this->response->redirect($this->url->link('extension/module/product_downloads', 'token=' . $this->session->data['token'], true));
		} else {
			$this->response->addHeader('Content-Type: application/json');
			$this->response->setOutput(json_enc($response, JSON_UNESCAPED_SLASHES));
		}
	}

	private function checkPrerequisites() {
		$errors = false;

		if (version_compare(phpversion(), EXTENSION_MIN_PHP_VERSION) < 0) {
			$errors = true;
			$this->alert['error']['php'] = sprintf($this->language->get('error_php_version'), phpversion(), EXTENSION_MIN_PHP_VERSION);
		}

		return !$errors;
	}

	private function checkVersion() {
		$errors = false;

		$installed_version = $this->installedVersion();

		if ($installed_version != EXTENSION_VERSION) {
			$errors = true;
			$this->alert['info']['version'] = sprintf($this->language->get('error_version'), EXTENSION_VERSION);
		}

		return !$errors;
	}

	private function validateFix() {
		$errors = false;

		if (!$this->user->hasPermission('modify', 'extension/module/product_downloads')) {
			$errors = true;
			$this->alert['error']['permission'] = $this->language->get('error_permission');
		}

		if (!$errors) {
			return $this->checkVersion() && $this->checkPrerequisites();
		} else {
			return false;
		}
	}

	private function validateDashboardInstall() {
		$errors = false;

		if (!$this->user->hasPermission('modify', 'extension/extension/dashboard')) {
			$errors = true;
			$this->alert['error']['permission'] = $this->language->get('error_dashboard_permission');
		}

		if (!$errors) {
			return true;
		} else {
			return false;
		}
	}

	private function validate() {
		$errors = false;

		if (!$this->user->hasPermission('modify', 'extension/module/product_downloads')) {
			$errors = true;
			$this->alert['error']['permission'] = $this->language->get('error_permission');
		}

		if (!$errors) {
			$result = $this->checkVersion() && $this->model_extension_module_product_downloads->checkDatabaseStructure($this->alert) && $this->checkPrerequisites();
			$this->alert = array_merge($this->alert, $this->model_extension_module_product_downloads->getAlerts());
			return $result;
		} else {
			return false;
		}
	}

	private function validateUpgrade() {
		$errors = false;

		if (!$this->user->hasPermission('modify', 'extension/module/product_downloads')) {
			$errors = true;
			$this->alert['error']['permission'] = $this->language->get('error_permission');
		}

		return !$errors;
	}

	private function validateForm(&$data) {
		$errors = false;

		$data["pd_aa_file_types"] = isset($data["pd_aa_file_types"]) ? format_file_types($data["pd_aa_file_types"]) : "";
		$data["pd_ba_file_types"] = isset($data["pd_ba_file_types"]) ? format_file_types($data["pd_ba_file_types"]) : "";

		if (!(int)$data["pd_aa_all_types"] && !$data["pd_aa_file_types"]) {
			$errors = true;
			$this->error['aa_file_types'] = $this->language->get('error_filetype');
		}

		if (!(int)$data["pd_ba_all_types"] && !$data["pd_ba_file_types"]) {
			$errors = true;
			$this->error['ba_file_types'] = $this->language->get('error_filetype');
		}

		$data["pd_aa_excludes"] = isset($data["pd_aa_excludes"]) ? format_excludes($data["pd_aa_excludes"]) : "";
		$data["pd_ba_excludes"] = isset($data["pd_ba_excludes"]) ? format_excludes($data["pd_ba_excludes"]) : "";

		if (!isset($data['pd_customer_groups']) || !is_array($data['pd_customer_groups'])) {
			$data['pd_customer_groups'] = array();
		}

		if (isset($data['modules'])) {
			foreach ((array)$data['modules'] as $idx => $module) {
				if (isset($module['names'])) {
					foreach ((array)$module['names'] as $language_id => $value) {
						if (!utf8_strlen($value)) {
							$errors = true;
							$this->error['modules'][$idx]['names'][$language_id]['name'] = $this->language->get('error_module_name');
						}
					}
				} else {
					$errors = true;
				}

				if ((int)$module['downloads_per_page'] < 0 || (string)((int)$module['downloads_per_page']) != $module['downloads_per_page']) {
					$errors = true;
					$this->error['modules'][$idx]['downloads_per_page'] = $this->language->get('error_positive_integer');
				}
			}
		}

		if ((int)$data['pd_aa_duration'] < 0 || (string)((int)$data['pd_aa_duration']) != $data['pd_aa_duration']) {
			$errors = true;
			$this->error['aa_duration'] = $this->language->get('error_positive_integer');
		}

		if ((int)$data['pd_aa_total_downloads'] < -1 || (string)((int)$data['pd_aa_total_downloads']) != $data['pd_aa_total_downloads']) {
			$errors = true;
			$this->error['aa_total_downloads'] = $this->language->get('error_integer');
		}

		if ((int)$data['pd_ba_duration'] < 0 || (string)((int)$data['pd_ba_duration']) != $data['pd_ba_duration']) {
			$errors = true;
			$this->error['ba_duration'] = $this->language->get('error_positive_integer');
		}

		if ((int)$data['pd_ba_total_downloads'] < -1 || (string)((int)$data['pd_ba_total_downloads']) != $data['pd_ba_total_downloads']) {
			$errors = true;
			$this->error['ba_total_downloads'] = $this->language->get('error_integer');
		}

		if (!file_exists($data['pd_aa_directory']) || !is_dir($data['pd_aa_directory']) ) {
			$errors = true;
			$this->error['aa_directory'] = $this->language->get('error_directory');
		}

		if (!file_exists($data['pd_ba_directory']) || !is_dir($data['pd_ba_directory']) ) {
			$errors = true;
			$this->error['ba_directory'] = $this->language->get('error_directory');
		}

		if (!isset($data["pd_aa_file_tags"])) {
			$data["pd_aa_file_tags"] = "";
		}

		if ($data["pd_aa_file_tags"]) {
			$tags = array_map("trim", explode(",", $data["pd_aa_file_tags"]));
			foreach ($tags as $tag) {
				if (utf8_strlen($tag) < 2 || utf8_strlen($tag) > 64) {
					$errors = true;
					$this->error['aa_file_tags'] = $this->language->get('error_tag_name');
					break;
				}
			}
		}

		if (!isset($data["pd_ba_file_tags"])) {
			$data["pd_ba_file_tags"] = "";
		}

		if ($data["pd_ba_file_tags"]) {
			$tags = array_map("trim", explode(",", $data["pd_ba_file_tags"]));
			foreach ($tags as $tag) {
				if (utf8_strlen($tag) < 2 || utf8_strlen($tag) > 64) {
					$errors = true;
					$this->error['ba_file_tags'] = $this->language->get('error_tag_name');
					break;
				}
			}
		}


		if ($this->config->get('config_seo_url') && utf8_strlen(trim($data['pd_ds_seo_keyword'])) == 0) {
			$errors = true;
			$this->error['ds_seo_keyword'] = $this->language->get('error_seo_keyword');
		}

		if ($data['pd_dp_status']) {
			if ($this->config->get('config_seo_url') && utf8_strlen(trim($data['pd_dp_seo_keyword'])) == 0) {
				$errors = true;
				$this->error['dp_seo_keyword'] = $this->language->get('error_seo_keyword');
			}

			if ((int)$data['pd_dp_downloads_per_page'] < 0 || (string)((int)$data['pd_dp_downloads_per_page']) != $data['pd_dp_downloads_per_page']) {
				$errors = true;
				$this->error['dp_downloads_per_page'] = $this->language->get('error_positive_integer');
			}
		}

		if ($errors) {
			$this->alert['warning']['warning'] = $this->language->get('error_warning');
		}

		if (!$errors) {
			return $this->validate();
		} else {
			return false;
		}
	}

	private function validateModuleForm(&$data) {
		$errors = false;

		if (isset($data['names'])) {
			foreach ((array)$data['names'] as $language_id => $value) {
				if (!utf8_strlen($value)) {
					$errors = true;
					$this->error['names'][$language_id]['name'] = $this->language->get('error_module_name');
				}
			}
		} else {
			$errors = true;
		}

		if ((int)$data['downloads_per_page'] < 0 || (string)((int)$data['downloads_per_page']) != $data['downloads_per_page']) {
			$errors = true;
			$this->error['downloads_per_page'] = $this->language->get('error_positive_integer');
		}

		if ($errors) {
			$this->alert['warning']['warning'] = $this->language->get('error_warning');
		}

		if (!$errors) {
			return $this->validate();
		} else {
			return false;
		}
	}

	private function processTags($tags) {
		$this->load->model('localisation/language');
		$this->load->model('catalog/download_tag');

		$languages = $this->model_localisation_language->getLanguages();

		$tags = array_map("trim", explode(",", $tags));
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
						"sort_order" => 0,
						"administrative" => 0,
						"descriptions" => $descriptions
					);

					$this->model_catalog_download_tag->addDownloadTag($tag_data);

					if (!in_array($tag, $processed_tags)) {
						$processed_tags[] = $tag;
					}
				} else {
					if (!in_array($_tag["name"], $processed_tags)) {
						$processed_tags[] = $_tag["name"];
					}
				}
			}
		}

		return implode(",", $processed_tags);
	}

	private function installedVersion() {
		$installed_version = $this->config->get('pd_installed_version');
		return $installed_version ? $installed_version : '3.7.5';
	}
}
