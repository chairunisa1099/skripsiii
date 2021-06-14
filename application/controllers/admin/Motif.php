<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Motif extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('motif_model');
        // proteksi hlmn
        $this->simple_login->cek_login();
    }

    // Data Kategori request
    public function index()
    {
        $motif = $this->motif_model->listing();

        $data = array('title'   => 'Data Motif',
                      'motif'   => $motif,
                      'isi'     =>'admin/motif/list'
                    );
        $this->load->view('admin/layout/wrapper', $data, FALSE);

    }


    // Tambah motif
    public function tambah()
    {
        //validasi input
        $valid = $this->form_validation;

        $valid->set_rules('nama_motif', 'Nama Motif', 'required',
                    array('required' => '%s harus diisi')); 
        
        $valid->set_rules('kode_motif', 'Kode Motif', 'required|is_unique[motif.kode_motif]',
                    array('required'    =>'%s harus diisi',
                          'is_unique'   =>'%s sudah ada. Buat kode motif baru'));            
        
        if($valid->run()) 
        {
            $config['upload_path']      = './assets/upload/image/motif';
            $config['allowed_types']    = 'gif|jpg|jpeg|png';
            $config['max_size']         = '2400'; //kb
            $config['max_width']        = '2400';
            $config['max_height']       = '2400';
            
            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('gambar_motif')){    
            $data = array('title'   =>'Tambah Motif',
                        'error'     => $this->upload->display_errors(),
                        'isi'       => 'motif/tambah'
                );
            $this->load->view('layout/wrapper', $data, FALSE);             

        //end validasi

        //masuk database
        }else{
            $upload_gambar = array('upload_data' => $this->upload->data());

            // create thumbnail gbr
            $config['image_library']    = 'gd2';
            $config['source_image']     = './assets/upload/motif/'.$upload_gambar['upload_data']['file_name'];
            // loc folder thumbnail
            $config['new_image']        = './assets/upload/motif/thumbs/';
            $config['create_thumb']     = TRUE;
            $config['maintain_ratio']   = TRUE;
            $config['width']            = 250;
            $config['height']           = 250;
            $config['thumb_marker']   = '';
            
            $this->load->library('image_lib', $config);

            $this->image_lib->resize();
            // end create

            $i = $this->input;
            //slug motif
            $slug_motif = url_title($this->input->post('nama_motif').'-'.$this->input->post('kode_motif'), 'dash', TRUE);

            $data = array(  'nama_motif'     => $i->post('nama_motif'),
                            'kode_motif'     => $i->post('kode_motif'),
                            'slug_motif'     => $slug_motif,
                            'gambar_motif'   => $upload_gambar['upload_data']['file_name']
                        );
        $this->motif_model->tambah($data);
        $this->session->set_flashdata('sukses', 'Data telah ditambah');
        redirect(base_url('admin/motif'),'refresh');
        }
    }
        //end masuk database
        $data = array('title'       => 'Tambah Motif',
                    'isi'           =>'admin/motif/tambah'
                    );
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }



    // Edit motif
    public function edit($id_motif)
    {
        $motif = $this->motif_model->detail($id_motif);
        //validasi input
        $valid = $this->form_validation;

        $valid->set_rules('nama_motif', 'Nama Motif', 'required',
                array('required' => '%s harus diisi'));   

        $valid->set_rules('kode_motif', 'Kode Motif', 'required',
                array('required'    =>'%s harus diisi'));    
        
        if($valid->run()) 
        // jika gambar ganti
        {
            if(!empty($_FILES['gambar_motif']['name'])) {
            $config['upload_path']      = './assets/upload/motif';
            $config['allowed_types']    = 'gif|jpg|jpeg|png';
            $config['max_size']         = '2400'; //kb
            $config['max_width']        = '2400';
            $config['max_height']       = '2400';
            
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ( ! $this->upload->do_upload('gambar_motif')){    
        
        }else{
            $upload_gambar = array('upload_data' => $this->upload->data());

            $config['image_library']    = 'gd2';
            $config['source_image']     = './assets/upload/motif/'.$upload_gambar['upload_data']['file_name'];
            // loc folder thumbnail
            $config['new_image']        = './assets/upload/image/motif/thumbs/';
            $config['create_thumb']     = TRUE;
            $config['maintain_ratio']   = TRUE;
            $config['width']            = 250;
            $config['height']           = 250;
            $config['thumb_marker']     = '';
            
            $this->load->library('image_lib', $config);

            $this->image_lib->resize();
            // end create

            $i = $this->input;
            $slug_motif = url_title($this->input->post('nama_motif').'-'.$this->input->post('kode_motif'), 'dash', TRUE);
            
            $data = array('id_motif'   => $id_motif,
                        'kode_motif'   => $i->post('kode_motif'),
                        'slug_motif'   => $slug_motif,
                        'nama_motif'   => $i->post('nama_motif'),
                        'gambar_motif' => $upload_gambar['upload_data']['file_name']                              
                        );
            $this->motif_model->edit($data);
            $this->session->set_flashdata('sukses', 'Data telah di edit');
            redirect(base_url('admin/motif'),'refresh');

            $data = array('title'       => 'Edit Motif '.$motif->nama_motif,
                        'motif'         => $motif,
                        'isi'           =>'admin/motif/edit'
                        );
            $this->load->view('admin/layout/wrapper', $data, FALSE);
        }}
        
        // tanpa ganti gambar
        else{
            $i = $this->input;
            $slug_motif = url_title($this->input->post('nama_motif').'-'.$this->input->post('kode_motif'), 'dash', TRUE);

            $data = array('id_motif'   => $id_motif,
                        'kode_motif'   => $i->post('kode_motif'),
                        'slug_motif'   => $slug_motif,
                        'nama_motif'   => $i->post('nama_motif'),                 
                        // 'gambar_motif'  => $upload_gambar['upload_data']['file_name']                              
            );
            $this->motif_model->edit($data);
            $this->session->set_flashdata('sukses', 'Data telah di edit');
            redirect(base_url('admin/motif'),'refresh');
            }}

            $data = array('title'       => 'Edit Motif '.$motif->nama_motif,
                        'motif'         => $motif,
                        'isi'           =>'admin/motif/edit'
            );
            $this->load->view('admin/layout/wrapper', $data, FALSE);
        }
        



    //Delete motif
    public function delete($id_motif)
    {
        $data = array('id_motif' => $id_motif);
        $this->motif_model->delete($data);
        $this->session->set_flashdata('sukses', 'Data telah dihapus');
        redirect(base_url('admin/motif'),'refresh');
    }
}