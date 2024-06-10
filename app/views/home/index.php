

<nav class="navbar bg-body-tertiary">
  	<div class="container-fluid container">
    	<a class="navbar-brand" href="#">KumpulTugas II</a>
		<div class="d-flex">
        	<a href="<?=BASE_URL?>guru/login" class="btn btn-outline-primary">Masuk</a>
      	</div>
    </div>
  </div>
</nav>


<div class="container mt-4">
	<section id="identitas">
		<div class="row">
			<div class="input-group">
				<h3 class="text-center">Identitas Siswa</h3>
				<button class="btn" id="upDown">
					<i class="fa-solid fa-caret-up d-none"></i>
					<i class="fa-solid fa-caret-down"></i>
				</button>
			</div>
		</div>
		<form method="Post" action="<?= BASE_URL ?>Home/tugas" class="row">
			<div class="col-12 col-md-7 mb-1">
				<input type="text" name="nama" class="form-control" required autocomplete="off" placeholder="Nama Siswa">
			</div>
			<div class="col-12 col-md-5 mb-1">
				<input type="password" name="pass" class="form-control" required autocomplete="off" placeholder="Password" aria-describedby="eye-password">
			</div>
			<div class="col-12 col-md-6 mb-1">
				<input type="email" name="email" class="form-control" required autocomplete="off" placeholder="Email">
			</div>
			<div class="col-12 col-md-6 mb-1">
				<input type="tel" name="noWa" class="form-control" required autocomplete="off" placeholder="no Wa">
			</div>
			<!-- <div class="col-12 col-md-5 mb-1">
				<select name="sekolah" class="form-control">
					<option value="" class="d-none">Sekolah</option>
					<option value="SMAN8BJM"> SMAN 8 Banjarmasin</option>
				</select>
			</div> -->
			<div class="col-7 col-md-5 mb-1">
				<input type="password" name="token" class="form-control" required autocomplete="off" placeholder="Token Kelas">
			</div>
			<div class="col-5 col-md-2 btn-group mb-1">
				<button id="eye-password" class="btn btn-primary">
					<i class="fa-solid fa-eye"></i>
					<i class="fa-solid fa-eye-slash d-none"></i>
				</button>
				<button id="btn-cari" class="btn btn-success" type="submit" disabled>
					<i class="fa-solid fa-magnifying-glass"></i>
				</button>
			</div>
		</form>
	</section>
	<hr class="mt-0">
</div>