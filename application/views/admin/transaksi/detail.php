<p class="pull-right">
    <div class="btn-group pull-right">
        <a href="<?php echo base_url('admin/transaksi/cetak/'.$header_transaksi->kode_transaksi) ?>" target="_blank" title="Cetak" class="btn btn-success btn-sm">
            <i class="fa fa-print"></i>Cetak
        </a>
        <a href="<?php echo base_url('admin/transaksi/produk/') ?>" title="Kembali" class="btn btn-info btn-sm">
            <i class="fa fa-backward"></i> Kembali
        </a>  
    </div>
</p>
<div class="clearfix"></div><hr>

<table class="table table-bordered">
    <thead>
        <tr>
            <th width="20%">Nama Pelanggan</th>
            <th>: <?php echo $header_transaksi->nama_pelanggan ?></th>
        </tr>
        <tr>
            <th width="20%">Kode Transaksi</th>
            <th>: <?php echo $header_transaksi->kode_transaksi ?></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Tanggal Transaksi</td>
            <td>: <?php echo date('d-m-Y', strtotime($header_transaksi->tanggal_transaksi)) ?></td>
        </tr>
        <tr>
            <td>Jumlah Total</td>
            <td>: <?php echo number_format($header_transaksi->jumlah_transaksi) ?></td>
        </tr>
        <tr>
            <td>Status Bayar</td>
            <td>: <?php echo $header_transaksi->status_bayar ?></td>
        </tr>
        <tr>
            <td>Tanggal Bayar</td>
            <td>: <?php echo date('d-m-Y', strtotime($header_transaksi->tanggal_bayar)) ?></td>
        </tr>
    </tbody>
</table>
<hr>

<table class="table table-bordered" width="100%">
    <thead>
        <tr class="bg-success">
            <th>NO</th>
            <th>KODE</th>
            <th>NAMA PRODUK</th>
            <th>JUMLAH</th>
            <th>HARGA</th>
            <th>SUB TOTAL</th>

        </tr>
    </thead>
    <tbody>
        <?php $i=1; foreach($transaksi as $transaksi) { ?>
        <tr>
            <td><p><?php echo $i ?></p></td>
            <td><?php echo $transaksi->kode_produk ?></td>
            <td><?php echo $transaksi->nama_produk ?></td>
            <td><?php echo number_format($transaksi->jumlah) ?></td>
            <td><?php echo number_format($transaksi->harga) ?></td>
            <td><?php echo number_format($transaksi->total_harga) ?></td>

        </tr>
        <?php $i++; } ?>
    </tbody>
</table>