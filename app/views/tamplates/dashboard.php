
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="<?= BASE_URL ?>Guru">Kumpul Tugas II</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" data-bs-toggle="offcanvas" data-bs-target="#id-offcanvas" aria-controls="offcanvasWithBothOptions" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" disabled/>
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button" disabled><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!"><i class="fa-solid fa-gear"></i> Pengaturan</a></li>
                        <li><a class="dropdown-item" href="#!"><i class="fa-solid fa-bell"></i> Notifikasi</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="<?= BASE_URL ?>Guru/keluar"><i class="fa-solid fa-door-closed"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>

        <div id="layoutSidenav">
            
            <div class="offcanvas offcanvas-start" data-bs-theme="dark" data-bs-scroll="true" tabindex="-1" id="id-offcanvas" aria-labelledby="offcanvasWithBothOptionsLabel">
                <div class="offcanvas-header border-bottom border-primary">
                    <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Kumpul Tugas II</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <div class="nav flex-column text-secondary nav-underline gap-2">
                        <div class="fw-bold mt-4">CORE</div>
                        <a href="<?= BASE_URL ?>Guru" class="nav-link ms-3 py-0 <?= ($data['offcanvas'] === 'dashboard') ? 'active' : '' ?>"><i class="fa-solid fa-school"></i> Dashboard</a>

                        <div class="fw-bold mt-4">KELAS</div>
                        <a href="<?= BASE_URL ?>Guru/buatKelas" class="nav-link ms-3 py-0 <?= ($data['offcanvas'] === 'buatKelas') ? 'active' : '' ?>"><i class="fa-solid fa-user"></i> Buat Kelas</a>
                        <?php foreach ($data['guru']['tokenKelas'] as $v) :?>
                            <a class="nav-link ms-3 py-0" data-bs-toggle="collapse" href="#<?= $v ?>" aria-controls="<?= $v ?>"role="button" aria-expanded="false"><i class="fa-solid fa-users" ></i> <?= $data['kelas'][$v]['nama'] ?></a>
                            <div class="collapse ms-4" id="<?= $v ?>" aria-labelledby="headingTwo" data-bs-parent="#id-offcanvas">
                                <div class="list-group ">
                                  <a href="<?= BASE_URL ?>Guru/detailKelas/<?= $v ?>" class="list-group-item list-group-item-action disabled <?= ($data['offcanvas'] === 'detailKelas_'.$v) ? 'active' : '' ?>"><i class="fa-solid fa-users"></i> Detail Kelas</a>
                                  <a href="<?= BASE_URL ?>Guru/daftarSiswa/<?= $v ?>" class="list-group-item list-group-item-action disabled <?= ($data['offcanvas'] === 'daftarSiswa_'.$v) ? 'active' : '' ?>"><i class="fa-solid fa-users"></i> Daftar Siswa</a>
                                  <a href="<?= BASE_URL ?>Guru/daftarTugas/<?= $v ?>" class="list-group-item list-group-item-action <?= ($data['offcanvas'] === 'daftarTugas_'.$v) ? 'active' : '' ?>"><i class="fa-solid fa-pen"></i> Tugas</a>
                                  <a href="<?= BASE_URL ?>Guru/daftarNilai/<?= $v ?>" class="list-group-item list-group-item-action disabled <?= ($data['offcanvas'] === 'daftarNilai_'.$v) ? 'active' : '' ?>"><i class="fa-solid fa-hundred-points"></i> Nilai</a>
                                </div>
                            </div>
                        <?php endforeach; ?>

                        <div class="fw-bold mt-4">SOAL</div>
                        <a href="<?= BASE_URL ?>Guru/soalku" class="nav-link ms-3 py-0 <?= ($data['offcanvas'] === 'soalKu') ? 'active' : '' ?>"><i class="fa-solid fa-file-code"></i> Soal Ku</a>
                        <a href="<?= BASE_URL ?>Guru/bankSoal" class="nav-link ms-3 py-0 disabled <?= ($data['offcanvas'] === 'bankSoal') ? 'active' : '' ?>"><i class="fa-solid fa-bank"></i> Bank Soal</a>

                    </div>
                </div>
                <div class="mb-3 pt-2 border-primary border-top ps-2" style="width: inherit;">
                    <div class="small">Nama Guru:</div>
                    <?= $data['guru']['nama'] ?>
                </div>
            </div>

            <div id="layoutSidenav_content">
                <main>
                	<?php include_once ('../app/views/'.$data['content_main'].'.php'); ?>
                </main>
                <!-- <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer> -->
            </div>
        </div>