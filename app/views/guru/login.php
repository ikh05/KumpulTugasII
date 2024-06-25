<section class="container d-flex justify-content-center align-items-center h-100vh">
	<div class="row w-100 justify-content-center">
		<div class="card-master-flip col-12 col-lg-7 col-md-10" height="90" id="card_1" style="">
			<div class="card-flip h-100">
				<form class="card card-front h-100" method="POST" action="<?= BASE_URL ?>Guru/masuk" id="form-masuk">
					<h3 class="card-header bg-dark text-light text-center py-4">Masuk</h3>
					<div class="card-body">
						<div class="mb-3 form-floating">
							<input type="text" name="m-username" placeholder="Username" class="form-control" required autocomplete="off">
							<label>Usename</label>
						</div>
						<div class="mb-3 input-group">
							<div class="form-floating">
								<input class="form-control" id="passMasuk" type="password" name="m-password" aria-label="" aria-describedby="iconPass" required autocomplete="off" placeholder="Password">
								<label>Password</label>
							</div>
							<button class="btn btn-outline-secondary border-translucent" type="button" id="m-eye">
								<i class="fa-solid fa-eye"></i>
								<i class="fa-solid fa-eye-slash d-none"></i>
							</button>
						</div>
						<br>
					</div>
					<div class="card-footer bg-dark text-light">
						<div class="row text-center">
							<div class="col border-end border-warning">
								<p class="m-0" style="color: transparent;">.</p>
								<button class="btn btn-outline-warning" type="submit" name="submit">Kirim</button>
							</div>
							<div class="col border-start border-primary">
								<p class="m-0">Belum memiliki akun?</p>
								<button class="btn btn-outline-primary" toggle-class="flip" type="button" target-toggle-class="#card_1" >Daftar</button>
							</div>
						</div>
					</div>
				</form>
				
				<form class="card card-back h-100" method="POST" action="<?= BASE_URL ?>Guru/daftar" id="from-daftar">
					<h3 class="card-header bg-dark text-light text-center py-4">Daftar</h3>
					<div class="card-body">
						<div class="row">
							<div class="col-12 mb-3 form-floating">
								<input class="form-control" type="text" name="d-username" placeholder="Usename" required autocomplete="off">
								<label>Username <span class="text-danger">*</span></label>
							</div>
							<div class="col-12 mb-3 form-floating ">
								<input class="form-control" type="text" name="d-nama" placeholder="Nama Lengkap" required autocomplete="off">
								<label>Nama Lengkap*</label>
							</div>
							<div class="col-6 mb-3 form-floating ">
								<input class="form-control" type="email" name="d-email" placeholder="Email tidak wajib diisi" autocomplete="off">
								<label>Email</label>
							</div>
							<div class="col-lg-6 col-12 mb-3 form-floating ">
								<input class="form-control" name="d-wa" type="tel" placeholder="Nomer Wa" autocomplete="off">
								<label>Wa</label>
							</div>
							<div class="col-lg-6 col-12 mb-3">
								<div class="input-group">
									<div class="form-floating is-invalid">
										<input class="form-control" class="form-control" id="passDaftar" type="password" name="d-password" aria-label="" required autocomplete="off" placeholder="Password">
										<label>Password*</label>
									</div>
									<button class="btn btn-outline-secondary btn-translucent" type="button" id="d-eye">
										<i class="fa-solid fa-eye"></i>
										<i class="fa-solid fa-eye-slash d-none"></i>
									</button>
								</div>
							</div>
							<div class="col-lg-6 col-12 mb-3 form-floating ">
								<input class="form-control" class="form-control" id="konfpassDaftar" type="password" name="d-konf-password" aria-label="" required autocomplete="off" placeholder="Konfirmasi Password">
								<label>Konfirmasi Password*</label>
							</div>
						</div>
					</div>
					<div class="card-footer bg-dark text-light">
						<div class="row text-center">
							<div class="col border-end border-warning">
								<p class="m-0">* wajib diisi!</p>
								<button class="btn btn-outline-warning" type="submit" name="submit">Kirim</button>
							</div>
							<div class="col border-start border-primary">
								<p class="m-0">Sudah memiliki akun?</p>
								<button class="btn btn-outline-primary" toggle-class="flip" type="button"target-toggle-class="#card_1" >Masuk</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
