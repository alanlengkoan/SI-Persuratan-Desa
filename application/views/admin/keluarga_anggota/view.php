<!-- begin:: breadcumb -->
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="page-header-title">
                    <h4 class="m-b-10"><?= $title ?></h4>
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
                                <h5 class="w-75 p-2">Daftar <?= $title ?></h5>
                            </div>
                            <div class="col-lg-6 text-right">
                                <button type="button" id="btn-add" class="btn btn-success btn-sm waves-effect" data-toggle="modal" data-target="#modal-add-upd"><i class="fa fa-plus"></i>&nbsp;Tambah</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-block table-border-style">
                        <table class="table table-striped table-bordered nowrap" id="tabel-keluarga-anggota">
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
                <h4 class="modal-title"><span id="judul-add-upd"></span> <?= $title ?></h4>
            </div>
            <form id="form-add-upd" action="<?= admin_url() ?>keluarga_anggota/process_save" method="POST">
                <!-- begin:: id -->
                <input type="hidden" name="inpidkeluargaanggota" id="inpidkeluargaanggota" />
                <input type="hidden" id="<?= $this->security->get_csrf_token_name() ?>" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
                <!-- end:: id -->


                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Nomor KK *</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="inpnokk" id="inpnokk">
                                <option value="">- Pilih -</option>
                                <?php foreach ($keluarga as $key => $row) { ?>
                                    <option value="<?= $row->no_kk ?>"><?= $row->no_kk ?> - <?= $row->nama_kk ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Nomor KTP *</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control inputNumber" name="inpnoktp" id="inpnoktp" pattern="\d*" maxlength="16" minlength="16" placeholder="Masukkan nomor ktp" />
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Nama *</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="inpnama" id="inpnama" placeholder="Masukkan nama" />
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Jenis Kelamin *</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="inpkelamin" id="inpkelamin">
                                <option value="">- Pilih -</option>
                                <option value="L">Laki - laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Tempat Lahir *</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="inptmplahir" id="inptmplahir" placeholder="Masukkan tempat lahir" />
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Tanggal Lahir *</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" name="inptgllahir" id="inptgllahir" placeholder="Masukkan tanggal lahir" />
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Agama *</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="inpidagama" id="inpidagama">
                                <option value="">- Pilih -</option>
                                <?php foreach ($agama as $key => $row) { ?>
                                    <option value="<?= $row->id_agama ?>"><?= $row->nama ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Pekerjaan *</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="inpidpekerjaan" id="inpidpekerjaan">
                                <option value="">- Pilih -</option>
                                <?php foreach ($pekerjaan as $key => $row) { ?>
                                    <option value="<?= $row->id_pekerjaan ?>"><?= $row->nama ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Kewarganegaraan *</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="inpkewarganegaraan" id="inpkewarganegaraan">
                                <option value="">- Pilih -</option>
                                <option value="wni">WNI</option>
                                <option value="wna">WNA</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Pendidikan *</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="inppendidikan" id="inppendidikan" placeholder="Masukkan pendidikan terakhir" />
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Status Nikah *</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="inpstatusnikah" id="inpstatusnikah">
                                <option value="">- Pilih -</option>
                                <option value="y">Iya</option>
                                <option value="n">Tidak</option>
                            </select>
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