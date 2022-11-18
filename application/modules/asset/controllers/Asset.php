<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Asset extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Asset_model');
        $this->model = $this->Asset_model;
        $this->load->library('form_validation');
        $this->session->set_flashdata('segment', explode('/', $this->uri->uri_string()));
    }

    public function index()
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        } else {
            $all_data = $this->model->get_all();
            $data = array(
                'judul'         => "Asset",
                'deskripsi'     => "Page",
                'all_data'      => $all_data
            );
        }

        $this->template->load('templates', 'Asset/index', $data);
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
                'judul' => 'Asset',
                'deskripsi' => 'Create',
                'action' => site_url('asset/create_action'),
                'room_type' => $this->model->get_room_type(),
                'area' => $this->model->get_area(),
                'status' => $this->model->get_status()
            );
        }
        $this->template->load('template', 'Asset/form', $data);
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

            $all_data = $this->model->get_by_id($id);
            $data = array(
                'judul' => 'Asset',
                'deskripsi' => 'Edit',
                'all_data'  => $all_data,
                'action' => site_url('asset/update_action'),
                'room_type' => $this->model->get_room_type(),
                'area' => $this->model->get_area(),
                'status' => $this->model->get_status()
            );
        }
        $this->template->load('template', 'asset/form', $data);
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


    public function view($id)
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

            $all_data = $this->model->get_by_id($id);
            $data = array(
                'judul' => 'Asset',
                'deskripsi' => 'View',
                'all_data'  => $all_data
            );
        }
        $this->template->load('template', 'Asset/form_view', $data);
    }

    public function delete($id)
    {

        $delete = $this->model->delete_data($id);

        if ($delete) {
            $this->session->set_flashdata('message', 'Delete Record Success');
            $this->session->set_flashdata('type', 'success');
            redirect(site_url('Asset'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            $this->session->set_flashdata('type', 'error');
            redirect(site_url('Asset'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('asset_name', 'asset_name', 'trim|required');
        $this->form_validation->set_rules('asset_type_code', 'asset_type_code', 'trim|required');
        $this->form_validation->set_rules('area_code', 'area_code', 'trim|required');
        $this->form_validation->set_rules('price', 'price', 'trim|required|numeric');
        $this->form_validation->set_rules('status_id', 'status_id', 'trim|required');
    }
}