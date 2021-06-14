	<!-- Cart -->
	<section class="bgwhite p-t-70 p-b-100">
		<div class="container">
			<!-- Cart item -->
			<div class="pos-relative">
				<div class="bgwhite">
					<h3><?php echo $title ?></h3> <hr>
                    <br></br>
                    
					<?php if($this->session->flashdata('sukses')) {
						echo '<div class="alert alert-warning">';
						echo $this->session->flashdata('sukses');
						echo'</div>';
					} ?>
                       
					
			</div>
		</div>
		</div>
	</section>

				
