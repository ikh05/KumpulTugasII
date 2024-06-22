<div class="container">
  <div class="card text-center">
    <div class="card-header">
      <h2><?= $data['siswa']['nama'] ?></h2>
    </div>
    <div class="card-body text-center text-wrap fw-bold">
      <div class="row justify-content-evenly">
        <!-- Banyaknya tugas dengang beberapa status -->
        <!-- status : belum dikerjakan (tugas), dikumpul, dinilai, ditolak, terlambat -->
          
        <!-- BELUM DIKERJAKAN -->
          <div class="col-6 col-lg-3 p-1">
            <a href="#bkerja" class="text-decoration-none rounded text-bg-secondary d-flex align-items-center justify-content-center position-relative" style="height: 3rem; width: 100%;">
              <spam class="m-0">Belum Dikerjakan</spam>
              <span class="position-absolute top-0 end-0 translate-middle-y badge rounded-pill bg-info">
                <?= count($data['tugas']) ?>
                <span class="visually-hidden">unread messages</span>
              </span>
            </a>
          </div>
        <!-- DIKUMPUL -->
          <div class="col-6 col-lg-3 p-1">
            <a href="#dikumpul" class="text-decoration-none rounded text-bg-primary d-flex align-items-center justify-content-center position-relative" style="height: 3rem; width: 100%;">
              <spam class="m-0">Dikumpul</spam>
              <span class="position-absolute top-0 end-0 translate-middle-y badge rounded-pill bg-info">
                <?= count($data['dikumpul']) ?>
                <span class="visually-hidden">unread messages</span>
              </span>
            </a>
          </div>
        <!-- Dinilai -->
          <div class="col-6 col-lg-3 p-1">
            <a href="#dinilai" class="text-decoration-none rounded text-bg-success d-flex align-items-center justify-content-center position-relative" style="height: 3rem; width: 100%;">
              <spam class="m-0">Dinilai</spam>
              <span class="position-absolute top-0 end-0 translate-middle-y badge rounded-pill bg-info">
                <?= count($data['dinilai']) ?>
                <span class="visually-hidden">unread messages</span>
              </span>
            </a>
          </div>
        <!-- DITOLAK -->
          <div class="col-6 col-lg-3 p-1">
            <a href="#ditolak" class="text-decoration-none rounded text-bg-warning d-flex align-items-center justify-content-center position-relative" style="height: 3rem; width: 100%;">
              <spam class="m-0">Ditolak</spam>
              <span class="position-absolute top-0 end-0 translate-middle-y badge rounded-pill bg-info">
                <?= count($data['ditolak']) ?>
                <span class="visually-hidden">unread messages</span>
              </span>
            </a>
          </div>
        <!-- TERLEWAT -->
          <div class="col-6 col-lg-3 p-1">
            <a href="#terlambat" class="text-decoration-none rounded text-bg-danger d-flex align-items-center justify-content-center position-relative" style="height: 3rem; width: 100%;">
              <spam class="m-0">Terlambat</spam>
              <span class="position-absolute top-0 end-0 translate-middle-y badge rounded-pill bg-info">
                <?= count($data['terlambat']) ?>
                <span class="visually-hidden">unread messages</span>
              </span>
            </a>
          </div>
      </div>
    </div>
    <div class="card-footer text-body-secondary">
      2 days ago
    </div>
  </div>
  <hr>
</div>





