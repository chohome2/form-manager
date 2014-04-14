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
        $this->load->model('form_data_model','',TRUE);
        $this->load->model('form_model','',TRUE);
        $this->load->model('account_model','',TRUE);

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
        $this->load->model('form_data_model','',TRUE);
        $this->load->model('form_model','',TRUE);

        $form_data = $this->form_data_model->getFormData($id);
        $data = array(
            'form' => $this->form_model->getForm($form_data->form_id),
            'form_data' => $form_data,
            'inquiry_data' => $this->form_data_model->getInquiryDataWithEmail($form_data->email)
        );
        $this->load_view('view_inquiry',$data);
    }

    public function form($id)
    {
        $this->load->model('form_data_model','',TRUE);
        $this->load->model('form_model','',TRUE);
        $this->load->model('account_model','',TRUE);

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
        $this->load->model('form_data_model','',TRUE);
        $this->form_data_model->updateFormData($id,array('memo'=>$this->input->post('memo')));
        redirect('/form_data/detail/'.$id,'redirect');
    }

    public function answer($id) {
        $this->load->model('form_data_model','',TRUE);
        $this->form_data_model->updateFormData($id,array('answer_text'=>$this->input->post('answer_text')));
        redirect('/form_data/inquiry/'.$id,'redirect');
    }

    public function change_status_confirm($id) {
        $this->load->model('form_data_model','',TRUE);
        $this->form_data_model->updateFormData($id,array('process_status'=>'확인'));
        redirect('/','redirect');
    }

    public function change_status_detail($status,$id) {
        $this->load->model('form_data_model','',TRUE);
        $this->load->model('account_model','',TRUE);

        $form_data = $this->form_data_model->getFormData($id);
        $status = urldecode($status);
        if($status == '삭제' && !$this->account_model->isRole('삭제',$form_data->form_id)) {
            $this->load_view('no_role');
            return;
        }

        $this->form_data_model->updateFormData($id,array('process_status'=>$status));
        redirect('/form_data/detail/'.$id,'redirect');
    }

    public function change_status_inquiry($status,$id) {
        $this->load->model('form_data_model','',TRUE);
        $this->form_data_model->updateFormData($id,array('process_status'=>urldecode($status)));
        redirect('/form_data/inquiry/'.$id,'redirect');
    }
}