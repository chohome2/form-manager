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
        require 'mailer/PHPMailerAutoload.php';

        $template = $this->getEmailTemplate($templateId);
        $content = $template->header . $content . $template->footer;
        $subject = $template->title;

        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = '1.234.27.164';
        $mail->SMTPAuth = true;
        $mail->Port = 6700;
        $mail->Username = 'tabsmailerauth';
        $mail->Password = 'admin1460';
        $mail->CharSet = 'utf8';
        $mail->isHTML(true);
        $mail->addCustomHeader('X-TABS-Campaign','{EBC5C6A1-5F68-4979-AA08-043CF68CFF82}');

        $mail->From = $fromEmail;
        $mail->FromName = $fromName;
        foreach($to as $toEmail) {
            $mail->addAddress($toEmail);
        }

        $mail->Subject = $subject;
        $mail->Body    = $content;

        if(!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message has been sent';
        }
    }
}
?>