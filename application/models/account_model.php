<?php
class Account_model extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    function isExistAccount($id, $pw) {
        $this->db->from('fm_account')->where(array('account_id' => $id, 'account_pw' => $pw));
        $query = $this->db->get();

        if($query->num_rows() == 1) return true;
        return false;
    }
}
?>