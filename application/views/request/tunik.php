<section class="bgwhite p-t-70 p-b-100">
<div class="container">
<?php if ($this->session->flashdata('sukses')) {
	echo '<div class="alert alert-warning">';
	echo $this->session->flashdata('sukses');
	echo '</div>';
} ?>

<?php
//error
// notifikasi error
echo validation_errors('<div class ="alert alert-warning">', '</div>');
//form open 
echo form_open_multipart(base_url('request/checkout/')); ?>

<div class="container bgwhite p-t-35 p-b-80">
	<div class="flex-w flex-sb">
		<div class="w-size14 p-t-30 respon5">
			<div class="wrap-slick3 flex-sb flex-w">
				<div class="wrap-slick3-dots"></div>

				<div class="slick3">
					<div class="item-slick3" data-thumb="<?php echo base_url('assets/upload/image/motif/t01.png') ?>">
						<div class="wrap-pic-w">
							<img src="<?php echo base_url('assets/upload/image/motif/t01.png') ?>">
						</div>
					</div>

					<div class="item-slick3" data-thumb="<?php echo base_url('assets/upload/image/motif/t02.png') ?>">
						<div class="wrap-pic-w">
							<img src="<?php echo base_url('assets/upload/image/motif/t02.png') ?>">
						</div>
					</div>

					<div class="item-slick3" data-thumb="<?php echo base_url('assets/upload/image/motif/t03.png') ?>">
						<div class="wrap-pic-w">
							<img src="<?php echo base_url('assets/upload/image/motif/t03.png') ?>">
						</div>
					</div>

					<div class="item-slick3" data-thumb="<?php echo base_url('assets/upload/image/motif/t04.png') ?>">
						<div class="wrap-pic-w">
							<img src="<?php echo base_url('assets/upload/image/motif/t04.png') ?>">
						</div>
					</div>

					<div class="item-slick3" data-thumb="<?php echo base_url('assets/upload/image/motif/t05.png') ?>">
						<div class="wrap-pic-w">
							<img src="<?php echo base_url('assets/upload/image/motif/t05.png') ?>">
						</div>
					</div>

					<div class="item-slick3" data-thumb="<?php echo base_url('assets/upload/image/motif/t06.png') ?>">
						<div class="wrap-pic-w">
							<img src="<?php echo base_url('assets/upload/image/motif/t06.png') ?>">
						</div>
					</div>

				</div>
			</div>
		</div>

		<div class="w-size13 p-t-30 respon5">
			<h3 class="product-detail-name m-text25 p-t-30">
				<?php echo $title ?>
			</h3>

			<p class="s-text8">
				Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare feugiat.
			</p>


				<div class="form-group">
					<div class="form-inline p-t-20">
						<div class="s-text20 w-size15 t-center">
							Size
						</div>
						<select name="ukuran_busana" class="form-control" required="required" id="ukuranBusana">
							<option value="">Choose an option</option>
							<option value="S">Size S</option>
							<option value="M">Size M</option>
							<option value="L">Size L</option>
							<option value="XL">Size XL</option>
						</select>
					</div>


					<div class="form-group">
						<div class="form-inline p-t-20">
							<div class="s-text20 w-size15 t-center">
								Bahan
							</div>
							<select name="bahan_busana" class="form-control" required="required">
								<option value="">Choose an option</option>
								<option value="Katun Rayon">Katun Rayon</option>
								<option value="Katun Jepang">Katun Jepang</option>	
							</select>
						</div>


					<div class="form-group">
						<div class="form-inline p-t-20">
							<div class="s-text20 w-size15 t-center">
								Motif
							</div>
							<select name="motif_busana" class="form-control" required="required">
							<option value="">Choose an option</option>
								<option value="T01">T01</option>
								<option value="T02">T02</option>
								<option value="T03">T03</option>	
								<option value="T04">T04</option>
								<option value="T05">T05</option>
								<option value="T06">T06</option>
							</select>
						</div>


					<div class="form-group">
						<div class="form-inline p-t-20">
							<div class="s-text20 w-size15 t-center">
								Model Lengan
							</div>
							<select name="motif_busana" class="form-control" required="required">
								<option value="">Choose an option</option>
								<option value="Bunga">Lengan Kerut</option>
								<option value="Polkadot">Lengan Rempel</option>
							</select>
					</div>


					<div class="form-group">
						<div class="form-inline p-t-20">
							<div class="s-text20">
								Upload Model Tunik
							</div>
							<td>
								<form action="" method="post" enctype="multipart/form-data">
									<input type="file" name="gambar_desain" class="dropify" data-height="300" required="required">
							<div class="s-text20">
						</div>
						</td>
					</div>
					</form>
							
							<br>
							<h3 class="product-detail-name m-text25 p-b-13">Harga Total</h3>
							<span class="m-text17" id="hargaShow">
								Rp. 0
							</span>
							<input type="hidden" id="hargaValue" name="harga_request" value="0">

							<div class="form-inline p-t-40">
								<div class="w-size16 flex-m flex-w">
									<div class="btn-addcart-product-detail size9 trans-0-4 m-t-10 m-b-10">
										<button id="checkout" type="submit" name="submit" value="submit" class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
											Checkout
										</button>
									</div>
								</div>
							</div>
						</div>


						<?php echo form_close(); ?>
					</div>
</section>
