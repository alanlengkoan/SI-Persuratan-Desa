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
        <?php foreach ($data->result() as $row) { ?>
            <div class="section-top-border">
                <h3 class="mb-30"><?= $row->organisasi ?></h3>
                <div class="row">
                    <div class="col-md-3">
                        <img src="<?= upload_url('gambar') ?><?= $row->gambar ?>" class="img-fluid" />
                    </div>
                    <div class="col-md-9 mt-sm-20 left-align-p">
                        <p><?= $row->isi ?></p>
                        <a href="<?= base_url() ?>organisasi/detail/<?= base64url_encode($row->id_organisasi) ?>" class="genric-btn info">Detail</a>
                    </div>
                </div>
                <br>
            </div>
        <?php } ?>
    </div>
</section>
<!-- end:: content -->