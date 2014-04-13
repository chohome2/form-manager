<?php
class Form_Field_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    function getFormField() {
        $this->db->from('fm_form_field');
        $query = $this->db->get();

        return $query;
    }

}
?>