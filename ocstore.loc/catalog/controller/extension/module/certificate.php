<?php
class ControllerExtensionModuleCertificate extends Controller
{
    public function index()
    {
        $this->load->model('extension/module/certificate');
        $this->load->language('extension/module/certificate');

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        $this->document->setTitle($this->language->get('meta_title'));
        $this->document->setDescription($this->language->get('meta_desc'));
        $this->document->setKeywords($this->language->get('meta_keyw'));
        $this->document->addLink($this->url->link('extension/module/certificate'),'');
        $this->document->addStyle('catalog/view/theme/default/stylesheet/collapse.css');
        $this->document->addScript('catalog/view/javascript/collapse.js');

        $data['heading_title'] = $this->language->get('heading_title');
        $data['questions_empty'] = $this->language->get('questions_empty');
        $data['answer_empty'] = $this->language->get('answer_empty');

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('extension/module/certificate')
        );

        $data['cat_answers'] = $this->model_extension_module_certificate->getCatAnswers();
        $data['answers'] = $this->model_extension_module_certificate->getNoCatAnswer();

        $data['column_left'] = $this->load->controller('common/column_left');
        $data['column_right'] = $this->load->controller('common/column_right');
        $data['content_top'] = $this->load->controller('common/content_top');
        $data['content_bottom'] = $this->load->controller('common/content_bottom');
        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');

        $this->response->setOutput($this->load->view('extension/module/certificate', $data));
    }
}