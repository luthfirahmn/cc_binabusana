<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Booking_model extends CI_Model
{

    public $table = 'tr_booking';
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
                t0.trx_code,
                t3.asset_name,
                t1.name customer_name,
                t0.total_price,
                t0.trx_date_from,
                t0.trx_date_to,
                t2.status
            FROM tr_booking t0
            LEFT JOIN ms_customer t1 ON t1.customer_code = t0.customer_code
            LEFT JOIN ms_status t2 ON t2.id = t0.status_id
            LEFT JOIN ms_asset t3 ON t3.asset_code = t0.asset_code
            ORDER BY t0.id  DESC
        ");
        $result = $query->result();

        return $result;
    }

    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // update data
    function change_status($post)
    {
        $id = $post['id'];
        $status = $post['status'];

        $this->db->trans_start();

        $data_book  = array(
            'status_id' => $status,
            'updated_time'  => date('Y-m-d H:i:s'),
        );

        $this->db->where('id', $id);
        $this->db->update($this->table, $data_book);

        if ($status == 6) {
            $status_id = 4;
        } else {
            $status_id = 1;
        }
        $update_time = date('Y-m-d H:i:s');
        $this->db->query("UPDATE 
                                ms_asset
                            SET 
                                status_id = {$status_id}
                                ,updated_time = '{$update_time}'
                            WHERE 
                                asset_code 
                            IN (SELECT 
                                    asset_code 
                                FROM 
                                    tr_booking 
                                WHERE 
                                    id = {$id}
                                    )
                        ");


        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            echo json_encode(['error' => true, 'message' => "Error Change Status"]);
            $this->db->trans_rollback();
            return FALSE;
        } else {

            echo json_encode(['error' => false, 'message' => "Success Change Status"]);
            $this->db->trans_commit();
            return TRUE;
        }
    }
}