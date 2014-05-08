<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class VerifyFormCreate extends CI_Controller {

    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        //This method will have the credentials validation
        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', 'Username', 'trim|required|xss_clean');


        if($this->form_validation->run() == FALSE)
        {
            //$this->load_view('form_setting');
            redirect('form/setting','refresh');
        }
        else
        {
            redirect('form/setting_ok','refresh');
        }

    }


}
?>
