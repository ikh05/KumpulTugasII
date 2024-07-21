<div class="container">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header text-bg-dark">
					<h5 class="card-title">Nilai</h5>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<?php if(empty($data['siswa'])): ?>
							<h4>Tidak terdapat "Siswa" yang terdaftar di kelas ini</h4>
						<?php else: ?>
							<table class="table table-striped table-hover" id="tabel-siswa" name-table="<?= $data['kelas']['nama'] ?>">
								<thead>
									<th scope="col">No</th>
									<th scope="col">Nama</th>
									<th scope="col">Tugas</th>
									<th scope="col">#</th>
								</thead>
								<tbody class="table-group-divider">
									 <caption>Jika nilai tidak muncul silahkan <a class="btn btn-success" href="<?= BASE_URL ?>Guru/daftarSiswa/<?= $data['kelas']['tokenKelas'] ?>">MUAT ULANG!</a></caption>
									<?php foreach ($data['siswa'] as $no => $siswa) : ?>
										<tr>
											<th scope="row" name-row="No."><?= $no+1 ?></th>
											<td name-row="Nama Siswa"><?= $siswa['nama'] ?></td>
											<td name-row="tugas">
												<!-- menampilkan banyak tugas berdasarkan 5 kategori -->
											</td>
											<td name-row='action'>
												<!-- <button class="btn btn-secondary dropdown-toggle w-auto form-control text-start" type="button" data-bs-toggle="dropdown" aria-expanded="false">Action</button>
			  									<ul class="dropdown-menu">
										    		<li>
										    			<a class="dropdown-item disabled" data-bs-toggle="modal" data-bs-target="#form-modal" href-ajax="<?= BASE_URL ?>Ajax/editSoal/<?= $v['id'] ?>">Edit</a>
													</li>
													<li>
					  									<a class="dropdown-item" href="<?= BASE_URL ?>Guru/delete/soal/<?= $v['id'] ?>">Delete</a>
													</li>
												</ul> -->
												<a class="btn btn-danger" href="<?= BASE_URL ?>Guru/delete/siswa/<?= $siswa['id'] ?>">Hapus</a>
											</td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						<?php endif; ?>
					</div>
				</div>
				<div class="card-footer text-bg-dark">
					<!-- bisa membagi menjadi beberapa halaman -->
				</div>
			</div>
		</div>
	</div>
</div>