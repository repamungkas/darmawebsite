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
        $this->session->set_userdata('product_type', $product_type);
        $barang = $this->pm->get_whereproduct($id);
        $qty = $this->input->post('jumlah');
        $harga = $this->input->post('harga');
        $upload_data = $this->uploaddesign();
        if (!$upload_data == null) {
            $data = array(
                'id' => $barang->id,
                'qty' => $qty,
                'price' => $harga,
                'name' => $barang->nama . " " . $barang->model_produk,
                'options' => array('ukuran' => $barang->ukuran, 'gambar' => $barang->gambar, 'type' => $product_type, 'ukuran_sablon' => $this->input->post('ukuran_sablon'), 'warna' => $this->input->post('warna'), 'area_sablon' => $this->input->post('area_sablon'), 'sablon_data' => $upload_data)
            );

            $this->cart->insert($data);
        } else {

            $data = array(
                'id' => $barang->id,
                'qty' => $qty,
                'price' => $harga,
                'name' => $barang->nama . " " . $barang->model_produk,
                'options' => array('ukuran' => $barang->ukuran, 'gambar' => $barang->gambar, 'type' => $product_type, 'ukuran_sablon' => $this->input->post('ukuran_sablon'), 'warna' => $this->input->post('warna'), 'area_sablon' => $this->input->post('area_sablon'), 'sablon_data' => $upload_data)
            );
            $this->cart->insert($data);
        }

        $this->load->view('templates/header');
        if ($product_type == 'sablon') {
            redirect('product/detailsablon/' . $id);
        } else {
            redirect('product/detail/' . $id);
        }
    }

    public function uploaddesign()
    {
        $config['upload_path']          = './assets/design';
        $config['allowed_types']        = 'gif|jpg|png|ai|cdr|ps|pdf';
        $config['max_size']             = 10000;
        $config['max_width']            = 10000;
        $config['max_height']           = 10000;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('userfile')) {
            echo "Gagal Tambah";
        } else {
            $file = $this->upload->data();
            $filedesain = $file['file_name'];


            return $filedesain;
        }
    }
}
