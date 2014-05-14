<?php
class Form_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    function upsertForm($data,$id) {
        if($id == 'new') {
            $this->db->insert('fm_form', $data);
        }
        else {
            $this->db->where('id', $id);
            $this->db->update('fm_form', $data);
        }
        return false;
    }

    function getForm($id) {
        $query = $this->db->get_where('fm_form',array('id' => $id));
        foreach($query->result() as $row)
            return $row;
    }

    function getAllForm() {
        $this->db->from('fm_form');
        $query = $this->db->get();
        return $query;
    }

    function getFormsByRole($role) {
        $account = $this->session->userdata('logged_in');
        $this->db->from('fm_form');
        $this->db->join('fm_account_role','fm_account_role.form_id = fm_form.id');
        $this->db->where('account_id',$account['id']);
        $this->db->where('role',$role);
        $query = $this->db->get();
        return $query;
    }
}
?>