<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Motif_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // listing all motif
    public function listing()
    {
        $this->db->select('*');
        $this->db->from('motif');
        $this->db->order_by('id_motif', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

     // detail motif
     public function detail($id_motif)
     {
         $this->db->select('*');
         $this->db->from('motif');
         $this->db->where('id_motif', $id_motif);
         $this->db->order_by('id_motif', 'desc');
         $query = $this->db->get();
         return $query->row();
     }

     // detail slug motif
     public function read($slug_motif)
     {
         $this->db->select('*');
         $this->db->from('motif');
         $this->db->where('slug_motif', $slug_motif);
         $this->db->order_by('id_motif', 'desc');
         $query = $this->db->get();
         return $query->row();
     }

     // login motif
     public function login($nama_motif,$password)
     {
         $this->db->select('*');
         $this->db->from('motif');
         $this->db->where(array('nama_motif'  => $nama_motif,
                                'password'       => ($password)));
         $this->db->order_by('id_motif', 'desc');
         $query = $this->db->get();
         return $query->row();
     }

    //tambah
    public function tambah($data)
    {
        $this->db->insert('motif', $data);
    }

     //edit
     public function edit($data)
     {
         $this->db->where('id_motif', $data['id_motif']);
         $this->db->update('motif', $data);
     }

    //delete
    public function delete($data)
    {
        $this->db->where('id_motif', $data['id_motif']);
        $this->db->delete('motif', $data);
    }
   
}