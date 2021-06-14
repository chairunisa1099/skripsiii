<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_request extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('kategori_request_model');
        // proteksi hlmn
        $this->simple_login->cek_login();
    }

    // Data Kategori request
    public function index()
    {
        $kategori_request = $this->kategori_request_model->listing();

        $data = array('title'            => 'Data Kategori Request',
                      'kategori_request' => $kategori_request,
                      'isi'              =>'admin/kategori_request/list'
    );
        $this->load->view('admin/layout/wrapper', $data, FALSE);

    }

      // Tambah Kategori
      public function tambah()
      {
            //validasi input
            $valid = $this->form_validation;

            $valid->set_rules('nama_kategori_request', 'Nama kategori Request', 'required|is_unique[kategori_request.nama_kategori_request]',
                    array('required' => '%s harus diisi',
                          'is_unique'=> '%s sudah ada, Buat kategori baru!'));           
            
            if($valid->run()===FALSE) {
            //end validasi

            $data = array('title'  =>'Tambah Kategori Request',
                          'isi'    =>'admin/kategori_request/tambah'
                         );
            $this->load->view('admin/layout/wrapper', $data, FALSE);
            //masuk database
            }else{
                $i = $this->input;
                $slug_kategori_request = url_title($this->input->post('nama_kategori_request'), 'dash', TRUE);
               
                $data = array('slug_kategori_request'   => $slug_kategori_request,
                              'nama_kategori_request'   => $i->post('nama_kategori_request')
                            );
            $this->kategori_request_model->tambah($data);
            $this->session->set_flashdata('sukses', 'Data telah ditambah');
            redirect(base_url('admin/kategori_request'),'refresh');
         }
      }

       // Edit Kategori
       public function edit($id_kategori_request)
       {
            $kategori_request = $this->kategori_request_model->detail($id_kategori_request);
            //validasi input
            $valid = $this->form_validation;

            $valid->set_rules('nama_kategori_request', 'Nama kategori request', 'required',
                    array('required' => '%s harus diisi'));           
            
            if($valid->run()===FALSE) {
            //end validasi

            $data = array('title'               =>'Edit Kategori request',
                          'kategori_request'    => $kategori_request,
                          'isi'                 =>'admin/kategori_request/edit'
                            );
            $this->load->view('admin/layout/wrapper', $data, FALSE);
            //masuk database
            }else{
                $i = $this->input;
                $slug_kategori_request = url_title($this->input->post('nama_kategori_request'), 'dash', TRUE);
                
                $data = array('id_kategori_request'     => $id_kategori_request,
                              'slug_kategori_request'   => $slug_kategori_request,
                              'nama_kategori_request'   => $i->post('nama_kategori_request')                              
            );
            $this->kategori_request_model->edit($data);
            $this->session->set_flashdata('sukses', 'Data telah di edit');
            redirect(base_url('admin/kategori_request'),'refresh');
            }
        }

            //Delete kategori
            public function delete($id_kategori_request)
            {
                $data = array('id_kategori_request' => $id_kategori_request);
                $this->kategori_request_model->delete($data);
                $this->session->set_flashdata('sukses', 'Data telah dihapus');
                redirect(base_url('admin/kategori_request'),'refresh');
            }
}