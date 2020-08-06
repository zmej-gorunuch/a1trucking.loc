<?php

class ControllerExtensionModulePartnershipPartnership extends Controller {
    public function index() {
        
        $this->load->model( 'extension/module/partnership' );
        $this->load->language( 'extension/module/partnership' );
        
        $data['breadcrumbs'] = [];
        
        $data['breadcrumbs'][] = [
            'text' => $this->language->get( 'text_home' ),
            'href' => $this->url->link( 'common/home' ),
        ];
        
        $this->document->setTitle( $this->language->get( 'meta_title' ) );
        $this->document->setDescription( $this->language->get( 'meta_desc' ) );
        $this->document->setKeywords( $this->language->get( 'meta_keyword' ) );
        $this->document->addLink( $this->url->link( 'extension/module/partnership' ), '' );
        
        $data['heading_title']      = $this->language->get( 'heading_title' );
        $data['partnerships_empty'] = $this->language->get( 'partnerships_empty' );
        
        $data['breadcrumbs'][] = [
            'text' => $this->language->get( 'heading_title' ),
            'href' => $this->url->link( 'extension/module/partnership' ),
        ];
        
        $results = $this->model_extension_module_partnership->getPartnerships();
        
        foreach ( $results as $result ) {
            $data['partnerships'][] = [
                'id'          => $result['id'],
                'category_id' => null,
                'category'    => null,
                'title'       => $result['title'],
                'href'        => $this->url->link( 'extension/module/partnership/download', 'download_id=' . $result['id'], true ),
            ];
        }
        
        $data['column_left']    = $this->load->controller( 'common/column_left' );
        $data['column_right']   = $this->load->controller( 'common/column_right' );
        $data['content_top']    = $this->load->controller( 'common/content_top' );
        $data['content_bottom'] = $this->load->controller( 'common/content_bottom' );
        $data['footer']         = $this->load->controller( 'common/footer' );
        $data['header']         = $this->load->controller( 'common/header' );
        
        $this->response->setOutput( $this->load->view( 'extension/module/partnership/partnership', $data ) );
    }
}