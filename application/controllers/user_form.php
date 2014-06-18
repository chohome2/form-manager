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

    public function local()
    {
        $this->load->view('user_form,_local');
    }

    public function form_data() {
        $data = array(
            'form_id' => $_GET['form_id'],
            'user_name' => $_GET['user_name'],
            'email' => $_GET['email'],
            'phone' => $_GET['phone']
        );
/*
        $data = array(
            'form_id' => '1',
            'user_name' => '조태호',
            'email' => 'chohome2@gmail.com',
            'phone' => '010-9820-6402'
        );
*/
        $form_data = $this->form_data_model->getFormDataWithData($data);

        echo json_encode($form_data);
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


        //지역 수련 담당자 전화번호 목록 필드가 존재하는 경우, 체크코드값을 발급하고 확인 링크를 문자로 보낸다.
        $check_code = uniqid();
        if(isset($data['local_phone_list'])) {
            $check_code = substr($check_code,12,1).substr($check_code,0,1).substr($check_code,11,1).substr($check_code,1,1).substr($check_code,10,1).substr($check_code,2,1)
                .substr($check_code,9,1).substr($check_code,3,1).substr($check_code,6,1).substr($check_code,4,1).substr($check_code,7,1).substr($check_code,5,1).substr($check_code,8,1);

            $data['check_code'] = $check_code;
        }
        $this->form_data_model->insertFormData($data);


        if(isset($data['local_phone_list'])) {
            $phone_list = explode(',',$data['local_phone_list']);
            foreach($phone_list as $phone) {
                $content = '링크누르세요. http://chk.maum.org/?c='.$check_code;
                $this->sms_model->insertSmsData(array($phone),$content);
            }
        }
//TODO 문자, 메일 보낼때 치환코드 사용로직 추가
        //가입 이메일 유저에게 보내기
        if($form->is_send_email_to_user == 1 && isset($data['email']) /*&& isset($data['email_ok']) && $data['email_ok'] == 1*/) {
            $content = str_replace('[NAME]',$data['user_name'],$form->email_content_to_user);
            $this->email_model->sendEmail($form->user_email_template_id,$content,array($data['email']),$form->email_name_to_user,$form->email_address_to_user);
        }

        //가입 이메일 관리자에게 보내기
        if($form->is_send_email_to_admin == 1) {
            $content = str_replace('[NAME]',$data['user_name'],$form->email_content_to_admin);
            $this->email_model->sendEmail($form->admin_email_template_id,$content,array($form->email_address_to_admin),$form->email_name_to_user,$form->email_address_to_user);
        }

        //가입 문자 유저에게 보내기
        if($form->is_send_sms_to_user == 1 && isset($data['phone']) /*&& isset($data['sms_ok']) && $data['sms_ok'] == 1*/) {
            $content = str_replace('[NAME]',$data['user_name'],$form->sms_content_to_user);
            $this->sms_model->insertSmsData(array($data['phone']),$content,$form->sms_number_to_user);
        }
        //가입 문자 어드민에게 보내기
        if($form->is_send_sms_to_admin == 1) {
            $content = str_replace('[NAME]',$data['user_name'],$form->sms_content_to_admin);
            $this->sms_model->insertSmsData(array($form->sms_number_to_admin),$content);
        }
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