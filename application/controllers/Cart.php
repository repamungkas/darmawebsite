<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cart extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Product_model', 'pm');
    }

    public function index()
    {
        // echo json_encode($this->cart->contents());

        if ($this->session->has_userdata('role_id')) {
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        } else {
            $data['user'] = array();
        }
        $this->load->view('templates/header', $data);
        $this->load->view('templates/include_js');
        $this->load->view('cart/index', $data);
        $this->load->view('templates/footer');
    }

    public function clear_cart($rowId)
    {
        // echo json_encode($this->session->userdata());
        $length = count($this->cart->contents());

        $data = array(
            'rowid'   => $rowId,
            'qty'     => 0
        );

        if ($length == 1) {
            $this->session->unset_userdata('product_type');
        };

        // echo json_encode($this->session->userdata('product_type'));

        $this->cart->update($data);
        redirect('cart', 'refresh');
    }

    public function checkout()
    {
        if ($this->session->has_userdata('role_id')) {
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        } else {
            $data['user'] = array();
        }

        $this->load->view('templates/header');
        $this->load->view('templates/include_js1');
        $this->load->view('cart/checkout', $data);
        $this->load->view('templates/footer');
    }

    public function cek()
    {
        $response = $this->cart->contents();
        $data = json_encode($response);
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }
}
