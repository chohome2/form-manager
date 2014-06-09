<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Form_Extra extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function data($type,$name)
    {
        $data = array();
        if($type == '1')
            $data = explode(",",$this->form_field_model->getFormExtraData($name));
        echo json_encode(array('data' => $data));
    }

}