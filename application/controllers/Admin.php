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
        $this->load->helper('download');
        $this->load->model('User_model');
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
            if ($data['user']['role_id'] > 2) {
                redirect('home', 'refresh');
            } else {
                $this->load->view('templates/admin_header', $data);
                $this->load->view('admin/order', $data);
                $this->load->view('templates/include_js');
                $this->load->view('templates/admin_footer');
            }
        } else {
            redirect('auth');
        }
    }

    public function user()
    {
        $data['notif_amount'] = $this->get_notif_amount();
        $loginstatus = $this->session->userdata('email');
        if ($loginstatus) {
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('templates/admin_header', $data);
            $data['query'] = $this->User_model->get_alluser();
            $this->load->view('admin/user', $data);
            $this->load->view('templates/admin_footer');
            if (is_null($data['user'])) {
                $x = 0;
                while ($x < 1) {
                    $this->User_model->recoveryadmin();
                    $x++;
                }
                redirect('auth', 'refresh');
            }
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

    public function deleteuser()
    {
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Users has been deleted!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button> </div>');

        $id = $this->input->post('id_user');
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

    public function doedit()
    {
        $data = array(
            'name' => $this->input->post('edit_name'),
            'address' => $this->input->post('edit_address'),
            'email' => $this->input->post('edit_email'),
            'nohandphone' => $this->input->post('edit_nohandphone'),
            'role_id' => $this->input->post('edit_role_id')
        );
        $this->db->where('id', $this->input->post('id_usr'));
        $this->db->update('user', $data);

        redirect('admin/user', 'refresh');
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

    //fungsi produkk

    public function product()
    {
        $loginstatus = $this->session->userdata('email');
        $data['notif_amount'] = $this->get_notif_amount();
        if ($loginstatus) {
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('templates/admin_header', $data);
            // $this->load->view('templates/include_js');
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

    public function editproduk($id)
    {
        $this->load->model('Product_model', 'produkmodel');
        $data = $this->produkmodel->edit_produk($id);
        // var_dump($data);
        $data = json_encode($data);
        echo $data;
    }

    public function doeditproduk()
    {
        // echo json_encode($this->input->post());
        $data = array(
            'nama' => $this->input->post('edit_name'),
            'model_produk' => $this->input->post('edit_model'),
            'ukuran' => $this->input->post('edit_size'),
            'harga' => $this->input->post('edit_price'),
            'sku' => $this->input->post('edit_stok')
        );
        $this->db->where('id', $this->input->post('id_prd'));
        $this->db->update('product', $data);

        redirect('admin/product', 'refresh');
    }

    public function deleteproduk()
    {
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Produk has been deleted!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button> </div>');
        $id = $this->input->post('id_prd');
        $this->db->delete('product', array('id' => $id));
        redirect('admin/product');
    }

    //
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

    public function pembayaran($order_id)
    {
        // echo $order_id;
        $data['querypayment'] = $this->db->get_where('payment', ['order_id' => $order_id])->result();
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

        $this->db->select('order_status');
        $this->db->from('order');
        $this->db->where('id', $order_id);
        $order_status = $this->db->get()->row();
        $data['order_status'] = $order_status->order_status;

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

    public function detailorder($order_id)
    {
        $this->db->select('
            order_detail.order_id, 
            order_detail.produk_id, 
            product.model_produk, 
            order_detail.type, 
            order_detail.ukuran_sablon, 
            order_detail.price, 
            order_detail.pcs, 
            order_detail.designlogo,
            order_detail.warna,
            order_detail.area_sablon,
            order_detail.subtotal
        ');
        $this->db->from('order_detail');
        $this->db->join('product', 'order_detail.produk_id = product.id');
        $this->db->where('order_detail.order_id', $order_id);
        $data['all_orderdetail'] = $this->db->get()->result();
        $data['notif_amount'] = $this->get_notif_amount();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/detailorder', $data);
        $this->load->view('templates/admin_footer');
        // echo json_encode($data['all_orderdetail']);
    }

    public function download($fileName)
    {
        $data = file_get_contents('assets/design/' . $fileName);
        $name = $fileName;
        force_download($name, $data);

        // force_download($fileName, $data);
        // // if ($fileName) {
        // //     // check file exists    
        // //     if (file_exists($file)) {
        // //         // get file content
        // //         //force download
        // //         force_download($fileName, $data);
        // //     } else {
        // //         // Redirect to base url
        // //         redirect(base_url('admin/detailorder'));
        // //     }
        // // }
    }

    public function edit_status_pemesanan($status_id, $order_id)
    {

        $data = array(
            'order_status' => $status_id
        );
        $this->db->where('id', $order_id);
        $this->db->update('order', $data);

        if ($status_id >= 2) {
            $this->doconfirm($order_id, false);
            $data['result'] = $this->db->get('payment')->result();
            $this->db->set('status_dp', 1);
            $this->db->where('order_id', $order_id);
            $this->db->update('payment');
        }

        if ($status_id >= 6) {
            $data['result'] = $this->db->get('payment')->result();
            $this->db->set('status_pelunasan', 1);
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
        $shipping_cost = $this->input->post('shippingcost');
        $payment_data = $this->db->get_where('payment', ['order_id' => $order_id])->row_array();
        $grand_total = $payment_data['grand_total'];
        $dp_bill = $payment_data['dp_bill'];
        $final_bill = ($grand_total - $dp_bill) + $shipping_cost;

        $data = array(
            'shipping_cost' => $shipping_cost,
            'final_bill' => $final_bill,
        );
        $this->db->where('order_id', $order_id);
        $this->db->update('payment', $data);
        redirect('admin/pembayaran/' . $order_id, 'refresh');
    }
}
