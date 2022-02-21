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
                        <table class="table table-striped table-bordered nowrap" id="tabel-guru">
                        </table>
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
            <form id="form-add-upd" action="<?= admin_url() ?>guru/process_save" method="POST">
                <!-- begin:: id -->
                <input type="hidden" name="inpidguru" id="inpidguru" />
                <!-- end:: id -->

                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Nip&nbsp;*</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control inputNumber" pattern="\d*" maxlength="18" minlength="18" name="inpnip" id="inpnip" placeholder="Masukkan nip" />
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
                        <label class="col-sm-3 col-form-label">Jabatan&nbsp;*</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="inpidjabatan" name="inpidjabatan">
                                <option value="">- Pilih -</option>
                                <?php foreach ($jabatan as $key => $value) { ?>
                                    <option value="<?= $value->id_jabatan ?>"><?= $value->nama ?></option>
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
                        <label class="col-sm-3 col-form-label">Alamat&nbsp;*</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="inpalamat" id="inpalamat" cols="30" rows="10" placeholder="Masukkan alamat"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Pendidikan&nbsp;*</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="inppendidikan" id="inppendidikan" placeholder="Masukkan pendidikan terakhir" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Tahun Masuk&nbsp;*</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="inpthnmasuk" id="inpthnmasuk" placeholder="Masukkan tahun masuk" />
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