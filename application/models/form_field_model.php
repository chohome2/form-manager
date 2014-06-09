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

    function getFormExtra() {
        $this->db->from('fm_form_extra');
        $query = $this->db->get();
        $data = array();
        foreach($query->result() as $row) {
            $data[$row->name] = $row->value;
        }
        return $data;
    }
    function updateFormExtra($name,$value) {
        $this->db->where('name', $name);
        $this->db->update('fm_form_extra', array("value" => $value));
    }

    function getFormExtraData($name) {
        $query = $this->db->get_where('fm_form_extra',array('name' => $name));
        foreach($query->result() as $row)
            return $row->value;
    }
}
?>