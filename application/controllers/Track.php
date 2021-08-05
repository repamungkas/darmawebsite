<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Track extends CI_Controller
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
        $data['active_order'] = [];
        $loginstatus = $this->session->userdata('email');
        if ($loginstatus) {
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

            // get all order
            $data['orders'] = $this->db->get_where('order', [
                'customer_id' => $data['user']['id']
            ])->result_array();

            // echo json_encode($data['orders']);

            $data['title'] = 'Darmabox Store';
            // $this->load->view('templates/include_js');
            $this->load->view('templates/header', $data);
            $this->load->view('trackorder/index', $data);
            $this->load->view('templates/footer', $data);
        } else {
            redirect('auth');
        }
    }

    public function active_order($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // get all order
        $data['orders'] = $this->db->get_where('order', [
            'customer_id' => $data['user']['id']
        ])->result_array();

        $this->db->select('order_detail.id, order_detail.order_id, product.nama, product.model_produk, order_detail.pcs, order_detail.subtotal, order.order_status');
        $this->db->from('order_detail');
        $this->db->join('product', 'order_detail.produk_id = product.id');
        $this->db->join('order', 'order_detail.order_id = order.id');
        $this->db->where('order.customer_id', $_SESSION['id']);
        $data['all_data'] = $this->db->get()->result_array();

        $data['active_order'] = $this->db->get_where('order_detail', [
            'order_id' => $id
        ])->result_array();

        $data['payment'] = $this->db->get_where('payment', ['order_id' => $id])->row_array();

        // echo json_encode($data['active_order']);

        // redirect('track', 'refresh');
        // $this->load->view('templates/include_js');
        $this->load->view('templates/header', $data);
        $this->load->view('trackorder/index', $data);
        $this->load->view('templates/footer', $data);
    }
}
