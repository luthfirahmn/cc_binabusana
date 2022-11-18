<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Asset_type_model extends CI_Model
{

    public $table = 'ms_asset_type';
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


    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // insert data
    function insert($post)
    {
        $data = array(
            'asset_type_code' => create_code('asset_type'),
            'desc' => $post['desc'],
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
            'desc' => $post['desc'],
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