<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Form extends CI_Controller {
    public function index()
    {
        $this->load->view('header');
        $this->load->view('form_list');
        $this->load->view('footer');
    }

    public function setting()
    {
        $this->load->view('header');
        $this->load->view('form_setting');
        $this->load->view('footer');
    }

    public function field()
    {
        $this->load->view('header');
        $this->load->view('form_field');
        $this->load->view('footer');
    }
}