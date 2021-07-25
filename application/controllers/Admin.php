<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
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
        $data['query'] = $this->pm->get_allorder();
        $data['status_pemesanan'] = $this->pm->get_order_status();
        $counter = 0;
        $data['notif_amount'] = $this->get_notif_amount();
        foreach ($data['query'] as $item) {
            if ($item->order_status == 1) {
                $counter++;
                $data['notif_amount'] = $counter;
            }
        }
        $loginstatus = $this->session->userdata('email');
        if ($loginstatus) {
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/index', $data);
            $this->load->view('templates/include_js');
            $this->load->view('templates/admin_footer');
        } else {
            redirect('auth');
        }
    }

    public function user()
    {
        $loginstatus = $this->session->userdata('email');
        if ($loginstatus) {
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('templates/admin_header', $data);
            $this->load->model('User_model');
            $data['query'] = $this->User_model->get_alluser();
            $this->load->view('admin/user', $data);
            $this->load->view('templates/admin_footer');
        } else {
            redirect('auth');
        }
    }

    public function createuser()
    {
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('address', 'Address', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'This email has already registered!'
        ]);
        $this->form_validation->set_rules('nohandphone', 'No. Handphone', 'required|trim');
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[8]|matches[password2]', [
            'matches' => 'Password dont match!',
            'min_length' => 'Password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() ==  false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Users has not been created!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button> </div>');
            redirect('admin/user');
        } else {
            $this->load->model('User_model');
            $this->User_model->insert_user();
            redirect('admin/user');
        }
    }

    public function delete_user($id)
    {
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Users has been deleted!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button> </div>');
        $this->db->delete('user', array('id' => $id));
        redirect('admin/user');
    }

    public function edituser($id)
    {
        $this->load->model('User_model', 'usermodal');
        $data = $this->usermodal->edit_user($id);
        $data = json_encode($data);
        echo $data;
    }

    public function get_notif_amount()
    {
        $data['query'] = $this->pm->get_allorder();
        $counter = 0;
        $data['notif_amount'] = 0;
        foreach ($data['query'] as $item) {
            if ($item->order_status == 1) {
                $counter++;
                $data['notif_amount'] = $counter;
            }
        }
        return $data['notif_amount'];
    }

    public function product()
    {
        $loginstatus = $this->session->userdata('email');
        $data['notif_amount'] = $this->get_notif_amount();
        if ($loginstatus) {
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('templates/admin_header', $data);
            $this->load->view('templates/include_js');
            $data['query'] = $this->pm->get_allproduct();
            $this->load->view('admin/product', $data);
            $this->load->view('templates/admin_footer');
        } else {
            redirect('auth');
        }
    }

    public function insert_product()
    {
        $this->pm->insert_product();
        redirect('admin/product');
    }

    public function order()
    {
        $data['query'] = $this->pm->get_allorder();
        $data['status_pemesanan'] = $this->pm->get_order_status();
        $counter = 0;
        $data['notif_amount'] = $this->get_notif_amount();
        foreach ($data['query'] as $item) {
            if ($item->order_status == 1) {
                $counter++;
                $data['notif_amount'] = $counter;
            }
        }
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/order', $data);
        $this->load->view('templates/admin_footer');
    }

    public function pembayaran()
    {
        $data['querypayment'] = $this->db->get('payment')->result();
        $data['query'] = $this->pm->get_allorder();
        $data['status_pemesanan'] = $this->pm->get_order_status();
        $counter = 0;
        $data['notif_amount'] = $this->get_notif_amount();
        foreach ($data['query'] as $item) {
            if ($item->order_status == 1) {
                $counter++;
                $data['notif_amount'] = $counter;
            }
        }
        // foreach ($data['query'] as $q) {
        //     $this->db->select('*');
        //     $this->db->from('payment');
        //     $this->db->join('order', 'payment.order_id = order_id');
        //     $this->db->where('order.id', $q->id);
        //     $data['querypayment'] = $this->db->get()->result_array();
        // }

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/pembayaran', $data);
        $this->load->view('templates/admin_footer');
    }

    public function edit_status_pemesanan($status_id, $order_id)
    {

        $data = array(
            'order_status' => $status_id
        );
        $this->db->where('id', $order_id);
        $this->db->update('order', $data);

        if ($status_id == 2) {
            $this->doconfirm($order_id, false);
            $data['result'] = $this->db->get('payment')->result();
            $this->db->set('status_dp', 1);
            $this->db->where('order_id', $order_id);
            $this->db->update('payment');
        }

        if ($status_id == 1) {
            $this->doconfirm($order_id, true);
            $data['result'] = $this->db->get('payment')->result();
            $this->db->set('status_dp', 0);
            $this->db->where('order_id', $order_id);
            $this->db->update('payment');
        }

        redirect('admin/order', 'refresh');
    }

    public function doconfirm($order_id, $undo_process)
    {
        $this->db->select('produk_id, pcs');
        $dataToPay = $this->db->get_where('order_detail', [
            'order_id' => $order_id
        ])->result_array();

        // kurangi sku
        foreach ($dataToPay as $item) {
            $this->db->select('sku');
            $getSKU = $this->db->get_where('product', ['id' => $item['produk_id']])->result_array();
            if ($undo_process == true) {
                $newSku = $getSKU[0]['sku'] + $item['pcs'];
            } else {
                $newSku = $getSKU[0]['sku'] - $item['pcs'];
            }
            $data = array(
                'sku' => $newSku
            );
            $this->db->where('id', $item['produk_id']);
            $this->db->update('product', $data);
        }
    }

    public function updateshipping($order_id)
    {
        // echo $order_id;
        $shipping = $this->input->post('shippingcost');
        $data['payment'] = $this->db->get('payment')->result();
        $this->db->set('shipping_cost', $shipping);
        $this->db->where('order_id', $order_id);
        $this->db->update('payment');
        echo json_encode($data);
    }
}
