<?php
class Form_Classify_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    function getFormClassify($id) {
        $this->db->from('fm_form_classify');
        $this->db->where('form_id',$id);
        $query = $this->db->get();

        return $query;
    }

    function addFormClassify($name, $id) {
        $this->db->insert('fm_form_classify',array('name' => $name, 'form_id' => $id));
    }
}
?>