<div class="container">
	<div class="row">

		<!-- identitas Kelas -->
		<div class="col-12 col-md-6 mb-3">
			<div class="card">
				<div class="card-header text-bg-dark">
					<h5 class="card-tittle">Identitas Kelas</h5>
				</div>
				<div class="card-body">
					<table class="table">
						<tr>
							<td>Nama Guru</td>
							<td>: <?= $data['guru']['nama'] ?></td>
						</tr>
						<tr>
							<td>Kelas</td>
							<td>: <?= $data['kelas'][$_SESSION[C_KELAS]]['nama'] ?></td>
						</tr>
						<tr>
							<td>Kelas</td>
							<td>: <a href="<?= BASE_URL ?>Guru/daftarTugas/<?= $_SESSION[C_KELAS] ?>" class="btn btn-primary"><?= $_SESSION[C_KELAS] ?></a></td>
						</tr>
					</table>
				</div>
				<div class="card-footer text-bg-dark d-flex justify-content-end">
		  		<a href="<?= BASE_URL ?>Guru/daftarTugas/<?= $_SESSION[C_KELAS] ?>" class="btn btn-outline-info me-1">Daftar Tugas</a>
				</div>
			</div>
		</div>

		<!-- identitas Tugas -->
		<div class="col-12 col-md-6 mb-3">
			<div class="card">
				<div class="card-header text-bg-dark">
					<h5 class="card-tittle">Identitas Tugas</h5>
				</div>
				<div class="card-body">
					<table class="table">
						<tr>
							<td>Nama Tugas</td>
							<td>: <?= $data['tugas']['nama'] ?></td>
						</tr>
						<tr>
							<td>Banyak Kumpul</td>
							<td>: <?= count($data['jawaban']) ?></td>
						</tr>
					</table>
					<div class="soal">
						<p>Soal :</p>
						<?= $data['tugas']['soal'] ?>
					</div>
				</div>
				<div class="card-footer text-bg-dark d-flex justify-content-end">
		  		<a href="<?= BASE_URL ?>Guru/edit/tugas/<?=$data['tugas']['id'] ?>" class="btn btn-outline-info me-1">Edit Tugas</a>
		  		<a href="<?= BASE_URL ?>Guru/delete/tugas/<?=$data['tugas']['id'] ?>" class="btn btn-outline-warning me-1">Hapus Tugas</a>
				</div>
			</div>
		</div>

		<!-- jawaban -->
		<?php foreach ($data['jawaban'] as $key => $value) :?>
			<div class="col-12 col-md-6 mb-3">
				<div class="card">
					<div class="card-header text-bg-<?= (new DateTime() > new DateTime($data['tugas']['batas']) ? TERLAMBAT : ($value['status'] === 'dinilai' ? DINILAI : ($value['status'] === 'ditolak' ? DITOLAK : DIKUMPUL))) ?>">
						<div class="card-tittle position-relative">
							<?= $value['siswa']['nama'] ?>
							<div class="position-absolute end-0 top-50 translate-middle-y"><?= $value['status'] ?></div>
						</div>
					</div>
					<div class="card-body">
						<div class="gambar">
							<?php foreach ($value['gambar'] as $k => $v) : ?>
								<img data-bs-toggle='modal' data-bs-target='#modal-cek' src='<?= BASE_URL ?>Gambar/getGambarTugas/<?= $v ?>' class='img-thumbnail' style='max-width:100px;'>
							<?php endforeach; ?>
						</div>
						<p class="ket">
							KET : <?= $value['ket'] ?>
						</p>
					</div>
					<div class="card-footer d-flex gap-2 justify-content-end">
						<p>Nilai : <?= $value['nilai'] !== 0 ? $value['nilai'] : '-' ?></p>
						<button class="btn btn-<?= (new DateTime() > new DateTime($data['tugas']['batas']) ? TERLAMBAT : ($value['status'] === 'dinilai' ? DINILAI : ($value['status'] === 'ditolak' ? DITOLAK : DIKUMPUL))) ?>" data-bs-toggle="modal" data-bs-target="#beriNilai" href-ajax="<?= BASE_URL ?>Ajax/getJawaban/<?= $value['id'] ?>" id-jawab="<?= $value['id'] ?>">Beri Nilai</button>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>









<!-- Modal Jawaban -->
<form action="<?= BASE_URL ?>Guru/simpanNilai/<?= $data['tugas']['id'] ?>" method="POST" class="modal" tabindex="-1" id="beriNilai">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-bg-dark">
        <h5 class="modal-title">Nama Siswa</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-hidden">
          <input type="hidden" name="id">
        </div>

        <!-- status -->
        <div class="form-floating mb-2">
        	<select id="status-tugas" class="form-select" aria-label="Default select example" required name="status">
			  <option value="" class="d-none">Pilih ...</option>
			  <option value="dinilai"> Dinilai </option>
			  <option value="ditolak"> Ditolak </option>
			</select>
			<label for="status-tugas">Status Tugas</label>
        </div>


        <!-- nilai -->
        <div class="form-floating mb-2">
        	<input type="number" class="form-control" max="100" min="0" id="nilai-tugas" name="nilai" placeholder="">
        	<label for="nilai-tugas">Nilai</label>
        </div>


        <!-- ket -->
        <div class="form-floating mb-2">
        	<input type="text" class="form-control" id="ket-tugas" name="ket" placeholder="">
        	<label for="ket-tugas">Keterangan</label>
        </div>


       
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan Nilai</button>
      </div>
    </div>
  </div>
</form>