<p>
    <a href="<?php echo base_url('admin/kategori_request/tambah') ?>" class="btn btn-success btn-lg">
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
            <th>NAMA</th>
            <th>SLUG</th>
            <th>ACTION</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($kategori_request as $kategori_request ) { ?>
        <tr>
            <td><?php echo $kategori_request ->id_kategori_request ?></td>
            <td><?php echo $kategori_request ->nama_kategori_request ?></td>
            <td><?php echo $kategori_request ->slug_kategori_request ?></td>
            <td>
                <a href="<?php echo base_url('admin/kategori_request/edit/'.$kategori_request->id_kategori_request) ?>" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i> Edit </a>           
                <a href="<?php echo base_url('admin/kategori_request/delete/'.$kategori_request->id_kategori_request) ?>" class="btn btn-danger btn-xs" onClick="return confirm('Yakin ingin menghapus kategori ini?')"><i class="fa fa-trash-o"></i>Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>