<?php
class ControllerCheckoutDownload extends Controller {
	public function index() {
		$this->response->redirect($this->url->link('checkout/cart', '', true));
	}

	public function order_add_hook($route='', $data=array(), $output=null) {
		$order_id = $output;

		if ($order_id) {
			$this->load->model('checkout/download');
			$this->model_checkout_download->addOrderDownloads($order_id);
		} else {
			$this->response->redirect($this->url->link('checkout/cart', '', true));
		}
	}

	public function order_edit_hook($route='', $data=array(), $output=null) {
		if (is_array($data) && !empty($data[0])) {
			$order_id = (int)$data[0];
		} else {
			$order_id = null;
		}

		if ($order_id) {
			$this->load->model('checkout/download');
			$this->model_checkout_download->editOrderDownloads($order_id);
		} else {
			$this->response->redirect($this->url->link('checkout/cart', '', true));
		}
	}

	public function order_delete_hook($route='', $data=null, $output=null) {
		if (is_array($data) && !empty($data[0])) {
			$order_id = (int)$data[0];
		} else {
			$order_id = (int)$data;
		}

		if ($order_id) {
			$this->load->model('checkout/download');
			$this->model_checkout_download->deleteOrderDownloads($order_id);
		} else {
			$this->response->redirect($this->url->link('checkout/cart', '', true));
		}
	}
}
