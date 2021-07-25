<?php

class Product_model extends CI_Model
{

    public $id;
    public $nama;
    public $model_produk;
    public $gambar;
    public $ukuran;
    public $harga;
    public $stok;


    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->proTable = 'product';
        $this->cusTable = 'customers';
        $this->ordTable = 'orders';
        $this->ordDetailTable = 'order_detail';
    }


    public function insert_product()
    {
        $this->nama = htmlspecialchars($this->input->post('nama_produk', true));
        $this->model_produk = $this->input->post('model_produk');
        $this->gambar = 'default.jpg';
        $this->ukuran = htmlspecialchars($this->input->post('ukuran'));
        $this->harga = $this->input->post('harga');
        $this->stok = $this->input->post('stok');

        $this->db->insert('product', $this);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Product has been added ! </div>');
        redirect('admin/product');
    }

    public function get_allproduct()
    {
        $query = $this->db->get('product');
        return $query->result();
    }

    public function get_whereproduct($id)
    {
        $result = $this->db->where('id', $id)
            ->limit(1)
            ->get('product');
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return array();
        }
    }

    public function getRows($id = '')
    {
        $this->db->select('*');
        $this->db->from($this->proTable);
        $this->db->where('status', '1');
        if ($id) {
            $this->db->where('id', $id);
            $query = $this->db->get();
            $result  = $query->result_array();
        }
    }

    public function get_allorder()
    {
        $query = $this->db->get('order');
        return $query->result();
    }

    public function get_order_status()
    {
        $query = $this->db->get('status_pemesanan');
        return $query->result();
    }
}
