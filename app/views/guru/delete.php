<section class="container d-flex justify-content-center align-items-center h-100vh">
	<div class="row w-100 justify-content-center">
		<div class="card-master-flip col-12 col-lg-7 col-md-10" height="90" id="card_1" style="">
			<div class="card-flip h-100">
				<div class="card card-front h-100">
					<h3 class="card-header text-bg-warning text-center py-4">Delete <?= $data['delete'] ?></h3>
					<div class="card-body">
						<p>Pastikan anda yakin menghapus <?= $data['delete'] ?> ini!</p>
					</div>
					<div class="card-footer text-bg-dark">
						<div class="row text-center">
							<div class="col border-end border-warning">
								<p class="m-0" style="color: transparent;">.</p>
								<a class="btn btn-outline-primary" href="<?=$data['asal'] ?>">Batal</a>
							</div>
							<div class="col border-start border-primary">
								<p class="m-0">Apakah anda yakun?</p>
								<button class="btn btn-outline-warning" toggle-class="flip" type="button" target-toggle-class="#card_1" >Yakin</button>
							</div>
						</div>
					</div>
				</div>
				
				<div class="card card-back h-100" method="POST" action="<?= BASE_URL ?>Guru/daftar" id="from-daftar">
					<h3 class="card-header text-bg-danger text-center py-4">Sangat Yakin?</h3>
					<div class="card-body">
						<p>Jika anda "Sangat Yakin" maka <?= $data['delete'] ?> akan benar-benar dihapus</p>
					</div>
					<div class="card-footer text-bg-dark">
						<div class="row text-center">
							<div class="col border-end border-warning">
								<p class="m-0" style="color: transparent;">.</p>
								<a href="<?= $data['asal'] ?>" class="btn btn-outline-primary">Batal</a>
							</div>
							<div class="col border-start border-primary">
								<p class="m-0">Apa anda sangat yakin</p>
								<a href="<?= BASE_URL ?>Guru/fiksDelete/<?= $data['delete'] ?>/<?= $data['id'] ?>" class="btn btn-outline-danger">Sangat Yakin</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
