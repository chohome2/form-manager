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

        foreach($this->input->post() as $key => $val)
        {
            $data[$key] = $val;
        }

        $this->form_data_model->insertFormData($data);
        echo 'rest success!!';
    }

    public function regist_rest()
    {
        $data = array();

        foreach($this->input->post() as $key => $val)
        {
            $data[$key] = $val;
        }
        //TODO 기본 필드 채우기(상태, 등록날짜 등등)
        $this->CallAPI("POST","http://localhost/user_form/regist",$data);
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