<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payment extends CI_Controller
{
    public $name;
    public $order_id;
    public $transfer_bill;
    public $jenis_pembayaran;
    public $resi_bank;


    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url', 'form'));
        $this->load->model('Product_model', 'pm');
    }

    public function index()
    {
        if ($this->session->has_userdata('role_id')) {
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        } else {
            $data['user'] = array();
        }
        if (count($this->cart->contents()) > 0) {
            // insert ke order  
            $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $insert = array(
                // 'id' => ,
                'type' => $this->session->userdata('product_type'),
                'customer_id' => $user['id'],
                // 'grand_total' => $this->session->userdata('subtotal'),
                'order_amount' => count($this->cart->contents()),
                'shipping_address' => $user['address'],
                'order_email' =>  $this->session->userdata('email'),
                'order_date' => date('YmdHis'),
                'order_status' => '1'
            );
            // var_dump($insert);
            $doInsert = $this->db->insert('order', $insert);

            // insert detail
            $orderId = $this->db->insert_id();
            $this->session->unset_userdata('order _id');
            $this->session->set_userdata('order_id', $orderId);
            foreach ($this->cart->contents() as $item) {
                $insertdetail = array(
                    'order_id' =>  $orderId,
                    'produk_id' => $item['id'],
                    'price' => $item['price'],
                    'pcs' => $item['qty'],
                    'subtotal' => $item['subtotal'],
                );
                // $getproduk = $this->db->get_where('product', array('id' => $item['id']), 1);
                $doInsertDetail = $this->db->insert('order_detail', $insertdetail);
            }
            // $this->db->get_where('order', )

            // insert payment
            $payment_data = array(
                'order_id' =>  $orderId,
                'status_dp' => 0,
                'status_pelunasan' => 0,
                'grand_total' => $this->session->userdata('grand_total'),
                'dp_bill' => $this->session->userdata('dp_total'),
            );
            $doInsertPayment = $this->db->insert('payment', $payment_data);

            $this->session->set_userdata('status_dp', 0);

            if ($doInsert && $doInsertDetail && $doInsertPayment) {
                $this->cart->destroy();
            }
        }
        $this->load->view('templates/header', $data);
        $this->load->view('templates/include_js');
        $this->load->view('payment/index', $data);
        $this->load->view('templates/footer');
    }

    public function clear_cart()
    {
        $this->cart->destroy();
        redirect('cart', 'refresh');
    }

    public function confirmation()
    {
        if ($this->session->has_userdata('role_id')) {
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        } else {
            $data['user'] = array();
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/include_js');
        $this->load->view('payment/confirmation', $data);
        $this->load->view('templates/footer');
    }

    public function doconfirm()
    {
        $config['upload_path']          = './assets/img/resipayment';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 10000;
        $config['max_width']            = 10000;
        $config['max_height']           = 10000;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('userfile')) {
            echo "Gagal Tambah";
        } else {

            $gambar = $this->upload->data();
            $resi_bank = $gambar['file_name'];
            $name = $this->input->post('name');
            $order_id = $this->input->post('order_id');
            $transfer_bill = $this->input->post('transfer_bill');
            $jenis_pembayaran = $this->input->post('jenis_pembayaran');

            $data = array(
                'bank_account' => $name,
                'resi_dp' => $resi_bank
            );
            $this->db->where('order_id', $order_id);
            $this->db->update('payment', $data);

            // $data['pembayaran'] = $this->db->get_where('order', ['id' => $data['order_id']])->row_array();
            // $this->db->set('order_status', 2);
            // $this->db->where('id', $data['order_id']);
            // $this->db->update('order');

            // echo json_encode($data['pembayaran']);
            $this->session->set_flashdata('message1', '<div class="alert alert-success" role="alert">
            Resi anda telah kami terima :) Kami akan menverifikasi pembayaran anda  </div>');
            redirect('payment/confirmation', 'refresh');
        }

        // $this->resi_bank = $this->upload->data('file_name');

        // $this->db->insert('payment', $this);
        // echo json_encode($data);
        // echo $data('file_name');
        // redirect('confirmation', 'refresh');    
    }

    // public function doconfirm()
    // {
    //     // echo json_encode($this->session->userdata());
    //     if ($this->session->has_userdata('role_id')) {
    //         $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    //     } else {
    //         $data['user'] = array();
    //     }

    //     //get cart
    //     // $this->db->select('id');
    //     // $orderData = $this->db->get_where('order', [
    //     //     'customer_id' => $this->session->userdata('id')
    //     // ])->result_array();

    //     $orderId = $this->session->userdata('order_id');

    //     $dataOrderStatus = array(
    //         'order_status' => 2
    //     );

    //     // ubah status pemesanan jadi diproses
    //     $this->db->where('id', $orderId);
    //     $this->db->update('order', $dataOrderStatus);

    //     $this->db->select('produk_id, pcs');
    //     $dataToPay = $this->db->get_where('order_detail', [
    //         'order_id' => $orderId
    //     ])->result_array();

    //     // kurangi sku
    //     foreach ($dataToPay as $item) {
    //         // echo json_encode($item['produk_id']);
    //         $this->db->select('sku');
    //         $getSKU = $this->db->get_where('product', ['id' => $item['produk_id']])->result_array();
    //         // echo json_encode($getSKU[0]['sku']);
    //         $newSku = $getSKU[0]['sku'] - $item['pcs'];
    //         echo json_encode($newSku);
    //         $data = array(
    //             'sku' => $newSku
    //         );
    //         echo json_encode($data);
    //         $this->db->where('id', $item['produk_id']);
    //         $this->db->update('product', $data);
    //     }


    //     die;

    //     $this->load->view('templates/header', $data);
    //     $this->load->view('templates/include_js');
    //     $this->load->view('payment/doconfirm', $data);
    //     $this->load->view('templates/footer');
    // }
}
