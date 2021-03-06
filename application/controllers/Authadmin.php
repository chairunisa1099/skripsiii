<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Authadmin extends CI_Controller {

    // Halaman Login
    public function index()
    {
        // validasi
        $this->form_validation->set_rules('username', 'Username', 'required',
            array('required'        => '%s harus diisi'));

        $this->form_validation->set_rules('password', 'Password', 'required',
        array('required'        => '%s harus diisi'));
        
        if($this->form_validation->run())
        {
            $username   = $this->input->post('username');
            $password   = $this->input->post('password');
            // proses ke simple login
            $this->simple_login->login($username, $password);
        }
        // end validasi

        $data = array( 'title' => 'Login Admin');
        $this->load->view('authadmin/login', $data, FALSE);
    }
    
    // fungsi logout
    public function logout()
    {
        // ambil fungsi logout dr simple_login
        $this->simple_login->logout();
    }
}