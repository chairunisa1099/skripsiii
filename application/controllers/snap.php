<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Snap extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -  
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */


    public function __construct()
    {
        parent::__construct();
        $params = array('server_key' => 'SB-Mid-server-O8eHCfCrnzQUbRTnpKJ2OHpR', 'production' => false);
        $this->load->library('midtrans');
        $this->midtrans->config($params);
        $this->load->helper('url');
        $this->load->model('produk_model');
        $this->load->model('kategori_model');
        $this->load->model('konfigurasi_model');
        $this->load->model('auth_model');
        $this->load->model('header_transaksi_model');
        $this->load->model('transaksi_model');
        $this->load->model('request_model');
        $this->load->model('header_transaksi_request_model');
        // load helper
        $this->load->helper('string');
    }

    public function index()
    {
        $this->load->view('belanja/checkout');
    }

    public function token()
    {
        $nama_pelanggan = $this->input->get('nama_pelanggan');
        $jumlah_transaksi = $this->input->get('jumlah_transaksi');

        $keranjang = $this->cart->contents();

        // Required
        $transaction_details = array(
            'order_id' => rand(),
            'gross_amount' => $jumlah_transaksi,
        );

        if ($this->session->flashdata('type') == 'custom') {
            // Optional
            $item_details = array(
                'id' => '1',
                'price' => $jumlah_transaksi,
                'quantity' => 1,
                'name' => "Request Busana"
            );
        } else {

            foreach ($keranjang as $keranjang) {
                $item_details[] = array(
                    'id'        => $keranjang['id'],
                    'price'     => $keranjang['price'],
                    'quantity'  => $keranjang['qty'],
                    'name'      => $keranjang['name']
                );
            }
        }

        // Optional
        $billing_address = array(
            'first_name'    => "Andri",
            'last_name'     => "Litani",
            'address'       => "Mangga 20",
            'city'          => "Jakarta",
            'postal_code'   => "16602",
            'phone'         => "081122334455",
            'country_code'  => 'IDN'
        );

        // Optional
        $shipping_address = array(
            'first_name'    => "Obet",
            'last_name'     => "Supriadi",
            'address'       => "Manggis 90",
            'city'          => "Jakarta",
            'postal_code'   => "16601",
            'phone'         => "08113366345",
            'country_code'  => 'IDN'
        );

        // Optional
        $customer_details = array(
            'first_name'    => $nama_pelanggan,
            'email'         => "chairunisa@gmail.com",
            'phone'         => "087774133238",
            'billing_address'  => $billing_address,
            'shipping_address' => $shipping_address
        );

        // Data yang akan dikirim untuk request redirect_url.
        $credit_card['secure'] = true;
        //ser save_card true to enable oneclick or 2click
        //$credit_card['save_card'] = true;

        $time = time();
        $custom_expiry = array(
            'start_time' => date("Y-m-d H:i:s O", $time),
            'unit' => 'day',
            'duration'  => 1
        );

        $transaction_data = array(
            'transaction_details' => $transaction_details,
            'item_details'       => $item_details,
            'customer_details'   => $customer_details,
            'credit_card'        => $credit_card,
            'expiry'             => $custom_expiry
        );

        error_log(json_encode($transaction_data));
        $snapToken = $this->midtrans->getSnapToken($transaction_data);
        error_log($snapToken);
        echo $snapToken;
    }

    public function finish()
    {
        $result = json_decode($this->input->post('result_data'));
        echo 'RESULT <br><pre>';
        var_dump($result);
        echo '</pre>';
        
        if ($this->session->userdata('email')) {
            $email              = $this->session->userdata('email');
            $nama_pelanggan     = $this->session->userdata('nama_pelanggan');
            $pelanggan          = $this->auth_model->sudah_login($email, $nama_pelanggan);

            if ($this->input->post('type') == 'custom') {
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

                if ($valid->run() === FALSE) {
                    //end validasi

                    $data   = array(
                        'title'     => 'Checkout',
                        'pelanggan' => $pelanggan,
                        'isi'       => 'belanja/checkout'
                    );
                    $this->session->set_flashdata('type', 'custom');
                    $this->load->view('layout/wrapper', $data, FALSE);
                    // masuk db
                } else {
                    $i = $this->input;
                    $data = array(
                        'id_pelanggan'          => $pelanggan->id_pelanggan,
                        'nama_pelanggan'        => $i->post('nama_pelanggan'),
                        'email'                 => $i->post('email'),
                        'telepon'               => $i->post('telepon'),
                        'alamat'                => $i->post('alamat'),
                        'kode_transaksi'        => $i->post('kode_transaksi'),
                        'tanggal_transaksi'     => $i->post('tanggal_transaksi'),
                        'jumlah_transaksi'      => $i->post('jumlah_transaksi'),
                        'status_bayar'          => 'Belum'
                    );
                    // masuk ke header transaksi
                    $this->header_transaksi_request_model->tambahRequest($data);
                    // masuk ke tabel transaksi
                    $data = array(
                        'ukuran_busana'    => $i->post('ukuran_busana'),
                        'bahan_busana'     => $i->post('bahan_busana'),
                        'motif_busana'     => $i->post('motif_busana'),
                        'gambar_desain'    => $i->post('img_name'),
                        'harga_request'    => $i->post('harga_request'),
                        'kode_transaksi'   => $i->post('kode_transaksi'),

                    );
                    $this->request_model->tambahRequest($data);

                    $this->session->set_flashdata('sukses', 'Checkout berhasil');
                    redirect(base_url('request/sukses'), 'refresh');
                }
                //end masuk database
            } else {
                $keranjang          = $this->cart->contents();

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

                if ($valid->run() === FALSE) {
                    //end validasi

                    $data   = array(
                        'title'     => 'Checkout',
                        'keranjang' => $keranjang,
                        'pelanggan' => $pelanggan,
                        'isi'       => 'belanja/checkout'
                    );
                    $this->load->view('layout/wrapper', $data, FALSE);
                    // masuk db
                } else {
                    $i = $this->input;
                    $data = array(
                        'id_pelanggan'          => $pelanggan->id_pelanggan,
                        'nama_pelanggan'        => $i->post('nama_pelanggan'),
                        'email'                 => $i->post('email'),
                        'telepon'               => $i->post('telepon'),
                        'alamat'                => $i->post('alamat'),
                        'kode_transaksi'        => $i->post('kode_transaksi'),
                        'tanggal_transaksi'     => $i->post('tanggal_transaksi'),
                        'jumlah_transaksi'      => $i->post('jumlah_transaksi'),
                        'status_bayar'          => $result->transaction_status,
                        'tanggal_bayar'          => date('Y-m-d H:i:s')
                    );
                    // masuk ke header transaksi
                    $this->header_transaksi_model->tambah($data);
                    // masuk ke tabel transaksi
                    foreach ($keranjang as $keranjang) {
                        $sub_total  = $keranjang['price'] * $keranjang['qty'];

                        $data       = array(
                            'id_pelanggan'      => $pelanggan->id_pelanggan,
                            'kode_transaksi'    => $i->post('kode_transaksi'),
                            'id_produk'         => $keranjang['id'],
                            'harga'             => $keranjang['price'],
                            'jumlah'            => $keranjang['qty'],
                            'total_harga'       => $sub_total,
                            'tanggal_transaksi' => $i->post('tanggal_transaksi')
                        );
                        $this->transaksi_model->tambah($data);
                    }
                    // end proses masuk ke tabel transaksi

                    // stlh masuk ke tabel transaksi, keranjang dikosongkan
                    $this->cart->destroy();
                    // end destroy keranjang
                    $this->session->set_flashdata('sukses', 'Checkout berhasil');
                    redirect(base_url('belanja/sukses'), 'refresh');
                }
                //end masuk database
            }
        } else {
            // klo blm hrs regist
            $this->session->set_flashdata('sukses', 'Silahkan login atau registrasi terlebih dahulu');
            redirect(base_url('register'), 'refresh');
        }
    }
}
