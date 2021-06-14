<table class="table table-bordered" width="100%">
        <thead>
            <tr class="bg-success">
                <th>NO</th>
                <th>PELANGGAN</th>
                <th>KODE TRANSAKSI</th>
                <th>TANGGAL</th>
                <th>JUMLAH TOTAL</th>
                <th>JUMLAH ITEM</th>
                <th>STATUS BAYAR</th>
                <th>ACTION</th>

            </tr>
        </thead>
        <tbody>
            <?php $i=1; foreach($header_transaksi_request as $header_transaksi_request) { ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $header_transaksi_request->nama_pelanggan ?>
                    <br><small>
                        Telepon : <?php echo $header_transaksi_request->telepon?>
                        <br>Email : <?php echo $header_transaksi_request->email?>
                        <br>Alamat kirim :  <br><?php echo nl2br ($header_transaksi_request->alamat) ?>
                    </small>
                </td>
                <td><?php echo $header_transaksi_request->kode_transaksi ?></td>
                <td><?php echo date('d-m-Y', strtotime($header_transaksi_request->tanggal_transaksi)) ?></td>
                <td><?php echo number_format($header_transaksi_request->jumlah_transaksi) ?></td>
                <td><?php echo $header_transaksi_request->total_item ?></td>
                <td><?php echo $header_transaksi_request->status_bayar ?></td>
            
                <td>
                <div class="btn-group">
                    <a href="<?php echo base_url('admin/transaksi/detail/'.$header_transaksi_request->kode_transaksi) ?>"
                    target="_blank" class="btn btn-success btn-sm"><i class="fa fa-eye"></i>Detail</a>
                    <a href="<?php echo base_url('admin/transaksi/cetak/'.$header_transaksi_request->kode_transaksi) ?>"
                    class="btn btn-info btn-sm"><i class="fa fa-print"></i>Cetak</a>
                    </div>
                </td>

            </tr>
            <?php $i++; } ?>
        </tbody>
    </table>
    