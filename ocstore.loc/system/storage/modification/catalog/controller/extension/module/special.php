<?php
class ControllerExtensionModuleSpecial extends Controller {
	public function index($setting) {
		$this->load->language('extension/module/special');

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_tax'] = $this->language->get('text_tax');

		$data['button_cart'] = $this->language->get('button_cart');
		$data['button_wishlist'] = $this->language->get('button_wishlist');
		$data['button_compare'] = $this->language->get('button_compare');

		$this->load->model('catalog/product');

		$this->load->model('tool/image');

		$data['products'] = array();

		$filter_data = array(
			'sort'  => 'pd.name',
			'order' => 'ASC',
			'start' => 0,
			'limit' => $setting['limit']
		);

		$results = $this->model_catalog_product->getProductSpecials($filter_data);

		if ($results) {
			foreach ($results as $result) {
				if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], $setting['width'], $setting['height']);
				} else {
					$image = $this->model_tool_image->resize('placeholder.png', $setting['width'], $setting['height']);
				}

				if ($this->customer->isLogged() || !$this->config->get('config_customer_price')) {
					$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
				} else {
					$price = false;
				}

				if ((float)$result['special']) {
					$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
				} else {
					$special = false;
				}

				if ($this->config->get('config_tax')) {
					$tax = $this->currency->format((float)$result['special'] ? $result['special'] : $result['price'], $this->session->data['currency']);
				} else {
					$tax = false;
				}

				if ($this->config->get('config_review_status')) {
					$rating = $result['rating'];
				} else {
					$rating = false;
				}


					// XD Stickers start
						$this->load->model('setting/setting');
						$xdstickers = $this->config->get('xdstickers');
						$current_language_id = $this->config->get('config_language_id');
						$product_xdstickers = array();
						$data['xdstickers_position'] = ($xdstickers['position'] == '0') ? ' position_upleft' : ' position_upright';
						if ($xdstickers['status']) {
							if ($xdstickers['sale']['status'] == '1' && $special) {
								if ($xdstickers['sale']['discount_status'] == '1') {
									$sale_value = ceil(((float)$result['price'] - (float)$result['special']) / ((float)$result['price'] * 0.01));
									$sale_text = $xdstickers['sale']['text'][$current_language_id] . ' -' . strval($sale_value) . '%';
								} else {
									$sale_text = $xdstickers['sale']['text'][$current_language_id];
								}								
								$product_xdstickers[] = array(
									'id'			=> 'xdsticker_sale',
									'text'			=> $sale_text
								);
							}
							if ($xdstickers['bestseller']['status'] == '1') {
								$bestsellers = $this->model_catalog_product->getBestSellerProducts((int)$xdstickers['bestseller']['property']);
								foreach ($bestsellers as $bestseller) {
									if ($bestseller['product_id'] == $result['product_id']) {
										$product_xdstickers[] = array(
											'id'			=> 'xdsticker_bestseller',
											'text'			=> $xdstickers['bestseller']['text'][$current_language_id]
										);
									}
								}
							}
							if ($xdstickers['novelty']['status'] == '1') {
								if ((strtotime($result['date_added']) + intval($xdstickers['novelty']['property']) * 24 * 3600) > time()) {
									$product_xdstickers[] = array(
										'id'			=> 'xdsticker_novelty',
										'text'			=> $xdstickers['novelty']['text'][$current_language_id]
									);
								}
							}
							if ($xdstickers['last']['status'] == '1') {
								if ($result['quantity'] <= intval($xdstickers['last']['property']) && $result['quantity'] > 0) {
									$product_xdstickers[] = array(
										'id'			=> 'xdsticker_last',
										'text'			=> $xdstickers['last']['text'][$current_language_id]
									);
								}
							}
							if ($xdstickers['freeshipping']['status'] == '1') {
								if ((float)$result['special'] >= intval($xdstickers['freeshipping']['property'])) {
									$product_xdstickers[] = array(
										'id'			=> 'xdsticker_freeshipping',
										'text'			=> $xdstickers['freeshipping']['text'][$current_language_id]
									);
								} else if ((float)$result['price'] >= intval($xdstickers['freeshipping']['property'])) {
									$product_xdstickers[] = array(
										'id'			=> 'xdsticker_freeshipping',
										'text'			=> $xdstickers['freeshipping']['text'][$current_language_id]
									);
								}
							}

							// STOCK stickers
							if (isset($xdstickers['stock']) && !empty($xdstickers['stock'])) {
								foreach($xdstickers['stock'] as $key => $value) {
									if (isset($value['status']) && $value['status'] == '1' && $key == $result['stock_status_id'] && $result['quantity'] <= 0) {
										$product_xdstickers[] = array(
											'id'			=> 'xdsticker_stock_' . $key,
											'text'			=> $result['stock_status']
										);
									}
								}
							}

							// CUSTOM stickers
							$this->load->model('extension/module/xdstickers');
							$custom_xdstickers_id = $this->model_extension_module_xdstickers->getCustomXDStickersProduct($result['product_id']);
							if (!empty($custom_xdstickers_id)) {
								foreach ($custom_xdstickers_id as $custom_xdsticker_id) {
									$custom_xdsticker = $this->model_extension_module_xdstickers->getCustomXDSticker($custom_xdsticker_id['xdsticker_id']);
									$custom_xdsticker_text = json_decode($custom_xdsticker['text'], true);
									// var_dump($custom_xdsticker);
									if ($custom_xdsticker['status'] == '1') {
										$custom_sticker_class = 'xdsticker_' . $custom_xdsticker_id['xdsticker_id'];
										$product_xdstickers[] = array(
											'id'			=> $custom_sticker_class,
											'text'			=> $custom_xdsticker_text[$current_language_id]
										);
									}
								}
							}
						}
					// XD Stickers end
				
				$data['products'][] = array(

					'product_xdstickers'  => $product_xdstickers,
				
					'product_id'  => $result['product_id'],
					'thumb'       => $image,
					'name'        => $result['name'],
					'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get($this->config->get('config_theme') . '_product_description_length')) . '..',
					'price'       => $price,
					'special'     => $special,
					'tax'         => $tax,
					'rating'      => $rating,
					'href'        => $this->url->link('product/product', 'product_id=' . $result['product_id'])
				);
			}

			return $this->load->view('extension/module/special', $data);
		}
	}
}