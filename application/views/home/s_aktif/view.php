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
                    <table class="table table-striped table-bordered nowrap" id="tabel-siswa-aktif" width="100%">
                        <thead align="center">
                            <tr>
                                <th>No.</th>
                                <th>Kelas</th>
                                <th>Jumlah Siswa</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody align="center">
                            <?php
                            $no = 1;
                            foreach ($data->result() as $row) { ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row->nama ?></td>
                                    <td><?= $row->jumlah_siswa ?></td>
                                    <td>
                                        <a href="<?= base_url() ?>siswa/aktif/detail/<?= $row->id_kelas ?>" class="btn btn-info info-icon-notika"><i class="fa fa-info-circle"></i></a>
                                    </td>
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