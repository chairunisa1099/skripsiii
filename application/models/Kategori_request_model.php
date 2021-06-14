<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_request_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // listing all kategori
    public function listing()
    {
        $this->db->select('*');
        $this->db->from('kategori_request');
        $this->db->order_by('id_kategori_request', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    // detail kategori
    public function detail($id_kategori_request)
    {
        $this->db->select('*');
        $this->db->from('kategori_request');
        $this->db->where('id_kategori_request', $id_kategori_request);
        $this->db->order_by('id_kategori_request', 'desc');
        $query = $this->db->get();
        return $query->row();
    }

    // detail slug kategori
    public function read($slug_kategori_request)
    {
        $this->db->select('*');
        $this->db->from('kategori_request');
        $this->db->where('slug_kategori_request', $slug_kategori_request);
        $this->db->order_by('id_kategori_request', 'desc');
        $query = $this->db->get();
        return $query->row();
    }

    // login kategori
    public function login($nama_kategori_request, $password)
    {
        $this->db->select('*');
        $this->db->from('kategori_request');
        $this->db->where(array('nama_kategori_request'  => $nama_kategori_request,
                                'password'              => ($password)));
        $this->db->order_by('id_kategori_request', 'desc');
        $query = $this->db->get();
        return $query->row();
    }

    //tambah
    public function tambah($data)
    {
        $this->db->insert('kategori_request', $data);
    }

    //edit
    public function edit($data)
    {
        $this->db->where('id_kategori_request', $data['id_kategori_request']);
        $this->db->update('kategori_request', $data);
    }

    //delete
    public function delete($data)
    {
        $this->db->where('id_kategori_request', $data['id_kategori_request']);
        $this->db->delete('kategori_request', $data);
    }
   
}