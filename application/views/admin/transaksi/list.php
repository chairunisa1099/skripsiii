<div class="row mt-4">
    <div class="col-12">
        <h4 class="container h4">Cek Status Pembayaran</h4>
        <form action="<?= base_url('admin/transaksi/cekstatus')?>" method="POST">
        <div class="col-md-4">
        <input name="order_id" type="text" class="form-control" placeholder="Order Id" >
    </div>
</div>
    <div class="col-4">
        <button class="btn btn-primary" type="submit">Cari</button>
    </div>
</div>
<br>
  


<table class="table table-bordered" width="100%">
        <thead>
            <tr class="bg-success">
                <th>NO</th>
                <th>PELANGGAN</th>
                <th>KODE TRANSAKSI</th>
                <th>TANGGAL</th>
                <th>JUMLAH TOTAL</th>
                <th>JUMLAH ITEM</th>
                <th>ORDER ID</th>
                <th>STATUS BAYAR</th>
                <th>ACTION</th>

            </tr>
        </thead>
        <tbody>
            <?php $i=1; foreach($header_transaksi as $header_transaksi) { ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $header_transaksi->nama_pelanggan ?>
                    <br><small>
                        Telepon : <?php echo $header_transaksi->telepon?>
                        <br>Email : <?php echo $header_transaksi->email?>
                        <br>Alamat kirim :  <br><?php echo nl2br ($header_transaksi->alamat) ?>
                    </small>
                </td>
                <td><?php echo $header_transaksi->kode_transaksi ?></td>
                <td><?php echo date('d-m-Y', strtotime($header_transaksi->tanggal_transaksi)) ?></td>
                <td><?php echo number_format($header_transaksi->jumlah_transaksi) ?></td>
                <td><?php echo $header_transaksi->total_item ?></td>
                <td><?php echo $header_transaksi->order_id ?></td>
                <td><?php echo $header_transaksi->status_bayar ?></td>
            
                <td>
                <div class="btn-group">
                    <a href="<?php echo base_url('admin/transaksi/detail/'.$header_transaksi->kode_transaksi) ?>"
                    target="_blank" class="btn btn-success btn-sm"><i class="fa fa-eye"></i>Detail</a>
                    <a href="<?php echo base_url('admin/transaksi/cetak/'.$header_transaksi->kode_transaksi) ?>"
                    class="btn btn-info btn-sm"><i class="fa fa-print"></i>Cetak</a>
                    </div>
                </td>

            </tr>
            <?php $i++; } ?>
        </tbody>
    </table>
    