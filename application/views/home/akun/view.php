<!-- begin:: banner -->
<section class="about-banner relative" id="home">
    <div class="overlay"></div>
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                <h1 class="text-white">
                    <?= $halaman ?>
                </h1>
                <p class="text-white link-nav"><a href="<?= base_url() ?>">Beranda </a> <span class="lnr lnr-arrow-right"></span> <a href="<?= base_url() ?>tentang"><?= $halaman ?></a></p>
            </div>
        </div>
    </div>
</section>
<!-- end:: banner -->

<!-- begin:: content -->
<section class="contact-page-area section-gap">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-akun-tab" data-toggle="pill" href="#pills-akun" role="tab" aria-controls="pills-akun" aria-selected="true">Akun</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-keamanan-tab" data-toggle="pill" href="#pills-keamanan" role="tab" aria-controls="pills-keamanan" aria-selected="false">Keamanan</a>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-akun" role="tabpanel" aria-labelledby="pills-akun-tab">
                        <form id="form-akun" action="<?= base_url() ?>simpan_akun" method="POST">
                            <div class="form-group">
                                <label>Nama&nbsp;*</label>
                                <input type="text" class="form-control form-control-sm" name="inpnama" id="inpnama" value="<?= $data->nama ?>" placeholder="Masukkan nama" />
                            </div>
                            <div class="form-group">
                                <label>Email&nbsp;*</label>
                                <input type="email" class="form-control form-control-sm" name="inpemail" id="inpemail" value="<?= $data->email ?>" placeholder="Masukkan email" />
                            </div>
                            <div class="form-group">
                                <label>Username&nbsp;*</label>
                                <input type="text" class="form-control form-control-sm" name="inpusername" id="inpusername" value="<?= $data->username ?>" placeholder="Masukkan username" />
                            </div>
                            <button type="submit" id="simpan-akun" class="btn btn-primary btn-sm"><i class="fa fa-save"></i>&nbsp;Simpan</button>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="pills-keamanan" role="tabpanel" aria-labelledby="pills-keamanan-tab">
                        <form id="form-keamanan" action="<?= base_url() ?>simpan_keamanan" method="POST">
                            <div class="form-group">
                                <label>Password Lama&nbsp;*</label>
                                <input type="text" class="form-control form-control-sm" name="inppasswordlama" id="inppasswordlama" placeholder="Masukkan password lama" />
                            </div>
                            <div class="form-group">
                                <label>Password Baru&nbsp;*</label>
                                <input type="password" class="form-control form-control-sm" name="inppasswordbaru" id="inppasswordbaru" placeholder="Masukkan password baru" />
                            </div>
                            <div class="form-group">
                                <label>Ulangi Password Baru&nbsp;*</label>
                                <input type="password" class="form-control form-control-sm" name="inpkonfirmasipassword" id="inpkonfirmasipassword" placeholder="Konfirmasi password baru" />
                            </div>
                            <button type="submit" id="simpan-keamanan" class="btn btn-primary btn-sm"><i class="fa fa-save"></i>&nbsp;Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end:: content -->