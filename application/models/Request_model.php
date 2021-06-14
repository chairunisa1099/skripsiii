<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request_model extends CI_Model {

  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  public function tambahRequest($data)
  {
      $this->db->insert('request', $data);
  }

	public function get_all_request()
	{
        $this->db->select('*');
        $this->db->from('request');
        $this->db->order_by('id_request', 'desc');
        $query = $this->db->get();
        return $query->result();
  }

  public function detail($id_request)
	{
        $this->db->select('*');
        $this->db->from('request');
        $this->db->where('id_request',$id_request);
        $this->db->order_by('id_request', 'desc');
        $query = $this->db->get();
        return $query->row();
  }

  public function getId($kodeTransaksi)
	{
        $this->db->select('id_request');
        $this->db->from('request');
        $this->db->where('kode_transaksi',$kodeTransaksi);
        $query = $this->db->get();
        return $query->row()->id_request;
  }

// tambah
  public function tambah($data)
    {
        $this->db->insert('request', $data);
    }
    
//edit
  public function edit($data)
  {
      $this->db->where('id_request',$data['id_request']);
      $this->db->update('request',$data);
  }
// delete

  public function delete($data)
  {
      $this->db->where('id_request',$data['id_request']);
      $this->db->delete('request',$data);
  }
  
 // login transaksi
 public function login($nama_transaksi,$password)
 {
     $this->db->select('*');
     $this->db->from('request');
     $this->db->where(array('nama_transaksi'  => $nama_transaksi,
                            'password'       => ($password)));
     $this->db->order_by('id_request', 'desc');
     $query = $this->db->get();
     return $query->row();
 }

  // listing all transaksi berdasar header
  public function kode_transaksi($kode_transaksi)
  {
      $this->db->select('request.*,
                          request.nama_produk,
                          request.kode_produk');
      $this->db->from('request');
      // join dgn produk
      $this->db->join('request', 'request.id_request = request.id_request', 'left');
      // end join
      $this->db->where('kode_transaksi', $kode_transaksi);
      $this->db->order_by('id_request', 'desc');
      $query = $this->db->get();
      return $query->result();
  }

   // detail slug transaksi
   public function read($slug_transaksi)
   {
       $this->db->select('*');
       $this->db->from('request');
       $this->db->where('slug_transaksi', $slug_transaksi);
       $this->db->order_by('id_request', 'desc');
       $query = $this->db->get();
       return $query->row();
   }
}
             