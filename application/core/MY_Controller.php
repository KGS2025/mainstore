<?php
class MY_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->model(array('comman_model'));
		$commission_trial = $this->config->item('commission_trial');
		$commission_term_status = $this->config->item('commission_term_status');



		if ($commission_trial == "0" && $commission_term_status == "0") {
				$pageData = array(
				'all_data'                   => allDataArray($this->comman_model->GetAllDataLangByid('home_page', 'id', 1, $this->lang->default_lang_id, 'home_page_country')),
				'general_instruction'       => (object)get_user_lang_data(array('general_instruction'), $this->lang->default_lang_id)['general_instruction'],
				'page_title'       => (object)get_user_lang_data(array('page_title'), $this->lang->default_lang_id)['page_title']

				);
			echo $this->load->view('elements/termexpired',$pageData,true);
			exit;
		}

	}
}
