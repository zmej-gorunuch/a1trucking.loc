<?php

class ControllerExtensionModulePartnership extends Controller {
	
	private $error = [];
	
	public function index() {
		$this->load->language( 'extension/module/partnership' );
		
		$this->document->setTitle( $this->language->get( 'heading_title' ) );
		
		$this->load->model( 'extension/module/partnership' );
		
		$this->getList();
	}
	
	protected function getList() {
		if ( isset( $this->request->get['filter_status'] ) ) {
			$filter_status = $this->request->get['filter_status'];
		} else {
			$filter_status = null;
		}
		
		if ( isset( $this->request->get['sort'] ) ) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'p.create';
		}
		
		if ( isset( $this->request->get['order'] ) ) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}
		
		if ( isset( $this->request->get['page'] ) ) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
		
		$url = '';
		
		if ( isset( $this->request->get['filter_status'] ) ) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}
		
		if ( isset( $this->request->get['sort'] ) ) {
			$url .= '&sort=' . $this->request->get['sort'];
		}
		
		if ( isset( $this->request->get['order'] ) ) {
			$url .= '&order=' . $this->request->get['order'];
		}
		
		if ( isset( $this->request->get['page'] ) ) {
			$url .= '&page=' . $this->request->get['page'];
		}
		
		$data['breadcrumbs'] = [];
		
		$data['breadcrumbs'][] = [
			'text' => $this->language->get( 'text_home' ),
			'href' => $this->url->link( 'common/dashboard', 'token=' . $this->session->data['token'], true ),
		];
		
		$data['breadcrumbs'][] = [
			'text' => $this->language->get( 'heading_title' ),
			'href' => $this->url->link( 'extension/module/partnership', 'token=' . $this->session->data['token'] . $url, true ),
		];
		
		$data['add']    = $this->url->link( 'extension/module/partnership/add', 'token=' . $this->session->data['token'] . $url, true );
		$data['delete'] = $this->url->link( 'extension/module/partnership/delete', 'token=' . $this->session->data['token'] . $url, true );
		
		$data['partnerships'] = [];
		
		$filter_data = [
			'filter_status' => $filter_status,
			'sort'          => $sort,
			'order'         => $order,
			'start'         => ( $page - 1 ) * $this->config->get( 'config_limit_admin' ),
			'limit'         => $this->config->get( 'config_limit_admin' ),
		];
		
		$partnerships_total = $this->model_extension_module_partnership->getTotalPartnerships( $filter_data );
		
		$results = $this->model_extension_module_partnership->getPartnerships( $filter_data );
		
		foreach ( $results as $result ) {
			$data['partnerships'][] = [
				'id'     => $result['id'],
				'name'   => $result['name'],
				'status' => ( $result['status'] ) ? $this->language->get( 'text_enabled' ) : $this->language->get( 'text_disabled' ),
				'edit'   => $this->url->link( 'extension/module/partnership/edit', 'token=' . $this->session->data['token'] . '&partnership_id=' . $result['id'] . $url, true ),
			];
		}
		
		$data['heading_title'] = $this->language->get( 'heading_title' );
		
		$data['text_list']       = $this->language->get( 'text_list' );
		$data['text_enabled']    = $this->language->get( 'text_enabled' );
		$data['text_disabled']   = $this->language->get( 'text_disabled' );
		$data['text_no_results'] = $this->language->get( 'text_no_results' );
		$data['text_confirm']    = $this->language->get( 'text_confirm' );
		
		$data['column_title']  = $this->language->get( 'column_title' );
		$data['column_status'] = $this->language->get( 'column_status' );
		$data['column_action'] = $this->language->get( 'column_action' );
		
		$data['entry_name']     = $this->language->get( 'entry_name' );
		$data['entry_quantity'] = $this->language->get( 'entry_quantity' );
		$data['entry_status']   = $this->language->get( 'entry_status' );
		
		$data['button_add']    = $this->language->get( 'button_add' );
		$data['button_edit']   = $this->language->get( 'button_edit' );
		$data['button_delete'] = $this->language->get( 'button_delete' );
		$data['button_filter'] = $this->language->get( 'button_filter' );
		
		$data['token'] = $this->session->data['token'];
		
		if ( isset( $this->error['warning'] ) ) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		if ( isset( $this->session->data['success'] ) ) {
			$data['success'] = $this->session->data['success'];
			
			unset( $this->session->data['success'] );
		} else {
			$data['success'] = '';
		}
		
		if ( isset( $this->request->post['selected'] ) ) {
			$data['selected'] = (array) $this->request->post['selected'];
		} else {
			$data['selected'] = [];
		}
		
		$url = '';
		
		if ( isset( $this->request->get['filter_status'] ) ) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}
		
		if ( $order == 'ASC' ) {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}
		
		if ( isset( $this->request->get['page'] ) ) {
			$url .= '&page=' . $this->request->get['page'];
		}
		
		$data['sort_status'] = $this->url->link( 'extension/module/partnership', 'token=' . $this->session->data['token'] . '&sort=p.status' . $url, true );
		$data['sort_order']  = $this->url->link( 'extension/module/partnership', 'token=' . $this->session->data['token'] . '&sort=p.sort_order' . $url, true );
		
		$url = '';
		
		if ( isset( $this->request->get['filter_status'] ) ) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}
		
		if ( isset( $this->request->get['sort'] ) ) {
			$url .= '&sort=' . $this->request->get['sort'];
		}
		
		if ( isset( $this->request->get['order'] ) ) {
			$url .= '&order=' . $this->request->get['order'];
		}
		
		$pagination        = new Pagination();
		$pagination->total = $partnerships_total;
		$pagination->page  = $page;
		$pagination->limit = $this->config->get( 'config_limit_admin' );
		$pagination->url   = $this->url->link( 'extension/module/partnership', 'token=' . $this->session->data['token'] . $url . '&page={page}', true );
		
		$data['pagination'] = $pagination->render();
		
		$data['results'] = sprintf( $this->language->get( 'text_pagination' ), ( $partnerships_total ) ? ( ( $page - 1 ) * $this->config->get( 'config_limit_admin' ) ) + 1 : 0, ( ( ( $page - 1 ) * $this->config->get( 'config_limit_admin' ) ) > ( $partnerships_total - $this->config->get( 'config_limit_admin' ) ) ) ? $partnerships_total : ( ( ( $page - 1 ) * $this->config->get( 'config_limit_admin' ) ) + $this->config->get( 'config_limit_admin' ) ), $partnerships_total, ceil( $partnerships_total / $this->config->get( 'config_limit_admin' ) ) );
		
		$data['filter_status'] = $filter_status;
		
		$data['sort']  = $sort;
		$data['order'] = $order;
		
		$data['header']      = $this->load->controller( 'common/header' );
		$data['column_left'] = $this->load->controller( 'common/column_left' );
		$data['footer']      = $this->load->controller( 'common/footer' );
		
		$this->response->setOutput( $this->load->view( 'extension/module/partnership_list', $data ) );
	}
	
	public function add() {
		
		$this->load->language( 'extension/module/partnership' );
		
		$this->document->setTitle( $this->language->get( 'heading_title' ) );
		
		$this->load->model( 'extension/module/partnership' );
		
		if ( ( $this->request->server['REQUEST_METHOD'] == 'POST' ) && $this->validateForm() ) {
			
			$this->model_extension_module_partnership->addPartnership( $this->request->post );
			
			$this->session->data['success'] = $this->language->get( 'text_success' );
			
			$url = '';
			
			if ( isset( $this->request->get['filter_status'] ) ) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
			}
			
			if ( isset( $this->request->get['sort'] ) ) {
				$url .= '&sort=' . $this->request->get['sort'];
			}
			
			if ( isset( $this->request->get['order'] ) ) {
				$url .= '&order=' . $this->request->get['order'];
			}
			
			if ( isset( $this->request->get['page'] ) ) {
				$url .= '&page=' . $this->request->get['page'];
			}
			
			$this->response->redirect( $this->url->link( 'extension/module/partnership', 'token=' . $this->session->data['token'] . $url, true ) );
		}
		
		$this->getForm();
	}
	
	public function edit() {
		$this->load->language( 'extension/module/partnership' );
		
		$this->document->setTitle( $this->language->get( 'heading_title' ) );
		
		$this->load->model( 'extension/module/partnership' );
		
		if ( ( $this->request->server['REQUEST_METHOD'] == 'POST' ) && $this->validateForm() ) {
			$this->model_extension_module_partnership->editPartnership( $this->request->get['partnership_id'], $this->request->post );
			
			$this->session->data['success'] = $this->language->get( 'text_success' );
			
			$url = '';
			
			if ( isset( $this->request->get['filter_status'] ) ) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
			}
			
			if ( isset( $this->request->get['sort'] ) ) {
				$url .= '&sort=' . $this->request->get['sort'];
			}
			
			if ( isset( $this->request->get['order'] ) ) {
				$url .= '&order=' . $this->request->get['order'];
			}
			
			if ( isset( $this->request->get['page'] ) ) {
				$url .= '&page=' . $this->request->get['page'];
			}
			
			$this->response->redirect( $this->url->link( 'extension/module/partnership', 'token=' . $this->session->data['token'] . $url, true ) );
		}
		
		$this->getForm();
	}
	
	public function delete() {
		$this->load->language( 'extension/module/partnership' );
		
		$this->document->setTitle( $this->language->get( 'heading_title' ) );
		
		$this->load->model( 'extension/module/partnership' );
		
		if ( isset( $this->request->post['selected'] ) && $this->validateDelete() ) {
			foreach ( $this->request->post['selected'] as $partnership_id ) {
				$this->model_extension_module_partnership->deletePartnership( $partnership_id );
			}
			
			$this->session->data['success'] = $this->language->get( 'text_success' );
			
			$url = '';
			
			if ( isset( $this->request->get['filter_status'] ) ) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
			}
			
			if ( isset( $this->request->get['sort'] ) ) {
				$url .= '&sort=' . $this->request->get['sort'];
			}
			
			if ( isset( $this->request->get['order'] ) ) {
				$url .= '&order=' . $this->request->get['order'];
			}
			
			if ( isset( $this->request->get['page'] ) ) {
				$url .= '&page=' . $this->request->get['page'];
			}
			
			$this->response->redirect( $this->url->link( 'extension/module/partnership', 'token=' . $this->session->data['token'] . $url, true ) );
		}
		
		$this->getList();
	}
	
	protected function validateDelete() {
		if ( ! $this->user->hasPermission( 'modify', 'extension/module/partnership' ) ) {
			$this->error['warning'] = $this->language->get( 'error_permission' );
		}
		
		return ! $this->error;
	}
	
	protected function getForm() {
		$data['heading_title'] = $this->language->get( 'heading_title' );
		
		$data['text_form']     = ! isset( $this->request->get['partnership_id'] ) ? $this->language->get( 'text_add' ) : $this->language->get( 'text_edit' );
		$data['text_enabled']  = $this->language->get( 'text_enabled' );
		$data['text_disabled'] = $this->language->get( 'text_disabled' );
		$data['text_none']     = $this->language->get( 'text_none' );
		$data['text_yes']      = $this->language->get( 'text_yes' );
		$data['text_no']       = $this->language->get( 'text_no' );
		$data['text_plus']     = $this->language->get( 'text_plus' );
		$data['text_minus']    = $this->language->get( 'text_minus' );
		$data['text_default']  = $this->language->get( 'text_default' );
		$data['text_nocat']    = $this->language->get( 'text_nocat' );
		
		$data['entry_create']           = $this->language->get( 'entry_create' );
		$data['entry_title']            = $this->language->get( 'entry_title' );
		$data['entry_name']             = $this->language->get( 'entry_name' );
		$data['entry_announce']         = $this->language->get( 'entry_announce' );
		$data['entry_description']      = $this->language->get( 'entry_description' );
		$data['entry_image']            = $this->language->get( 'entry_image' );
		$data['entry_additional_image'] = $this->language->get( 'entry_additional_image' );
		$data['entry_status']           = $this->language->get( 'entry_status' );
		$data['entry_sort_order']       = $this->language->get( 'entry_sort_order' );
		
		$data['help_intro_text'] = $this->language->get( 'help_intro_text' );
		
		$data['button_save']      = $this->language->get( 'button_save' );
		$data['button_cancel']    = $this->language->get( 'button_cancel' );
		$data['button_remove']    = $this->language->get( 'button_remove' );
		$data['button_image_add'] = $this->language->get( 'button_image_add' );
		
		$data['tab_general'] = $this->language->get( 'tab_general' );
		$data['tab_image']   = $this->language->get( 'tab_image' );
		
		if ( isset( $this->error['warning'] ) ) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		if ( isset( $this->error['name'] ) ) {
			$data['error_title'] = $this->error['title'];
		} else {
			$data['error_title'] = [];
		}
		
		$url = '';
		
		if ( isset( $this->request->get['filter_status'] ) ) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}
		
		if ( isset( $this->request->get['sort'] ) ) {
			$url .= '&sort=' . $this->request->get['sort'];
		}
		
		if ( isset( $this->request->get['order'] ) ) {
			$url .= '&order=' . $this->request->get['order'];
		}
		
		if ( isset( $this->request->get['page'] ) ) {
			$url .= '&page=' . $this->request->get['page'];
		}
		
		$data['breadcrumbs'] = [];
		
		$data['breadcrumbs'][] = [
			'text' => $this->language->get( 'text_home' ),
			'href' => $this->url->link( 'common/dashboard', 'token=' . $this->session->data['token'], true ),
		];
		
		$data['breadcrumbs'][] = [
			'text' => $this->language->get( 'heading_title' ),
			'href' => $this->url->link( 'extension/module/partnership', 'token=' . $this->session->data['token'] . $url, true ),
		];
		
		$this->load->model( 'localisation/language' );
		
		$data['languages'] = $this->model_localisation_language->getLanguages();
		
		if ( ! isset( $this->request->get['partnership_id'] ) ) {
			$data['action'] = $this->url->link( 'extension/module/partnership/add', 'token=' . $this->session->data['token'] . $url, true );
		} else {
			$data['action'] = $this->url->link( 'extension/module/partnership/edit', 'token=' . $this->session->data['token'] . '&partnership_id=' . $this->request->get['partnership_id'] . $url, true );
		}
		
		$data['cancel'] = $this->url->link( 'extension/module/partnership', 'token=' . $this->session->data['token'] . $url, true );
		
		if ( isset( $this->request->get['partnership_id'] ) && ( $this->request->server['REQUEST_METHOD'] != 'POST' ) ) {
			$partnership_info = $this->model_extension_module_partnership->getPartnership( $this->request->get['partnership_id'] );
		}
		
		if ( isset( $this->request->post['partnership_data'] ) ) {
			$data['partnership_data'] = $this->request->post['partnership_data'];
		} elseif ( isset( $this->request->get['partnership_id'] ) ) {
			$data['partnership_data'] = $this->model_extension_module_partnership->getPartnershipDescriptions( $this->request->get['partnership_id'] );
		} else {
			$data['partnership_data'] = [];
		}
		
		if ( isset( $this->request->post['sort_order'] ) ) {
			$data['sort_order'] = $this->request->post['sort_order'];
		} elseif ( ! empty( $partnership_info ) ) {
			$data['sort_order'] = $partnership_info['sort_order'];
		} else {
			$data['sort_order'] = 1;
		}
		
		if ( isset( $this->request->post['status'] ) ) {
			$data['status'] = $this->request->post['status'];
		} elseif ( ! empty( $partnership_info ) ) {
			$data['status'] = $partnership_info['status'];
		} else {
			$data['status'] = true;
		}
		
		// Image
		if ( isset( $this->request->post['image'] ) ) {
			$data['image'] = $this->request->post['image'];
		} elseif ( ! empty( $partnership_info ) ) {
			$data['image'] = $partnership_info['image'];
		} else {
			$data['image'] = '';
		}
		
		$this->load->model( 'tool/image' );
		
		if ( isset( $this->request->post['image'] ) && is_file( DIR_IMAGE . $this->request->post['image'] ) ) {
			$data['thumb'] = $this->model_tool_image->resize( $this->request->post['image'], 100, 100 );
		} elseif ( ! empty( $partnership_info ) && is_file( DIR_IMAGE . $partnership_info['image'] ) ) {
			$data['thumb'] = $this->model_tool_image->resize( $partnership_info['image'], 100, 100 );
		} else {
			$data['thumb'] = $this->model_tool_image->resize( 'no_image.png', 100, 100 );
		}
		
		var_dump( $data['thumb'] );
		
		$data['placeholder'] = $this->model_tool_image->resize( 'no_image.png', 100, 100 );
		
		// Images
		if ( isset( $this->request->post['product_image'] ) ) {
			$product_images = $this->request->post['product_image'];
		} elseif ( isset( $this->request->get['product_id'] ) ) {
			$product_images = $this->model_catalog_product->getProductImages( $this->request->get['product_id'] );
		} else {
			$product_images = [];
		}
		
		$data['product_images'] = [];
		
		foreach ( $product_images as $product_image ) {
			if ( is_file( DIR_IMAGE . $product_image['image'] ) ) {
				$image = $product_image['image'];
				$thumb = $product_image['image'];
			} else {
				$image = '';
				$thumb = 'no_image.png';
			}
			
			$data['product_images'][] = [
				'image'      => $image,
				'thumb'      => $this->model_tool_image->resize( $thumb, 100, 100 ),
				'sort_order' => $product_image['sort_order'],
			];
		}
		
		$data['header']      = $this->load->controller( 'common/header' );
		$data['column_left'] = $this->load->controller( 'common/column_left' );
		$data['footer']      = $this->load->controller( 'common/footer' );
		
		$this->response->setOutput( $this->load->view( 'extension/module/partnership_form', $data ) );
	}
	
	protected function validateForm() {
		if ( ! $this->user->hasPermission( 'modify', 'extension/module/partnership' ) ) {
			$this->error['warning'] = $this->language->get( 'error_permission' );
		}
		
		foreach ( $this->request->post['partnership_data'] as $language_id => $value ) {
			if ( ( utf8_strlen( $value['title'] ) < 3 ) || ( utf8_strlen( $value['title'] ) > 255 ) ) {
				$this->error['title'][ $language_id ] = $this->language->get( 'error_title' );
			}
		}
		
		if ( $this->error && ! isset( $this->error['warning'] ) ) {
			$this->error['warning'] = $this->language->get( 'error_warning' );
		}
		
		return ! $this->error;
	}
	
	/** ===== Installation Functions ===== **/
	
	/**
	 * Install module
	 */
	public function install() {
		$this->load->model( 'setting/setting' );
		$this->load->model( 'user/user_group' );
		$this->load->model( 'design/layout' );
		$this->load->language( 'extension/module/partnership' );
		$this->load->model( 'extension/module/partnership' );
		
		$this->model_user_user_group->addPermission( $this->user->getGroupId(), 'access', 'extension/module/partnership' );
		$this->model_user_user_group->addPermission( $this->user->getGroupId(), 'modify', 'extension/module/partnership' );
		
		$this->model_extension_module_partnership->createTable();
		
		$this->model_extension_module_partnership->addRoute();
	}
	
	/**
	 * Uninstall module
	 */
	public function uninstall() {
		$this->load->model( 'setting/setting' );
		$this->load->model( 'user/user_group' );
		$this->load->model( 'design/layout' );
		$this->load->model( 'extension/module/partnership' );
		
		$this->model_user_user_group->removePermission( $this->user->getGroupId(), 'access', 'extension/module/partnership' );
		$this->model_user_user_group->removePermission( $this->user->getGroupId(), 'modify', 'extension/module/partnership' );
		
		$this->model_extension_module_partnership->removeLayout();
		
		$this->model_extension_module_partnership->removeTable();
		
		$this->model_extension_module_partnership->removeRoute();
	}
}