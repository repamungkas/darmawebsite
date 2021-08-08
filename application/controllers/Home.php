<?php

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }

    public function index()
    {
        $loginstatus = $this->session->userdata('email');
        if (isset($loginstatus)) {
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            if ($data['user']['role_id'] >= 1 && $data['user']['role_id'] <= 2) {
                redirect('admin', 'refresh');
            }
            $data['title'] = 'Darmabox Store';
            $this->load->view('templates/header', $data);
            $this->load->view('home/index');
            $this->load->view('templates/footer');
        } else {
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $data['title'] = 'Darmabox Store';
            $this->load->view('templates/header', $data);
            $this->load->view('home/index');
            $this->load->view('templates/footer');
        }
    }
}
