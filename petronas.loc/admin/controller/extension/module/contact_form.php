<?php

class ControllerExtensionModuleContactForm extends Controller {
	
	private $error = [];
	
	public function install() {
		$this->load->model( 'setting/setting' );
		$this->load->model( 'user/user_group' );
		$this->load->model( 'design/layout' );
		$this->load->model( 'extension/contact_form' );
		
		$this->model_user_user_group->addPermission( $this->user->getGroupId(), 'access', 'extension/module/contact_form' );
		$this->model_user_user_group->addPermission( $this->user->getGroupId(), 'modify', 'extension/module/contact_form' );
		
		$this->model_extension_contact_form->createTable();
	}
	
	public function index() {
		$this->load->language( 'extension/module/contact_form' );
		
		$this->document->setTitle( $this->language->get( 'heading_title' ) );
		
		$this->load->model( 'extension/contact_form' );
		
		$this->getList();
	}
	
	public function add() {
		$this->load->language( 'extension/module/contact_form' );
		
		$this->document->setTitle( $this->language->get( 'heading_title' ) );
		
		$this->load->model( 'extension/contact_form' );
		
		if ( ( $this->request->server['REQUEST_METHOD'] == 'POST' ) && $this->validateForm() ) {
			
			$this->model_extension_contact_form->addContactForm( $this->request->post );
			
			$this->session->data['success'] = $this->language->get( 'text_success' );
			
			$url = '';
			
			if ( isset( $this->request->get['sort'] ) ) {
				$url .= '&sort=' . $this->request->get['sort'];
			}
			
			if ( isset( $this->request->get['order'] ) ) {
				$url .= '&order=' . $this->request->get['order'];
			}
			
			if ( isset( $this->request->get['page'] ) ) {
				$url .= '&page=' . $this->request->get['page'];
			}
			
			$this->response->redirect( $this->url->link( 'extension/module/contact_form', 'token=' . $this->session->data['token'] . $url, true ) );
		}
		
		$this->getForm();
	}
	
	public function edit() {
		$this->load->language( 'extension/module/contact_form' );
		
		$this->document->setTitle( $this->language->get( 'heading_title' ) );
		
		$this->load->model( 'extension/contact_form' );
		
		if ( ( $this->request->server['REQUEST_METHOD'] == 'POST' ) && $this->validateForm() ) {
			$this->model_extension_contact_form->editContactForm( $this->request->get['contact_form_id'], $this->request->post );
			
			$this->session->data['success'] = $this->language->get( 'text_success' );
			
			$url = '';
			
			if ( isset( $this->request->get['sort'] ) ) {
				$url .= '&sort=' . $this->request->get['sort'];
			}
			
			if ( isset( $this->request->get['order'] ) ) {
				$url .= '&order=' . $this->request->get['order'];
			}
			
			if ( isset( $this->request->get['page'] ) ) {
				$url .= '&page=' . $this->request->get['page'];
			}
			
			$this->response->redirect( $this->url->link( 'extension/module/contact_form', 'token=' . $this->session->data['token'] . $url, true ) );
		}
		
		$this->getForm();
	}
	
	public function delete() {
		$this->load->language( 'extension/module/contact_form' );
		
		$this->document->setTitle( $this->language->get( 'heading_title' ) );
		
		$this->load->model( 'extension/contact_form' );
		
		if ( isset( $this->request->post['selected'] ) && $this->validateDelete() ) {
			foreach ( $this->request->post['selected'] as $contact_form_id ) {
				$this->model_extension_contact_form->deleteContactForm( $contact_form_id );
			}
			
			$this->session->data['success'] = $this->language->get( 'text_success' );
			
			$url = '';
			
			if ( isset( $this->request->get['sort'] ) ) {
				$url .= '&sort=' . $this->request->get['sort'];
			}
			
			if ( isset( $this->request->get['order'] ) ) {
				$url .= '&order=' . $this->request->get['order'];
			}
			
			if ( isset( $this->request->get['page'] ) ) {
				$url .= '&page=' . $this->request->get['page'];
			}
			
			$this->response->redirect( $this->url->link( 'extension/module/contact_form', 'token=' . $this->session->data['token'] . $url, true ) );
		}
		
		$this->getList();
	}
	
