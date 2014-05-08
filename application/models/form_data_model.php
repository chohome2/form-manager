<?php
class Form_Data_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    function insertFormData($data) {
        $this->db->insert('fm_form_data', $data);
        return false;
    }

    function getFormDatasWithStatus($roles,$status) {
        $this->db->from('fm_form_data');
        $this->db->where('process_status',$status);
        $this->db->where_in('form_id',$roles);
        $this->db->order_by('regist_date','desc');
        $query = $this->db->get();

        return $query;
    }

    function getFormData($id) {
        $query = $this->db->get_where('fm_form_data',array('id' => $id));
        foreach($query->result() as $row)
            return $row;
    }

    function getFormDataWithFormId($id) {
        return $this->db->get_where('fm_form_data',array('form_id' => $id));
    }

    function updateFormData($id,$data) {
        $this->db->where('id', $id);
        $this->db->update('fm_form_data', $data);
    }

    function getInquiryDataWithEmail($email) {
        return $this->db->get_where('fm_form_data',array('email' => $email, 'form_template' => 2));
    }
}
?>