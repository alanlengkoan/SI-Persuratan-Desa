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
                        <table class="table table-striped table-bordered nowrap" id="tabel-informasi">
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
            <form id="form-add-upd" action="<?= admin_url() ?>informasi/process_save" method="POST">
                <!-- begin:: id -->
                <input type="hidden" name="inpidinformasi" id="inpidinformasi" />
                <!-- end:: id -->

                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Judul&nbsp;*</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="inpjudul" id="inpjudul" placeholder="Masukkan nama" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Kategori&nbsp;*</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="inpidkategori" name="inpidkategori">
                                <option value="">- Pilih -</option>
                                <?php foreach ($kategori as $key => $value) { ?>
                                    <option value="<?= $value->id_kategori ?>"><?= $value->nama ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Gambar *</label>
                        <div class="col-sm-10">
                            <div id="lihat_gambar"></div>
                            <input type="file" class="form-control" name="inpgambar" id="inpgambar" />
                            <div id="centang_gambar"></div>
                            <p>File dengan tipe (*.jpg,*.jpeg,*.png) Max. 20MB</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Isi&nbsp;*</label>
                        <div class="col-sm-10">
                            <textarea name="inpisi" id="inpisi" cols="30" rows="10"></textarea>
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