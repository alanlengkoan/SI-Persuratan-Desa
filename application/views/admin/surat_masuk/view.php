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
                        <table class="table table-striped table-bordered nowrap" id="tabel-surat-masuk" style="width: 100%;">
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
            <form id="form-add-upd" action="<?= admin_url() ?>surat_masuk/process_save" method="POST">
                <!-- begin:: id -->
                <input type="hidden" name="inpidsuratmasuk" id="inpidsuratmasuk" />
                <input type="hidden" id="<?= $this->security->get_csrf_token_name() ?>" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
                <!-- end:: id -->

                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Nomor Surat *</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="inpnosurat" id="inpnosurat" placeholder="Masukkan nomor surat" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Tanggal Surat *</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" name="inptglsurat" id="inptglsurat" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Tanggal Masuk *</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" name="inptglmasuk" id="inptglmasuk" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Jenis Surat *</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="inpidsuratjenis" id="inpidsuratjenis">
                                <option value="">- Pilih -</option>
                                <?php foreach ($jenis_surat as $key => $row) { ?>
                                    <option value="<?= $row->id_surat_jenis ?>"><?= $row->nama ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Asal Surat *</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="inpidsuratasal" id="inpidsuratasal">
                                <option value="">- Pilih -</option>
                                <?php foreach ($asal_surat as $key => $row) { ?>
                                    <option value="<?= $row->id_surat_asal ?>"><?= $row->nama ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Sifat Surat *</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="inpidsuratsifat" id="inpidsuratsifat">
                                <option value="">- Pilih -</option>
                                <?php foreach ($sifat_surat as $key => $row) { ?>
                                    <option value="<?= $row->id_surat_sifat ?>"><?= $row->nama ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Perihal *</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="inpperihal" id="inpperihal" placeholder="Masukkan perihal" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Tipe Arsip *</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="inparsiptipe" id="inparsiptipe">
                                <option value="">- Pilih -</option>
                                <option value="pdf">Pdf</option>
                                <option value="doc">Doc</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Arsip *</label>
                        <div class="col-sm-9">
                            <div id="lihat_gambar"></div>
                            <input type="file" class="form-control" name="inparsip" id="inparsip" />
                            <div id="centang_gambar"></div>
                            <p>File dengan tipe (*.pdf,*.doc/docx,*.mp4) Max. 20MB</p>
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