	protected function getList() {
		if ( isset( $this->request->get['sort'] ) ) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'contact_form_date';
		}
		
		if ( isset( $this->request->get['order'] ) ) {
			$order = $this->request->get['order'];
		} else {
			$order = 'DESC';
		}
		
		if ( isset( $this->request->get['page'] ) ) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
		
		$url = '';
		
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
			'href' => $this->url->link( 'extension/module/contact_form', 'token=' . $this->session->data['token'] . $url, true ),
		];
		
		$data['add']    = $this->url->link( 'extension/module/contact_form/add', 'token=' . $this->session->data['token'] . $url, true );
		$data['delete'] = $this->url->link( 'extension/module/contact_form/delete', 'token=' . $this->session->data['token'] . $url, true );
		
		$data['contact_form'] = [];
		
		$filter_data = [
			'sort'  => $sort,
			'order' => $order,
			'start' => ( $page - 1 ) * $this->config->get( 'config_limit_admin' ),
			'limit' => $this->config->get( 'config_limit_admin' ),
		];
		
		$contact_form_total = $this->model_extension_contact_form->getTotalContactForms();
		
		$results = $this->model_extension_contact_form->getContactForms( $filter_data );
		
		foreach ( $results as $result ) {
			
			$data['contact_form'][] = [
				'contact_form_id'      => (int) $result['contact_form_id'],
				'contact_form_email'   => $result['contact_form_email'],
				'contact_form_name'    => $result['contact_form_name'],
				'contact_form_phone'   => $result['contact_form_phone'],
				'contact_form_message' => utf8_substr(strip_tags(html_entity_decode($result['contact_form_message'], ENT_QUOTES, 'UTF-8')), 0, 120) . '...',
				'contact_form_date'    => date( $this->language->get( 'date_format_short' ), strtotime( $result['contact_form_date'] ) ),
				'edit'                 => $this->url->link( 'extension/module/contact_form/edit', 'token=' . $this->session->data['token'] . '&contact_form_id=' . $result['contact_form_id'] . $url, true ),
			];
		}
		
		$data['heading_title'] = $this->language->get( 'heading_title' );
		
		$data['text_list']       = $this->language->get( 'text_list' );
		$data['text_no_results'] = $this->language->get( 'text_no_results' );
		$data['text_confirm']    = $this->language->get( 'text_confirm' );
		
		$data['column_contact_form_id']      = $this->language->get( 'column_contact_form_id' );
		$data['column_contact_form_name']   = $this->language->get( 'column_contact_form_name' );
		$data['column_contact_form_email']   = $this->language->get( 'column_contact_form_email' );
		$data['column_contact_form_message'] = $this->language->get( 'column_contact_form_message' );
		$data['column_contact_form_date']    = $this->language->get( 'column_contact_form_date' );
		$data['column_action']               = $this->language->get( 'column_action' );
		
		$data['button_add']    = $this->language->get( 'button_add' );
		$data['button_edit']   = $this->language->get( 'button_edit' );
		$data['button_delete'] = $this->language->get( 'button_delete' );
		
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
		
		if ( $order == 'ASC' ) {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}
		
		if ( isset( $this->request->get['page'] ) ) {
			$url .= '&page=' . $this->request->get['page'];
		}
		
		$data['sort_contact_form_id']    = $this->url->link( 'extension/module/contact_form', 'token=' . $this->session->data['token'] . '&sort=contact_form_id' . $url, true );
		$data['sort_contact_form_name'] = $this->url->link( 'extension/module/contact_form', 'token=' . $this->session->data['token'] . '&sort=contact_form_name' . $url, true );
		$data['sort_contact_form_email'] = $this->url->link( 'extension/module/contact_form', 'token=' . $this->session->data['token'] . '&sort=contact_form_email' . $url, true );
		$data['sort_contact_form_date']  = $this->url->link( 'extension/module/contact_form', 'token=' . $this->session->data['token'] . '&sort=contact_form_date' . $url, true );
		
		$url = '';
		
		if ( isset( $this->request->get['sort'] ) ) {
			$url .= '&sort=' . $this->request->get['sort'];
		}
		
		
		if ( isset( $this->request->get['order'] ) ) {
			$url .= '&order=' . $this->request->get['order'];
		}
		
		$pagination        = new Pagination();
		$pagination->total = $contact_form_total;
		$pagination->page  = $page;
		$pagination->limit = $this->config->get( 'config_limit_admin' );
		$pagination->url   = $this->url->link( 'extension/module/contact_form', 'token=' . $this->session->data['token'] . $url . '&page={page}', true );
		
		$data['pagination'] = $pagination->render();
		
		$data['results'] = sprintf( $this->language->get( 'text_pagination' ), ( $contact_form_total ) ? ( ( $page - 1 ) * $this->config->get( 'config_limit_admin' ) ) + 1 : 0, ( ( ( $page - 1 ) * $this->config->get( 'config_limit_admin' ) ) > ( $contact_form_total - $this->config->get( 'config_limit_admin' ) ) ) ? $contact_form_total : ( ( ( $page - 1 ) * $this->config->get( 'config_limit_admin' ) ) + $this->config->get( 'config_limit_admin' ) ), $contact_form_total, ceil( $contact_form_total / $this->config->get( 'config_limit_admin' ) ) );
		
		$data['sort']  = $sort;
		$data['order'] = $order;
		
		$data['header']      = $this->load->controller( 'common/header' );
		$data['column_left'] = $this->load->controller( 'common/column_left' );
		$data['footer']      = $this->load->controller( 'common/footer' );
		
		$this->response->setOutput( $this->load->view( 'extension/module/contact_form_list', $data ) );
	}
	
	protected function getForm() {
		$data['heading_title'] = $this->language->get( 'heading_title' );
		
		$data['text_form'] = ! isset( $this->request->get['contact_form_id'] ) ? $this->language->get( 'text_add' ) : $this->language->get( 'text_edit' );
		
		$data['entry_contact_form_email'] = $this->language->get( 'entry_contact_form_email' );
		$data['entry_contact_form_name']  = $this->language->get( 'entry_contact_form_name' );
		$data['entry_contact_form_phone'] = $this->language->get( 'entry_contact_form_phone' );
		$data['entry_contact_form_message'] = $this->language->get( 'entry_contact_form_message' );
		
		$data['button_save']   = $this->language->get( 'button_save' );
		$data['button_cancel'] = $this->language->get( 'button_cancel' );
		
		$data['token'] = $this->session->data['token'];
		
		if ( isset( $this->request->get['contact_form_id'] ) ) {
			$data['contact_form_id'] = $this->request->get['contact_form_id'];
		} else {
			$data['contact_form_id'] = 0;
		}
		
		if ( isset( $this->error['warning'] ) ) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		if ( isset( $this->error['contact_form_email'] ) ) {
			$data['error_contact_form_email'] = $this->error['contact_form_email'];
		} else {
			$data['error_contact_form_email'] = '';
		}
		
		$url = '';
		
		if ( isset( $this->request->get['page'] ) ) {
			$url .= '&page=' . $this->request->get['page'];
		}
		
		if ( isset( $this->request->get['sort'] ) ) {
			$url .= '&sort=' . $this->request->get['sort'];
		}
		
		if ( isset( $this->request->get['order'] ) ) {
			$url .= '&order=' . $this->request->get['order'];
		}
		
		$data['breadcrumbs'] = [];
		
		$data['breadcrumbs'][] = [
			'text' => $this->language->get( 'text_home' ),
			'href' => $this->url->link( 'common/dashboard', 'token=' . $this->session->data['token'], true ),
		];
		
		$data['breadcrumbs'][] = [
			'text' => $this->language->get( 'heading_title' ),
			'href' => $this->url->link( 'extension/module/contact_form', 'token=' . $this->session->data['token'] . $url, true ),
		];
		
		if ( ! isset( $this->request->get['contact_form_id'] ) ) {
			$data['action'] = $this->url->link( 'extension/module/contact_form/add', 'token=' . $this->session->data['token'] . $url, true );
		} else {
			$data['action'] = $this->url->link( 'extension/module/contact_form/edit', 'token=' . $this->session->data['token'] . '&contact_form_id=' . $this->request->get['contact_form_id'] . $url, true );
		}
		
		$data['cancel'] = $this->url->link( 'extension/module/contact_form', 'token=' . $this->session->data['token'] . $url, true );
		
		if ( isset( $this->request->get['contact_form_id'] ) && ( ! $this->request->server['REQUEST_METHOD'] != 'POST' ) ) {
			$contact_form_info = $this->model_extension_contact_form->getContactForm( $this->request->get['contact_form_id'] );
		}
		
		if ( isset( $this->request->post['contact_form_email'] ) ) {
			$data['contact_form_email'] = $this->request->post['contact_form_email'];
		} elseif ( ! empty( $contact_form_info ) ) {
			$data['contact_form_email'] = $contact_form_info['contact_form_email'];
		} else {
			$data['contact_form_email'] = '';
		}
		
		if ( isset( $this->request->post['contact_form_name'] ) ) {
			$data['contact_form_name'] = $this->request->post['contact_form_name'];
		} elseif ( ! empty( $contact_form_info ) ) {
			$data['contact_form_name'] = $contact_form_info['contact_form_name'];
		} else {
			$data['contact_form_name'] = '';
		}
		
		if ( isset( $this->request->post['contact_form_phone'] ) ) {
			$data['contact_form_phone'] = $this->request->post['contact_form_phone'];
		} elseif ( ! empty( $contact_form_info ) ) {
			$data['contact_form_phone'] = $contact_form_info['contact_form_phone'];
		} else {
			$data['contact_form_phone'] = '';
		}
		
		if ( isset( $this->request->post['contact_form_message'] ) ) {
			$data['contact_form_message'] = $this->request->post['contact_form_message'];
		} elseif ( ! empty( $contact_form_info ) ) {
			$data['contact_form_message'] = $contact_form_info['contact_form_message'];
		} else {
			$data['contact_form_message'] = '';
		}
		
		if ( isset( $this->request->post['contact_form_date'] ) ) {
			$data['contact_form_date'] = $this->request->post['contact_form_date'];
		} elseif ( ! empty( $contact_form_info ) ) {
			$data['contact_form_date'] = ( $contact_form_info['contact_form_date'] != '0000-00-00' ? $contact_form_info['contact_form_date'] : '' );
		} else {
			$data['contact_form_date'] = date( 'Y-m-d', time() );
		}
		
		$data['header']      = $this->load->controller( 'common/header' );
		$data['column_left'] = $this->load->controller( 'common/column_left' );
		$data['footer']      = $this->load->controller( 'common/footer' );
		
		$this->response->setOutput( $this->load->view( 'extension/module/contact_form_form', $data ) );
	}
	
	protected function validateForm() {
		
		if ( ! $this->user->hasPermission( 'modify', 'extension/module/contact_form' ) ) {
			$this->error['warning'] = $this->language->get( 'error_permission' );
		}
		
		if ( ( utf8_strlen( $this->request->post['contact_form_email'] ) > 96 ) || ( ! filter_var( $this->request->post['contact_form_email'], FILTER_VALIDATE_EMAIL ) ) ) {
			$this->error['contact_form_email'] = $this->language->get( 'error_contact_form_email' );
		}
		
		return ! $this->error;
	}
	
	protected function validateDelete() {
		if ( ! $this->user->hasPermission( 'modify', 'extension/module/contact_form' ) ) {
			$this->error['warning'] = $this->language->get( 'error_permission' );
		}
		
		return ! $this->error;
	}
}
