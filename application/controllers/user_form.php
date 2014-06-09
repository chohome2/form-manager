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
        $data = array();
//TODO 아래처럼 데이터 받는건 임시, 테이블 필드 하나하나 수동으로 받아야 함
        foreach($this->input->post() as $key => $val)
        {
            $data[$key] = $val;
        }

        if(!isset($data['form_id'])) {
            echo 'fail';
            return;
        }

        $form = $this->form_model->getForm($data['form_id']);

        $data['form_name'] = $form->name;
        $data['form_template'] = $form->template;
        $data['classify'] = $form->classify;
        $data['regist_date'] = date('Y-m-d H:i:s');
        $data['process_status'] = '미처리';
        $data['is_delete'] = 0;
        $this->form_data_model->insertFormData($data);

        //가입 이메일 유저에게 보내기
        if($form->is_send_email_to_user == 1 && isset($data['email']) && isset($data['email_ok']) && $data['email_ok'] == 1) {
            $content = str_replace('[NAME]',$data['user_name'],$form->email_content_to_user);
            $this->email_model->sendEmail($form->user_email_template_id,$content,$data['email'],$form->email_name_to_user,$form->email_address_to_user);
        }

        //가입 문자 유저에게 보내기
        if($form->is_send_sms_to_user == 1 && isset($data['phone']) && isset($data['sms_ok']) && $data['sms_ok'] == 1) {
            $content = str_replace('[NAME]',$data['user_name'],$form->sms_content_to_user);
            $this->sms_model->insertSmsData(array($data['phone']),$content,$form->sms_number_to_user);
        }
//TODO 가입문자 어드민에게 보내기 구현

        echo 'success';
    }

    public function regist_rest()
    {
        $data = array();

        foreach($this->input->post() as $key => $val)
        {
            $data[$key] = $val;
        }
        echo $this->CallAPI("POST","http://localhost/user_form/regist",$data);
        //$this->form_data_model->insertFormData($data);

        //echo 'success!!';
    }


    private function CallAPI($method, $url, $data = false)
    {
        $curl = curl_init();

        switch ($method)
        {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);

                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_PUT, 1);
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }

        // Optional Authentication:
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, "username:password");

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        return curl_exec($curl);
    }
}