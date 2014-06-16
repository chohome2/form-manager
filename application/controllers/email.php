<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email extends CI_Controller {

    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
            $data = array(
                "form_list" => $this->form_model->getFormsByRole("이메일발송"),
                'template_list' => $this->email_model->getAllEmailTemplates()
            );
            $this->load_view('email',$data);
    }

    function template()
    {
        $data = array(
            'template_list' => $this->email_model->getAllEmailTemplates()
        );
        $this->load_view('email_template_list',$data);
    }

    function template_setting($id)
    {
        $this->load->helper(array('form'));
        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', 'name', 'trim|required|xss_clean');
        if($this->form_validation->run() == FALSE)
        {
            $data = array(
                'id' => $id
            );
            if($id != 'new') {
                $data['template'] = $this->email_model->getEmailTemplate($id);
            }

            $this->load_view('email_template_setting',$data);
        }
        else
        {
            $data = array(
                'name' => $this->input->post('name'),
                'title' => $this->input->post('title'),
                'header' => $this->input->post('header'),
                'footer' => $this->input->post('footer')
            );
            $this->email_model->upsertTemplate($data,$id);
            redirect('/email/setting_ok','refresh');
        }
    }

    public function delete_template($id) {
        $this->email_model->deleteTemplate($id);
        redirect('/email/delete_ok','refresh');
    }

    public function setting_ok()
    {
        $this->load_view('form_submit_ok',array("message"=>"템플릿 설정이 완료되었습니다.","path"=>"/email/template"));
    }

    public function delete_ok()
    {
        $this->load_view('form_submit_ok',array("message"=>"템플릿 삭제가 완료되었습니다.","path"=>"/email/template"));
    }

    function getEmails()
    {
        $form_id = $_GET['form_id'];
        $classify =  $_GET['classify'];
        $agree =  $_GET['agree'];
        $rows = $this->form_data_model->getFormDatasWithEmail($form_id,$classify,$agree);
        $data = array();
        foreach($rows->result() as $row) {
            if($row->email)
                $data[] = $row->email;
        }
        echo json_encode(array("data"=>$data));
    }

    function sendEmail()
    {
        //TODO 메일 보내기 로직 개발
        $emailList = $_POST['email_list'];
        $message = $_POST['message'];
        $templateId = $_POST['template_id'];

        $this->email_model->sendEmail($templateId,$message,$emailList);
        echo "success";
    }
}

?>

