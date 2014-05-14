<?php
class Sms_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    function insertSmsData($phoneList,$message) {
        $smsDB = $this->load->database('sms', TRUE);
        $data = array(
            "tran_phone"=>"",
            "tran_callback"=>"010-0000-0000",
            "tran_status"=>"1",
            "tran_date"=>date('Y-m-d H:i:s'),
            "tran_msg"=>$message,
            "tran_type"=>"4"
        );
        foreach($phoneList as $phone) {
            $data['tran_phone'] = $phone;
            $smsDB->insert('em_tran', $data);
        }
    }
}
?>