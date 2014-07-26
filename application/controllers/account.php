<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in'))
            redirect('/login','redirect');
    }

    public function index()
    {
        $account = $this->session->userdata('logged_in');
        if($account['account_id'] != 'admin') {
            $this->load_view('no_role');
            return;
        }

        $data = array(
            'account_role_list' => $this->account_model->getAccountRoles(),
            'account_list' => $this->account_model->getAccounts()
        );
        $this->load_view('account_list',$data);
    }

    public function setting($id)
    {
        $account = $this->session->userdata('logged_in');
        if($account['account_id'] != 'admin') {
            $this->load_view('no_role');
            return;
        }

        $this->load->helper(array('form'));

        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', 'Username', 'trim|required|xss_clean');


        if($this->form_validation->run() == FALSE)
        {
            $data = array(
                'id' => $id,
                'form' => $this->form_model->getAllForm()
            );
            if($id != 'new') {
                $data['account'] = $this->account_model->getAccount($id);
                $data['account_role'] = $this->account_model->getAccountRole($id);
            }
            $this->load_view('account_data',$data);
        }
        else {
            $data = array(
                'account_id' => $this->input->post('account_id'),
                'account_pw' => $this->input->post('account_pw'),
                'name' => $this->input->post('name'),
                'department' => $this->input->post('department'),
                'phone' => $this->input->post('phone'),
                'email' => $this->input->post('email')
            );
            if($id == 'new') {
                $account_id = $this->account_model->insertAccount($data);

            }
            else {
                $this->account_model->updateAccount($id,$data);
                $this->account_model->deleteAccountRole($id);
                $account_id = $id;
            }

            foreach($this->input->post('role') as $value) {
                list($form_id,$form_name,$role) = explode("\t",$value);
                $data = array(
                    'form_id' => $form_id,
                    'form_name' => $form_name,
                    'account_id' => $account_id,
                    'role' => $role
                );
                $this->account_model->insertAccountRole($data);
            }
            redirect('account/setting_ok','refresh');
        }

    }

    public function setting_ok()
    {
        $this->load_view('account_setting_ok');
    }

    public function modify($account_id)
    {
        $this->load_view('account_data');
    }

    public function logout()
    {
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('id');
        redirect('/login', 'refresh');
    }
}