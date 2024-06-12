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
</div>





<?php foreach ($data['bkerja'] as $key => $value): ?>
  <section id="bkerja"><?php var_dump($value) ?></section>
<?php endforeach; ?>
<section id="Dikumpul"></section>
<section id="Dinilai"></section>
<section id="Ditolak"></section>