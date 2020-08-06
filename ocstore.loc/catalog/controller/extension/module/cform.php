<?php
class ControllerExtensionModuleCform extends Controller {

	public function index() {

		$this->load->language('extension/module/cform');

		$this->load->model('extension/module/cform');

		$this->model_extension_module_cform->createcform();

		$data['heading_title'] = $this->language->get('heading_title');
		$data['text_email'] = $this->language->get('text_email');
		$data['text_subscribe_btn'] = $this->language->get('text_subscribe_btn');
		$data['text_subscribe_placeholder'] = $this->language->get('text_subscribe_placeholder');
		$data['error_cform_email_invalid'] = $this->language->get('error_cform_email_invalid');
		$data['error_cform_email_required'] = $this->language->get('error_cform_email_required');
		$data['error_cform_sent'] = $this->language->get('error_cform_sent');
		$data['error_cform_fail'] = $this->language->get('error_cform_fail');

		return $this->load->view($this->config->get('config_template') . '/extension/module/cform', $data);
	}

	public function add() {

		$this->load->model('extension/module/cform');

		$json = array();
		$json['message'] = $this->model_extension_module_cform->addcform($this->request->post);
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}