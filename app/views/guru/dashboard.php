<div class="container">
	<h2>Kelas</h2>
	<!-- Bagian kelas -->
	<div class="row justify-content-evenly">
		<!-- //card 
			- nama kelas, sekolah, banyak tugas, progres(nanti), banyak siswa
		 -->
		 <?php foreach ($data['allkelas'] as $key => $value):?>
			 <div class="col-11 col-md-8 col-lg-6">
			 	<div class="card mb-2">
			 		<div class="card-header text-bg-dark">
			 			<p class="mb-0 fs-5"><strong><?= $value['nama'] ?></strong></p>
			 			<p class="mb-0"><?= $value['sekolah'] ?></p>
			 		</div>
			 		<div class="card-body">
			 			<div class="d-flex justify-content-evenly">
				 			<p>Banyak Siswa (...?)</p>
				 			<p>Banyak Tugas (...?)</p>
			 			</div>
			 			<p class="text-center">Token Kelas (<?= $key  ?>)</p>
			 		</div>
			 		<div class="card-footer text-end text-bg-dark">
			 			<p><?= $value['tahun'] ?></p>
			 		</div>
			 	</div>
			 </div>
		 <?php endforeach; ?>
	</div>
	<hr>
	<h2>Berita</h2>
	<div class="row justify-content-evenly">
		<section id="Berita" class="col-11 col-md-8 col-lg-6">
			<div class="card mb-2" id="update" style="max-height: 80vh;">
				<div class="card-header text-bg-dark">
					<h2 class="text-center">Update</h2>
				</div>
				<div class="card-body overflow-auto">
					<ul class="list-group list-group-flush">
						<?php foreach ($data['log_update'] as $key => $value): ?>
						    <li class="list-group-item pb-2">
						    	<div class="identitas-update hstack">
							    	<p class="version fs-4 mb-0"><strong><?= $value['version'] ?></strong></p>
							    	<p class="date ms-auto mb-0"><em><?= $value['date'] ?></em></p>
						    	</div>
						    	<div class="d-flex">
						    		<div class="vr"></div>
						    		<div class="d-block ms-2">
							    		<?php foreach ($value['changes'] as $changes):?>
							    			<p class="changes mb-0">  ~ <?= $changes ?></p>
							    		<?php endforeach; ?>
						    		</div>
						    	</div>
						    </li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
		</section>
	</div>
</div>
