<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Header_transaksi_request_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function tambahRequest($data)
    {
        $this->db->insert('header_transaksi_request', $data);
    }

    public function listing()
    {
        $this->db->select('header_transaksi_request.*,
                            pelanggan.nama_pelanggan,
                            SUM(request.jumlah) AS total_item');
        $this->db->from('header_transaksi_request');
        $this->db->join('request', 'request.kode_transaksi = header_transaksi_request.kode_transaksi', 'left');
        $this->db->join('pelanggan', 'pelanggan.id_pelanggan = header_transaksi_request.id_pelanggan', 'left');
        $this->db->group_by('header_transaksi_request.id_header_transaksi_request');
        $this->db->order_by('id_header_transaksi_request', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    public function pelanggan($id_pelanggan)
    {
        $this->db->select('header_transaksi_request.*,
                            SUM(request.jumlah) AS total_item');
        $this->db->from('header_transaksi_request');
        $this->db->where('header_transaksi_request.id_pelanggan', $id_pelanggan);
        $this->db->join('request', 'request.kode_transaksi = header_transaksi_request.kode_transaksi', 'left');

        $this->db->group_by('header_transaksi_request.id_header_transaksi_request');
        $this->db->order_by('id_header_transaksi_request', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    // detail header_transaksi
    public function detail($id_header_transaksi_request)
    {
        $this->db->select('*');
        $this->db->from('header_transaksi_request');
        $this->db->where('id_header_transaksi_request', $id_header_transaksi_request);
        $this->db->order_by('id_header_transaksi_request', 'desc');
        $query = $this->db->get();
        return $query->row();
    }


    public function kode_transaksi($kode_transaksi)
    {
        $this->db->select('header_transaksi_request.*,
                            pelanggan.nama_pelanggan,
                            SUM(request.jumlah) AS total_item');
        $this->db->from('header_transaksi_request');
        $this->db->join('request', 'request.kode_transaksi = header_transaksi_request.kode_transaksi', 'left');
        $this->db->join('pelanggan', 'pelanggan.id_pelanggan = header_transaksi_request.id_pelanggan', 'left');
        $this->db->group_by('header_transaksi_request.id_header_transaksi_request');
        $this->db->where('request.kode_transaksi', $kode_transaksi);
        $this->db->order_by('id_header_transaksi_request', 'desc');
        $query = $this->db->get();
        return $query->row();
    }


}