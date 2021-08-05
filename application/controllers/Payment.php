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
            $order_data = array(
                'type' => $this->session->userdata('product_type'),
                'customer_id' => $user['id'],
                'order_amount' => count($this->cart->contents()),
                'shipping_address' => $user['address'],
                'order_email' =>  $this->session->userdata('email'),
                'order_date' => date('YmdHis'),
                'order_status' => '1'
            );
            $insert = $order_data;
            $doInsert = $this->db->insert('order', $insert);

            // insert detail
            $orderId = $this->db->insert_id();
            $this->session->unset_userdata('order _id');
            $this->session->set_userdata('order_id', $orderId);
            foreach ($this->cart->contents() as $item) {
                if ($item['options']['type'] == 'sablon') {
                    $area_sablon = $item['options']['area_sablon'];
                    $ukuran_sablon = $item['options']['ukuran_sablon'];
                    $designlogo = $item['options']['sablon_data'];
                    $warna = $item['options']['warna'];
                } else {
                    $area_sablon = '';
                    $ukuran_sablon = '';
                    $designlogo = '';
                    $warna = '';
                }

                $insertdetail = array(
                    'order_id' =>  $orderId,
                    'produk_id' => $item['id'],
                    'type' => $item['options']['type'],
                    'area_sablon' => $area_sablon,
                    'ukuran_sablon' => $ukuran_sablon,
                    'designlogo' => $designlogo,
                    'warna' => $warna,
                    'price' => $item['price'],
                    'pcs' => $item['qty'],
                    'subtotal' => $item['subtotal'],
                );
                $doInsertDetail = $this->db->insert('order_detail', $insertdetail);
            }

            // insert payment
            $payment_data = array(
                'customer_id' => $user['id'],
                'order_id' =>  $orderId,
                'status_dp' => 0,
                'status_pelunasan' => 0,
                'grand_total' => $this->session->userdata('grand_total'),
                'dp_bill' => $this->session->userdata('dp_total'),
            );
            $doInsertPayment = $this->db->insert('payment', $payment_data);

            if ($doInsert && $doInsertDetail && $doInsertPayment) {
                $this->session->set_userdata('order_number', $orderId);
                $this->cart->destroy();
            }
        }
        $this->load->view('templates/header', $data);
        $this->load->view('templates/include_js');
        $this->load->view('payment/index', $data);
        $this->load->view('templates/footer');
    }

    public function payment_continue($order_id)
    {
        if ($this->session->has_userdata('role_id')) {
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        } else {
            $data['user'] = array();
        }
        echo 'payment continue';
        echo $order_id;

        $this->session->set_userdata('order_number', $order_id);

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

        $order_id = $this->session->userdata('order_number');
        $data['payment'] = $this->db->get_where('payment', ['order_id' => $order_id])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/include_js');
        $this->load->view('payment/confirmation', $data);
        $this->load->view('templates/footer');
    }

    public function get_bill($order_id)
    {
        $data['bill'] = $this->db->get_where('payment', ['order_id' => $order_id])->row_array();
        redirect('payment/confirmation', 'refresh', $data);
    }

    public function doconfirm()
    {
        $config['upload_path']          = './assets/img/resi_dp';
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

            $data = array(
                'bank_account' => $name,
                'resi_dp' => $resi_bank
            );
            $this->db->where('order_id', $order_id);
            $this->db->update('payment', $data);

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

    public function pelunasan()
    {
        $config['upload_path']          = './assets/img/resi_pelunasan';
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

            $data = array(
                'bank_account' => $name,
                'resi_pelunasan' => $resi_bank
            );
            $this->db->where('order_id', $order_id);
            $this->db->update('payment', $data);

            $this->session->set_flashdata('message1', '<div class="alert alert-success" role="alert">
            Resi anda telah kami terima :) Kami akan menverifikasi pembayaran anda  </div>');
            redirect('payment/confirmation', 'refresh');
        }

        $this->resi_bank = $this->upload->data('file_name');

        $this->db->insert('payment', $this);
        echo json_encode($data);
        echo $data('file_name');
        redirect('confirmation', 'refresh');
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
