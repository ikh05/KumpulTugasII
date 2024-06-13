<div class="container">
	<!-- nama VARCHAR(15) NOT NULL,
    tokenKelas VARCHAR(10) NOT NULL,
    sekolah VARCHAR(50) NOT NULL,
    tahun VARCHAR(7) NOT NULL -->
    <!-- kalau bisa menggunakan ajax -->
    <form method="POST" action="<?=BASE_URL?>Guru/simpanKelas">
    	<h1 class="text-center">BUAT KELAS</h1>
    	<div class="mb-3 form-floating">
			<input type="text" name="nama" placeholder='contoh: "XII Mipa 1"' class="form-control" required autocomplete="off">
			<label>Nama Kelas</label>
		</div>
		<div class="mb-3 form-floating">
			<input type="text" name="sekolah" placeholder='contoh: "SMAN 8 Banjarmasin"' class="form-control" required autocomplete="off">
			<label>Nama Sekolah</label>
		</div>
		<div class="mb-3 form-floating">
			<input type="text" name="tokenKelas" placeholder='kode Unic' class="form-control" required autocomplete="off">
			<label>Token Kelas</label>
		</div>
		<div class="mb-3 form-floating">
			<input type="text" name="tahun" placeholder='contoh: "2022-2023"' class="form-control" required autocomplete="off">
			<label>Tahun Ajaran</label>
		</div>
		<button class="btn btn-success" type="submit" name="submit">Simpan</button>
    </form>
</div>