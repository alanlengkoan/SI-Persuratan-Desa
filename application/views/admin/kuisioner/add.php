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
                <!-- begin:: form -->
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <h5 class="w-75 p-2">Kuisioner</h5>
                            </div>
                            <div class="col-lg-6 text-right">
                            </div>
                        </div>
                    </div>
                    <div class="card-block table-border-style">
                        <form>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="inpnama" id="inpnama" placeholder="<?= $kuisioner->nama ?>" readonly="readonly" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- end:: form -->
                <!-- begin:: table -->
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
                        <table class="table table-striped table-bordered nowrap" id="tabel-kuisioner-soal">
                        </table>
                    </div>
                </div>
                <!-- end:: table -->
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
            <form id="form-add-upd" action="<?= admin_url() ?>kuisioner/process_save_soal" method="POST">
                <!-- begin:: id -->
                <input type="hidden" name="inpidkuisionersoal" id="inpidkuisionersoal" />
                <input type="hidden" name="inpidkuisioner" id="inpidkuisioner" value="<?= $kuisioner->id_kuisioner ?>" />
                <!-- end:: id -->

                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Soal&nbsp;*</label>
                        <div class="col-sm-9">
                            <textarea name="inpsoal" id="inpsoal" class="form-control" placeholder="Masukkan soal"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Pilihan A&nbsp;*</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="inppila" id="inppila" placeholder="Masukkan pilihan A" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Pilihan B&nbsp;*</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="inppilb" id="inppilb" placeholder="Masukkan pilihan B" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Pilihan C&nbsp;*</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="inppilc" id="inppilc" placeholder="Masukkan pilihan C" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Pilihan D&nbsp;*</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="inppild" id="inppild" placeholder="Masukkan pilihan D" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Pilihan E&nbsp;*</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="inppile" id="inppile" placeholder="Masukkan pilihan E" />
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