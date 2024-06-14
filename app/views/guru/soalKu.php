<div class="container">
	<h1 class="text-center"> SOAL KU</h1>
	<div class="identitas mt-3">
		<h2 class="border-end">Identitas Guru</h2>
		<div class="row ms-3">
			<dl class="col-1">Nama</dl>
			<dd class="col-11">: <?= $data['guru']['nama'] ?></dd>

			<dl class="col-1">Kelas</dl>
			<dd class="col-11">
				:<?php foreach ($data['kelas'] as $v) : ?>
					<?= $v['nama'].' ('.$v['sekolah'].'), ' ?>  
				<?php endforeach; ?>
			</dd>
		</div>
	</div>
	<div class="daftarsoal mt-3">
		<div class="row">
			<h2 class="border-end col-11">Daftar Soal</h2>
			<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-soal">Tambah Soal</button>
		</div>
		<?php var_dump($data['soal']) ?>
		<?php if(empty($data['soal'])) :?>
			<h4 class="ms-3">Tidak Memiliki Soal!</h4>
		<?php else: ?>
			<table class="table">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Nama</th>
						<th scope="col">Soal</th>
						<th scope="col">Action</th>
					</tr>
				</thead>
				<tbody>
				<!-- no nama soal action-->
				<?php foreach ($data['soal'] as $key => $value) :?>
					<tr>
						<th scope="row"><?= $key+1 ?></th>
						<td><?= $value['nama'] ?></td>
						<td><?= $value['soal'] ?></td>
						<td>
							<!-- edit, duplikat, delete -->
						</td>
					</tr>
				<?php endforeach;?>
				</tbody>
			</table>
			<div class="countrow">
				<p>Banyak Baris: 
					<select name="countrow">
						<option value="25">25</option>
						<option value="50">50</option>
						<option value="100">100</option>
						<option value="All">All</option>
					</select>
				</p>
			</div>
		<?php endif; ?>
	</div>
</div>


<!-- Model -->
<form method="POST" action="<?= BASE_URL ?>Guru/simpanSoal" class="modal" tabindex="-1" id="modal-soal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-bg-dark">
        <h5 class="modal-title">Tambah Soal</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
  		<input name="id" type="hidden">
        <div class="form-floating mb-2">
  			<input name="nama" type="text" class="form-control" id="nama-soal" placeholder="Nama Soal" required>
  			<label for="nama-soal">Nama Soal</label>
		</div>
		<div class="form-floating mb-2" style="height: 40vh;">
  			<textarea name="soal" class="form-control h-100" placeholder="Tuliskan text soal" id="text-soal" required></textarea>
  			<label for="text-soal">Soal</label>
		</div>
      </div>
      <div class="modal-footer text-bg-dark">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
        <button type="submit" name="submit" class="btn btn-outline-primary">Simpan</button>
      </div>
    </div>
  </div>
</form>