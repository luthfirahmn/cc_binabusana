<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Area extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Area_model');
        $this->model = $this->Area_model;
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
                'judul' => 'Area',
                'deskripsi' => 'Page',
                'all_data' => $all_data
            );
            $this->template->load('template', 'area/index', $data);
        }
    }

    public function create()
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect to the login page if not logged in
            redirect('auth/login', 'refresh');
        } elseif (!$this->ion_auth->is_admin()) {
            // redirect to the access error page if not admin
            $data = array(
                'judul' => 'Error',
                'deskripsi' => 'Access'
            );
            $this->template->load('template', 'errors/html/error_access', $data);
        } else {
            $data = array(
                'judul' => 'Area',
                'deskripsi' => 'Create',
                'button' => 'Create',
                'action' => site_url('area/create_action'),
            );
        }
        $this->template->load('template', 'area/form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(['error' => true, 'message' => validation_errors()]);
        } else {
            $this->model->insert($_POST);
        }
    }

    public function update($id)
    {
        $row = $this->model->get_by_id($id);
        if (!$this->ion_auth->logged_in()) {
            // redirect to the login page if not logged in
            redirect('auth/login', 'refresh');
        } elseif (!$this->ion_auth->is_admin()) {
            // redirect to the access error page if not admin
            $data = array(
                'judul' => 'Error',
                'deskripsi' => 'Access'
            );
            $this->template->load('template', 'errors/html/error_access', $data);
        } elseif ($row) {
            $data = array(
                'judul' => 'Area',
                'deskripsi' => 'Edit',
                'action' => site_url('area/update_action'),
                'all_data' => $row,
            );
            $this->template->load('template', 'area/form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            $this->session->set_flashdata('type', 'error');
            redirect(site_url('area'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(['error' => true, 'message' => validation_errors()]);
        } else {
            $this->model->update($_POST);
        }
    }

    public function delete($id)
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect to the login page if not logged in
            redirect('auth/login', 'refresh');
        } elseif (!$this->ion_auth->is_admin()) {
            // redirect to the access error page if not admin
            $data = array(
                'judul' => 'Error',
                'deskripsi' => 'Access'
            );
            $this->template->load('template', 'errors/html/error_access', $data);
        } else {
            $row = $this->model->get_by_id($id);

            if ($row) {
                $this->model->delete($id);
                $this->session->set_flashdata('message', 'Delete Record Success');
                $this->session->set_flashdata('type', 'success');
                redirect(site_url('area'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                $this->session->set_flashdata('type', 'error');
                redirect(site_url('area'));
            }
        }
    }


    public function _rules()
    {
        $this->form_validation->set_rules('area_name', 'area_name', 'trim|required');
    }
}