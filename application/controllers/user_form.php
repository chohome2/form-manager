<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_Form extends CI_Controller {
    public function main_center()
    {
        $this->load->view('user_form_main');
    }

    public function university()
    {
        $this->load->view('user_form_university');
    }

    public function inquiry()
    {
        $this->load->view('user_form_request');
    }

    public function regist()
    {
        $this->load->model('form_data_model','',TRUE);
        $data = array(
            'form_id' => $this->input->post('form_id'),
            'form_name' => $this->input->post('form_name'),
            'form_template' => $this->input->post('form_template'),
            'regist_date' => date('Y-m-d H:i:s'),
            'confirm_date' => null,
            'process_status' => '미처리',
            'pay_ok' => 1,
            'pay_status' => '입금대기',
            'pay_method' => $this->input->post('pay_method'),
            'pay_info' => '',
            'user_name' => $this->input->post('user_name'),
            'phone' => $this->input->post('phone'),
            'email' => $this->input->post('email'),
            'sms_ok' => $this->input->post('sms_ok'),
            'email_ok' => $this->input->post('smsnumber2'),
            'classify' => $this->input->post('classify'),
            'gender' => $this->input->post('gender'),
            'birth' => $this->input->post('birth'),
            'school' => $this->input->post('school'),
            'major' => $this->input->post('major'),
            'inquiry_text' => $this->input->post('inquiry_text')
        );
        $this->form_data_model->insertFormData($data);
        echo 'success!!';
    }
}