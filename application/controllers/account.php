<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller {
    public function index()
    {
        $this->load_view('account_list');
    }

    public function create()
    {
        $this->load_view('account_data');
    }

    public function modify($account_id)
    {
        $this->load_view('account_data');
    }

    public function logout()
    {
        $this->session->unset_userdata('logged_in');
        redirect('/login', 'refresh');
    }
}