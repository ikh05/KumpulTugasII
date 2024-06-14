

<nav class="navbar bg-body-tertiary">
  	<div class="container-fluid container">
    	<a class="navbar-brand" href="#">KumpulTugas II</a>
		<div class="d-flex">
        	<a href="<?=BASE_URL?>Guru" class="btn btn-outline-primary">Masuk</a>
      	</div>
    </div>
  </div>
</nav>


<div class="container">
	<section id="identitas">
		<div class="accordion" id="accordionPanelsStayOpenExample">
		  <div class="accordion-item">
		     <h2 class="accordion-header">
		      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#input-identitas" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
		        <h3>Identitas Siswa</h3>
				<span>
					<i class="fa-solid fa-caret-up d-none"></i>
					<i class="fa-solid fa-caret-down"></i>
				</span>
		      </button>
		    </h2>
		    <div id="input-identitas" class="accordion-collapse collapse show">
		      <div class="accordion-body">
		        
		      	<form method="Post" class="upDown" action="<?= BASE_URL ?>Home/tugas">
					<div id="tinggiInput" class="row">
						<div class="col-12 mb-1 form-floating">
							<input type="text" id="input-nama" name="nama" placeholder="Nama siswa" class="form-control" required autocomplete="off">
							<label for="input-nama">Nama</label>
						</div>
						<div class="col-12 col-md-6 mb-1 form-floating">
							<input type="email" id='input-email' name="email" class="form-control" required autocomplete="off" placeholder="Email">
							<label for="input-email">Email</label>
						</div>
						<div class="col-12 col-md-6 mb-1 form-floating">
							<input type="tel" id="input-noWa" name="noWa" class="form-control" required autocomplete="off" placeholder="no Wa">
							<label for="input-noWa">No Wa</label>
						</div>
						<div class="col-12 col-md-5 mb-1 form-floating">
							<input type="password" id="input-password" name="pass" class="form-control" required autocomplete="off" placeholder="Password (1-20 karakter)" aria-describedby="eye-password">
							<label for="input-password">Password</label>
						</div>
						<div class="col-7 col-md-5 mb-1 form-floating">
							<input type="password" id="input-token" name="tokenKelas" class="form-control" required autocomplete="off" placeholder="Identitas kelas dan sekolah">
							<label for="input-token">Token</label>
						</div>
						<div class="col-5 col-md-2 btn-group mb-1">
							<button id="eye-password" class="btn btn-primary" type="button">
								<i class="fa-solid fa-eye"></i>
								<i class="fa-solid fa-eye-slash d-none"></i>
							</button>
							<button id="btn-cari" class="btn btn-success" type="submit" disabled>
								<i class="fa-solid fa-magnifying-glass"></i>
							</button>
						</div>
					</div>
				</form>

		      </div>
		    </div>
		  </div>
		</div>
	</section>
	<hr>
</div>