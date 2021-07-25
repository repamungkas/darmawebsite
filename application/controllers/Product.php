<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Product extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->model('Product_model', 'pm');
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $data['query'] = $this->pm->get_allproduct();
        $this->load->view('product/index', $data);
        $this->load->view('templates/footer');
    }

    public function detailsablon($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/include_js');
        $data['query'] = $this->db->get_where('product', array('id' => $id))->result();
        $this->load->view('product/detailsablon', $data);
        $this->load->view('templates/footer');
    }

    public function sablon()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $data['query'] = $this->pm->get_allproduct();
        $this->load->view('product/sablon', $data);
        $this->load->view('templates/footer');
    }



    public function detail($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/include_js');
        $data['query'] = $this->db->get_where('product', array('id' => $id))->result();
        $this->load->view('product/detail', $data);
        $this->load->view('templates/footer');
    }

    // khusus produk polos
    public function add_cart($product_type)
    {
        $id = $this->input->post('id');
        if ($this->session->has_userdata('product_type') == null || $this->session->userdata('product_type') == 'polos') {
            $this->session->set_userdata('product_type', $product_type);
            // $type = $product_type;
            $barang = $this->pm->get_whereproduct($id);
            $qty = $this->input->post('jumlah');
            $harga = $this->input->post('harga');
            $harga_sablon_logo = $this->input->post('harga_sablon_logo');

            echo $id . " " . $qty;

            $data = array(
                'id' => $barang->id,
                'qty' => $qty,
                'price' => $harga,
                'price_additional' => $harga_sablon_logo,
                'name' => $barang->nama . " " . $barang->model_produk,
                'options' => array('ukuran' => $barang->ukuran, 'gambar' => $barang->gambar)
            );

            $this->cart->insert($data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Selesaikan pesanan produk sablon anda !  </div>');
        }
        $this->load->view('templates/header');
        redirect('product/detail/' . $id);
    }

    // khusus produk sablon
    public function addcartsablon($product_type)
    {
        $id = $this->input->post('id');
        if ($this->session->has_userdata('product_type') == null || $this->session->userdata('product_type') == 'sablon') {
            $this->session->set_userdata('product_type', $product_type);
            // $type = $product_type;
            $barang = $this->pm->get_whereproduct($id);
            $qty = $this->input->post('jumlah');
            $harga = $this->input->post('harga');
            $harga_sablon_logo = $this->input->post('harga_sablon_logo');

            echo $id . " " . $qty;

            $data = array(
                'id' => $barang->id,
                'qty' => $qty,
                'price' => $harga,
                'price_additional' => $harga_sablon_logo,
                'name' => $barang->nama . " " . $barang->model_produk,
                'options' => array('ukuran' => $barang->ukuran, 'gambar' => $barang->gambar)
            );

            $this->cart->insert($data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Selesaikan pesanan produk polos anda !  </div>');
        }

        $this->load->view('templates/header');
        redirect('product/detailsablon/' . $id);
    }

    // Aku nyoba nggae function anyar

}
