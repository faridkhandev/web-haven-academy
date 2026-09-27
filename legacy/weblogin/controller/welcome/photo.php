<?php
class ControllerWelcomePhoto extends Controller {
	private $error = array(); 
	 
	public function index() {   
		$this->language->load('welcome/photo');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
		$this->document->addStyle('view/stylesheet/faq.css');
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            if(!empty($this->request->post['video_module']['sections'])){
                foreach($this->request->post['video_module']['sections'] as &$section){
                    if(!isset($section['id']) || !$section['id']){
                        $section['id'] = uniqid();
                    }
                }
            }
            
			$this->model_setting_setting->editSetting('video', $this->request->post);		
			
			$this->session->data['success'] = $this->language->get('text_success');
			
			$this->response->redirect($this->url->link('welcome/photo', 'token=' . $this->session->data['token'], 'SSL'));			
		}
		
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
		
		$data['action'] = $this->url->link('welcome/photo', 'token=' . $this->session->data['token'], 'SSL');
			
        $front_url = new Url(HTTP_CATALOG, $this->config->get('config_secure') ? HTTP_CATALOG : HTTPS_CATALOG);
        $data['token'] = $this->session->data['token'];
	
		if (isset($this->request->post['video_module'])) {
			$data['module'] = $this->request->post['video_module'];
		} elseif ($this->config->get('video_module')) { 
			$data['module'] = $this->config->get('video_module');
		}	
        
        if(isset($data['module']['sections']) && !empty($data['module']['sections'])){
            $this->sortData($data['module']['sections'], 'order');
        }
        if(isset($data['module']['items']) && !empty($data['module']['items'])){
            $this->sortData($data['module']['items'], 'order');
        }
		
		$data['heading_title'] = $this->language->get('heading_title');
		// Languages
		$this->load->model('localisation/language');
		$data['languages'] = $this->model_localisation_language->getLanguages();
		
		$data['breadcrumbs'] = array();
		
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);
		
		$data['breadcrumbs'][] = array(
			'text' => 'Photo Zoon',
			'href' => $this->url->link('welcome/photo', 'token=' . $this->session->data['token'], 'SSL')
		);
				
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
        $data['current_lang_id'] = $this->config->get('config_language_id');
		
		$this->response->setOutput($this->load->view('welcome/photo.tpl', $data));
	}
	
	protected function validate() {
		if (!$this->user->hasPermission('modify', 'welcome/photo')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
        // Languages
		$this->load->model('localisation/language');
        $languages = $this->model_localisation_language->getLanguages();
        
        if(!empty($this->request->post['video_module']['sections'])){
            foreach($this->request->post['video_module']['sections'] as $section){
                foreach($languages as $lang){
                    if(trim($section['title'][$lang['language_id']]) == ''){
                        $this->error['warning'] = "Section title cannot be empty"; 
                    }
                }
            }
        }
		
		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}
    
    function sortData(&$data, $col)
    {
        usort($data, function($a, $b) use ($col){
            if ($a[$col] == $b[$col]) {
                return 0;
            }
            return ($a[$col] < $b[$col]) ? -1 : 1;
        });
    }
}
?>