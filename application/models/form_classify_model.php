<?php
class Form_Classify_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    function getFormClassify() {
        $this->db->from('fm_form_classify');
        $query = $this->db->get();

        return $query;
    }

    function addFormClassify($name) {
        $this->db->insert('fm_form_classify',array('name' => $name));
    }
}
?>