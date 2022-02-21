<!-- begin:: banner -->
<section class="about-banner relative" id="home">
    <div class="overlay"></div>
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                <h1 class="text-white">
                    <?= $halaman ?>
                </h1>
                <p class="text-white link-nav"><a href="<?= base_url() ?>">Beranda </a> <span class="lnr lnr-arrow-right"></span><?= $halaman ?></p>
            </div>
        </div>
    </div>
</section>
<!-- end:: banner -->

<!-- begin:: content -->
<section class="post-content-area single-post-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 posts-list">
                <div class="single-post row">
                    <div class="col-lg-12">
                        <div class="feature-img">
                            <img class="img-fluid" src="<?= upload_url() ?>gambar/<?= $row->gambar ?>" alt="">
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-9">
                        <h3 class="mt-20 mb-20"><?= $row->organisasi ?></h3>
                        <?= $row->isi ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end:: content -->