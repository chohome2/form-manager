<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Form_Data extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in'))
            redirect('/login','redirect');
    }

    public function detail($id)
    {
        $form_data = $this->form_data_model->getFormData($id);

        if(!$this->account_model->isRole('열람',$form_data->form_id)) {
            $this->load_view('no_role');
            return;
        }

        $data = array(
            'form' => $this->form_model->getForm($form_data->form_id),
            'form_data' => $form_data
        );
        $this->load_view('view_data',$data);
    }

    public function inquiry($id)
    {
        $form_data = $this->form_data_model->getFormData($id);
        $data = array(
            'form' => $this->form_model->getForm($form_data->form_id),
            'form_data' => $form_data,
            'inquiry_data' => $this->form_data_model->getInquiryDataWithEmail($form_data->email)
        );
        $this->load_view('view_inquiry',$data);
    }

    public function modify($type,$id)
    {
        $this->load->helper(array('form'));

        $form_data = $this->form_data_model->getFormData($id);
        if(!$this->account_model->isRole('수정',$form_data->form_id)) {
            $this->load_view('no_role');
            return;
        }
        $this->load->library('form_validation');

        $this->form_validation->set_rules('id', 'id', 'trim|required|xss_clean');


        if($this->form_validation->run() == FALSE){
            $data = array(
                'type' => $type,
                'form' => $this->form_model->getForm($form_data->form_id),
                'form_data' => $form_data
            );
            $this->load_view('modify_data',$data);
        }
        else {
            $data = array();
            foreach($this->input->post() as $key => $val)
            {
                $data[$key] = $val;
            }
            $this->form_data_model->updateFormData($data['id'],$data);
            redirect('form_data/modify_ok/'.$type."/".$id,'refresh');
        }
    }

    public function modify_ok($type,$id)
    {
        $this->load_view('form_submit_ok',array("message"=>"정보수정이 완료되었습니다.","path"=>"/form_data/".$type."/".$id));
    }

    public function form($id)
    {
        if(!$this->account_model->isRole('열람',$id)) {
            $this->load_view('no_role');
            return;
        }

        $data = array(
            'form' => $this->form_model->getForm($id),
            'form_data' => $this->form_data_model->getFormDataWithFormId($id)
        );


        $this->load_view('data_list',$data);
    }

    public function memo($id) {
        $this->form_data_model->updateFormData($id,array('memo'=>$this->input->post('memo')));
        redirect('/form_data/detail/'.$id,'redirect');
    }

    public function answer($id) {
        $data = array(
            'answer_text'=>$this->input->post('answer_text'),
            'process_status'=>'처리',
            'confirm_date'=>date('Y-m-d H:i:s')
        );
        $this->form_data_model->updateFormData($id,$data);
        //TODO 답변용 디폴트 템플릿 생성 필요
        $this->email_model->sendEmail(1,$this->input->post('answer_text'),array($this->input->post('email')));
        redirect('/form_data/inquiry/'.$id,'redirect');
    }

    public function change_status_confirm($id) {
        $this->form_data_model->updateFormData($id,array('process_status'=>'확인','confirm_date'=>NULL));
        redirect('/','redirect');
    }

    public function change_status_complete($id) {
        $this->form_data_model->updateFormData($id,array('process_status'=>'처리','confirm_date'=>date('Y-m-d H:i:s')));
        redirect('/home/check','redirect');
    }

    public function change_status($status,$id,$path) {
        $status_list = array('미처리','확인','처리','삭제','취소');
        $status = $status_list[$status];
        $form_data = $this->form_data_model->getFormData($id);
        $status = urldecode($status);
        if($status == '삭제' && !$this->account_model->isRole('삭제',$form_data->form_id)) {
            $this->load_view('no_role');
            return;
        }
        $data = array('process_status'=>$status);
        if($status == '처리') {
            $data['confirm_date'] = date('Y-m-d H:i:s');
        }
        else if($status == '미처리' || $status == '확인') {
            $data['confirm_date'] = NULL;
        }
        $this->form_data_model->updateFormData($id,$data);
        redirect('/form_data/'.$path.'/'.$id,'redirect');
    }
}