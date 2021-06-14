<section class="cart bgwhite p-t-70 p-b-100">
<div class="container">
    <div class="container-table-cart pos-relative">
        <div class="wrap-table-shopping-cart bgwhite">

<h1><?php echo $title ?></h1>
<hr>
<div class="clearfix"></div>

<!-- Client key -->
<script type="text/javascript" 
    src="https://app.sandbox.midtrans.com/snap/snap.js" 
    data-client-key="SB-Mid-client-yli9Sc33VgeYZ9XH">
</script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<br><br>

<?php if ($this->session->flashdata('sukses')) {
echo '<div class="alert alert-warning">';
echo $this->session->flashdata('sukses');
echo '</div>';
} ?>


<?php if ($this->session->flashdata('type') != 'custom') { ?>


<table class="table-shopping-cart">
    <tr class="table-head">
        <th class="column-1">GAMBAR</th>
        <th class="column-2">PRODUK</th>
        <th class="column-3">HARGA</th>
        <th class="column-4">JUMLAH</th>
        <th class="column-5" width="15%">SUB TOTAL</th>
        <th class="column-6" width="20%">ACTION</th>
    </tr>

    <?php

    // looping data krjng blnj
    foreach ($keranjang as $keranjang) {
        // ambil data produk
        $id_produk = $keranjang['id'];
        $produk = $this->produk_model->detail($id_produk);
        // form update keranjang
        echo form_open(base_url('belanja/update_cart/' . $keranjang['rowid']));
    ?>

        <tr class="table-row">
            <td class="column-1">
                <div class="cart-img-product b-rad-4 o-f-hidden">
                    <img src="<?php echo base_url('assets/upload/image/thumbs/' . $produk->gambar) ?>" alt="<?php echo $keranjang['name'] ?>">
                </div>
            </td>
            <td class="column-2"><?php echo $keranjang['name'] ?></td>
            <td class="column-4">Rp. <?php echo number_format($keranjang['price'], '0', ',', '.') ?></td>
            <td class="column-4">
                <div class="flex-w bo5 of-hidden w-size17">
                    <button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2">
                        <i class="fs-12 fa fa-minus" aria-hidden="true"></i>
                    </button>

                    <input class="size8 m-text18 t-center num-product" type="number" name="qty" value="<?php echo $keranjang['qty'] ?>">

                    <button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2">
                        <i class="fs-12 fa fa-plus" aria-hidden="true"></i>
                    </button>
                </div>
            </td>
            <td class="column-5">Rp.
                <?php
                $sub_total = $keranjang['price'] * $keranjang['qty'];
                echo number_format($sub_total, '0', ',', '.');
                ?>
            </td>
            <td>
                <button type="submit" name="update" class="btn btn-success btn-sm">
                    <i class="fa fa-edit"></i> Update
                </button>
                <a href="<?php echo base_url('belanja/hapus/' . $keranjang['rowid']) ?>" class="btn btn-warning btn-sm">
                    <i class="fa fa-trash-o"></i> Hapus
                </a>
            </td>
        </tr>
    <?php
        // echo form close
        echo form_close();
        // end loop keranjang belanja
    }

    ?>

    <tr class="table-row bg-info text-strong" style="font-weight: bold; color: white !important;">
        <td colspan="4" class="column-1">Total Belanja</td>
        <td colspan="2" class="column-2">Rp. <?php echo number_format($this->cart->total(), '0', ',', '.') ?></td>
    </tr>
<?php } else { ?>
    <table class="table-shopping-cart">
        <tr class="table-row bg-info text-strong" style="font-weight: bold; color: white !important;">
            <td colspan="4" class="column-1">Total Belanja</td>
            <td colspan="2" class="column-2">Rp. <?php echo number_format($this->session->flashdata('price'), '0', ',', '.') ?></td>
        </tr>
    <?php } ?>
    </table>
    
    <br>

    <!------ Snap finish ------->
    <form id="payment-form" method="post" action="<?=base_url()?>snap/finish">
            <input type="hidden" name="result_type" id="result-type" value=""></div>
            <input type="hidden" name="result_data" id="result-data" value=""></div>
   
    <?php echo form_open(base_url('belanja/checkout')); 

    if ($this->session->flashdata('type') == 'custom') { ?>
        <input type="hidden" name="id_pelanggan" value="<?php echo $pelanggan->id_pelanggan; ?>">
        <input type="hidden" name="jumlah_transaksi" value="<?php echo $this->session->flashdata('price') ?>">
        <input type="hidden" name="id_req" value="<?php echo $this->session->flashdata('idProduk') ?>">
        <input type="hidden" name="tanggal_transaksi" value="<?php echo date('Y-m-d') ?>">
    <?php
    } else {
        $kode_transaksi = date('dmY') . strtoupper(random_string('alnum', 8));
    ?>
    
        <input type="hidden" name="id_pelanggan" value="<?php echo $pelanggan->id_pelanggan; ?>">
        <input type="hidden" name="jumlah_transaksi" value="<?php echo $this->cart->total() ?>">
        <input type="hidden" name="tanggal_transaksi" value="<?php echo date('Y-m-d') ?>"> <?php } ?> <table class="table">


        <!-----------REQUEST ------------>
        <?php if($this->session->flashdata('type') == 'custom'){
                    $jmlbayar = $this->session->flashdata('price');
                } else{
                    $jmlbayar = $this->cart->total();
            }  ?>
 
        <thead>
            <tr>
                <th width="25%">Kode Transaksi</th>
                <?php if ($this->session->flashdata('type') == 'custom') { ?>
                    <th><input type="text" name="kode_transaksi" class="form-control" value="<?php echo $this->session->flashdata('kode') ?>" readonly required></th>
                <?php } else { ?><th><input type="text" name="kode_transaksi" class="form-control" value="<?php echo $kode_transaksi ?>" readonly required></th><?php } ?>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Nama Penerima</td>
                <td><input type="text" name="nama_pelanggan" class="form-control" placeholder="Nama Lengkap" value="<?php echo $pelanggan->nama_pelanggan ?>" required></td>
            </tr>
            <tr>
                <td>Email Penerima</td>
                <td><input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo $pelanggan->email ?>" required></td>
            </tr>

            <tr>
                <td>Telepon</td>
                <td><input type="text" name="telepon" class="form-control" placeholder="Telepon" value="<?php echo $pelanggan->telepon ?>" required></td>
            </tr>
            <tr>
                <td>Alamat Pengiriman</td>
                <td><textarea name="alamat" class="form-control" placeholder="Alamat"><?php echo $pelanggan->alamat ?></textarea></td>
            </tr>

            <tr>
            <td></td>
                <td class="btn-group ">

                <!-- inject forms from flash data -->
                <input type="hidden" name="type" value="<?php echo $this->session->flashdata('type'); ?>">
                <input type="hidden" name="img_name" value="<?php echo $this->session->flashdata('img_name'); ?>">
                <input type="hidden" name="price" value="<?php echo $this->session->flashdata('price'); ?>">
                <input type="hidden" name="kode" value="<?php echo $this->session->flashdata('kode'); ?>">
                <input type="hidden" name="ukuran_busana" value="<?php echo $this->session->flashdata('ukuran_busana'); ?>">
                <input type="hidden" name="bahan_busana" value="<?php echo $this->session->flashdata('bahan_busana'); ?>">
                <input type="hidden" name="motif_busana" value="<?php echo $this->session->flashdata('motif_busana'); ?>">
                <input type="hidden" name="harga_request" value="<?php echo $this->session->flashdata('harga_request'); ?>">

                <button class="flex-c-m size10 bg1 bo-rad-23 hov1 m-text3 trans-0-4 mr-3" type="submit" data-amount="<?= $jmlbayar ?>" id="pay-button">
                Pembayaran


            <!-- MIDTRANS -->
            <script>
            $('#pay-button').click(function (event) {
                event.preventDefault();
                $(this).attr("disabled", "disabled");
                
                var nama_pelanggan = $("#nama_pelanggan").val();
                var jumlah_transaksi = $(this).data('amount');
                $.ajax({
                url: '<?=base_url()?>snap/token',
                data : {
                    nama_pelanggan: nama_pelanggan,
                    jumlah_transaksi: jumlah_transaksi
                },
                cache: false,
                
                success: function(data) {
                    //location = data;

                    console.log('token = '+data);
                    
                    var resultType = document.getElementById('result-type');
                    var resultData = document.getElementById('result-data');

                    function changeResult(type,data){
                    $("#result-type").val(type);
                    $("#result-data").val(JSON.stringify(data));
                    //resultType.innerHTML = type;
                    //resultData.innerHTML = JSON.stringify(data);
                    }

                    snap.pay(data, {
                    
                    onSuccess: function(result){
                        changeResult('success', result);
                        console.log(result.status_message);
                        console.log(result);
                        $("#payment-form").submit();
                    },
                    onPending: function(result){
                        changeResult('pending', result);
                        console.log(result.status_message);
                        $("#payment-form").submit();
                    },
                    onError: function(result){
                        changeResult('error', result);
                        console.log(result.status_message);
                        $("#payment-form").submit();
                    }
                    });
                }
                });
            });
            </script>
            </button>

                <button class="flex-c-m size10 bg1 bo-rad-23 hov1 m-text3 trans-0-4" type="reset">
                    <i class="fa fa-times m-r-5"></i> Reset
                </button>
                </td>
            </tr>
</tbody>
</table>

<?php echo form_close(); ?>
        </div>
    </div>
    </form>
</div>
</section>