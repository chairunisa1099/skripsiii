<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

    // load model
    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model');
    }

    // halaman regist
    public function index()
    {
        //validasi input
        $valid = $this->form_validation;

        $valid->set_rules('nama_pelanggan', 'Nama lengkap', 'required',
                array('required' => '%s harus diisi'));

        $valid->set_rules('email', 'Email', 'required|valid_email|is_unique[pelanggan.email]',
                array('required'     => '%s harus diisi', 
                    'valid_email'  => '%s tidak valid',
                    'is_unique'   => '%s sudah terdaftar'));

        $valid->set_rules('password', 'Password', 'required',
                array('required' => '%s harus diisi'));            
        
        if($valid->run()===FALSE) {
        //end validasi
        $data = array(  'title'       => 'Registrasi Pelanggan',
                        'isi'         => 'registrasi/list'
                    );
        $this->load->view('layout/wrapper', $data, FALSE);
        //masuk database
        }else{
            $i = $this->input;
            $data = array(  'status_pelanggan'      => 'Aktif',
                            'nama_pelanggan'        => $i->post('nama_pelanggan'),
                            'email'                 => $i->post('email'),
                            'password'              => $i->post('password'),
                            'telepon'               => $i->post('telepon'),
                            'alamat'                => $i->post('alamat'),
                            'tanggal_daftar'        => date('Y-m-d H:i:s')
                        );
        $this->auth_model->tambah($data);
        // buat session login pelanggan
        $this->session->set_userdata('email', $i->post('email'));
        $this->session->set_userdata('nama_pelanggan', $i->post('nama_pelanggan'));
        // end buat session
        $this->session->set_flashdata('sukses', 'Registrasi berhasil');
        redirect(base_url('registrasi/sukses'),'refresh');
    }
        //end masuk database
}
    public function sukses()
    {
        $data = array(  'title'     => 'Registrasi berhasil',
                        'isi'       => 'registrasi/sukses'
                    );
        $this->load->view('layout/wrapper', $data, FALSE);
        

    }
}