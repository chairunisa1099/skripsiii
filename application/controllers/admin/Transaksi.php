<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $params = array('server_key' => 'SB-Mid-server-O8eHCfCrnzQUbRTnpKJ2OHpR', 'production' => false);
        $this->load->library('veritrans');
        $this->veritrans->config($params);
        $this->load->model('header_transaksi_model');
        $this->load->model('transaksi_model');
        $this->load->model('konfigurasi_model');
        // proteksi hlmn
        $this->simple_login->cek_login();
    }

    // data trans
    public function produk()
    {
        $header_transaksi = $this->header_transaksi_model->listing();
        $data = array(  'title'             => 'Data Transaksi Pemesanan Produk',
                        'header_transaksi'  => $header_transaksi,
                        'isi'               => 'admin/transaksi/list'
                    );
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }


    public function detail($kode_transaksi)
    {
        $header_transaksi   = $this->header_transaksi_model->kode_transaksi($kode_transaksi);
        $transaksi          = $this->transaksi_model->kode_transaksi($kode_transaksi);    
       
        $data = array(  'title'             => 'Riwayat Belanja',
                        'header_transaksi'  => $header_transaksi,
                        'transaksi'         => $transaksi,
                        'isi'               => 'admin/transaksi/detail'
                    );
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    public function cetak($kode_transaksi)
    {
        $header_transaksi   = $this->header_transaksi_model->kode_transaksi($kode_transaksi);
        $transaksi          = $this->transaksi_model->kode_transaksi($kode_transaksi);    
        $site               = $this->konfigurasi_model->listing();

        $data = array(  'title'             => 'Riwayat Belanja',
                        'header_transaksi'  => $header_transaksi,
                        'transaksi'         => $transaksi,
                        'site'              => $site
                    );
        $this->load->view('admin/transaksi/cetak', $data, FALSE);
    }

    public function cekstatus()
    {
        $orderid    = $this->input->post('order_id');
        if($orderid){
            $this->status($orderid);
        }else{
            echo 'Order Id yang anda cek tidak ada';
        }
    }

    private function status($orderid)
    {
        $result = $this->veritrans->status($orderid);
        $dataupdate = [
            'status_bayar'  => $result->transaction_status,
  
        ];
    
        $where = [
            'order_id'  => $orderid

        ];
        $update = $this->header_transaksi_model->update($dataupdate, $where);
        redirect (base_url('admin/transaksi/produk'), 'refresh'); 
    }
}