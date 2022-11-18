<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Frontend extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Frontend_model');
        $this->model = $this->Frontend_model;
        $this->session->set_flashdata('segment', explode('/', $this->uri->uri_string()));
    }

    public function index()
    {

        // redirect to the access error page if not admin
        $data = array(
            'ruangan' => $this->model->get_asset_type()
        );
        $this->load->view('frontend/index', $data);
    }

    public function get_area()
    {
        $data = $this->model->get_area_by_type($_POST['id']);
        echo json_encode($data);
    }

    public function get_gedung()
    {
        $data = $this->model->get_gedung_by_param($_POST['area'], $_POST['jenis_ruangan']);
        echo json_encode($data);
    }

    public function get_gedung_by_code()
    {
        $data = $this->model->get_gedung_by_code($_POST['code']);
        echo json_encode($data);
    }

    public function booking_action()
    {
        if (isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {
            $secret = '6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe';
            $captchaResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
            $responseData = json_decode($captchaResponse);
            if ($responseData->success) {
                $this->_rules();

                if ($this->form_validation->run() == FALSE) {
                    echo json_encode(['error' => true, 'message' => validation_errors()]);
                } else {
                    $this->model->booking_process($_POST);
                }
            } else {
                echo json_encode(['error' => true, 'message' => 'Captcha is invalid']);
            }
        } else {
            echo json_encode(['error' => true, 'message' => 'Please confirm if you ar not a robot']);
        }
    }



    public function _rules()
    {
        $this->form_validation->set_rules('first_name', 'first name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'last name', 'trim|required');
        $this->form_validation->set_rules('email', 'email', 'trim|required');
        $this->form_validation->set_rules('jenis_ruangan', 'jenis ruangan', 'trim|required');
        $this->form_validation->set_rules('area_kantor', 'area kantor', 'trim|required');
        $this->form_validation->set_rules('pilih_gedung', 'pilih gedung', 'trim|required');
        $this->form_validation->set_rules('date_from', 'date from', 'trim|required');
        $this->form_validation->set_rules('date_to', 'date to', 'trim|required');
    }
}