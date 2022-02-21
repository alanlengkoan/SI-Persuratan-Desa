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

<!-- begin:: category -->
<?php if ($berita->num_rows() > 0) { ?>
    <section class="top-category-widget-area pt-90 pb-90 ">
        <div class="container">
            <div class="row">
                <?php foreach ($kategori as $row) { ?>
                    <div class="col-lg-4">
                        <div class="single-cat-widget">
                            <div class="content relative">
                                <div class="overlay overlay-bg"></div>
                                <a href="<?= base_url() ?>berita/<?= $row->id_kategori ?>">
                                    <div class="thumb">
                                        <img class="content-image img-fluid d-block mx-auto" src="<?= assets_url() ?>page/img/blog/kategori.jpg" alt="">
                                    </div>
                                    <div class="content-details">
                                        <h4 class="content-title mx-auto text-uppercase"><?= $row->nama ?></h4>
                                        <span></span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
<?php } ?>
<!-- end:: category -->

<!-- begin:: content -->
<section class="post-content-area">
    <div class="container">
        <?php if ($berita->num_rows() > 0) { ?>
            <div class="row">
                <div class="col-lg-8 posts-list">
                    <?php foreach ($berita->result() as $row) { ?>
                        <div class="single-post row">
                            <div class="col-lg-3  col-md-3 meta-details">
                                <ul class="tags">
                                    <li><?= $row->kategori ?></li>
                                </ul>
                                <div class="user-details row">
                                    <p class="date col-lg-12 col-md-12 col-6"><?= tgl_indo($row->tgl_publish) ?>&nbsp;<span class="lnr lnr-calendar-full"></span></p>
                                    <p class="view col-lg-12 col-md-12 col-6"><?= $row->jam_publish ?>&nbsp;<span class="lnr lnr-clock"></span></p>
                                </div>
                            </div>
                            <div class="col-lg-9 col-md-9 ">
                                <div class="feature-img">
                                    <img class="img-fluid" src="<?= upload_url() ?>gambar/<?= $row->gambar ?>" alt="<?= $row->judul ?>">
                                </div>
                                <a class="posts-title" href="<?= base_url() ?>berita/detail/<?= $row->id_informasi ?>">
                                    <h3><?= $row->judul ?></h3>
                                </a>
                                <p class="excert">
                                    <?= $row->isi ?>
                                </p>
                                <a href="<?= base_url() ?>berita/detail/<?= $row->id_informasi ?>" class="primary-btn">Detail</a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="col-lg-4 sidebar-widgets">
                    <div class="widget-wrap">
                        <div class="single-sidebar-widget popular-post-widget">
                            <h4 class="popular-title">Berita Terbaru</h4>
                            <div class="popular-post-list">
                                <?php foreach ($populer->result() as $row) { ?>
                                    <div class="single-post-list d-flex flex-row align-items-center">
                                        <div class="thumb">
                                            <img class="img-fluid" style="width: 100%;" src="<?= upload_url() ?>gambar/<?= $row->gambar ?>" alt="<?= $row->judul ?>">
                                        </div>
                                        <div class="details">
                                            <a href="<?= base_url() ?>berita/detail/<?= $row->id_informasi ?>">
                                                <h6><?= $row->judul ?></h6>
                                            </a>
                                            <p><?= $row->jam_publish ?></p>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="single-sidebar-widget post-category-widget">
                            <h4 class="category-title">Kategori</h4>
                            <ul class="cat-list">
                                <?php foreach ($kategori as $row) { ?>
                                    <li>
                                        <a href="<?= base_url() ?>berita/<?= $row->id_kategori ?>" class="d-flex justify-content-between">
                                            <p><?= $row->nama ?></p>
                                            <p><?= $row->jumlah ?></p>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                        <div class="single-sidebar-widget tag-cloud-widget">
                            <h4 class="tagcloud-title">Tag</h4>
                            <ul>
                                <?php foreach ($kategori as $row) { ?>
                                    <li>
                                        <a href="<?= base_url() ?>berita/<?= $row->id_kategori ?>"><?= $row->nama ?></a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <div class="pt-3">
                <div class="alert alert-info" role="alert">
                    <?= $halaman ?> Tidak Ada!
                </div>
            </div>
        <?php } ?>
    </div>
</section>
<!-- end:: content -->