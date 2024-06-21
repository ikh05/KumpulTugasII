<div class="container">
	<h1 class="text-center">Daftar Tugas</h1>
	<div class="card mb-3">
		<div class="card-header text-bg-dark">Identitas</div>
		<div class="card-body px-4">
			<div class="row">
				<div class="col-12 col-md-6">
				  	<table class="table">
				  		<tr>
				  			<th scope="row">Nama</th>
				  			<td>: <?= $data['guru']['nama'] ?></td>
				  		</tr>
				  		<tr>
				  			<th scope="row">Email</th>
				  			<td>: <?= $data['guru']['email'] ?></td>
				  		</tr>
				  		<tr>
				  			<th scope="row">No WA</th>
				  			<td>: <?= $data['guru']['noWa'] ?></td>
				  		</tr>
				  	</table>
				  </div>
				  <div class="col-12 col-md-6">
				  	<table class="table">
				  		<tr>
				  			<th scope="ow">Token</th>
				  			<td>: <?= $data['tokenKelas-active'] ?></td>
				  		</tr>
				  		<tr>
				  			<th scope="row">Kelas</th>
				  			<td>: <?= $data['kelas'][$data['tokenKelas-active']]['nama'] ?></td>
				  		</tr>
				  		<tr>
				  			<th scope="row">Sekolah</th>
				  			<td>: <?= $data['kelas'][$data['tokenKelas-active']]['sekolah'] ?></td>
				  		</tr>
				  	</table>
				  </div>
			</div>	
		</div>
		<div class="card-footer text-bg-dark text-end">
			<a href="<?= BASE_URL ?>Guru/setting" class="btn btn-outline-info disabled">Edit</a>
		</div>
	</div>



	<div class="row">
		<div class="col-12 col-md-6">
			<div class="card mb-3">
				<div class="card-header text-bg-dark position-relative">
					Daftar Soal (<?= count($data['soal']) ?>)
					<div class="selectAll position-absolute end-0 top-50 translate-middle-y me-4">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" id="soal-all">
							<label class="form-check-label w-100" for="soal-all" >Pilih Semua</label>
						</div>
					</div>
				</div>
				<div class="card-body">
					<?php if(empty($data['soal'])) :?>
						<p>Anda Belum memliki Soal! silahkan buat soal <a href="<?= BASE_URL ?>Guru/soalKu">disini!</a></p>
					<?php else: ?>
						<table class="table table-hover">
							<thead>
								<tr>
									<th scope="col">#</th>
									<th scope="col">Soal</th>
								</tr>
							</thead>
							<tbody class="table-group-divider daftar-soal">
								<?php foreach ($data['soal'] as $key => $value) :?>
									<tr>
										<th scope="row">
											<input class="form-check-input" type="checkbox" value="" id="soal-<?= $value['id'] ?>" id-soal=<?= $value['id'] ?>>
										</th>
										<td class="p-0 ps-2">
  											<label class=" p-2 form-check-label w-100" for="soal-<?= $value['id'] ?>" ><?= $value['soal'] ?></label>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					<?php endif; ?>
				</div>
				<div class="card-footer text-bg-dark">
					<div class="row">
						<div class="col">
							<div class="input-group">
					  			<select class="form-select form-control border-secondary" aria-label="Default select example" id="soal-banyakBaris">
								  <option selected value="5">5</option>
								  <option value="10">10</option>
								  <option value="25">25</option>
								  <option value="50">50</option>
								  <option value="100">100</option>
								  <option value="all">All</option>
								</select>
				  			</div>
						</div>
			  			<div class="col">
			  				<nav aria-label="Page navigation" id="soal-nav">
							  <ul class="pagination justify-content-end m-0">
							    <li class="page-item order-1"><a href="#soal-nav" value="-1" class="page-link" aria-label="Previous" class=""><span aria-hidden="true">&laquo;</span></a></li>
				    			<li class="disabled page-item order-2 d-none __"><a class="page-link">...</a></li>
								<li class="page-item order-1"><a href="#soal-nav" value="1" class="page-link active">1</a></li>
				    			<li class="disabled page-item order-4 d-none __"><a href="#soal-nav" class="page-link">...</a></li>
							    <li class="page-item order-5"><a href="#soal-nav" value="+1" class="page-link" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
							  </ul>
							</nav>
			  			</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-12 col-md-6">
			<div class="row">
				<di class="col-12">
					<div class="card mb-3">
						<div class="card-header text-bg-dark">Daftar Tugas</div>
						<div class="card-body">
							<?php if(empty($data['tugas'])) :?>
								<p>Anda belum memiliki tugas untuk kelas ini</p>
							<?php else : ?>
								<table class="table table-hover">
									<thead>
										<tr>
											<th scope="col">#</th>
											<th scope="col">Tugas</th>
										</tr>
									</thead>
									<tbody class="table-group-divider daftar-tugas">
										<?php foreach ($data['tugas'] as $key => $value) :?>
											<tr>
												<th scope="row">
													<?= $key+1 ?>
												</th>
												<td class="position-relative">
		  											<p><?= $value['nama'] ?></p>
		  											<div class="position-absolute end-0 top-50 translate-middle-y">
		  												<a href="#<?= $value['id'] ?>" class="btn btn-info me-1 disabled">Detail</a>
		  												<a href="<?= BASE_URL ?>/Guru/delete/tugas/<?=$value['id'] ?>" class="btn btn-danger me-1">Hapus</a>
		  											</div>
												</td>
											</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							<?php endif; ?>
						</div>
						<div class="card-footer text-bg-dark">
							<div class="row">
								<div class="col">
									<div class="input-group">
							  			<select class="form-select form-control border-secondary" aria-label="Default select example" id="tugas-banyakBaris">
										  <option selected value="5">5</option>
										  <option value="10">10</option>
										  <option value="25">25</option>
										  <option value="50">50</option>
										  <option value="100">100</option>
										  <option value="all">All</option>
										</select>
						  			</div>
								</div>
					  			<div class="col">
					  				<nav aria-label="Page navigation" id="tugas-nav">
									  <ul class="pagination justify-content-end m-0">
									    <li class="page-item order-1"> <a href="#tugas-nav" value="-1" class="page-link" aria-label="Previous" class=""><span aria-hidden="true">&laquo;</span></a></li>
				    					<li class="disabled page-item order-2 d-none __"><a class="page-link">...</a></li>
				    					<li class="page-item order-1"><a href="#tugas-nav" value="1" class="page-link active">1</a></li>
				    					<li class="disabled page-item order-4 d-none __"><a href="#tugas-nav" class="page-link">...</a></li>
									    <li class="page-item order-5"><a href="#tugas-nav" value="+1" class="page-link" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
									  </ul>
									</nav>
					  			</div>
							</div>
						</div>
					</div>				</di>
				<di class="col-12">
					<form class="card mb-3" method="POST" action="<?= BASE_URL ?>Guru/simpanTugas/<?= $data['tokenKelas-active'] ?>" enctype="multipart/form-data">
						<div class="card-header text-bg-dark">Tambah Tugas</div>
						<div class="card-body">
							<div class="form-floating mb-3">
								<input type="text" name="nama" class="form-control" placeholder="" required>
								<label>Nama Tugas*</label>
							</div>
							<div class="form-floating mb-3">
								<input type="text" name="perintah" class="form-control" placeholder="">
								<label>Perintah Tugas</label>
							</div>
							<div class="form-floating mb-3">
                            	<input type="date" name="batas-tanggal" class="form-control" placeholder="batas kumpul">
                            	<label>Batas Tanggal</label>
                            </div>
                    		<div class="form-floating mb-3">
                    			<input type="time" name="batas-waktu" class="form-control">
                    			<label>Batas Jam</label>
                    		</div>
							<div class="row" id="cara-soalTugas">
							    <ul class="nav nav-tabs justify-content-evenly">
							        <li class="nav-item" ><a data-bs-toggle="collapse" aria-expanded="false" type="button" class="nav-link active" href="#pilih-soal" checkbox-value="0">Pilih Soal</a></li>
							        <li class="nav-item" ><a data-bs-toggle="collapse" aria-expanded="false" type="button" class="nav-link" href="#upload-file" checkbox-value="1">Upload Tugas</a></li>
							    </ul>
							</div>
							<div class="row mt-2" id="input-soalTugas">
                            	<div class="collapse show" id="pilih-soal" aria-labelledby="headingTwo" data-bs-parent="#input-soalTugas">
                        			<div class="input-group">
	                            		<div class="form-floating">
	                            			<input type="number" name="banyak-soal" id="banyak-soal" placeholder="Banyak Soal" disabled class="form-control" value="0">
	                            			<label for="banyak-soal">Banyak Soal</label>
                            			</div>
                        				<button type="button" class="btn btn-outline-secondary disabled">Cek</button>
                        			</div>
                            	</div>
                            	<div class="collapse" id="upload-file" aria-labelledby="headingTwo" data-bs-parent="#input-soalTugas">
                            		<div class="input-group">
                            			<div class="form-floating">
                            				<input type="text" name="namafile" class="form-control" disabled placeholder="">
                            				<label>Nama File</label>
                            			</div>
                            			<input type="file" id="input-upload-file" name="file-tugas" class="form-control d-none" accept="application/pdf">
                            			<label for="input-upload-file" class="btn btn-outline-secondary d-flex align-items-center">File Tugas</label>
                            		</div>
                            	</div>

							</div>
						</div>
						<div class="card-hidden" style="overflow: hidden; width: 0; height: 0; opacity: 0;">
							<input type="checkbox" name="cara" checked>
							<input type="text" name="soal-pilih">
						</div>
						<div class="card-footer text-bg-dark d-flex justify-content-end">
							<button class="btn btn-outline-info" disabled type="submit">Simpan</button>	
						</div>
					</form>
				</di>
			</div>
		</div>
	</div>
</div>