<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $this->load->helper(array('form'));
        $this->load->model('account_model','',TRUE);
        $this->load->library('form_validation');

        $this->form_validation->set_rules('account_id', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('account_pw', 'Password', 'trim|required|xss_clean|callback_check_database');

        if($this->form_validation->run() == FALSE)
        {
            //Field validation failed.&nbsp; User redirected to login page
            $this->load->view('login');
        }
        else
        {
            redirect('/', 'refresh');
        }

    }

    function check_database($password)
    {
        //Field validation succeeded.&nbsp; Validate against database
        $username = $this->input->post('account_id');

        //query the database
        $result = $this->account_model->isExistAccount($username, $password);

        if($result)
        {
            foreach($result as $row)
            {
                $sess_array = array(
                    'account_id' => $row->account_id,
                    'name' => $row->name
                );
                $this->session->set_userdata('logged_in', $sess_array);
            }
            return TRUE;
        }
        else
        {
            $this->form_validation->set_message('check_database', '등록된 사용자가 아닙니다.');
            return false;
        }
    }

}

?>

