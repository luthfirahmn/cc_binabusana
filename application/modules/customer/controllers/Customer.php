<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Customer extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Customer_model');
        $this->model = $this->Customer_model;
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
                'judul' => 'Access',
                'deskripsi' => 'Customer'
            );
            $this->template->load('template', 'errors/html/error_access', $data);
        } else {
            $all_data = $this->model->get_all();

            $data = array(
                'judul' => 'Customer',
                'deskripsi' => 'Page',
                'all_data' => $all_data
            );
            $this->template->load('template', 'customer/index', $data);
        }
    }
}