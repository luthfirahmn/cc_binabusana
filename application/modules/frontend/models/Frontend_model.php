<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Frontend_model extends CI_Model
{

    public $table_customer = 'ms_customer';
    public $table_booking = 'tr_booking';
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

    function get_asset_type()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get('ms_asset_type')->result();
    }

    function get_area_by_type($type_code)
    {
        $query = $this->db->query("SELECT *
                            FROM ms_area
                            WHERE area_code IN (SELECT area_code FROM ms_asset WHERE asset_type_code = '{$type_code}')
                            ");
        $result = $query->result();

        return $result;
    }


    function get_gedung_by_param($area, $type)
    {
        $query = $this->db->query("SELECT *
                            FROM ms_asset
                            WHERE area_code = '{$area}'
                            AND asset_type_code = '{$type}'
                            ");
        $result = $query->result();

        return $result;
    }

    function get_gedung_by_code($code)
    {
        $query = $this->db->query("SELECT *
                            FROM ms_asset
                            WHERE asset_code = '{$code}'
                            ");
        $result = $query->row();

        return $result;
    }

    function booking_process($post)
    {
        $this->db->trans_start();
        $customer_code = create_code('customer');

        $data_customer  = array(
            'customer_code' => $customer_code,
            'name'  => $post['first_name'] . ' ' . $post['last_name'],
            'email'  => $post['email'],
            'phone'  => $post['phone'],
            'created_time'  => date('Y-m-d H:i:s'),
            'updated_time'  => date('Y-m-d H:i:s'),
        );

        $this->db->insert($this->table_customer, $data_customer);

        $data = array(
            'trx_code' => create_code('booking'),
            'customer_code' => $customer_code,
            'asset_code' => $post['pilih_gedung'],
            'trx_date_from' => $post['date_from'],
            'trx_date_to' => $post['date_to'],
            'total_price' => $post['total'],
            'status_id' => 8,
            'created_time'  => date('Y-m-d H:i:s'),
            'updated_time'  => date('Y-m-d H:i:s'),
        );
        $this->db->insert($this->table_booking, $data);

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            echo json_encode(['error' => true, 'message' => "Error Add Data"]);
            $this->db->trans_rollback();
            return FALSE;
        } else {

            echo json_encode(['error' => false, 'message' => "Success Add Data"]);
            $this->db->trans_commit();
            return TRUE;
        }
    }
}