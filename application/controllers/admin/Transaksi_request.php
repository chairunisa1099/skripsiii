<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_request extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('header_transaksi_request_model');
        $this->load->model('konfigurasi_model');
        // proteksi hlmn
        $this->simple_login->cek_login();
    }

    public function request()
    {
        $header_transaksi_request = $this->header_transaksi_request_model->listing();
        $data = array(  'title'             => 'Data Transaksi Pesanan Request',
                        'header_transaksi_request'  => $header_transaksi_request,
                        'isi'               => 'admin/transaksi_request/request'
                    );
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    public function detail($kode_transaksi)
    {
        $header_transaksi_request   = $this->header_transaksi_request_model->kode_transaksi($kode_transaksi);
        $transaksi          = $this->transaksi_model->kode_transaksi($kode_transaksi);    
       
        $data = array(  'title'             => 'Riwayat Belanja',
                        'header_transaksi'  => $header_transaksi_request,
                        'transaksi'         => $transaksi,
                        'isi'               => 'admin/transaksi_request/detail'
                    );
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    public function cetak($kode_transaksi)
    {
        $header_transaksi_request   = $this->header_transaksi__request_model->kode_transaksi($kode_transaksi);
        $transaksi          = $this->transaksi_model->kode_transaksi($kode_transaksi);    
        $site               = $this->konfigurasi_model->listing();

        $data = array(  'title'             => 'Riwayat Belanja',
                        'header_transaksi_request'  => $header_transaksi_request,
                        'transaksi'         => $transaksi,
                        'site'              => $site
                    );
        $this->load->view('admin/transaksi_request/cetak', $data, FALSE);
    }

}