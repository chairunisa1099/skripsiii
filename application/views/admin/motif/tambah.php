<?php 
//notif error
echo validation_errors('<div class="alert alert-warning">','</div>');

//form open 
echo form_open_multipart(base_url('admin/motif/tambah'),' class="form-horizontal"');
?>

<div class="form-group">
    <label class="col-md-2 control-label">Nama motif </label>
    <div class="col-md-5">
    <input type="text" name="nama_motif" class="form-control" placeholder="Nama Motif" value="<?php echo set_value('nama_motif') ?>" required>
    </div>
</div>

<div class="form-group">
    <label class="col-md-2 control-label">Kode Motif</label>
    <div class="col-md-5">
    <input type="text" name="kode_motif" class="form-control" placeholder="Kode Motif" value="<?php echo set_value('kode_motif') ?>" required>
    </div>
</div>

<div class="form-group">
    <label class="col-md-2 control-label">Upload Gambar Motif</label>
    <div class="col-md-10">
        <input type="file" name="gambar_motif" class="form-control">
    </div>
</div>

<div class="form-group">
    <label class="col-md-2 control-label"></label>
    <div class="col-md-5">
        <button class="btn btn-success btn-lg" name="submit" type="submit">
            <i class="fa fa-save"></i>Simpan
        </button>

        <button class="btn btn-info btn-lg" name="reset" type="reset">
            <i class="fa fa-times"></i>Reset
        </button>
    </div>
</div>
<?php echo form_close(); ?>