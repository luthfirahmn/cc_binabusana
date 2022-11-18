<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Status extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Status_model');
        $this->model = $this->Status_model;
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
                'judul' => 'Status',
                'deskripsi' => 'Page',
                'all_data' => $all_data
            );
            $this->template->load('template', 'status/index', $data);
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
                'judul' => 'Status',
                'deskripsi' => 'Create',
                'button' => 'Create',
                'action' => site_url('status/create_action'),
            );
        }
        $this->template->load('template', 'status/form', $data);
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
                'judul' => 'Status',
                'deskripsi' => 'Edit',
                'action' => site_url('status/update_action'),
                'id' => set_value('id', $row->id),
                'status_type' => set_value('status_type', $row->status_type),
                'status' => set_value('status', $row->status)
            );
            $this->template->load('template', 'status/form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            $this->session->set_flashdata('type', 'error');
            redirect(site_url('status'));
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
                redirect(site_url('status'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                $this->session->set_flashdata('type', 'error');
                redirect(site_url('status'));
            }
        }
    }


    public function _rules()
    {
        $this->form_validation->set_rules('status_type', 'status_type', 'trim|required');
        $this->form_validation->set_rules('status', 'status', 'trim|required');
    }
}