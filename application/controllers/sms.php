<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sms extends CI_Controller {

    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
            $data = array(
                "form_list" => $this->form_model->getFormsByRole("sms발송"),
                "classify_list" => $this->form_classify_model->getFormClassify()
            );
            //$this->sms_model->insertSmsData(array("12345","56789"),"message message");
            $this->load_view('sms',$data);
    }

    function getPhoneNumbers()
    {
        $form_id = $_GET['form_id'];
        $classify =  $_GET['classify'];
        $agree =  $_GET['agree'];
        $rows = $this->form_data_model->getFormDatasWithSms($form_id,$classify,$agree);
        $data = array();
        foreach($rows->result() as $row) {
            if($row->phone)
                $data[] = $row->phone;
        }
        echo json_encode(array("data"=>$data));
    }

    function sendSms()
    {
        $phoneList = $_POST['phone_list'];
        $message = $_POST['message'];
        $this->sms_model->insertSmsData($phoneList,$message);
        echo "success";
    }
}

?>

