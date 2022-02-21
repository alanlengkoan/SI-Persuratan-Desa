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
            <div class="col-lg-8 posts-list">
                <div class="single-post row">
                    <div class="col-lg-12">
                        <div class="feature-img">
                            <img class="img-fluid" src="<?= upload_url() ?>gambar/<?= $berita->gambar ?>" alt="">
                        </div>
                    </div>
                    <div class="col-lg-3  col-md-3 meta-details">
                        <ul class="tags">
                            <li><?= $berita->kategori ?></li>
                        </ul>
                        <div class="user-details row">
                            <p class="date col-lg-12 col-md-12 col-6"><?= tgl_indo($berita->tgl_publish) ?>&nbsp;<span class="lnr lnr-calendar-full"></span></p>
                            <p class="view col-lg-12 col-md-12 col-6"><?= $berita->jam_publish ?>&nbsp;<span class="lnr lnr-clock"></span></p>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-9">
                        <h3 class="mt-20 mb-20"><?= $berita->judul ?></h3>
                        <?= $berita->isi ?>
                    </div>
                </div>
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
    </div>
</section>
<!-- end:: content -->