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
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered display no-wrap" style="width:100%" id="tabel-siswa-aktif">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>NIS</th>
                                                <th>Nama</th>
                                                <th>Tempat Lahir</th>
                                                <th>Tanggal Lahir</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Ortu Wali</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            foreach ($aktif as $key => $value) { ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td><?= $value->nis ?></td>
                                                    <td><?= $value->nama ?></td>
                                                    <td><?= $value->tmp_lahir ?></td>
                                                    <td><?= tgl_indo($value->tgl_lahir) ?></td>
                                                    <td><?= ($value->kelamin === 'L' ? 'Laki - laki' : 'Perempuan') ?></td>
                                                    <td><?= $value->ortu_wali ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="alumni" role="tabpanel">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered display no-wrap" style="width:100%" id="tabel-siswa-alumni">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>NIS</th>
                                                <th>Nama</th>
                                                <th>Tempat Lahir</th>
                                                <th>Tanggal Lahir</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Ortu Wali</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            foreach ($alumni as $key => $value) { ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td><?= $value->nis ?></td>
                                                    <td><?= $value->nama ?></td>
                                                    <td><?= $value->tmp_lahir ?></td>
                                                    <td><?= tgl_indo($value->tgl_lahir) ?></td>
                                                    <td><?= ($value->kelamin === 'L' ? 'Laki - laki' : 'Perempuan') ?></td>
                                                    <td><?= $value->ortu_wali ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end:: content -->