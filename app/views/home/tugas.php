<div class="container">
  <div class="card text-center">
    <div class="card-header">
      <h2><?= $_SESSION[C_SISWA]['nama'] ?></h2>
    </div>
    <div class="card-body text-center text-wrap fw-bold">
      <div class="row">

        <?php foreach ($data['status-tugas'] as $key => $value) : ?>
          <div class="col-6 col-lg-3 p-1">
            <a href="#<?= $value['id'] ?>" class="text-decoration-none rounded text-bg-<?= $value['warna'] ?> d-flex align-items-center justify-content-center position-relative" style="height: 3rem; width: 100%;">
              <spam class="m-0"><?= $key ?></spam>
              <span class="position-absolute top-0 end-0 translate-middle-y badge rounded-pill bg-info">
                <?= $value['banyak'] ?>
                <span class="visually-hidden">unread messages</span>
              </span>
            </a>
          </div>
        <?php endforeach; ?>

      </div>
    </div>
    <div class="card-footer text-body-secondary">
      2 days ago
    </div>
  </div>
  <hr>
</div>



<div id="tugas" class="container">
  <?php if(!empty($data['bkerja'])): ?>
  <section id="bkerja">
    <div class="row justify-content-evenly">
      <?php foreach ($data['bkerja'] as $key => $value): ?>
        <div class='col-12 col-md-6'>
          <div class="card border-secondary" id="tugas-<?= $value['id']?>">
            <div class="card-header">
              <div class="w-100 d-flex h-100">
                <h3 class='flex-fill'>{$nama} - {$kelas}</h3>
                <p class="p-2 m-auto fw-bold text-light bg-secondary" style="border-radius: .3rem;">
                  Belum Dikerjakan
                </p>
              </div>
            </div>
            <div class='card-body'>
              <h5 class='card-text' id="text-soal-{$id}">{$soal}</h5>
              <div class='form-modal'>
                <input type="hidden" name="idTugas" value="{$id}">
                <input type="hidden" name="namaTugas" value="{$nama}">
              </div>
              <div class="ket">
                <p class="m-0">{$ket}</p>
              </div>
            </div>
            <div class='card-footer p-3 text-body-secondary d-flex gap-2' style="justify-content: center;">
              <iframe id="online-alarm-kur-iframe" src="https://embed-countdown.onlinealarmkur.com/id/#<?= str_replace(' ','T',$value['batas'])?>@Asia%2FMakassar" width="360" height="80" style="display: block; margin: 0px a uto; border: 0px;"></iframe>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </section>
  <?php endif; ?>

  <hr class="mb-1 border-secondary">
  <?php if(!empty($data['ditolak'])): ?>
    <hr class="mt-0 border-danger">
    <section id="ditolak">
      <div class="row justify-content-evenly">
        <?php foreach ($data['ditolak'] as $key => $value) :?>
          <div class='col-12 col-md-6'>
            <div class="card border-danger" id="tugas-<?= $value['idTugas'] ?>">
              <div class="card-header">
                <div class="w-100 d-flex h-100">
                  <h3 class='flex-fill'>{$nama} - {$kelas}</h3>
                  <p class="p-2 m-auto fw-bold text-light bg-secondary" style="border-radius: .3rem;">
                    Belum Dikerjakan
                  </p>
                </div>
              </div>
              <div class='card-body'>
                <h5 class='card-text' id="text-soal-{$id}">{$soal}</h5>
                <div class='form-modal'>
                  <input type="hidden" name="idTugas" value="{$id}">
                  <input type="hidden" name="namaTugas" value="{$nama}">
                </div>
                <div class="ket">
                  <p class="m-0">{$ket}</p>
                </div>
              </div>
              <div class='card-footer p-3 text-body-secondary d-flex gap-2' style="justify-content: center;">
                <iframe id="online-alarm-kur-iframe" src="https://embed-countdown.onlinealarmkur.com/id/#<?= str_replace(' ','T',$value['batas'])?>@Asia%2FMakassar" width="360" height="80" style="display: block; margin: 0px a uto; border: 0px; overflow: hidden;"></iframe>
              </div>
            </div>
          </div>
        <?php endforeach ?>
      </div>
    </section>
    <hr class="mb-1 border-danger">
  <?php endif; ?>
  <?php if(!empty($data['dikumpul'])) : ?>
    <hr class="mt-0 border-warning">
    <section id="dikumpul">
      <div class="row justify-content-evenly">
        <?php foreach ($data['dikumpul'] as $key => $value) : ?>
          <div class='col-12 col-md-6'>
            <div class="card border-warning" id="tugas-<?= $value['idTugas'] ?>">
              <div class="card-header">
                <div class="w-100 d-flex h-100">
                  <h3 class='flex-fill'>{$nama} - {$kelas}</h3>
                  <p class="p-2 m-auto fw-bold text-light bg-secondary" style="border-radius: .3rem;">
                    Belum Dikerjakan
                  </p>
                </div>
              </div>
              <div class='card-body'>
                <h5 class='card-text' id="text-soal-{$id}">{$soal}</h5>
                <div class='form-modal'>
                  <input type="hidden" name="idTugas" value="{$id}">
                  <input type="hidden" name="namaTugas" value="{$nama}">
                </div>
                <div class="ket">
                  <p class="m-0">{$ket}</p>
                </div>
              </div>
              <div class='card-footer p-3 text-body-secondary d-flex gap-2' style="justify-content: center;">
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </section>
    <hr class="mb-1 border-warning">
  <?php endif; ?>
  <?php if(!empty($data['dinilai'])) : ?>
    <hr class="mt-0 border-success">
    <section id="dinilai">
      <div class="row justify-content-evenly">
        <?php foreach ($data['dikumpul'] as $key => $value) : ?>
          <div class='col-12 col-md-6'>
            <div class="card border-warning" id="tugas-<?= $value['idTugas'] ?>">
              <div class="card-header">
                <div class="w-100 d-flex h-100">
                  <h3 class='flex-fill'>{$nama} - {$kelas}</h3>
                  <p class="p-2 m-auto fw-bold text-light bg-secondary" style="border-radius: .3rem;">
                    Belum Dikerjakan
                  </p>
                </div>
              </div>
              <div class='card-body'>
                <h5 class='card-text' id="text-soal-{$id}">{$soal}</h5>
                <div class='form-modal'>
                  <input type="hidden" name="idTugas" value="{$id}">
                  <input type="hidden" name="namaTugas" value="{$nama}">
                </div>
                <div class="ket">
                  <p class="m-0">{$ket}</p>
                </div>
              </div>
              <div class='card-footer p-3 text-body-secondary d-flex gap-2' style="justify-content: center;">
                <p>nilai: <?= $value['nilai'] ?></p>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </section>
    <hr class="mb-1 border-success">
  <?php endif; ?>
</div>