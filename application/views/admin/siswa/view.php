<!-- begin:: breadcumb -->
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="page-header-title">
                    <h4 class="m-b-10"><?= $halaman ?></h4>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.html">
                            <i class="feather icon-home"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#!">Dashboard</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- end:: breadcumb -->

<!-- begin:: content -->
<div class="pcoded-inner-content">
    <div class="main-body">
        <div class="page-wrapper">
            <div class="page-body">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <h5 class="w-75 p-2">Daftar <?= $halaman ?></h5>
                            </div>
                            <div class="col-lg-6 text-right">
                                <button type="button" id="btn-add" class="btn btn-success btn-sm waves-effect" data-toggle="modal" data-target="#modal-add-upd"><i class="fa fa-plus"></i>&nbsp;Tambah</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-block table-border-style">
                        <ul class="nav nav-tabs md-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#aktif" role="tab">Aktif</a>
                                <div class="slide"></div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#alumni" role="tab">Alumni</a>
                                <div class="slide"></div>
                            </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content card-block">
                            <div class="tab-pane active" id="aktif" role="tabpanel">
                                <table class="table table-striped table-bordered nowrap" id="tabel-siswa-aktif" width="100%">
                                </table>
                            </div>
                            <div class="tab-pane" id="alumni" role="tabpanel">
                                <table class="table table-striped table-bordered nowrap" id="tabel-siswa-alumni" width="100%">
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end:: content -->

<!-- begin:: modal tambah & ubah -->
<div class="modal fade" id="modal-add-upd" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><span id="judul-add-upd"></span> <?= $halaman ?></h4>
            </div>
            <form id="form-add-upd" action="<?= admin_url() ?>siswa/process_save" method="POST">
                <!-- begin:: id -->
                <input type="hidden" name="inpidsiswa" id="inpidsiswa" />
                <input type="hidden" name="inpidusers" id="inpidusers" />
                <!-- end:: id -->

                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Nis&nbsp;*</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control inputNumber" pattern="\d*" maxlength="10" minlength="10" name="inpnis" id="inpnis" placeholder="Masukkan nis" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Nama&nbsp;*</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="inpnama" id="inpnama" placeholder="Masukkan nama" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Agama&nbsp;*</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="inpidagama" name="inpidagama">
                                <option value="">- Pilih -</option>
                                <?php foreach ($agama as $key => $value) { ?>
                                    <option value="<?= $value->id_agama ?>"><?= $value->nama ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Kelas&nbsp;*</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="inpidkelas" name="inpidkelas">
                                <option value="">- Pilih -</option>
                                <?php foreach ($kelas as $key => $value) { ?>
                                    <option value="<?= $value->id_kelas ?>"><?= $value->nama ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Jenis Kelamin&nbsp;*</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="inpkelamin" id="inpkelamin">
                                <option value="">- Pilih -</option>
                                <option value="L">Laki-Laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Tempat Lahir&nbsp;*</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="inptmplahir" id="inptmplahir" placeholder="Masukkan tempat lahir" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Tanggal Lahir&nbsp;*</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" name="inptgllahir" id="inptgllahir" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Alamat&nbsp;*</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="inpalamat" id="inpalamat" cols="30" rows="10" placeholder="Masukkan alamat"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Orang Tua Wali&nbsp;*</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="inportuwali" id="inportuwali" placeholder="Masukkan orang tua wali" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm waves-effect" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp;Batal</button>
                    <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light" id="save"><i class="fa fa-save"></i>&nbsp;Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end:: modal tambah & ubah -->