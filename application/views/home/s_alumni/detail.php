<!-- begin:: banner -->
<section class="about-banner relative" id="home">
    <div class="overlay"></div>
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                <h1 class="text-white">
                    <?= $halaman ?>
                </h1>
                <p class="text-white link-nav"><a href="<?= base_url() ?>">Beranda </a> <span class="lnr lnr-arrow-right"></span> <a href="<?= base_url() ?>kontak"><?= $halaman ?></a></p>
            </div>
        </div>
    </div>
</section>
<!-- end:: banner -->

<!-- begin:: content -->
<section class="section-gap">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered nowrap" id="tabel-siswa-alumni" width="100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>NIS</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Tempat Lahir</th>
                                <th>Tanggal Lahir</th>
                                <th>Agama</th>
                                <th>Jenis Kelamin</th>
                                <th>Status Siswa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($data as $row) { ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row->nis ?></td>
                                    <td><?= $row->nama ?></td>
                                    <td><?= $row->kelas ?></td>
                                    <td><?= $row->tmp_lahir ?></td>
                                    <td><?= $row->tgl_lahir ?></td>
                                    <td><?= $row->agama ?></td>
                                    <td><?= ($row->kelamin === 'L' ? "Laki - laki" : "Perempuan") ?></td>
                                    <td><?= ($row->status === '0' ? "Aktif" : "Perempuan") ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end:: content -->
<!-- begin:: banner -->
<section class="about-banner relative" id="home">
    <div class="overlay"></div>
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                <h1 class="text-white">
                    <?= $halaman ?>
                </h1>
                <p class="text-white link-nav"><a href="<?= base_url() ?>">Beranda </a> <span class="lnr lnr-arrow-right"></span> <a href="<?= base_url() ?>kontak"><?= $halaman ?></a></p>
            </div>
        </div>
    </div>
</section>
<!-- end:: banner -->

<!-- begin:: content -->
<section class="section-gap">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered nowrap" id="tabel-siswa-alumni" width="100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>NIS</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Tempat Lahir</th>
                                <th>Tanggal Lahir</th>
                                <th>Agama</th>
                                <th>Jenis Kelamin</th>
                                <th>Status Siswa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($data as $row) { ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row->nis ?></td>
                                    <td><?= $row->nama ?></td>
                                    <td><?= $row->kelas ?></td>
                                    <td><?= $row->tmp_lahir ?></td>
                                    <td><?= $row->tgl_lahir ?></td>
                                    <td><?= $row->agama ?></td>
                                    <td><?= ($row->kelamin === 'L' ? "Laki - laki" : "Perempuan") ?></td>
                                    <td><?= ($row->status === '0' ? "Aktif" : "Perempuan") ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end:: content -->