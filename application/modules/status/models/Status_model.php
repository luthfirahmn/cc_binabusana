<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Status_model extends CI_Model
{

    public $table = 'ms_status';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($post)
    {
        $data = array(
            'status_type' => $post['status_type'],
            'status' => $post['status'],
        );
        $this->db->insert($this->table, $data);

        $insert_id = $this->db->insert_id();

        if ($insert_id > 0) {
            echo json_encode(['error' => false, 'message' => "Success Add Data"]);
        } else {
            echo json_encode(['error' => true, 'message' => "Error Add Data"]);
        }
    }

    // update data
    function update($post)
    {
        $data = array(
            'status_type' => $post['status_type'],
            'status' => $post['status'],
        );
        $this->db->where($this->id, $post['id']);
        $this->db->update($this->table, $data);

        $update_id =  $this->db->affected_rows();

        if ($update_id > 0) {
            echo json_encode(['error' => false, 'message' => "Success Update Data"]);
        } else {
            echo json_encode(['error' => true, 'message' => "Error Update Data"]);
        }
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }
}