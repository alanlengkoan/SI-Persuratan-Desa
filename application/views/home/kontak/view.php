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
<section class="contact-page-area section-gap">
    <div class="container">
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
<!-- end:: content -->