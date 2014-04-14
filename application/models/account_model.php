<?php
class Account_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    function isExistAccount($id, $pw) {
        $this->db->from('fm_account')->where(array('account_id' => $id, 'account_pw' => $pw));
        $query = $this->db->get();

        if($query->num_rows() == 1) return $query->result();
        return false;
    }

    function insertAccount($data) {
        $this->db->insert('fm_account', $data);
        return $this->db->insert_id();
    }

    function insertAccountRole($data) {
        $this->db->insert('fm_account_role', $data);
        return false;
    }

    function getAccount($id) {
        $query = $this->db->get_where('fm_account',array('id' => $id));
        foreach($query->result() as $row)
            return $row;
    }

    function getAccounts() {
        $this->db->from('fm_account');
        $query = $this->db->get();

        return $query;
    }

    function getAccountRole($id) {
        $ret = array();
        $query = $this->db->get_where('fm_account_role',array('account_id' => $id));
        foreach($query->result() as $row)
            $ret[$row->form_id."\t".$row->role] = 1;
        return $ret;
    }

    function getAccountRolesWithRole($role,$id) {
        $ret = array();
        $query = $this->db->get_where('fm_account_role',array('role' => $role,'account_id' => $id));
        foreach($query->result() as $row)
            array_push($ret,$row->form_id);
        return $ret;
    }

    function getAccountRoles() {
        $this->db->from('fm_account_role');
        $query = $this->db->get();

        return $query;
    }

    function updateAccount($id,$data) {
        $this->db->where('id', $id);
        $this->db->update('fm_account', $data);
    }

    function deleteAccountRole($id) {
        $this->db->delete('fm_account_role', array('account_id' => $id));
    }

    function isRole($role,$id) {
        $account = $this->session->userdata('logged_in');
        $this->db->where(array('role' => $role,'form_id' => $id,'account_id' => $account['id']));
        $this->db->from('fm_account_role');
        return $this->db->count_all_results();
    }
}
?>