<div id="tugas" class="container">

  <?php if(!empty($data['tugas'])): ?>
  <section id="bkerja">
    <div class="row justify-content-evenly">
      <?php foreach ($data['tugas'] as $key => $value): ?>
        <div class='col-12 col-md-6 mb-3'>
          <div class="card border-secondary" id="tugas-<?= $value['id']?>">
            <div class="card-header">
              <div class="w-100 d-flex h-100">
                <h3 class='flex-fill nama-soal'><?= $value['nama'] ?></h3>
                <p class="p-2 m-auto fw-bold text-light bg-secondary" style="border-radius: .3rem;">
                  Belum Dikerjakan
                </p>
              </div>
            </div>
            <div class='card-body'>
              <h5 class='card-text text-soal'><?= $value['soal'] ?></h5>
              <div class='form-modal' form-action='kumpulTugas/bkerja/<?= $value['id'] ?>'></div>
            </div>
            <div class='card-footer p-3 text-body-secondary d-flex gap-2' style="justify-content: center;">
              <iframe id="online-alarm-kur-iframe" src="https://embed-countdown.onlinealarmkur.com/id/#<?= str_replace(' ','T',$value['batas'])?>@Asia%2FMakassar" width="360" height="80" style="display: block; margin: 0px a uto; border: 0px;"></iframe>
              <button class="btn btn-outline-secondary" status-tugas='bkerja' data-bs-toggle="modal" data-bs-target="#jawabTugas" href-ajax="<?= BASE_URL ?>Ajax/getTugas/<?= $value['id'] ?>">Jawaban</button>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </section>
  <?php endif; ?>

  <hr class="mb-1 border-secondary">
  <?php if(!empty($data['dikumpul'])) : ?>
    <hr class="mt-0 border-primary">
    <section id="dikumpul">
      <div class="row justify-content-evenly">
        <?php foreach ($data['dikumpul'] as $key => $value) : ?>
          <div class='col-12 col-md-6'>
            <div class="card border-primary" id="kumpul-<?= $value['id'] ?>">
              <div class="card-header border-primary">
                <div class="w-100 d-flex h-100">
                  <h3 class='flex-fill'><?= $value['nama'] ?></h3>
                  <p class="p-2 m-auto fw-bold text-bg-primary" style="border-radius: .3rem;">
                    Dikumpul
                  </p>
                </div>
              </div>
              <div class='card-body '>
                <h5 class='card-text' id="text-soal-{$id}"><?= $value['soal'] ?></h5>
                <div class='form-modal'>
                  <input type="hidden" name="idTugas" value="{$id}">
                  <input type="hidden" name="namaTugas" value="{$nama}">
                </div>
              </div>
              <div class='card-footer border-primary p-3 text-body-secondary d-flex gap-2 justify-content-end'>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </section>
    <hr class="mb-1 border-primary">
  <?php endif; ?>
  
  <?php if(!empty($data['dinilai'])) : ?>
    <hr class="mt-0 border-success">
    <section id="dinilai">
      <div class="row justify-content-evenly">
        <?php foreach ($data['dinilai'] as $key => $value) : ?>
          <div class='col-12 col-md-6'>
            <div class="card border-success" id="nilai-<?= $value['id'] ?>">
              <div class="card-header border-success">
                <div class="w-100 d-flex h-100">
                  <h3 class='flex-fill'><?= $value['nama'] ?></h3>
                  <p class="p-2 m-auto fw-bold text-light bg-secondary" style="border-radius: .3rem;">
                    Dinilai
                  </p>
                </div>
              </div>
              <div class='card-body'>
                <h5 class='card-text'><?= $value['soal'] ?></h5>
              </div>
              <div class='card-footer border-success border-primary p-3 text-body-secondary d-flex gap-2 justify-content-end'>
                <p class="">Nilai: <?= $value['nilai'] ?> </p>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </section>
    <hr class="mb-1 border-success">
  <?php endif; ?>

  <?php if(!empty($data['ditolak'])): ?>
    <hr class="mt-0 border-warning">
    <section id="ditolak">
      <div class="row justify-content-evenly">
        <?php foreach ($data['ditolak'] as $key => $value) :?>
          <div class='col-12 col-md-6'>
            <div class="card border-warning" id="tolak-<?= $value['id'] ?>">
              <div class="card-header">
                <div class="w-100 d-flex h-100">
                  <h3 class='flex-fill'><?= $value['nama'] ?></h3>
                  <p class="p-2 m-auto fw-bold text-bg-warning" style="border-radius: .3rem;">
                    Ditolak
                  </p>
                </div>
              </div>
              <div class='card-body'>
                <h5 class='card-text' id="text-soal-{$id}"><?= $value['soal'] ?></h5>
                <div class='form-modal'>
                  <input type="hidden" name="idTugas" value="{$id}">
                  <input type="hidden" name="namaTugas" value="{$nama}">
                </div>
                <div class="ket">
                  <p class="m-0">alasan: <?= $value['ket'] ?>, tolong perbaiki sebelum waktu habis!</p>
                </div>
              </div>
              <div class='card-footer border-warning p-3 text-body-secondary d-flex gap-2'>
                <iframe id="online-alarm-kur-iframe" src="https://embed-countdown.onlinealarmkur.com/id/#<?= str_replace(' ','T',$value['batas'])?>@Asia%2FMakassar" width="360" height="80" style="display: block; margin: 0px a uto; border: 0px; overflow: hidden;"></iframe>
              </div>
            </div>
          </div>
        <?php endforeach ?>
      </div>
    </section>
    <hr class="mb-1 border-danger">
  <?php endif; ?>
  <?php if(!empty($data['terlambat'])): ?>
    <hr class="mt-0 border-danger">
    <section id="terlambat">
      <div class="row justify-content-evenly">
        <?php foreach ($data['terlambat'] as $key => $value) :?>
          <div class='col-12 col-md-6'>
            <div class="card border-danger" id="terlambat-<?= $value['id'] ?>">
              <div class="card-header">
                <div class="w-100 d-flex h-100">
                  <h3 class='flex-fill'><?= $value['nama'] ?></h3>
                  <p class="p-2 m-auto fw-bold text-bg-danger" style="border-radius: .3rem;">
                    Terlambat
                  </p>
                </div>
              </div>
              <div class='card-body'>
                <h5 class='card-text' id="text-soal-{$id}"><?= $value['soal'] ?></h5>
                <div class="ket">
                  <p class="m-0 color-danger">Ket: tolong tetap lengkapi tugas!</p>
                </div>
              </div>
              <div class='card-footer border-danger p-3 text-body-denger d-flex gap-2'>
                <button class="btn btn-outline-danger" status-tugas='terlambat' data-bs-toggle="modal" data-bs-target="#jawabTugas" href-ajax="<?= BASE_URL ?>Ajax/getTugas/<?= $value['id'] ?>">Jawaban</button>
              </div>
            </div>
          </div>
        <?php endforeach ?>
      </div>
    </section>
    <hr class="mb-1 border-danger">
  <?php endif; ?>
</div>








<!-- Modal Jawaban -->
<form action="<?= BASE_URL ?>Home/simpanTugas/<?= $data['siswa']['tokenKelas'] ?>" method="POST" enctype="multipart/form-data" class="modal" tabindex="-1" id="jawabTugas">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-bg-secondary">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-hidden">
          <input type="hidden" name="idTugas">
        </div>
        <div class="modal-form" id="gambar"></div>
        <div class="input-group">
          <input type="text" name="ket" placeholder="Tuliskan alasan terlambat!" required class="form-control">
          <input type="hidden" name="status-tugas">
        </div>
        <div class="form-check form-switch mb-3">
          <input type="checkbox" class="form-check-input" id="pastikan">
          <label class="form-check-label" for="pastikan">Gambar yang dikirim sudah lengkap</label>
        </div>
        <button id="tambah-gambar" class="btn btn-success" type="button">Tambah Gambar</button>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary disabled">Kirim Jawaban</button>
      </div>
    </div>
  </div>
</form>