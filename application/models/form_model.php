<?php
class Form_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    function insertForm($data) {
        $this->db->insert('fm_form', $data);
        return false;
    }

    function getForm($id) {
        $query = $this->db->get_where('fm_form',array('id' => $id));
        foreach($query->result() as $row)
            return $row;
    }
}
?>