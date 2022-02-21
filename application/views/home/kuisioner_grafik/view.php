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
                <form id="form-login" action="<?= base_url() ?>auth/check_validation" method="post">
                    <div class="form-group">
                        <label>Nis&nbsp;*</label>
                        <input type="text" class="form-control form-control-sm" name="username" id="username" placeholder="Masukkan nis Anda" />
                    </div>
                    <div class="form-group">
                        <label>Password&nbsp;*</label>
                        <input type="password" class="form-control form-control-sm" name="password" id="password" placeholder="Masukkan password Anda" />
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" id="login" class="btn btn-primary btn-sm">Login</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-12">
                <?php foreach ($kuisional_soal->result() as $value) { ?>
                    <figure class="highcharts-figure">
                        <div id="<?= $value->id_kuisioner_soal ?>"></div>
                    </figure>
                    <br>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
<!-- end:: content -->