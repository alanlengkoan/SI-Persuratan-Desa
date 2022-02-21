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
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered display no-wrap" style="width:100%" id="tabel-guru">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>IP Address</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Telepon</th>
                                        <th>Email</th>
                                        <th>Alamat</th>
                                        <th>Keperluan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($data->result() as $key => $value) { ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $value->ip_address ?></td>
                                            <td><?= $value->nama ?></td>
                                            <td><?= ($value->kelamin === 'L' ? 'Laki - laki' : 'Perempuan') ?></td>
                                            <td><?= $value->telepon ?></td>
                                            <td><?= $value->email ?></td>
                                            <td><?= $value->alamat ?></td>
                                            <td><?= $value->keperluan ?></td>
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
<!-- end:: content -->