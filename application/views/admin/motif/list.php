<p>
    <a href="<?php echo base_url('admin/motif/tambah') ?>" class="btn btn-success btn-lg">
        <i class="fa fa-plus"></i> Tambah Baru
    </a>
</p>

<?php 
//Notif
if($this->session->flashdata('sukses')) {
    echo '<p class="alert alert-success">';
    echo $this->session->flashdata('sukses');
    echo '</div>';
}
?>

<table class="table table-bordered" id="example1">
    <thead>
        <tr>
            <th>NO</th>
            <th>GAMBAR</th>
            <th>NAMA MOTIF</th>
            <th>KODE MOTIF</th>
            <th>SLUG MOTIF</th>
            <th>ACTION</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($motif as $motif ) { ?>
        <tr>
            <td><?php echo $motif ->id_motif ?></td>
            <td>
                <img src="<?php echo base_url('assets/upload/image/motif/'.$motif->gambar_motif) ?>" class="img img-responsive img-thumbnail" width="60">
            </td>
            <td><?php echo $motif ->nama_motif ?></td>
            <td><?php echo $motif ->kode_motif ?></td>
            <td><?php echo $motif ->slug_motif ?></td>
            <td>
                <a href="<?php echo base_url('admin/motif/edit/'.$motif->id_motif) ?>" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i> Edit </a>           
                <a href="<?php echo base_url('admin/motif/delete/'.$motif->id_motif) ?>" class="btn btn-danger btn-xs" onClick="return confirm('Yakin ingin menghapus data ini?')"><i class="fa fa-trash-o"></i>Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>