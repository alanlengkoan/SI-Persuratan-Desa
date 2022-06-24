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
                <!-- begin:: form pasangan -->
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <h5 class="w-75 p-2"><?= $title ?></h5>
                            </div>
                            <div class="col-lg-6 text-right">
                            </div>
                        </div>
                    </div>
                    <div class="card-block">
                        <form>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nomor Surat</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control-plaintext" value="<?= $data->no_surat ?>" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tanggal Surat</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control-plaintext" value="<?= tgl_indo($data->tgl_surat) ?>" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tanggal Keluar</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control-plaintext" value="<?= tgl_indo($data->tgl_keluar) ?>" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Jenis Surat</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control-plaintext" value="<?= $data->jenis_surat ?>" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tujuan Surat</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control-plaintext" value="<?= $data->tujuan_surat ?>" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Perihal</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control-plaintext" value="<?= $data->perihal ?>" />
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Dokumen Lampiran</label>
                                <div class="col-sm-9">
                                    <embed style="height: 500px;" src="<?= upload_url('pdf') ?><?= $data->dok_lampiran ?>" type="application/pdf" frameBorder="0" scrolling="auto" height="100%" width="100%"></embed>
                                </div>
                            </div>
                            <?php if ($data->approve === '1') { ?>
                                <hr>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Arsip</label>
                                    <div class="col-sm-9">
                                        <embed style="height: 500px;" src="<?= admin_url() ?>surat_keluar/print/<?= base64url_encode($data->id_surat_keluar) ?>" type="application/pdf" frameBorder="0" scrolling="auto" height="100%" width="100%"></embed>
                                    </div>
                                </div>
                            <?php } ?>
                        </form>
                    </div>
                </div>
                <!-- end:: form pasangan -->
            </div>
        </div>
    </div>
</div>
<!-- end:: content -->