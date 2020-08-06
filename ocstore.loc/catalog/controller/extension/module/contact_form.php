<?php

class ControllerExtensionModuleContactForm extends Controller {
	public function add() {
		$this->load->language( 'extension/module/contact_form' );
		$this->load->model( 'extension/module/contact_form' );
		
		if ( ! isset( $this->request->post['phone'] ) ) {
			$this->request->post['phone'] = null;
		}
		
		$result = $this->model_extension_module_contact_form->addContactForm( $this->request->post );
		
		if ( $result ) {
			$json['message'] = $data['success_message_sent'] = $this->language->get( 'success_message_sent' );
			$json['status']  = true;
		} else {
			$json['message'] = $data['error_message_sent'] = $this->language->get( 'error_message_sent' );
			$json['status']  = false;
		}
		
		$this->response->addHeader( 'Content-Type: application/json' );
		$this->response->setOutput( json_encode( $json ) );
	}
}