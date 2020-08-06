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
        $data['certificates_empty'] = $this->language->get('certificates_empty');
        $data['certificate_empty'] = $this->language->get('certificate_empty');

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('extension/module/certificate')
        );
	
		$data['certificates'] = array();
  
		$results_cat_certificates = $this->model_extension_module_certificate->getCatCertificates();
		
		var_dump($results_cat_certificates);
	
		foreach ($results_cat_certificates as $result_cat_certificates) {
			if (file_exists(DIR_DOWNLOAD . $result_cat_certificates['filename'])) {
				$size = filesize(DIR_DOWNLOAD . $result_cat_certificates['filename']);
			
				$i = 0;
			
				$suffix = array(
					'B',
					'KB',
					'MB',
					'GB',
					'TB',
					'PB',
					'EB',
					'ZB',
					'YB'
				);
			
				while (($size / 1024) > 1) {
					$size = $size / 1024;
					$i++;
				}
				
				$data['certificates'][] = array(
					'id'  => $result_cat_certificates['id'],
					'category_id' => $result_cat_certificates['category_id'],
					'category'   => $result_cat_certificates['category'],
					'title'      => $result_cat_certificates['title'],
					'filename'   => $result_cat_certificates['filename'],
					'size'       => round(substr($size, 0, strpos($size, '.') + 4), 2) . $suffix[$i],
					'href'       => $this->url->link('extension/module/certificate/download', 'download_id=' . $result_cat_certificates['id'], true)
				);
			}
		}
		
		$results = $this->model_extension_module_certificate->getNoCatCertificate();
	
		foreach ($results as $result) {
			if (file_exists(DIR_DOWNLOAD . $result['filename'])) {
				$size = filesize(DIR_DOWNLOAD . $result['filename']);
			
				$i = 0;
			
				$suffix = array(
					'B',
					'KB',
					'MB',
					'GB',
					'TB',
					'PB',
					'EB',
					'ZB',
					'YB'
				);
			
				while (($size / 1024) > 1) {
					$size = $size / 1024;
					$i++;
				}
			
				$data['certificates'][] = array(
					'id'  => $result['id'],
					'category_id'  => null,
					'category'   => null,
					'title'      => $result['title'],
					'filename'   => $result['filename'],
					'size'       => round(substr($size, 0, strpos($size, '.') + 4), 2) . $suffix[$i],
					'href'       => $this->url->link('extension/module/certificate/download', 'download_id=' . $result['id'], true)
				);
			}
		}

        $data['column_left'] = $this->load->controller('common/column_left');
        $data['column_right'] = $this->load->controller('common/column_right');
        $data['content_top'] = $this->load->controller('common/content_top');
        $data['content_bottom'] = $this->load->controller('common/content_bottom');
        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');

        $this->response->setOutput($this->load->view('extension/module/certificate', $data));
    }
	
	public function download() {
		$this->load->model('account/download');
		
		if (isset($this->request->get['download_id'])) {
			$download_id = $this->request->get['download_id'];
		} else {
			$download_id = 0;
		}
		
		$this->load->model('extension/module/certificate');
		
		$download_info = $this->model_extension_module_certificate->getDownload($download_id);
		
		if ($download_info) {
			$file = DIR_DOWNLOAD . $download_info[0]['filename'];
//			$mask = basename($download_info['mask']);
			
			if (!headers_sent()) {
				if (file_exists($file)) {
					header('Content-Type: application/octet-stream');
					header('Content-Disposition: attachment; filename="' . (basename($file)) . '"');
					header('Expires: 0');
					header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
					header('Pragma: public');
					header('Content-Length: ' . filesize($file));
					
					if (ob_get_level()) {
						ob_end_clean();
					}
					
					readfile($file, 'rb');
					
					exit();
				} else {
					exit('Error: Could not find file ' . $file . '!');
				}
			} else {
				exit('Error: Headers already sent out!');
			}
		} else {
			$this->response->redirect($this->url->link('extension/module/certificate', '', true));
		}
	}
}