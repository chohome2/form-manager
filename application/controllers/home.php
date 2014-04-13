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
        $this->load_view('main');
	}

}