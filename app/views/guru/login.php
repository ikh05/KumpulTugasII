<section class="container d-flex justify-content-center align-items-center h-100vh">
	<div class="card-master-flip w-100 h-90vh" id="card_1" style="">
		<div class="card-flip h-100">
			<div class="card card-front h-100">
				<h3 class="card-header">Masuk</h3>
				<div class="card-body">
					<form method="POST" action="<?= BASE_URL ?>Guru/masuk" id="form-masuk">
						<div class="input-grup mb-3 form-floating ">
							<input type="text" name="m-username" placeholder="Username" class="form-control" required autocomplete="off">
							<label>Usename</label>
						</div>
						<div class="input-grup mb-3 form-floating ">
							<input class="form-control" id="passMasuk" type="password" name="m-password" aria-label="" aria-describedby="iconPass" required autocomplete="off" placeholder="Password">
							<label>Password</label>
						</div>
						<button class="btn btn-success" ajax-post="" data-ajax-post="#form-masuk">Masuk</button>
					</form>
					<br>
					<p>Belum memiliki akun? Anda bisa membuat akun baru atau masuk tanpa akun</p>
					<div class="row">
						<div class="col">
							<button class="btn btn-primary" toggle-class="flip" target-toggle-class="#card_1">Daftar</button>
						</div>
					</div>
				</div>
			</div>
			
			<div class="card card-back h-100">
				<h3 class="card-header">Daftar</h3>
				<div class="card-body">
					<div class="row">
						<form method="POST" action="<?= BASE_URL ?>Guru/daftar" id="from-daftar">
							<div class="input-grup mb-3 form-floating">
								<input class="form-control" type="text" name="d-username" placeholder="Usename" required autocomplete="off">
								<label>Username*</label>
							</div>
							<div class="input-grup mb-3 form-floating ">
								<input class="form-control" type="text" name="d-nama" placeholder="Nama Lengkap" required autocomplete="off">
								<label>Nama Lengkap*</label>
							</div>
							<div class="input-grup mb-3 form-floating ">
								<input class="form-control" type="email" name="d-email" placeholder="Email tidak wajib diisi" autocomplete="off">
								<label>Email</label>
							</div>
							<div class="input-grup mb-3 form-floating ">
								<input class="form-control" type="email" name="d-wa" placeholder="Nomer Wa" autocomplete="off">
								<label>Wa</label>
							</div>
							<div class="input-grup mb-3 form-floating ">
								<input class="form-control" class="form-control" id="passDaftar" type="password" name="d-password" aria-label="" required autocomplete="off" placeholder="Password">
								<label>Password*</label>
							</div>
							<div class="input-grup mb-3 form-floating ">
								<input class="form-control" class="form-control" id="konfpassDaftar" type="password" name="d-konf-password" aria-label="" required autocomplete="off" placeholder="Konfirmasi Password">
								<label>Konfirmasi Password*</label>
							</div>
							<p>catatan: * wajib di isi!</p>
							<button name="submit" class="btn btn-success" ajax-post="" data-ajax-post="#from-daftar">Kirim</button>
						</form>
					</div>
					<p>Sudah memiliki akun?</p>
					<button class="btn btn-primary" toggle-class="flip" target-toggle-class="#card_1">Masuk</button>
				</div>
			</div>
		</div>
	</div>
</section>
