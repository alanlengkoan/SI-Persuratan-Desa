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
                <ul>
                    <?php for ($i = 1; $i <= 4; $i++) { ?>
                        <li><a target="_blank" href="<?= base_url() ?>laporan_cetak?id_dana=<?= $jenis['id_dana'] ?>&triwulan=<?= $i ?>">Laporan <?= $jenis['nama'] ?> <?= date('Y') ?> Triwulan <?= number_to_roman($i) ?></a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- end:: content -->