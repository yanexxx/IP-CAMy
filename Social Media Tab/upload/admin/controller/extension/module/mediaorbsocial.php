<?php
class ControllerExtensionModuleMediaorbsocial extends Controller {
	public function index() {
		if (isset($this->request->get['user_token']) && isset($this->session->data['user_token']) && ($this->request->get['user_token'] == $this->session->data['user_token'])) {

			// Load the localisation
			$this->load->language('extension/module/mediaorbsocial');

			// Set the meta title attribute


			// Load the page text from the local language file
			$data['heading']			= $this->language->get('heading_title');
			$data['succes']				= $this->language->get('text_success');
			$data['edit']					= $this->language->get('text_edit');
			$data['about']				= $this->language->get('desc_about');
			$data['example']			= $this->language->get('desc_example');
			$data['error']				= $this->language->get('error_permission');

			// Load the text and links for the top of page buttons
			$data['cancel'] 			= $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true);
			$data['btn_cancel']		= $this->language->get('button_cancel');
			$data['btn_save']			= $this->language->get('button_save');

			// Load the entry text
			$data['status']				= $this->language->get('entry_status');
			$data['location']			= $this->language->get('entry_location');
			$data['appearance']		= $this->language->get('entry_type');
			$data['facebook']			= $this->language->get('entry_facebook');
			$data['twitter']			= $this->language->get('entry_twit');
			$data['instagram']		= $this->language->get('entry_instagram');

			// Load any descriptive or tooltip text
			$data['desc_location']= $this->language->get('desc_location');
			$data['desc_appear']	= $this->language->get('desc_appearance');

			// Load placeholder text for input
			$data['placeholder_enabled']		= $this->language->get('status_enabled');
			$data['placeholder_disabled']		= $this->language->get('status_disabled');

			// Load the headers, footers and left menu
			$data['header'] 			= $this->load->controller('common/header');
			$data['column_left'] 	= $this->load->controller('common/column_left');
			$data['footer'] 			= $this->load->controller('common/footer');

			// Get a list of the possible locations links can be placed
			$locArray							= $this->language->get('locations');
			$apArray							= $this->language->get('appearance');

			//
			$data['locArray'] 		= $locArray;
			$data['apArray']			= $apArray;

			// Set the output
			$this->response->setOutput($this->load->view('extension/module/mediaorbsocial', $data));
		}
	}
	protected function install() {
		// Edit permissions to allow admins to view and use the plugin
		$this->load->model('user/user_group');
		$this->model_user_user_group->addPermission($this->user->getId(), 'access', 'extension/module/mediaorbsocial');
		$this->model_user_user_group->addPermission($this->user->getId(), 'modify', 'extension/module/mediaorbsocial');
	}
}
