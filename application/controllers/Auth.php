<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    // load model
    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model');
    }

    // Login pelanggan
    public function index()
    {
        // validasi
        $this->form_validation->set_rules('email', 'Email/Username', 'required',
            array('required'        => '%s harus diisi'));

        $this->form_validation->set_rules('password', 'Password', 'required',
        array('required'        => '%s harus diisi'));
        
        if($this->form_validation->run())
        {
            $email      = $this->input->post('email');
            $password   = $this->input->post('password');
            // proses ke simple login
            $this->simple_pelanggan->login($email, $password);
        }
        // end validasi

        $data = array(  'title'     => 'Login Pelanggan',
                        'isi'       => 'login_pelanggan/list'
                    );
        $this->load->view('layout/wrapper', $data, FALSE);
    }

    // Logout
    public function logout()
    {
        $this->simple_pelanggan->logout();
    }

}