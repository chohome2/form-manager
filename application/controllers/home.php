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
        $account = $this->session->userdata('logged_in');
        $data = array(
            'status' => '미처리',
            'form_data' => $this->form_data_model->getFormDatasWithStatus($this->account_model->getAccountRolesWithRole('열람',$account['id']),'미처리')
        );
        $this->load_view('main_list',$data);
	}

    public function check()
    {
        $account = $this->session->userdata('logged_in');
        $data = array(
            'status' => '확인',
            'form_data' => $this->form_data_model->getFormDatasWithStatus($this->account_model->getAccountRolesWithRole('열람',$account['id']),'확인')
        );
        $this->load_view('main_list',$data);
    }

    public function complete()
    {
        $account = $this->session->userdata('logged_in');
        $data = array(
            'status' => '처리',
            'form_data' => $this->form_data_model->getFormDatasWithStatus($this->account_model->getAccountRolesWithRole('열람',$account['id']),'처리')
        );
        $this->load_view('main_list',$data);
    }

}