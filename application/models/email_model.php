<?php
class Email_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    function getEmailTemplate($id) {
        $query = $this->db->get_where('fm_email_template',array('id' => $id));
        foreach($query->result() as $row)
            return $row;
    }

    function getAllEmailTemplates() {
        $this->db->from('fm_email_template');
        $query = $this->db->get();
        return $query;
    }

    function upsertTemplate($data,$id) {
        if($id == 'new') {
            $this->db->insert('fm_email_template', $data);
        }
        else {
            $this->db->where('id', $id);
            $this->db->update('fm_email_template', $data);
        }
        return false;
    }

    function deleteTemplate($id) {
        $this->db->delete('fm_email_template', array('id' => $id));
    }

    function sendEmail($templateId, $content, $to, $fromName = '마음수련원', $fromEmail = 'admin@maum.org') {
        $this->load->library('email');

        $template = $this->getEmailTemplate($templateId);

        $content = $template->header . $content . $template->footer;
        $this->email->from($fromEmail, $fromName);
        $this->email->to($to);

        $this->email->subject($template->title);
        $this->email->message($content);

        $this->email->send();
    }
}
?>