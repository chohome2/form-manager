<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Form extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in'))
            redirect('/login','redirect');
    }

    public function index()
    {
        $this->load_view('form_list');
    }

    public function setting($id)
    {
        $this->load->helper(array('form'));

        if($id != "new" && !$this->account_model->isRole('폼설정',$id)) {
            $this->load_view('no_role');
            return;
        }

        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', 'Username', 'trim|required|xss_clean');


        if($this->form_validation->run() == FALSE)
        {
            $data = array(
                'id' => $id,
                'classify_list' => $this->form_classify_model->getFormClassify(),
                'field_list' => $this->form_field_model->getFormField()
            );
            if($id != 'new') {
                $data['form'] = $this->form_model->getForm($id);
            }

            $this->load_view('form_setting',$data);
        }
        else
        {
            $data = array(
                'name' => $this->input->post('name'),
                'template' => $this->input->post('template'),
                'classify' => $this->input->post('classify'),
                'used_fields' => $this->makeCSV($this->input->post('use_field')),
                'view_fields' => $this->makeCSV($this->input->post('view_field')),
                'is_send_sms_to_user' => $this->input->post('smsok1'),
                'is_send_sms_to_admin' => $this->input->post('smsok2'),
                'is_send_email_to_user' => $this->input->post('mailok1'),
                'is_send_email_to_admin' => $this->input->post('mailok2'),
                'sms_content_to_user' => $this->input->post('smstext1'),
                'sms_number_to_user' => $this->input->post('smsnumber1'),
                'sms_content_to_admin' => $this->input->post('smstext2'),
                'sms_number_to_admin' => $this->input->post('smsnumber2'),
                'email_content_to_user' => $this->input->post('mailtext1'),
                'email_address_to_user' => $this->input->post('mailmail1'),
                'email_name_to_user' => $this->input->post('mailname1'),
                'email_content_to_admin' => $this->input->post('mailtext2'),
                'email_address_to_admin' => $this->input->post('mailmail2'),
                'user_email_template_id' => 1,//TODO template처리
                'admin_email_template_id' => 1,
                'is_use_pay' => $this->input->post('ispay')?1:0,
                'pay_account' => $this->input->post('payaccount')
            );

            $this->form_model->upsertForm($data,$id);
            redirect('form/setting_ok','refresh');
        }
    }

    public function setting_ok()
    {
        $this->load_view('form_submit_ok',array("message"=>"폼 설정이 완료되었습니다.","path"=>"/form"));
    }


    public function field()
    {
        $this->load_view('form_field');
    }

    public function addClassify($name)
    {
        $this->form_classify_model->addFormClassify(urldecode($name));
    }

    private function makeCSV($data) {
        $ret = '';
        foreach($data as $value) {
            $ret .= $value."\t";
        }
        return substr($ret,0,-1);
    }
}