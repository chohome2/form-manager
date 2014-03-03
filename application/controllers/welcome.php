<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
        $this->load->model('account_model');
        //echo $this->account_model->isExistAccount('admin','admin');

        $this->load->view('header');
        $this->load->view('main');
        $this->load->view('footer');
	}
}