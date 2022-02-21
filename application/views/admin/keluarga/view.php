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
                        <table class="table table-striped table-bordered nowrap" id="tabel-keluarga">
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
            <form id="form-add-upd" action="<?= admin_url() ?>keluarga/process_save" method="POST">
                <!-- begin:: id -->
                <input type="hidden" name="inpidkeluarga" id="inpidkeluarga" />
                <!-- end:: id -->

                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Nomor KK *</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control inputNumber" pattern="\d*" maxlength="16" minlength="16" name="inpnokk" id="inpnokk" placeholder="Masukkan nomor kk" />
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Nama KK *</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="inpnmkk" id="inpnmkk" placeholder="Masukkan nama kk" />
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Alamat *</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="inpalamat" id="inpalamat" placeholder="Masukkan alamat"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">RT/RW *</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="inprtrw" id="inprtrw" placeholder="Masukkan rt/rw" />
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Kode Pos *</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="inpkdpos" id="inpkdpos" placeholder="Masukkan kode pos" />
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Desa/Kelurahan *</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="inpdesakel" id="inpdesakel" placeholder="Masukkan desa/kelurahan" />
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Kecamatan *</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="inpkec" id="inpkec" placeholder="Masukkan kecamatan" />
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Kabupaten/Kota *</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="inpkabkot" id="inpkabkot" placeholder="Masukkan kabupaten/kota" />
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Provinsi *</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="inpprovinsi" id="inpprovinsi" placeholder="Masukkan nama" />
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