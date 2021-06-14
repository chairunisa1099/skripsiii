<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Request extends CI_Controller
{

  //load model
  public function __construct()
  {
    parent::__construct();
    $this->load->model('request_model');
    $this->load->model('header_transaksi_request_model');
  }

  public function busanatunik()
  {
    // Validation input
    $this->form_validation->set_rules('ukuran_busana', 'Ukuran Busana', 'required');
    $this->form_validation->set_rules('bahan_busana', 'Bahan Busana', 'required');
    $this->form_validation->set_rules('motif_busana', 'Motif Busana', 'required');

    $data = array(
      'title'       => 'Request Busana Tunik',
      'isi'         => 'request/tunik',
      'extraScript' => 'request/tunik_extraScripts'
    );
    $this->load->view('layout/wrapper', $data, FALSE);
  }


  public function busanagamis()
  {
    // Validation input
    $this->form_validation->set_rules('ukuran_busana', 'Ukuran Busana', 'required');
    $this->form_validation->set_rules('bahan_busana', 'Bahan Busana', 'required');
    $this->form_validation->set_rules('motif_busana', 'Motif Busana', 'required');

    $data = array(
      'title'     => 'Request Busana Gamis',
      'isi'       => 'request/gamis',
      'extraScript' => 'request/gamis_extraScripts'
    );
    $this->load->view('layout/wrapper', $data, FALSE);
  }

  // checkout function for request
  public function checkout()
  {
    $kode_transaksi = date('dmY') . strtoupper(random_string('alnum', 8));
    // request custom
    if ($this->session->userdata('email')) {
      $email              = $this->session->userdata('email');
      $nama_pelanggan     = $this->session->userdata('nama_pelanggan');
      $pelanggan          = $this->auth_model->sudah_login($email, $nama_pelanggan);

      //validasi input
      $valid = $this->form_validation;

      $valid->set_rules(
        'nama_pelanggan',
        'Nama lengkap',
        'required',
        array('required' => '%s harus diisi')
      );

      $valid->set_rules(
        'telepon',
        'Nomor telepon',
        'required',
        array('required' => '%s harus diisi')
      );

      $valid->set_rules(
        'alamat',
        'Alamat Lengkap',
        'required',
        array('required' => '%s harus diisi')
      );

      $valid->set_rules(
        'email',
        'Email',
        'required|valid_email',
        array(
          'required'     => '%s harus diisi',
          'valid_email'  => '%s tidak valid'
        )
      );

      $config['upload_path']   = './assets/upload/image/desain/';
      $config['allowed_types'] = 'gif|jpg|png|jpeg';
      $config['max_size']      = '2400'; //kb
      $config['max_width']     = '2024';
      $config['max_height']    = '2024';

      $this->load->library('upload', $config);

      if (!$this->upload->do_upload('gambar_desain')) {
        $data = array(
          'title'     => 'Request Busana Tunik',
          'error'     => $this->upload->display_errors(),
          'isi'       => 'request/tunik',
          'extraScript' => 'request/tunik_extraScripts'
        );
        // kasih flash data error upload
        $this->load->view('layout/wrapper', $data, FALSE);
      } else {
        $upload_gambar = array('upload_data' => $this->upload->data());
        //thumbnail
        $img_name = $upload_gambar['upload_data']['file_name'];

        $this->session->set_flashdata('img_name', $img_name);
        if ($valid->run() === FALSE) {
          //end validasi

          $data   = array(
            'title'     => 'Checkout',
            'pelanggan' => $pelanggan,
            'isi'       => 'belanja/checkout'
          );
          $this->session->set_flashdata('price', $this->input->post('harga_request'));
          $this->session->set_flashdata('type', 'custom');
          $this->session->set_flashdata('kode', $kode_transaksi);
          $this->session->set_flashdata('ukuran_busana', $this->input->post('ukuran_busana'));
          $this->session->set_flashdata('bahan_busana', $this->input->post('bahan_busana'));
          $this->session->set_flashdata('motif_busana', $this->input->post('motif_busana'));
          $this->session->set_flashdata('harga_request', $this->input->post('harga_request'));

          $this->load->view('layout/wrapper', $data, FALSE);
          // masuk db
        } else {
          $data = array(
            'ukuran_busana'    => $this->input->post('ukuran_busana'),
            'bahan_busana'     => $this->input->post('bahan_busana'),
            'motif_busana'     => $this->input->post('motif_busana'),
            'gambar_desain'    => $img_name,
            'harga_request'    => $this->input->post('harga_request'),
            'kode_transaksi'   => $kode_transaksi

          );
          $this->request_model->tambah($data);
          //$this->session->set_flashdata('sukses', 'Data telah ditambahkan');
          $idProduk = $this->request_model->getId($kode_transaksi);
          //redirect(base_url('request/sukses'), 'refresh');

          $i = $this->input;
          $data = array(
            'id_pelanggan'          => $pelanggan->id_pelanggan,
            'nama_pelanggan'        => $i->post('nama_pelanggan'),
            'email'                 => $i->post('email'),
            'telepon'               => $i->post('telepon'),
            'alamat'                => $i->post('alamat'),
            'kode_transaksi'        => $kode_transaksi,
            'tanggal_transaksi'     => $i->post('tanggal_transaksi'),
            'jumlah_transaksi'      => $i->post('jumlah_transaksi'),
            'status_bayar'          => $result->transaction_status,
          );
          // masuk ke header transaksi
          $this->header_transaksi_request_model->tambahRequest($data);

          $this->session->set_flashdata('sukses', 'Checkout berhasil');
          redirect(base_url('request/sukses'), 'refresh');
        }
      }
      //end masuk database

    } else {
      // klo blm hrs regist
      $this->session->set_flashdata('sukses', 'Silahkan login atau registrasi terlebih dahulu');
      redirect(base_url('register'), 'refresh');
    }
  }

  // sukses
  public function sukses()
  {
    $data     = array(
      'title'     => 'Request berhasil',
      'isi'       => 'request/sukses'
    );
    $this->load->view('layout/wrapper', $data, FALSE);
  }


  public function theDumper()
  {
    echo $this->request_model->getId('03042021N8MPXEAZ');
    exit;
  }
}
