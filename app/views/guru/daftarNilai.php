<div class="container">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header text-bg-dark">
					<h5 class="card-title">Nilai</h5>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<?php if(empty($data['tugas'])) :?>
							<h4>Kelas ini tidak memiliki "Tugas"</h4>
						<?php elseif(empty($data['siswa'])): ?>
							<h4>Tidak terdapat "Siswa" yang terdaftar di kelas ini</h4>
						<?php else: ?>
							<?php $download = true ?>
							<table class="table table-striped table-hover" id="tabel-nilai" name-table="<?= $data['kelas']['nama'] ?>">
								<thead>
									<th scope="col">No</th>
									<th scope="col">Nama</th>
									<?php foreach ($data['tugas'] as $key => $value) : ?>
										<th scope="col">Tugas-<?= $key+1 ?></th>
									<?php endforeach;?>
									<th scope="col">Rata-rata</th>
								</thead>
								<tbody class="table-group-divider">
									 <caption>Jika nilai tidak muncul silahkan <a class="btn btn-success" href="<?= BASE_URL ?>Guru/daftarNilai/<?= $data['kelas']['tokenKelas'] ?>">MUAT ULANG!</a></caption>
									<?php foreach ($data['siswa'] as $no => $siswa) : ?>
										<tr>
											<th scope="row" name-row="No."><?= $no+1 ?></th>
											<td name-row="Nama Siswa"><?= $siswa['nama'] ?></td>
											<?php $tnilai = 0 ?>
											<?php foreach ($data['tugas'] as $kt => $tugas): ?>
												<?php $ada = false; ?>
												<?php foreach ($data['nilai'] as $nilai): ?>
													<?php if ($nilai['idSiswa'] === $siswa['id'] && $nilai['idTugas'] === $tugas['id']) : ?>
														<td name-row="tugas" tugas="<?= $kt+1 ?>"><?= $nilai['nilai'] ?></td>
														<?php $ada = true; $tnilai += ((int)$nilai['nilai']) ?>
														<?php continue; ?>
													<?php endif; ?>
												<?php endforeach ?>
												<?php if(!$ada) : ?>
													<td name-row="tugas" tugas="<?= $kt+1 ?>">0</td>
												<?php endif; ?>
											<?php endforeach ?>
											<td name-row='Rata-rata'><?= number_format($tnilai/count($data['tugas']), 2, ',') ?></td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						<?php endif; ?>
					</div>
				</div>
				<div class="card-footer text-bg-dark d-flex gap-2 justify-content-end">
					<button class="btn btn-outline-info <?= (isset($download) ? '' : 'disabled') ?>" download-sheet-js="#tabel-nilai">Download Excel</button>
				</div>
			</div>
		</div>
	</div>
</div>