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
        if ($this->session->has_userdata('role_id')) {
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        } else {
            $data['user'] = array();
        }

        $data['province'] = $this->shipping_get_province();

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

    public function shipping_get_province()
    {
        $curl = curl_init();
        $provinces = [];

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: 58a4e641443959d6488c2b5eed119bdc"
            ),
        ));

        $response = curl_exec($curl);

        $err = curl_error($curl);

        curl_close($curl);

        $data = json_decode($response, true);

        // echo json_encode($data['rajaongkir']['results']);

        // foreach ($response as $items) {
        //     echo $items;
        // }

        return $data['rajaongkir']['results'];
    }

    public function shipping_get_city()
    {
        echo 'get city';
    }
}
