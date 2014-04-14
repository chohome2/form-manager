<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in'))
            redirect('/login','redirect');
    }

    public function index()
	{
        $this->load->model('form_data_model','',TRUE);
        $this->load->model('account_model','',TRUE);

        echo 1111;
        $account = $this->session->userdata('logged_in');
        $data = array(
            'form_data' => $this->form_data_model->getFormDatas($this->account_model->getAccountRolesWithRole('열람',$account['id']))
        );
        $this->load_view('main',$data);
	}

}