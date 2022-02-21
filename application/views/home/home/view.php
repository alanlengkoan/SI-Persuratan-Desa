<!-- begin:: banner -->
<section class="banner-area relative" id="home">
    <div class="overlay"></div>
    <div class="container">
        <div class="row fullscreen d-flex align-items-center justify-content-between">
            <div class="banner-content col-lg-9 col-md-12">
                <h1 class="text-uppercase">
                    SELAMAT DATANG DI WEBSITE SMA NEGERI 12 TANA TORAJA
                </h1>
            </div>
        </div>
    </div>
</section>
<!-- end:: banner -->

<!-- begin:: berita -->
<?php if ($berita->num_rows() > 0) { ?>
    <section class="blog-area section-gap">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="menu-content pb-70 col-lg-8">
                    <div class="title text-center">
                        <h1 class="mb-10">Berita</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php foreach ($berita->result() as $row) { ?>
                    <div class="col-lg-3 col-md-6 single-blog">
                        <div class="thumb">
                            <img class="img-fluid" src="<?= upload_url() ?>gambar/<?= $row->gambar ?>" alt="<?= $row->judul ?>">
                        </div>
                        <p class="meta"><?= tgl_indo($row->tgl_publish) ?> | <a href="#"><?= $row->kategori ?></a></p>
                        <a href="<?= base_url() ?>berita/detail/<?= $row->id_informasi ?>">
                            <h5><?= $row->judul ?></h5>
                        </a>
                        <p>
                            <?= substr($row->isi, 0, 150) ?> ...
                        </p>
                        <a href="<?= base_url() ?>berita/detail/<?= $row->id_informasi ?>" class="details-btn d-flex justify-content-center align-items-center"><span class="details">Details</span><span class="lnr lnr-arrow-right"></span></a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
<?php } ?>
<!-- end:: berita -->

<!-- begin:: galeri -->
<?php if ($galeri->num_rows() > 0) { ?>
    <section class="gallery-area section-gap">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="menu-content pb-70 col-lg-8">
                    <div class="title text-center">
                        <h1 class="mb-10">Galeri</h1>
                    </div>
                </div>
            </div>
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
        </div>
    </section>
<?php } ?>
<!-- end:: galeri -->

<!-- begin:: tentang -->
<section class="contact-page-area section-gap">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="menu-content pb-70 col-lg-8">
                <div class="title text-center">
                    <h1 class="mb-10">Tentang Kami</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 no-padding info-area-left">
                <img class="img-fluid" src="<?= assets_url() ?>page/img/about-img.jpg" alt="">
            </div>
            <div class="col-lg-6 info-area-right">
                <h1>Selamat Datang di website SMA 12 TANA TORAJA</h1>
                <p>
                    Salam Sejahtera Bagi Kita Semua.
                </p>
                <p>
                    Puji syukur kami panjatkan kepada Tuhan Yang maha Esa atas limpahan rahmat dan karunia-Nya sehingga SMA 12 TANA TORAJA berhasil membangun website, Kehadiran Website SMA 12 TANA TORAJA diharapkan dapat memudahkan penyampaian informasi secara terbuka kepada warga sekolah, alumni dan masyarakat serta instansi lain yang terkait.
                </p>
                <br>
                <p>
                    Semoga dengan kehadiran Website ini akan terjalin informasi, komunikasi antar alumni khususnya sebagai salah satu upaya sekolah mendapatkan informasi akan penelusuran tamatan/ alumni dimana saja berada. Dapat memperoleh informasi dengan cepat sehingga dapat mengikuti perkembangan dalam pengetahuan yang berkembang dengan cepat pula.
                </p>
            </div>
        </div>
    </div>
</section>
<!-- end:: tentang -->

<!-- begin:: kontak -->
<section class="contact-page-area section-gap">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="menu-content pb-70 col-lg-8">
                <div class="title text-center">
                    <h1 class="mb-10">Kontak Kami</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 d-flex flex-column address-wrap">
                <div class="single-contact-address d-flex flex-row">
                    <div class="icon">
                        <span class="lnr lnr-home"></span>
                    </div>
                    <div class="contact-details">
                        <h5><?= (empty(get_sistem_detail()->alamat) ? '-' : get_sistem_detail()->alamat) ?></h5>
                        <p>Alamat</p>
                    </div>
                </div>
                <div class="single-contact-address d-flex flex-row">
                    <div class="icon">
                        <span class="lnr lnr-phone-handset"></span>
                    </div>
                    <div class="contact-details">
                        <h5><?= (empty(get_sistem_detail()->telepon) ? '-' : get_sistem_detail()->telepon) ?></h5>
                        <p>Telepon</p>
                    </div>
                </div>
                <div class="single-contact-address d-flex flex-row">
                    <div class="icon">
                        <span class="lnr lnr-envelope"></span>
                    </div>
                    <div class="contact-details">
                        <h5><?= (empty(get_sistem_detail()->email) ? '-' : get_sistem_detail()->email) ?></h5>
                        <p>Email</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15933.920959498695!2d119.4743838!3d-3.2299623!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xd824f6cdd616641d!2sSMA%20Negeri%2012%20Tana%20Toraja!5e0!3m2!1sid!2sid!4v1634106491600!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </div>
</section>
<!-- begin:: kontak -->