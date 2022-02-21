<!-- begin:: banner -->
<section class="about-banner relative" id="home">
    <div class="overlay"></div>
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                <h1 class="text-white">
                    <?= $halaman ?>
                </h1>
                <p class="text-white link-nav"><a href="<?= base_url() ?>">Beranda </a> <span class="lnr lnr-arrow-right"></span> <a href="<?= base_url() ?>galeri"><?= $halaman ?></a></p>
            </div>
        </div>
    </div>
</section>
<!-- end:: banner -->

<!-- begin:: content -->
<section class="gallery-area section-gap">
    <div class="container">
        <?php if ($galeri->num_rows() > 0) { ?>
            <div class="row">
                <?php foreach ($galeri->result() as $row) { ?>
                    <div class="col-lg-4">
                        <a href="<?= upload_url() ?>gambar/<?= $row->gambar ?>" class="img-gal">
                            <div class="single-imgs relative">
                                <div class="overlay overlay-bg"></div>
                                <div class="relative">
                                    <img class="img-fluid" src="<?= upload_url() ?>gambar/<?= $row->gambar ?>" alt="">
                                </div>
                            </div>
                        </a>
                    </div>
                <?php } ?>
            </div>
        <?php } else { ?>
            <div class="alert alert-info" role="alert">
                <?= $halaman ?> Tidak Ada!
            </div>
        <?php } ?>
    </div>
</section>
<!-- end:: content -->