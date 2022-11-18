<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Booking extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Booking_model');
        $this->model = $this->Booking_model;
        $this->load->library('form_validation');
        $this->session->set_flashdata('segment', explode('/', $this->uri->uri_string()));
    }

    public function index()
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect to the login page
            redirect('auth/login', 'refresh');
        } elseif (!$this->ion_auth->is_admin()) {
            // redirect to the access error page if not admin
            $data = array(
                'judul' => 'Error',
                'deskripsi' => 'Access'
            );
            $this->template->load('template', 'errors/html/error_access', $data);
        } else {
            $all_data = $this->model->get_all();

            $data = array(
                'judul' => 'Booking',
                'deskripsi' => 'Page',
                'all_data' => $all_data
            );
            $this->template->load('template', 'booking/index', $data);
        }
    }


    public function change_status()
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect to the login page
            redirect('auth/login', 'refresh');
        } elseif (!$this->ion_auth->is_admin()) {
            // redirect to the access error page if not admin
            $data = array(
                'judul' => 'Error',
                'deskripsi' => 'Access'
            );
            $this->template->load('template', 'errors/html/error_access', $data);
        } else {
            $this->model->change_status($_POST);
        }
    }
}