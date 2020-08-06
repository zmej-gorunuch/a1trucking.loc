<?php
class ControllerVacancyVacancy extends Controller {
	public function index() {
		$this->load->language('vacancy/vacancy');

		$this->load->model('vacancy/vacancy');

		$this->load->model('tool/image');

		if (isset($this->request->post['country_id'])) {
			$country_id = $this->request->post['country_id'];
		} else {
			$country_id = 3;
		}
		
		if (isset($this->request->post['city_id'])) {
			$city_id = $this->request->post['city_id'];
		} else {
			$city_id = 1;
		}
		
		if (isset($this->request->post['trend_id'])) {
			$trend_id = $this->request->post['trend_id'];
		} else {
			$trend_id = 0;
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);
		
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('vacancy/vacancy')
		);
		
		$this->document->setTitle($this->language->get('heading_title'));
		$this->document->setDescription($this->language->get('meta_description'));
		$this->document->setKeywords($this->language->get('meta_keyword'));

		$data['heading_title'] = $this->language->get('heading_title');
		$data['text_country'] = $this->language->get('text_country');
		$data['text_city'] = $this->language->get('text_city');
		$data['text_trend'] = $this->language->get('text_trend');
		$data['text_show_on_map'] = $this->language->get('text_show_on_map');
		$data['button_filtr'] = $this->language->get('button_filtr');
		$data['text_all'] = $this->language->get('text_all');
		$data['text_empty'] = $this->language->get('text_empty');

		$data['vacancy'] = array();
		
		$filter_data = array(
			'filter_town' 		=> $city_id,
			'filter_country'    => $country_id,
			'filter_trend' 		=> $trend_id
		);
		
		

		$results = $this->model_vacancy_vacancy->getVacancy($filter_data);

		foreach ($results as $result) {
			if ($result['image']) {
				//$image = $this->model_tool_image->resize($result['image'], $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
				$image = $this->model_tool_image->resize($result['image'], 280, 186);
			} else {
				//$image = $this->model_tool_image->resize('placeholder.png', $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
				$image = $this->model_tool_image->resize('placeholder.png', 280, 186);
			}

			$data['vacancy'][] = array(
				'salon_id'  => $result['salon_id'],
				'thumb'       => $image,
				'name'        => $result['name'],
				'address'     => $result['address'],
				'description' => html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8'),
				'latitude'	  => $result['latitude'],	
				'longitude'	  => $result['longitude']
			);
		}
		
		$data['trends'] = $this->model_vacancy_vacancy->getTrends();
		
		$data['cities'] = array();
		$data['cits'] = array();
		
		$data['countries'] = $this->model_vacancy_vacancy->getCountries();
		$data['cities'] = $this->model_vacancy_vacancy->getCitiesByCountryId($country_id);
		$data['cits'] = $this->model_vacancy_vacancy->getCities();
		
		$data['country_id'] = $country_id;
		$data['city_id'] = $city_id;
		$data['trend_id'] = $trend_id;

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/vacancy/vacancy.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/vacancy/vacancy.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('/vacancy/vacancy.tpl', $data));
		}
		
	}
	
	public function city() {
		$json = array();

		$this->load->model('vacancy/vacancy');

		$country_info = $this->model_vacancy_vacancy->getCountry($this->request->get['country_id']);

		if ($country_info) {
			$json = array(
				'country_id'        => $country_info['country_id'],
				'name'              => $country_info['name'],
				'city'              => $this->model_vacancy_vacancy->getCitiesByCountryId($this->request->get['country_id'])
			);
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}	
}