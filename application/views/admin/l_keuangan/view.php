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
                                <h5 class="w-75 p-2"><?= $halaman ?></h5>
                            </div>
                            <div class="col-lg-6 text-right">
                            </div>
                        </div>
                    </div>
                    <div class="card-block table-border-style">
                        <form id="form-report" action="<?= admin_url() ?>laporan/l_keuangan_show" method="POST">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Jenis Dana&nbsp;*</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="id_dana" name="id_dana">
                                        <option value="">- Pilih -</option>
                                        <?php foreach ($dana->result() as $key => $value) { ?>
                                            <option value="<?= $value->id_dana ?>"><?= $value->nama ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Dari Tanggal *</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" name="tgl_awal" id="tgl_awal" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Sampai Tanggal *</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" name="tgl_akhir" id="tgl_akhir" />
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light" id="proses"><i class="fa fa-eye"></i>&nbsp;Proses</button>
                            <button type="button" class="btn btn-success btn-sm waves-effect waves-light" id="cetak"><i class="fa fa-print"></i>&nbsp;Cetak</button>
                        </form>
                    </div>
                </div>
                <!-- begin:: untuk tabel -->
                <div id="lihat-tabel"></div>
                <!-- end:: untuk tabel -->
            </div>
        </div>
    </div>
</div>
<!-- end:: content -->