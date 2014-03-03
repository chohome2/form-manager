<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller {
    public function index()
    {
        $this->load->view('header');
        $this->load->view('account_list');
        $this->load->view('footer');
    }

    public function create()
    {
        $this->load->view('header');
        $this->load->view('account_data');
        $this->load->view('footer');
    }

    public function modify($account_id)
    {
        $this->load->view('header');
        $this->load->view('account_data');
        $this->load->view('footer');
    }
}