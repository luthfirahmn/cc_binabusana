<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Asset_model extends CI_Model
{

    public $table = 'ms_asset';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $query = $this->db->query("SELECT
                                t0.id,
                                t0.asset_code,
                                t0.asset_name,
                                t1.desc type,
                                t3.area_name,
                                t0.price,
                                t2.status
                            FROM ms_asset t0
                            LEFT JOIN ms_asset_type t1 ON t1.asset_type_code = t0.asset_type_code
                            LEFT JOIN ms_status t2 ON t2.id = t0.status_id
                            LEFT JOIN ms_area t3 ON t3.area_code = t0.area_code
                            ORDER BY id  DESC
                        ");
        $result = $query->result();

        return $result;
    }

    function get_room_type()
    {
        $this->db->order_by('asset_type_code', 'ASC');
        return $this->db->get('ms_asset_type')->result();
    }

    function get_area()
    {
        $this->db->order_by('area_code', 'ASC');
        return $this->db->get('ms_area')->result();
    }

    function get_status()
    {
        $this->db->where('status_type', 'ASSET');
        $this->db->order_by('id', 'ASC');
        return $this->db->get('ms_status')->result();
    }


    function get_by_id($id)
    {
        $query = $this->db->query("SELECT
                                t0.id,
                                t0.asset_code,
                                t0.asset_name,
                                t0.asset_type_code,
                                t0.status_id,
                                t1.desc type,
                                t3.area_name,
                                t0.price,
                                t2.status
                            FROM ms_asset t0
                            LEFT JOIN ms_asset_type t1 ON t1.asset_type_code = t0.asset_type_code
                            LEFT JOIN ms_status t2 ON t2.id = t0.status_id
                            LEFT JOIN ms_area t3 ON t3.area_code = t0.area_code
                            WHERE t0.id = {$id}
                            ORDER BY id  DESC
                        ");
        $result = $query->row();

        return $result;
    }

    // insert data
    function insert($post)
    {
        $data = array(
            'asset_code' => create_code('asset'),
            'asset_name' => $post['asset_name'],
            'asset_type_code' => $post['asset_type_code'],
            'area_code' => $post['area_code'],
            'price' => $post['price'],
            'status_id' => $post['status_id'],
            'created_time' => date('Y-m-d H:i:s'),
            'updated_time' => date('Y-m-d H:i:s'),
        );
        $this->db->insert($this->table, $data);

        $insert_id = $this->db->insert_id();

        if ($insert_id > 0) {
            echo json_encode(['error' => false, 'message' => "Success Add Data"]);
        } else {
            echo json_encode(['error' => true, 'message' => "Error Add Data"]);
        }
    }

    function update($post)
    {
        $data = array(
            'asset_name' => $post['asset_name'],
            'asset_type_code' => $post['asset_type_code'],
            'area_code' => $post['area_code'],
            'price' => $post['price'],
            'status_id' => $post['status_id'],
            'created_time' => date('Y-m-d H:i:s'),
            'updated_time' => date('Y-m-d H:i:s'),
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
    function delete_data($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }
}