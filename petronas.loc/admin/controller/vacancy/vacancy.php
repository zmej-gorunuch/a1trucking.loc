<?php
class ControllerVacancyVacancy extends Controller {
	private $error = array();

	public function index() {
		$this->language->load('vacancy/vacancy');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('vacancy/vacancy');

		$this->getList();
	}

	public function add() {
		$this->language->load('vacancy/vacancy');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('vacancy/vacancy');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_vacancy_vacancy->addSalon($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_town'])) {
				$url .= '&filter_town=' . $this->request->get['filter_town'];
			}

			if (isset($this->request->get['filter_country'])) {
				$url .= '&filter_country=' . $this->request->get['filter_price'];
			}

			if (isset($this->request->get['filter_trend'])) {
				$url .= '&filter_trend=' . $this->request->get['filter_trend'];
			}

			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('vacancy/vacancy', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function edit() {
		$this->language->load('vacancy/vacancy');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('vacancy/vacancy');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_vacancy_vacancy->editSalon($this->request->get['salon_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_town'])) {
				$url .= '&filter_town=' .$this->request->get['filter_town'];
			}

			if (isset($this->request->get['filter_country'])) {
				$url .= '&filter_country=' . $this->request->get['filter_price'];
			}

			if (isset($this->request->get['filter_trend'])) {
				$url .= '&filter_trend=' . $this->request->get['filter_trend'];
			}

			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('vacancy/vacancy', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function delete() {
		$this->language->load('vacancy/vacancy');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('vacancy/vacancy');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $salon_id) {
				$this->model_vacancy_vacancy->deleteSalon($salon_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_town'])) {
				$url .= '&filter_town=' . $this->request->get['filter_town'];
			}

			if (isset($this->request->get['filter_country'])) {
				$url .= '&filter_country=' . $this->request->get['filter_price'];
			}

			if (isset($this->request->get['filter_trend'])) {
				$url .= '&filter_trend=' . $this->request->get['filter_trend'];
			}

			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('vacancy/vacancy', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
		}

	protected function getList() {
		if (isset($this->request->get['filter_name'])) {
			$filter_name = $this->request->get['filter_name'];
		} else {
			$filter_name = null;
		}

		if (isset($this->request->get['filter_town'])) {
			$filter_town = $this->request->get['filter_town'];
		} else {
			$filter_town = null;
		}

		if (isset($this->request->get['filter_country'])) {
			$filter_country = $this->request->get['filter_country'];
		} else {
			$filter_country = null;
		}

		if (isset($this->request->get['filter_trend'])) {
			$filter_trend = $this->request->get['filter_trend'];
		} else {
			$filter_trend = null;
		}

		if (isset($this->request->get['filter_status'])) {
			$filter_status = $this->request->get['filter_status'];
		} else {
			$filter_status = null;
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 's.name';
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

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}

		if (isset($this->request->get['filter_town'])) {
				$url .= '&filter_town=' . $this->request->get['filter_town'];
			}

			if (isset($this->request->get['filter_country'])) {
				$url .= '&filter_country=' . $this->request->get['filter_country'];
			}

			if (isset($this->request->get['filter_trend'])) {
				$url .= '&filter_trend=' . $this->request->get['filter_trend'];
			}
            
		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('vacancy/vacancy', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		$data['add'] = $this->url->link('vacancy/vacancy/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['copy'] = $this->url->link('vacancy/vacancy/copy', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['delete'] = $this->url->link('vacancy/vacancy/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$data['vacancy'] = array();

		$filter_data = array(
			'filter_name'	  => $filter_name,
			'filter_town'	  => $filter_town,
			'filter_country'  => $filter_country,
			'filter_trend'    => $filter_trend,
      		'filter_status'   => $filter_status,
			'sort'            => $sort,
			'order'           => $order,
			'start'           => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit'           => $this->config->get('config_limit_admin')
		);

		$this->load->model('tool/image');

		$salon_total = $this->model_vacancy_vacancy->getTotalSalons($filter_data);

		$results = $this->model_vacancy_vacancy->getSalons($filter_data);

		$data['trends'] = $this->model_vacancy_vacancy->getTrends();
		
		$data['cities'] = array();
		
		$data['countries'] = $this->model_vacancy_vacancy->getCountries();
		$data['cities'] = $this->model_vacancy_vacancy->getCitiesByCountryId($filter_country);
		

		foreach ($results as $result) {

			$data['vacancy'][] = array(
				'salon_id' 	 => $result['salon_id'],
				'name'       => strip_tags(html_entity_decode($result['salon'], ENT_QUOTES, 'UTF-8')),
				'town'       => $result['town'],
				'country'    => $result['country'],
				'status'     => ($result['status']) ? $this->language->get('text_enabled') : $this->language->get('text_disabled'),
				'edit'       => $this->url->link('vacancy/vacancy/edit', 'token=' . $this->session->data['token'] . '&salon_id=' . $result['salon_id'] . $url, 'SSL')
			);
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_list'] = $this->language->get('text_list');
		$data['text_all'] = $this->language->get('text_all');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['column_name'] = $this->language->get('column_name');
		$data['column_city'] = $this->language->get('column_city');
		$data['column_trend'] = $this->language->get('column_trend');
		$data['column_country'] = $this->language->get('column_country');
		$data['column_status'] = $this->language->get('column_status');
		$data['column_action'] = $this->language->get('column_action');

		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_town'] = $this->language->get('entry_town');
		$data['entry_country'] = $this->language->get('entry_country');
		$data['entry_trend'] = $this->language->get('entry_trend');
		$data['entry_status'] = $this->language->get('entry_status');

		$data['button_add'] = $this->language->get('button_add');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_delete'] = $this->language->get('button_delete');
		$data['button_filter'] = $this->language->get('button_filter');

		$data['token'] = $this->session->data['token'];

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array)$this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_town'])) {
			$url .= '&filter_town=' .$this->request->get['filter_town'];
		}

		if (isset($this->request->get['filter_country'])) {
			$url .= '&filter_country=' . $this->request->get['filter_country'];
		}

		if (isset($this->request->get['filter_trend'])) {
			$url .= '&filter_trend=' . $this->request->get['filter_trend'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['sort_name'] = $this->url->link('vacancy/vacancy', 'token=' . $this->session->data['token'] . '&sort=sd.name' . $url, 'SSL');
		$data['sort_town'] = $this->url->link('vacancy/vacancy', 'token=' . $this->session->data['token'] . '&sort=td.name' . $url, 'SSL');
		$data['sort_country'] = $this->url->link('vacancy/vacancy', 'token=' . $this->session->data['token'] . '&sort=cd.name' . $url, 'SSL');
		$data['sort_status'] = $this->url->link('vacancy/vacancy', 'token=' . $this->session->data['token'] . '&sort=s.status' . $url, 'SSL');
		

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_town'])) {
			$url .= '&filter_town=' .$this->request->get['filter_town'];
		}

		if (isset($this->request->get['filter_country'])) {
			$url .= '&filter_country=' . $this->request->get['filter_country'];
		}

		if (isset($this->request->get['filter_trend'])) {
			$url .= '&filter_trend=' . $this->request->get['filter_trend'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $salon_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('vacancy/vacancy', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($salon_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($salon_total - $this->config->get('config_limit_admin'))) ? $salon_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $salon_total, ceil($salon_total / $this->config->get('config_limit_admin')));

		$data['filter_name'] = $filter_name;
		$data['filter_town'] = $filter_town;
   	    $data['filter_country'] = $filter_country;
        $data['filter_trend'] = $filter_trend;
		$data['filter_status'] = $filter_status;

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('vacancy/salon_list.tpl', $data));
	}

	protected function getForm() {
    //CKEditor
    if ($this->config->get('config_editor_default')) {
        $this->document->addScript('view/javascript/ckeditor/ckeditor.js');
        $this->document->addScript('view/javascript/ckeditor/ckeditor_init.js');
    } else {
        $this->document->addScript('view/javascript/summernote/summernote.js');
        $this->document->addScript('view/javascript/summernote/lang/summernote-' . $this->language->get('lang') . '.js');
        $this->document->addScript('view/javascript/summernote/opencart.js');
        $this->document->addStyle('view/javascript/summernote/summernote.css');
    }
		//$this->document->addScript('http://maps.google.com/maps/api/js?sensor=false&key=AIzaSyDm1blrNyg34jP3zWQDV24U-mr3ZPRncZc&libraries=places');
		//$this->document->addScript('view/javascript/jquery/locationpicker/locationpicker.jquery.js');
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_form'] = !isset($this->request->get['salon_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_none'] = $this->language->get('text_none');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		$data['text_select'] = $this->language->get('text_select');
		$data['text_select_all'] = $this->language->get('text_select_all');
		$data['text_unselect_all'] = $this->language->get('text_unselect_all');
		$data['text_all'] = $this->language->get('text_all');
		$data['text_location_address'] = $this->language->get('text_location_address');
		$data['entry_map'] = $this->language->get('entry_map');
		$data['entry_latitude'] = $this->language->get('entry_latitude');
		$data['entry_longitude'] = $this->language->get('entry_longitude');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');

		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_description'] = $this->language->get('entry_description');
		$data['entry_city'] = $this->language->get('entry_city');
		$data['entry_country'] = $this->language->get('entry_country');
		$data['entry_trend'] = $this->language->get('entry_trend');
		$data['entry_address'] = $this->language->get('entry_address');
		$data['entry_image'] = $this->language->get('entry_image');
		$data['entry_filter'] = $this->language->get('entry_filter');
		$data['entry_text'] = $this->language->get('entry_text');
		$data['entry_status'] = $this->language->get('entry_status');
		
		
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_remove'] = $this->language->get('button_remove');
		
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = array();
		}

		if (isset($this->error['country'])) {
			$data['error_country'] = $this->error['country'];
		} else {
			$data['error_country'] = '';
		}
		
		if (isset($this->error['trend'])) {
			$data['error_trend'] = $this->error['trend'];
		} else {
			$data['error_trend'] = '';
		}

		

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_town'])) {
			$url .= '&filter_town=' .$this->request->get['filter_town'];
		}

		if (isset($this->request->get['filter_country'])) {
			$url .= '&filter_country=' . $this->request->get['filter_country'];
		}

		if (isset($this->request->get['filter_trend'])) {
			$url .= '&filter_trend=' . $this->request->get['filter_trend'];
		}


		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('vacancy/vacancy', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		if (!isset($this->request->get['salon_id'])) {
			$data['action'] = $this->url->link('vacancy/vacancy/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$data['action'] = $this->url->link('vacancy/vacancy/edit', 'token=' . $this->session->data['token'] . '&salon_id=' . $this->request->get['salon_id'] . $url, 'SSL');
		}

		$data['cancel'] = $this->url->link('vacancy/vacancy', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['salon_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$salon_info = $this->model_vacancy_vacancy->getSalon($this->request->get['salon_id']);
		}

		$data['token'] = $this->session->data['token'];
		$data['ckeditor'] = $this->config->get('config_editor_default');

		$this->load->model('localisation/language');

		$data['languages'] = $this->model_localisation_language->getLanguages();

		$data['lang'] = $this->language->get('lang');

		if (isset($this->request->post['salon_description'])) {
			$data['salon_description'] = $this->request->post['salon_description'];
		} elseif (isset($this->request->get['salon_id'])) {
			$data['salon_description'] = $this->model_vacancy_vacancy->getSalonDescriptions($this->request->get['salon_id']);
		} else {
			$data['salon_description'] = array();
		}

		if (isset($this->request->post['image'])) {
			$data['image'] = $this->request->post['image'];
		} elseif (!empty($salon_info)) {
			$data['image'] = $salon_info['image'];
		} else {
			$data['image'] = '';
		}
		
		if (isset($this->request->post['longitude'])) {
			$data['longitude'] = $this->request->post['longitude'];
		} elseif (!empty($salon_info)) {
			$data['longitude'] = $salon_info['longitude'];
		} else {
			$data['longitude'] = '30.523400';
		}
		if (isset($this->request->post['latitude'])) {
			$data['latitude'] = $this->request->post['latitude'];
		} elseif (!empty($salon_info)) {
			$data['latitude'] = $salon_info['latitude'];
		} else {
			$data['latitude'] = '50.450100';
		}
		
		if (isset($this->request->post['sort_order'])) {
			$data['sort_order'] = $this->request->post['sort_order'];
		} elseif (!empty($salon_info)) {
			$data['sort_order'] = $salon_info['sort_order'];
		} else {
			$data['sort_order'] = '1';
		}

		$this->load->model('tool/image');

		if (isset($this->request->post['image']) && is_file(DIR_IMAGE . $this->request->post['image'])) {
			$data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);
		} elseif (!empty($salon_info) && is_file(DIR_IMAGE . $salon_info['image'])) {
			$data['thumb'] = $this->model_tool_image->resize($salon_info['image'], 100, 100);
		} else {
			$data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}

		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);

		if (isset($this->request->post['city_id'])) {
			$data['city_id'] = $this->request->post['city_id'];
		} elseif (!empty($salon_info)) {
			$data['city_id'] = $salon_info['city_id'];
		} else {
			$data['city_id'] = 0;
		}

		if (isset($this->request->post['country_id'])) {
			$data['country_id'] = $this->request->post['country_id'];
		} elseif (!empty($salon_info)) {
			$data['country_id'] = $salon_info['country_id'];
		} else {
			$data['country_id'] = 0;
		}

		$data['countries'] = $this->model_vacancy_vacancy->getCountries();
		$data['cities'] = $this->model_vacancy_vacancy->getCitiesByCountryId($data['country_id']);

		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($salon_info)) {
			$data['status'] = $salon_info['status'];
		} else {
			$data['status'] = true;
		}

		if (isset($this->request->post['trend'])) {
			$data['salon_trend'] = $this->request->post['trend'];
		} elseif (isset($this->request->get['salon_id'])) {
			$data['salon_trend'] = $this->model_vacancy_vacancy->getSalonTrends($this->request->get['salon_id']);
		} else {
			$data['salon_trend'] = array();
		}
		
		$filter_data = array(
			'sort'        => 'name',
			'order'       => 'ASC'
		);

		$data['trends'] = $this->model_vacancy_vacancy->getTrends();

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('vacancy/salon_form.tpl', $data));
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'vacancy/vacancy')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		foreach ($this->request->post['salon_description'] as $language_id => $value) {
			if ((utf8_strlen($value['name']) < 3) || (utf8_strlen($value['name']) > 255)) {
				$this->error['name'][$language_id] = $this->language->get('error_name');
			}
		}

		

		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}

		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'vacancy/vacancy')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

	public function autocomplete() {
		$json = array();

		if (isset($this->request->get['filter_name'])) {
			$this->load->model('vacancy/vacancy');
			

			if (isset($this->request->get['filter_name'])) {
				$filter_name = $this->request->get['filter_name'];
			} else {
				$filter_name = '';
			}

			if (isset($this->request->get['limit'])) {
				$limit = $this->request->get['limit'];
			} else {
				$limit = 5;
			}

			$filter_data = array(
				'filter_name'  => $filter_name,
				'start'        => 0,
				'limit'        => $limit
			);

			$results = $this->model_vacancy_vacancy->getSalons($filter_data);

			foreach ($results as $result) {
				$json[] = array(
					'name'       => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')),
					'salon_id' 	 => $result['salon_id'],
					'town'       => $result['town'],
					'country'    => $result['country'],
				);
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}