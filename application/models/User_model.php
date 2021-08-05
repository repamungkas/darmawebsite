<?php

class User_model extends CI_Model
{

    public $id;
    public $name;
    public $address;
    public $email;
    public $nohandphone;
    public $password;
    public $role_id;
    public $is_active;
    public $date_created;


    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }


    public function insert_user()
    {
        $this->name = htmlspecialchars($this->input->post('name', true));
        $this->address = $this->input->post('address');
        $this->email = htmlspecialchars($this->input->post('email'));
        $this->nohandphone = $this->input->post('nohandphone');
        $this->password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
        $this->role_id = 2;
        $this->is_active = 1;
        $this->date_created = time();

        $this->db->insert('user', $this);
        if ($this->uri->segment(2) == 'registration') {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Congratulation! Your account has been created. Please Login </div>');
            redirect('auth');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Users has been created! <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button></div>');
            redirect('admin/user');
        }
    }

    public function get_alluser()
    {
        $query = $this->db->get('user');
        return $query->result();
    }

    public function edit_user($id)
    {
        $query = $this->db->get_where('user', array('id' => $id));
        return $query->result_array();
    }
}
