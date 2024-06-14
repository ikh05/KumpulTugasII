<div class="container">
	<h1 class="text-center"> SOAL KU</h1>
	<div class="row">
		<div class="col-12 col-md-6 mb-3">
			<div class="card">
			  <div class="card-header text-bg-dark">Identitas</div>
			  <div class="card-body px-4">
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
			  <div class="card-footer text-bg-dark text-end">
			  	<a href="<?= BASE_URL ?>Guru/setting" class="btn btn-outline-info">Edit</a>
			  </div>
			</div>
		</div>
		<div class="col-12 col-md-6 mb-3">
			<div class="card">
			  <div class="card-header text-bg-dark">Option</div>
			  <div class="card-body px-4">
			  	<div class="input-group mb-3">
			  		<button class="btn btn-outline-secondary dropdown-toggle w-auto form-control text-start disabled" type="button" data-bs-toggle="dropdown" aria-expanded="false">Kategori Materi</button>
			  		<ul class="dropdown-menu ps-4">
					    <li>
					    	<div class="form-check">
  								<input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
  								<label class="form-check-label" for="flexCheckChecked">Aljabar</label>
							</div>
						</li>
						<li>
					    	<div class="form-check">
  								<input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
  								<label class="form-check-label" for="flexCheckChecked">Geometri</label>
							</div>
						</li>
						<li>
					    	<div class="form-check">
  								<input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
  								<label class="form-check-label" for="flexCheckChecked">Kalkulus</label>
							</div>
						</li>
					</ul>
					<button class="btn btn-outline-secondary disabled" type="button">Cari</button>
			  	</div>
			  	<div class="row">
			  		<div class="col-12 col-lg-7 mb-3">
			  			<div class="input-group">
			  				<span class="input-group-text border-secondary" id="basic-addon1">Banyak Baris:</span>
				  			<select class="form-select form-control border-secondary" aria-label="Default select example" id="banyakBaris">
							  <option selected value="5">5</option>
							  <option value="10">10</option>
							  <option value="25">25</option>
							  <option value="50">50</option>
							  <option value="100">100</option>
							  <option value="100000">All</option>
							</select>
			  			</div>
			  		</div>
			  		<div class="col text-end">
			  			<button class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#form-modal" form-action="<?= BASE_URL ?>Guru/simpanSoal">Tambah Soal</button>
			  		</div>
			  	</div>
			  </div>
			  <div class="card-footer text-bg-dark text-end">
			  	<a href="<?= BASE_URL ?>Guru/petunjukPembuatanSoal" class="btn btn-outline-info">Perunjuk Pembuatan Soal</a>
			  </div>
			</div>
		</div>
	</div>
	<div class="daftarsoal">
		<div class="card mb-3">
			<div class="card-header text-bg-dark">Daftar Soal (<?= count($data['soal']) ?>)</div>
			  <div class="card-body px-4">
			  	<?php if(empty($data['soal'])) : ?>
			  		<h4 class="ms-3">Kamu Masih Belum Memiliki Soal!</h4>
			  	<?php else: ?>
			  		<table class="table table-hover">
			  			<thead>
			  				<tr>
			  					<th scope="col">#</th>
			  					<th scope="col">Soal</th>
			  					<th scope="col"></th>
			  				</tr>
			  			</thead>
			  			<tbody class="table-group-divider">
			  				<?php foreach ($data['soal'] as $k => $v) :?>
			  					<tr class="data-soal">
			  						<th scope="row"><?= $k+1 ?></th>
			  						<td><?= $v['soal'] ?></td>
			  						<td>
			  							<button class="btn btn-secondary dropdown-toggle w-auto form-control text-start disabled" type="button" data-bs-toggle="dropdown" aria-expanded="false">Action</button>
			  							<ul class="dropdown-menu">
										    <li>
										    	<a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#form-modal" form-action="<?= BASE_URL ?>Guru/updateSoal/<?= $v['id'] ?>">Edit</a>
											</li>
											<li>
			  									<a class="dropdown-item" href="<?= BASE_URL ?>Guru/deleteSoal/<?= $v['id'] ?>">Delete</a>
											</li>
										</ul>
			  						</td>
			  					</tr>
			  				<?php endforeach; ?>
			  			</tbody>
			  		</table>
			  	<?php endif; ?>
			  </div>
			  <div class="card-footer text-bg-dark">
			  	<nav aria-label="Page navigation" id="navigation-pages">
				  <ul class="pagination justify-content-end m-0">
				    <li class="page-item">
				      <a href="#navigation-pages" value="-1" class="page-link" aria-label="Previous" class="">
				        <span aria-hidden="true">&laquo;</span>
				      </a>
				    </li>
				    <li class="page-item"><a href="#navigation-pages" value="1" class="page-link active">1</a></li>
				    <li class="page-item"><a href="#navigation-pages" value="2" class="page-link">2</a></li>
				    <li class="page-item"><a href="#navigation-pages" value="3" class="page-link">3</a></li>
				    <li class="page-item">
				      <a href="#navigation-pages" value="+1" class="page-link" aria-label="Next">
				        <span aria-hidden="true">&raquo;</span>
				      </a>
				    </li>
				  </ul>
				</nav>
			  </div>
		</div>
	</div>
</div>


<!-- Model -->
<form method="POST" action="" class="modal" tabindex="-1" id="form-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-bg-dark">
        <h5 class="modal-title">Tambah Soal</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-floating mb-2">
  			<input name="nama" type="text" class="form-control" id="nama-soal" placeholder="Nama Soal" required>
  			<label for="nama-soal">Nama Soal</label>
		</div>
		<div class="form-floating mb-2" style="height: 40vh;">
  			<textarea name="soal" class="form-control h-100" placeholder="Tuliskan text soal" id="text-soal" required></textarea>
  			<label for="text-soal">Soal</label>
		</div>
		<div id="gambar">
		</div>
		<button type="button" class="btn btn-success" id="tambah-gambar">Tambahkan Gambar</button>
      </div>
      <div class="modal-footer text-bg-dark">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
        <button type="submit" name="submit" class="btn btn-outline-primary">Simpan</button>
      </div>
    </div>
  </div>
</form>



<!-- modal 2 -->
<div class="modal" id="modal-cek-gambar" tabindex="-1" data-bs-toggle='modal' data-bs-target='#form-modal'>
	<div class="modal-dialog">
		<img src="" alt="gambar" class="position-absolute top-0 start-0" style="max-height: 100vh;">
	</div>
</div>